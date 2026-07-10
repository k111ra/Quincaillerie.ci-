<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <title>Document interne — {{ $quoteRequest->quote_number ?? ('Demande #' . $quoteRequest->id) }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 12px;
            color: #444;
        }

        .confidential {
            background: #c0392b;
            color: #fff;
            text-align: center;
            padding: 6px;
            font-weight: bold;
            letter-spacing: 2px;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 18px;
            color: #2c3e50;
        }

        h2 {
            font-size: 14px;
            color: #2c3e50;
            background: #f0f3f7;
            padding: 6px 8px;
            margin-top: 24px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        th {
            background: #2c3e50;
            color: #fff;
            padding: 6px;
            text-align: left;
            font-size: 11px;
        }

        td {
            padding: 6px;
            border-bottom: 1px solid #eee;
            vertical-align: top;
        }

        .num {
            text-align: right;
            white-space: nowrap;
        }

        .muted {
            color: #888;
            font-size: 11px;
        }

        .links {
            font-size: 11px;
            margin: 4px 0 12px 0;
        }

        .links a {
            color: #2980b9;
        }

        .summary td {
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="confidential">DOCUMENT INTERNE — CONFIDENTIEL — NE PAS ENVOYER AU CLIENT</div>

    <h1>Recherche fournisseurs — {{ $quoteRequest->quote_number ?? ('Demande #' . $quoteRequest->id) }}</h1>
    <p class="muted">
        Client : {{ $quoteRequest->from_name ?: $quoteRequest->from_email }} ({{ $quoteRequest->from_email }})<br>
        Objet : {{ $quoteRequest->subject }}<br>
        Reçu le : {{ optional($quoteRequest->received_at)->format('d/m/Y H:i') }} —
        Marge appliquée : {{ rtrim(rtrim(number_format($margin, 2, ',', ' '), '0'), ',') }}%
    </p>

    @foreach ($itemsData as $data)
        @php $item = $data['item']; @endphp
        <h2>{{ $loop->iteration }}. {{ $item->product_name_raw }}
            ({{ rtrim(rtrim(number_format($item->quantity, 2, ',', ' '), '0'), ',') }} {{ $item->unit }})</h2>

        @if ($data['offers']->isNotEmpty())
            <table>
                <thead>
                    <tr>
                        <th>Fournisseur</th>
                        <th>Contact</th>
                        <th>Lien d'achat</th>
                        <th class="num">Prix d'achat</th>
                        <th class="num">Prix de vente (+{{ rtrim(rtrim(number_format($margin, 2, ',', ' '), '0'), ',') }}%)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['offers'] as $offer)
                        <tr>
                            <td>
                                <strong>{{ optional($offer->fournisseur)->nom ?? 'N/A' }}</strong><br>
                                <span class="muted">{{ optional($offer->fournisseur)->adresse }}</span>
                            </td>
                            <td>
                                {{ optional($offer->fournisseur)->telephone ?? optional($offer->fournisseur)->phone_primary }}<br>
                                <span class="muted">{{ optional($offer->fournisseur)->email ?? optional($offer->fournisseur)->email_primary }}</span>
                            </td>
                            <td>
                                @if ($offer->purchase_link)
                                    <a href="{{ $offer->purchase_link }}">{{ \Illuminate\Support\Str::limit($offer->purchase_link, 45) }}</a>
                                @else
                                    <span class="muted">—</span>
                                @endif
                            </td>
                            <td class="num">{{ number_format($offer->purchase_price, 0, ',', ' ') }} F</td>
                            <td class="num">{{ number_format(round($offer->purchase_price * (1 + $margin / 100) / 5) * 5, 0, ',', ' ') }} F</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="muted">Aucun fournisseur dans le catalogue interne pour ce produit.</p>
        @endif

        <div class="links">
            <strong>Recherche web :</strong>
            @foreach ($data['web_links'] as $label => $url)
                <a href="{{ $url }}">{{ $label }}</a>@if (!$loop->last) &nbsp;|&nbsp; @endif
            @endforeach
        </div>

        @if ($item->notes)
            <p class="muted">Note : {{ $item->notes }}</p>
        @endif
    @endforeach

    <h2>Récapitulatif</h2>
    <table class="summary">
        <thead>
            <tr>
                <th>Produit</th>
                <th class="num">Qté</th>
                <th class="num">Prix d'achat retenu</th>
                <th class="num">Prix de vente client</th>
                <th class="num">Marge (FCFA)</th>
            </tr>
        </thead>
        <tbody>
            @php $totalMargin = 0; @endphp
            @foreach ($quoteRequest->items as $item)
                @php
                    $lineMargin = ($item->selling_price - $item->purchase_price) * $item->quantity;
                    $totalMargin += $item->purchase_price ? $lineMargin : 0;
                @endphp
                <tr>
                    <td>{{ $item->product_name_raw }}</td>
                    <td class="num">{{ rtrim(rtrim(number_format($item->quantity, 2, ',', ' '), '0'), ',') }}</td>
                    <td class="num">{{ $item->purchase_price ? number_format($item->purchase_price, 0, ',', ' ') . ' F' : 'À COMPLÉTER' }}</td>
                    <td class="num">{{ $item->selling_price ? number_format($item->selling_price, 0, ',', ' ') . ' F' : '—' }}</td>
                    <td class="num">{{ $item->purchase_price ? number_format($lineMargin, 0, ',', ' ') . ' F' : '—' }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="4"><strong>MARGE TOTALE ESTIMÉE</strong></td>
                <td class="num"><strong>{{ number_format($totalMargin, 0, ',', ' ') }} F</strong></td>
            </tr>
        </tbody>
    </table>
</body>

</html>
