<?php

namespace App\Services\Cotation;

use App\Mail\QuoteReplyMail;
use App\Models\QuoteRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

/**
 * Orchestrateur du traitement automatique des demandes de cotation.
 *
 * Étape 1 : lecture des emails + détection des demandes de cotation
 * Étape 2 : extraction des produits demandés
 * Étape 3 : recherche des fournisseurs locaux + document interne fournisseurs
 * Étape 4 : calcul des prix de vente (+marge) + devis client PDF
 * Étape 5 : envoi du devis au client (après validation manuelle par défaut)
 *
 * L'administrateur est notifié par email à la fin de chaque étape.
 */
class CotationPipelineService
{
    public function __construct(
        private EmailFetcherService $fetcher,
        private QuoteDetectionService $detector,
        private ProductExtractionService $extractor,
        private SupplierMatchingService $matcher,
        private QuotePdfService $pdfService,
        private AdminNotifierService $notifier,
    ) {
    }

    /**
     * Point d'entrée : traite les nouveaux emails.
     *
     * @return array{fetched: int, detected: int, processed: int}
     */
    public function run(): array
    {
        $emails = $this->fetcher->fetchNewEmails();
        $detected = 0;
        $processed = 0;

        foreach ($emails as $email) {
            // Anti-doublon
            if (QuoteRequest::where('message_id', $email['message_id'])->exists()) {
                continue;
            }

            // ÉTAPE 1 : détection
            if ($this->detector->shouldIgnoreSender($email['from_email'])) {
                continue;
            }

            $score = $this->detector->score($email['subject'], $email['body']);

            if ($score < (int) config('cotation.detection_threshold', 30)) {
                continue; // Email normal, on ne crée rien
            }

            $request = QuoteRequest::create([
                'message_id' => $email['message_id'],
                'from_email' => $email['from_email'],
                'from_name' => $email['from_name'],
                'subject' => $email['subject'],
                'body' => $email['body'],
                'received_at' => $email['received_at'],
                'status' => QuoteRequest::STATUS_DETECTE,
                'detection_score' => $score,
            ]);

            $detected++;

            $this->notifier->notify($request, 'Étape 1 — Demande de cotation détectée',
                'Un email a été identifié comme demande de cotation (score : ' . $score . '/100). Le traitement automatique continue.',
                ['Score de détection' => $score . '/100']
            );

            try {
                $this->processRequest($request);
                $processed++;
            } catch (\Throwable $e) {
                Log::error('[Cotation] Erreur de traitement demande #' . $request->id . ' : ' . $e->getMessage());
                $request->update([
                    'status' => QuoteRequest::STATUS_ERREUR,
                    'error_message' => $e->getMessage(),
                ]);
                $this->notifier->notify($request, 'Erreur de traitement',
                    'Le traitement automatique a échoué. Ouvrez la demande dans l\'administration pour la traiter manuellement.',
                    ['Erreur' => $e->getMessage()]
                );
            }
        }

        return ['fetched' => count($emails), 'detected' => $detected, 'processed' => $processed];
    }

