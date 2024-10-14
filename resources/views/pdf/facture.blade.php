<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture #{{ $order->order_number }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2>Facture pour la commande #{{ $order->order_number }}</h2>
    <p>Client: {{ $order->user->name }}</p>
    <p>Date : {{ now()->format('d/m/Y') }}</p>

    <h3>Adresse de livraison :</h3>
    <p>{{ $order->shipping_address }}</p>

    <h3>Détails de la commande :</h3>
    <table>
        <thead>
            <tr>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix Unitaire</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->items as $item)
                <tr>
                    <td>{{ $item->product->nom }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price, 2) }} F CFA</td>
                    <td>{{ number_format($item->price * $item->quantity, 2) }} F CFA</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Total de la commande : {{ number_format($order->total_amount, 2) }} F CFA</h3>

    <h3>Méthode de livraison :
        @if ($order->shipping_method == 'standard')
            Livraison standard petit objet
        @elseif ($order->shipping_method == 'tricycle')
            Livraison en tricycle
        @elseif ($order->shipping_method == 'utilitaire')
            Livraison véhicule utilitaire
        @elseif ($order->shipping_method == 'cargo')
            Livraison cargo
        @endif
    </h3>
</body>

</html>
