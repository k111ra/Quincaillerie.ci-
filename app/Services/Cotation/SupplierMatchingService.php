<?php

namespace App\Services\Cotation;

use App\Models\Product;
use App\Models\QuoteRequestItem;
use App\Models\SupplierProduct;

/**
 * Étape 2b / 3 : Recherche des produits chez les fournisseurs locaux (Abidjan).
 *
 * Priorité 1 : catalogue interne fournisseurs (table supplier_products, prix d'achat réels).
 * Priorité 2 : produits du site liés à un fournisseur (table products).
 * Complément : liens de recherche web pour les produits introuvables.
 */
class SupplierMatchingService
{
    /**
     * Cherche le meilleur fournisseur pour un item et remplit :
     * fournisseur_id, supplier_product_id, product_id, purchase_price, selling_price.
     *
     * @return bool true si un prix d'achat a été trouvé
     */
    public function match(QuoteRequestItem $item): bool
    {
        $name = $item->product_name_raw;

        // 1. Catalogue interne fournisseurs : on prend le prix d'achat le plus bas
        $supplierProduct = $this->searchSupplierProducts($name);

        if ($supplierProduct) {
            $item->supplier_product_id = $supplierProduct->id;
            $item->fournisseur_id = $supplierProduct->fournisseur_id;
            $item->product_id = $supplierProduct->product_id;
            $item->purchase_price = $supplierProduct->purchase_price;
            $item->selling_price = $this->applyMargin($supplierProduct->purchase_price);
            $item->notes = trim(($item->notes ? $item->notes . ' | ' : '') . 'Source : catalogue fournisseurs');
            $item->save();

            return true;
        }

        // 2. Produits du site liés à un fournisseur
        $product = $this->searchProducts($name);

        if ($product && $product->prix > 0) {
            $item->product_id = $product->id;
            $item->fournisseur_id = $product->fournisseur_id;
            $item->purchase_price = (float) $product->prix;
            $item->selling_price = $this->applyMargin((float) $product->prix);
            $item->notes = trim(($item->notes ? $item->notes . ' | ' : '') . 'Source : catalogue produits du site — prix d\'achat à vérifier');
            $item->save();

            return true;
        }

        // 3. Introuvable : à compléter manuellement (liens de recherche web fournis dans le doc interne)
        $item->notes = trim(($item->notes ? $item->notes . ' | ' : '') . 'Aucun fournisseur trouvé — prix à saisir manuellement');
        $item->save();

        return false;
    }

    /**
     * Toutes les offres fournisseurs pour un produit (pour le document interne, étape 3).
     *
     * @return \Illuminate\Support\Collection<int, SupplierProduct>
     */
    public function allOffersFor(string $productName)
    {
        return $this->buildSearchQuery(SupplierProduct::query()->with('fournisseur'), 'product_name', $productName)
            ->orderBy('purchase_price')
            ->limit(10)
            ->get();
    }

    /**
     * Liens de recherche web (Jumia CI, Google Shopping...) pour un produit.
     *
     * @return array<string, string> label => url
     */
    public function webSearchLinks(string $productName): array
    {
        $links = [];

        foreach (config('cotation.web_sources', []) as $label => $baseUrl) {
            $query = $productName;
            if (str_contains($label, 'fournisseurs')) {
                $query .= ' fournisseur quincaillerie Abidjan prix';
            }
            $links[$label] = $baseUrl . urlencode($query);
        }

        return $links;
    }

    /**
     * Prix de vente = prix d'achat + marge (35% par défaut), arrondi aux 5 FCFA.
     */
    public function applyMargin(float $purchasePrice): float
    {
        $margin = (float) config('cotation.margin_percent', 35);
        $price = $purchasePrice * (1 + $margin / 100);

        return round($price / 5) * 5;
    }

    private function searchSupplierProducts(string $name): ?SupplierProduct
    {
        return $this->buildSearchQuery(SupplierProduct::query(), 'product_name', $name)
            ->orderBy('purchase_price')
            ->first();
    }

    private function searchProducts(string $name): ?Product
    {
        return $this->buildSearchQuery(Product::query()->whereNotNull('fournisseur_id'), 'nom', $name)
            ->first()
            ?? $this->buildSearchQuery(Product::query(), 'nom', $name)->first();
    }

    /**
     * Recherche souple : correspondance exacte, puis LIKE complet,
     * puis tous les mots significatifs présents.
     */
    private function buildSearchQuery($query, string $column, string $name)
    {
        $nameClean = trim($name);

        return $query->where(function ($q) use ($column, $nameClean) {
            $q->where($column, 'LIKE', $nameClean)
                ->orWhere($column, 'LIKE', '%' . $nameClean . '%');

            $words = $this->significantWords($nameClean);
            if (count($words) >= 2) {
                $q->orWhere(function ($sub) use ($column, $words) {
                    foreach ($words as $word) {
                        $sub->where($column, 'LIKE', '%' . $word . '%');
                    }
                });
            }
        });
    }

    /**
     * @return string[]
     */
    private function significantWords(string $name): array
    {
        $stopWords = ['de', 'du', 'des', 'le', 'la', 'les', 'un', 'une', 'et', 'en', 'pour', 'avec', 'sans'];

        $words = preg_split('/[\s,;\/]+/u', mb_strtolower($name));

        return array_values(array_filter($words, function ($w) use ($stopWords) {
            return mb_strlen($w) >= 3 && !in_array($w, $stopWords, true);
        }));
    }
}