    /**
     * Étapes 2 à 4 (et 5 si envoi automatique activé) pour une demande.
     */
    public function processRequest(QuoteRequest $request): void
    {
        // ÉTAPE 2 : extraction des produits
        $result = $this->extractor->extract((string) $request->subject, (string) $request->body);
        $items = $result['items'];

        $request->extraction_method = $result['method'];

        if (empty($items)) {
            $request->status = QuoteRequest::STATUS_ANALYSE;
            $request->save();

            $this->notifier->notify($request, 'Étape 2 — Aucun produit extrait',
                'La demande a été détectée mais aucun produit n\'a pu être extrait automatiquement. Ajoutez les produits manuellement dans l\'administration.',
                ['Méthode d\'extraction' => $result['method']]
            );

            return;
        }

        foreach ($items as $item) {
            $request->items()->create([
                'product_name_raw' => $item['name'],
                'quantity' => $item['quantity'],
                'unit' => $item['unit'],
            ]);
        }

        $request->status = QuoteRequest::STATUS_ANALYSE;
        $request->save();

        $this->notifier->notify($request, 'Étape 2 — Produits extraits',
            count($items) . ' produit(s) identifié(s) dans la demande (méthode : ' . $result['method'] . ').',
            ['Produits' => collect($items)->map(fn ($i) => $i['quantity'] . ' ' . $i['unit'] . ' — ' . $i['name'])->implode(' ; ')]
        );

        // ÉTAPE 3 : recherche fournisseurs + document interne
        $found = 0;
        foreach ($request->items as $item) {
            if ($this->matcher->match($item)) {
                $found++;
            }
        }

        $this->pdfService->generateSupplierDoc($request);

        $totalItems = $request->items()->count();

        $this->notifier->notify($request, 'Étape 3 — Fournisseurs recherchés',
            $found . '/' . $totalItems . ' produit(s) trouvé(s) chez vos fournisseurs. Le document interne (contacts, liens, prix d\'achat) est prêt.',
            ['Document fournisseurs' => 'Disponible dans l\'administration (confidentiel)']
        );

        // ÉTAPE 4 : devis client (+marge)
        if ($found === $totalItems && $totalItems > 0) {
            $this->pdfService->generateClientPdf($request);

            $request->status = QuoteRequest::STATUS_PRET;
            $request->client_message = $this->defaultClientMessage($request);
            $request->save();

            $this->notifier->notify($request, 'Étape 4 — Devis prêt',
                'Le devis client ' . $request->quote_number . ' a été généré (total : ' . number_format($request->total(), 0, ',', ' ') . ' FCFA). '
                . (config('cotation.auto_send') ? 'Envoi automatique en cours.' : 'Connectez-vous à l\'administration pour le valider et l\'envoyer.'),
                ['Total devis' => number_format($request->total(), 0, ',', ' ') . ' FCFA']
            );

            // ÉTAPE 5 : envoi automatique (désactivé par défaut)
            if (config('cotation.auto_send')) {
                $this->sendToClient($request);
            }
        } else {
            $this->notifier->notify($request, 'Étape 4 — Validation requise',
                'Certains produits n\'ont pas de prix fournisseur. Complétez les prix manquants dans l\'administration pour générer le devis.',
                ['Produits sans prix' => (string) ($totalItems - $found)]
            );
        }
    }

    /**
     * ÉTAPE 5 : envoi du devis au client.
     */
    public function sendToClient(QuoteRequest $request): void
    {
        if (empty($request->client_pdf_path)) {
            $this->pdfService->generateClientPdf($request);
            $request->refresh();
        }

        Mail::to($request->from_email)->send(new QuoteReplyMail($request));

        $request->update([
            'status' => QuoteRequest::STATUS_ENVOYE,
            'sent_at' => now(),
        ]);

        $this->notifier->notify($request, 'Étape 5 — Devis envoyé au client',
            'Le devis ' . $request->quote_number . ' a été envoyé à ' . $request->from_email . ' avec le PDF en pièce jointe.',
            ['Envoyé le' => now()->format('d/m/Y H:i')]
        );
    }

    private function defaultClientMessage(QuoteRequest $request): string
    {
        $name = trim((string) $request->from_name);
        $greeting = $name !== '' ? 'Bonjour ' . $name . ',' : 'Bonjour,';

        return $greeting . "\n\n"
            . "Nous vous remercions pour votre demande de cotation.\n"
            . "Veuillez trouver ci-joint notre devis " . $request->quote_number . " correspondant aux produits demandés.\n\n"
            . "Ce devis est valable 15 jours. Les prix s'entendent en Francs CFA (FCFA).\n"
            . "Nous restons à votre disposition pour toute précision ou ajustement des quantités.\n\n"
            . "Cordialement,\n"
            . config('app.name');
    }
}
