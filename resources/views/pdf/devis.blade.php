<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devis PR{{ $order->order_number }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }

        .container {
            width: 100%;
            margin: 0 auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            border: 1px solid #ddd;
        }

        .header,
        .footer {
            margin-bottom: 20px;
        }

        .header h2,
        .header p {
            margin: 0;
        }

        .footer {
            position: absolute;
            bottom: 0;
        }

        .right {
            text-align: right;
        }

        .center {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <table>
                <tr>
                    <td>
                        <strong>ADM Service</strong><br>
                        Riviera Palmeraie derrière la SODECI<br>
                        PLANETKONCEPT<br>
                        Abidjan Tél.: +225 0747104513<br>
                        Email: info@quincaillerie.ci<br>
                        Web: https://quincaillerie.ci
                    </td>
                    <td class="right">
                        <strong>Devis PR{{ $order->order_number }}</strong><br>
                        Date : {{ now()->format('d/m/Y') }}<br>
                        Date de fin de validité : {{ now()->addDays(15)->format('d/m/Y') }}<br>
                        Code client : {{ $order->user->id }}
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>Émetteur :</strong><br>
                        ADM Service
                    </td>
                    <td>
                        <strong>Adressé à :</strong><br>
                        {{ $order->user->name }}<br>
                        {{ $order->shipping_address }}
                    </td>
                </tr>
            </table>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Désignation</th>
                    <th class="center">TVA</th>
                    <th class="center">P.U. HT</th>
                    <th class="center">Qté</th>
                    <th class="right">Total HT</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                    <tr>
                        <td>{{ $item->product->nom }}</td>
                        <td class="center">0%</td>
                        <td class="center">{{ number_format($item->price, 2) }} F CFA</td>
                        <td class="center">{{ $item->quantity }}</td>
                        <td class="right">{{ number_format($item->price * $item->quantity, 2) }} F CFA</td>
                    </tr>
                @endforeach
                <tr>
                    <td>Livraison</td>
                    <td class="center">0%</td>
                    <td class="center">{{ number_format(80000, 2) }} F CFA</td>
                    <td class="center">1</td>
                    <td class="right">{{ number_format(80000, 2) }} F CFA</td>
                </tr>
            </tbody>
        </table>

        <div class="footer">
            <p><strong>Total HT : {{ number_format($order->total_amount + 80000, 2) }} F CFA</strong></p>
        </div>
    </div>
</body>

</html>
