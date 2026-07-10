<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <title>Devis {{ $quoteRequest->quote_number }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 13px;
            color: #444;
            margin: 0;
            padding: 0;
        }

        .box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
        }

        .header {
            width: 100%;
            margin-bottom: 30px;
        }

        .header td {
            vertical-align: top;
        }

        .company-name {
            font-size: 26px;
            font-weight: bold;
            color: #2c3e50;
        }

        .doc-title {
            text-align: right;
            font-size: 22px;
            color: #2c3e50;
            font-weight: bold;
        }

        .meta {
            text-align: right;
            font-size: 12px;
            color: #666;
        }

        .parties {
            width: 100%;
            margin-bottom: 25px;
        }

        .parties td {
            vertical-align: top;
            width: 50%;
        }

        .label {
            font-size: 11px;
            text-transform: uppercase;
            color: #999;
            letter-spacing: 1px;
        }

        table.items {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table.items th {
            background: #2c3e50;
            color: #fff;
            padding: 8px;
            text-align: left;
            font-size: 12px;
        }

        table.items td {
            padding: 8px;
            border-bottom: 1px solid #eee;
        }

        table.items .num {
            text-align: right;
            white-space: nowrap;
        }

        .total-row td {
            font-weight: bold;
            font-size: 15px;
            background: #f5f7fa;
            border-top: 2px solid #2c3e50;
        }

        .footer {
            margin-top: 30px;
            font-size: 11px;
            color: #888;
            border-top: 1px solid #eee;
            padding-top: 12px;
        }
    </style>
</head>

<body>
    <div class="box">
        <table class="header">
            <tr>
                <td>
                    <div class="company-name">{{ config('app.name') }}</div>
                    <div>Quincaillerie — Abidjan, Côte d'Ivoire</div>
                    <div>Email : info@quincaillerie.ci</div>
                </td>
                <td>
                    <div class="doc-title">DEVIS</div>
                    <div class="meta">
                        N° : {{ $quoteRequest->quote_number }}<br>
                        Date : {{ now()->format('d/m/Y') }}<br>
                        Validité : 15 jours
                    </div>
                </td>
            </tr>
        </table>

        <table class="parties">
            <tr>
                <td>
                    <div class="label">Client</div>
                    <strong>{{ $quoteRequest->from_name ?: $quoteRequest->from_email }}</strong><br>
                    {{ $quoteRequest->from_email }}
                </td>
                <td>
                    <div class="label">Objet</div>
                    {{ $quoteRequest->subject ?: 'Demande de cotation' }}
                </td>
            </tr>
        </table>

        <table class="items">
            <thead>
                <tr>
                    <th style="width: 45%;">Désignation</th>
                    <th class="num">Quantité</th>
                    <th>Unité</th>
                    <th class="num">Prix unitaire (FCFA)</th>
                    <th class="num">Montant (FCFA)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($quoteRequest->items as $item)
                    <tr>
                        <td>{{ $item->product_name_raw }}</td>
                        <td class="num">{{ rtrim(rtrim(number_format($item->quantity, 2, ',', ' '), '0'), ',') }}</td>
                        <td>{{ $item->unit }}</td>
                        <td class="num">{{ number_format($item->selling_price, 0, ',', ' ') }}</td>
                        <td class="num">{{ number_format($item->lineTotal(), 0, ',', ' ') }}</td>
                    </tr>
                @endforeach
                <tr class="total-row">
                    <td colspan="4">TOTAL</td>
                    <td class="num">{{ number_format($quoteRequest->total(), 0, ',', ' ') }} FCFA</td>
                </tr>
            </tbody>
        </table>

        <div class="footer">
            Prix exprimés en Francs CFA (FCFA). Devis valable 15 jours à compter de sa date d'émission.<br>
            Livraison et disponibilité à confirmer à la commande. Merci de votre confiance.
        </div>
    </div>
</body>

</html>
