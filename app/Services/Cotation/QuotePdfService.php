<?php

namespace App\Services\Cotation;

use App\Models\QuoteRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

/**
 * Étapes 3 & 4 : Génération des documents PDF.
 *  - Document interne fournisseurs (contacts, liens, prix d'achat, marge) — CONFIDENTIEL.
 *  - Devis client (prix de vente uniquement, la marge n'apparaît jamais).
 */
class QuotePdfService
{
    public function __construct(private SupplierMatchingService $matcher)
    {
    }

    /**
     * Devis client (prix +35%, marge invisible).
     */
    public function generateClientPdf(QuoteRequest $request): string
    {
        if (empty($request->quote_number)) {
            $request->quote_number = $this->nextQuoteNumber();
        }

        $pdf = Pdf::loadView('pdf.devis-cotation', [
            'quoteRequest' => $request->load('items'),
        ]);

        $path = 'cotations/' . $request->quote_number . '-devis-client.pdf';
        Storage::disk('local')->put($path, $pdf->output());

        $request->client_pdf_path = $path;
        $request->save();

        return $path;
    }

    /**
     * Document interne : liste des fournisseurs par produit avec contacts,
     * liens d'achat, prix d'achat et marge. NE JAMAIS ENVOYER AU CLIENT.
     */
    public function generateSupplierDoc(QuoteRequest $request): string
    {
        if (empty($request->quote_number)) {
            $request->quote_number = $this->nextQuoteNumber();
        }

        $request->load('items.fournisseur', 'items.supplierProduct');

        $itemsData = [];
        foreach ($request->items as $item) {
            $itemsData[] = [
                'item' => $item,
                'offers' => $this->matcher->allOffersFor($item->product_name_raw),
                'web_links' => $this->matcher->webSearchLinks($item->product_name_raw),
            ];
        }

        $pdf = Pdf::loadView('pdf.fournisseurs-doc', [
            'quoteRequest' => $request,
            'itemsData' => $itemsData,
            'margin' => (float) config('cotation.margin_percent', 35),
        ]);

        $path = 'cotations/' . $request->quote_number . '-fournisseurs-INTERNE.pdf';
        Storage::disk('local')->put($path, $pdf->output());

        $request->supplier_doc_path = $path;
        $request->save();

        return $path;
    }

    private function nextQuoteNumber(): string
    {
        $year = date('Y');
        $count = QuoteRequest::whereNotNull('quote_number')
            ->where('quote_number', 'LIKE', "DEV-{$year}-%")
            ->count();

        return sprintf('DEV-%s-%04d', $year, $count + 1);
    }
}
