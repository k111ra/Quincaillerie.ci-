<?php

namespace App\Http\Controllers;

use App\Models\QuoteRequest;
use App\Models\QuoteRequestItem;
use App\Services\Cotation\CotationPipelineService;
use App\Services\Cotation\QuotePdfService;
use App\Services\Cotation\SupplierMatchingService;
use Illuminate\Http\Request;

/**
 * Administration des demandes de cotation automatiques.
 */
class QuoteRequestController extends Controller
{
    public function index()
    {
        $requests = QuoteRequest::withCount('items')
            ->orderByDesc('created_at')
            ->paginate(25);

        $counts = QuoteRequest::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        return view('admin.cotations.index', compact('requests', 'counts'));
    }

    public function show(QuoteRequest $cotation, SupplierMatchingService $matcher)
    {
        $cotation->load('items.fournisseur', 'items.supplierProduct.fournisseur');

        $itemsData = [];
        foreach ($cotation->items as $item) {
            $itemsData[$item->id] = [
                'offers' => $matcher->allOffersFor($item->product_name_raw),
                'web_links' => $matcher->webSearchLinks($item->product_name_raw),
            ];
        }

        return view('admin.cotations.show', compact('cotation', 'itemsData'));
    }

    /**
     * Lance manuellement la lecture des emails (bouton "Vérifier les emails").
     */
    public function processNow(CotationPipelineService $pipeline)
    {
        try {
            $stats = $pipeline->run();

            return redirect()->route('admin.cotations.index')->with(
                'success',
                $stats['fetched'] . ' email(s) lu(s), ' . $stats['detected'] . ' demande(s) détectée(s).'
            );
        } catch (\Throwable $e) {
            return redirect()->route('admin.cotations.index')->with(
                'error',
                'Erreur de connexion à la boîte email : ' . $e->getMessage()
            );
        }
    }

    /**
     * Mise à jour des lignes (prix d'achat, prix de vente, quantités) + message client.
     */
    public function update(Request $request, QuoteRequest $cotation, SupplierMatchingService $matcher, QuotePdfService $pdfService)
    {
        $data = $request->validate([
            'client_message' => 'nullable|string|max:5000',
            'items' => 'array',
            'items.*.quantity' => 'nullable|numeric|min:0.01',
            'items.*.unit' => 'nullable|string|max:50',
            'items.*.purchase_price' => 'nullable|numeric|min:0',
            'items.*.selling_price' => 'nullable|numeric|min:0',
        ]);

        foreach ($data['items'] ?? [] as $itemId => $values) {
            $item = QuoteRequestItem::where('quote_request_id', $cotation->id)->find($itemId);

            if (!$item) {
                continue;
            }

            if (isset($values['quantity'])) {
                $item->quantity = (float) $values['quantity'];
            }
            if (!empty($values['unit'])) {
                $item->unit = $values['unit'];
            }

            if (isset($values['purchase_price']) && $values['purchase_price'] !== null && $values['purchase_price'] !== '') {
                $item->purchase_price = (float) $values['purchase_price'];
                // Si le prix de vente n'est pas saisi manuellement, on applique la marge
                if (empty($values['selling_price'])) {
                    $item->selling_price = $matcher->applyMargin($item->purchase_price);
                }
            }

            if (isset($values['selling_price']) && $values['selling_price'] !== null && $values['selling_price'] !== '') {
                $item->selling_price = (float) $values['selling_price'];
            }

            $item->save();
        }

        if (array_key_exists('client_message', $data)) {
            $cotation->client_message = $data['client_message'];
        }

        // Si toutes les lignes ont un prix de vente, la demande devient "prête"
        $cotation->refresh();
        $allPriced = $cotation->items()->count() > 0
            && $cotation->items()->whereNull('selling_price')->count() === 0;

        if ($allPriced && !in_array($cotation->status, [QuoteRequest::STATUS_ENVOYE, QuoteRequest::STATUS_REJETE])) {
            $cotation->status = QuoteRequest::STATUS_PRET;
            if (empty($cotation->client_message)) {
                $cotation->client_message = 'Bonjour,' . "\n\n"
                    . 'Veuillez trouver ci-joint notre devis correspondant à votre demande.' . "\n\n"
                    . 'Cordialement,' . "\n" . config('app.name');
            }
        }

        $cotation->save();

        // Régénérer les documents avec les nouveaux prix
        $pdfService->generateSupplierDoc($cotation);
        if ($allPriced) {
            $pdfService->generateClientPdf($cotation);
        }

        return redirect()->route('admin.cotations.show', $cotation)->with('success', 'Demande mise à jour, documents régénérés.');
    }

    /**
     * Ajout manuel d'une ligne produit.
     */
    public function addItem(Request $request, QuoteRequest $cotation, SupplierMatchingService $matcher)
    {
        $data = $request->validate([
            'product_name_raw' => 'required|string|max:255',
            'quantity' => 'required|numeric|min:0.01',
            'unit' => 'nullable|string|max:50',
        ]);

        $item = $cotation->items()->create([
            'product_name_raw' => $data['product_name_raw'],
            'quantity' => $data['quantity'],
            'unit' => $data['unit'] ?: 'unité',
        ]);

        $matcher->match($item);

        return redirect()->route('admin.cotations.show', $cotation)->with('success', 'Produit ajouté.');
    }

    public function removeItem(QuoteRequest $cotation, QuoteRequestItem $item)
    {
        if ($item->quote_request_id === $cotation->id) {
            $item->delete();
        }

        return redirect()->route('admin.cotations.show', $cotation)->with('success', 'Produit supprimé.');
    }

    /**
     * ÉTAPE 5 : validation + envoi du devis au client.
     */
    public function send(QuoteRequest $cotation, CotationPipelineService $pipeline)
    {
        if (!$cotation->isReadyToSend()) {
            return redirect()->route('admin.cotations.show', $cotation)->with(
                'error',
                'Le devis n\'est pas prêt : chaque produit doit avoir un prix de vente.'
            );
        }

        try {
            $pipeline->sendToClient($cotation);
        } catch (\Throwable $e) {
            return redirect()->route('admin.cotations.show', $cotation)->with('error', 'Envoi échoué : ' . $e->getMessage());
        }

        return redirect()->route('admin.cotations.show', $cotation)->with('success', 'Devis envoyé à ' . $cotation->from_email . '.');
    }

    public function reject(QuoteRequest $cotation)
    {
        $cotation->update(['status' => QuoteRequest::STATUS_REJETE]);

        return redirect()->route('admin.cotations.index')->with('success', 'Demande rejetée.');
    }

    public function downloadClientPdf(QuoteRequest $cotation)
    {
        abort_unless($cotation->client_pdf_path && file_exists(storage_path('app/' . $cotation->client_pdf_path)), 404);

        return response()->download(storage_path('app/' . $cotation->client_pdf_path));
    }

    public function downloadSupplierDoc(QuoteRequest $cotation)
    {
        abort_unless($cotation->supplier_doc_path && file_exists(storage_path('app/' . $cotation->supplier_doc_path)), 404);

        return response()->download(storage_path('app/' . $cotation->supplier_doc_path));
    }
}
