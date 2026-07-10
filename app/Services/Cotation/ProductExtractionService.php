<?php

namespace App\Services\Cotation;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

/**
 * Étape 2a : Extraction des produits demandés (nom, quantité, unité)
 * depuis le corps de l'email.
 *
 * Mode hybride :
 *  - Si une clé API Anthropic est configurée -> extraction par IA (fiable).
 *  - Sinon -> extraction par règles (regex sur les lignes).
 *
 * @return array<int, array{name: string, quantity: float, unit: string}>
 */
class ProductExtractionService
{
    public function extract(string $subject, string $body): array
    {
        $apiKey = config('cotation.anthropic.api_key');

        if (!empty($apiKey)) {
            try {
                $items = $this->extractWithAi($subject, $body, $apiKey);
                if (!empty($items)) {
                    return ['items' => $items, 'method' => 'ia'];
                }
            } catch (\Throwable $e) {
                Log::warning('[Cotation] Extraction IA échouée, bascule sur les règles : ' . $e->getMessage());
            }
        }

        return ['items' => $this->extractWithRules($body), 'method' => 'regles'];
    }

    /**
     * Extraction par l'API Claude (Anthropic).
     */
    private function extractWithAi(string $subject, string $body, string $apiKey): array
    {
        $prompt = <<<PROMPT
Tu es un assistant pour une quincaillerie à Abidjan (Côte d'Ivoire).
Voici un email de demande de cotation reçu d'un client.

Sujet : {$subject}

Corps :
{$body}

Extrais la liste des produits demandés. Réponds UNIQUEMENT avec un JSON valide, sans texte autour, au format :
{"items":[{"name":"nom du produit","quantity":1,"unit":"unité"}]}

Règles :
- "quantity" est un nombre (1 si non précisé).
- "unit" : unité mentionnée (sac, carton, pièce, mètre, kg, rouleau...) ou "unité" si non précisée.
- Garde le nom du produit tel que le client l'a écrit (avec dimensions, marque, référence).
- Si aucun produit n'est identifiable, renvoie {"items":[]}.
PROMPT;

        $client = new Client(['timeout' => 60]);

        $response = $client->post('https://api.anthropic.com/v1/messages', [
            'headers' => [
                'x-api-key' => $apiKey,
                'anthropic-version' => '2023-06-01',
                'content-type' => 'application/json',
            ],
            'json' => [
                'model' => config('cotation.anthropic.model'),
                'max_tokens' => 2048,
                'messages' => [
                    ['role' => 'user', 'content' => $prompt],
                ],
            ],
        ]);

        $data = json_decode((string) $response->getBody(), true);
        $text = $data['content'][0]['text'] ?? '';

        // Isoler le JSON même si le modèle a ajouté du texte
        if (preg_match('/\{.*\}/s', $text, $m)) {
            $text = $m[0];
        }

        $parsed = json_decode($text, true);

        if (!is_array($parsed) || !isset($parsed['items']) || !is_array($parsed['items'])) {
            return [];
        }

        $items = [];
        foreach ($parsed['items'] as $item) {
            $name = trim((string) ($item['name'] ?? ''));
            if ($name === '') {
                continue;
            }
            $items[] = [
                'name' => $name,
                'quantity' => max(0.01, (float) ($item['quantity'] ?? 1)),
                'unit' => trim((string) ($item['unit'] ?? 'unité')) ?: 'unité',
            ];
        }

        return $items;
    }

    /**
     * Extraction par règles : analyse ligne par ligne.
     * Gère les formats courants :
     *   "- 10 sacs de ciment 50kg"
     *   "Ciment 50kg : 10 sacs"
     *   "Pointes de 8 ........ 5 cartons"
     *   "3 x tuyau PVC 100"
     */
    private function extractWithRules(string $body): array
    {
        $items = [];
        $units = 'sacs?|cartons?|pi[eè]ces?|paquets?|rouleaux?|m[eè]tres?|barres?|feuilles?|bo[iî]tes?|litres?|kg|tonnes?|unit[eé]s?|lots?|bottes?|planches?|plaques?';

        $lines = preg_split('/\r\n|\r|\n/', $body);

        foreach ($lines as $line) {
            $line = trim(preg_replace('/^[\-\*\•\d]+[\.\)]?\s*/u', '', trim($line)));

            if ($line === '' || mb_strlen($line) < 3 || mb_strlen($line) > 150) {
                continue;
            }

            // Ignorer les formules de politesse et signatures
            if (preg_match('/^(bonjour|bonsoir|cordialement|merci|salutations|monsieur|madame|dans l\'attente|veuillez|je vous|nous vous|tel|tél|email|mobile)/iu', $line)) {
                continue;
            }

            // Format : "10 sacs de ciment" ou "10 ciment"
            if (preg_match('/^(\d+(?:[.,]\d+)?)\s*(?:x\s*)?(' . $units . ')?\s*(?:de\s+|d\')?(.{3,})$/iu', $line, $m)) {
                $items[] = [
                    'name' => trim($m[3]),
                    'quantity' => (float) str_replace(',', '.', $m[1]),
                    'unit' => !empty($m[2]) ? mb_strtolower($m[2]) : 'unité',
                ];
                continue;
            }

            // Format : "ciment 50kg : 10 sacs" ou "ciment ....... 10 sacs"
            if (preg_match('/^(.{3,}?)[\s:\.\-]{2,}(\d+(?:[.,]\d+)?)\s*(' . $units . ')?\s*$/iu', $line, $m)) {
                $items[] = [
                    'name' => trim($m[1]),
                    'quantity' => (float) str_replace(',', '.', $m[2]),
                    'unit' => !empty($m[3]) ? mb_strtolower($m[3]) : 'unité',
                ];
            }
        }

        return $items;
    }
}
