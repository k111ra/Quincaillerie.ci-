@extends('layouts/contentNavbarLayout')

@section('title', 'Modifier Commande')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h2>Modifier Commande #{{ $order->order_number }}</h2>
                    <h3>Client : {{ $order->user->name }}</h3>
                    <p>Téléphone: {{ $order->tel }}</p>
                    <p>Email : {{ $order->user->email }}</p>
                    <p>Adresse de livraison : {{ $order->shipping_address }}</p>
                    <p>Méthode de livraison :
                        @if ($order->shipping_method == 'standard')
                            Livraison standard petit objet
                        @elseif ($order->shipping_method == 'tricycle')
                            Livraison en tricycle
                        @elseif ($order->shipping_method == 'utilitaire')
                            Livraison véhicule utilitaire
                        @elseif ($order->shipping_method == 'cargo')
                            Livraison cargo
                        @else
                            Non spécifiée
                        @endif
                    </p>
                    <p>Tarif recommandé :
                        @if ($order->shipping_method == 'standard')
                            2 000 F CFA
                        @elseif ($order->shipping_method == 'tricycle')
                            10 000 F CFA
                        @elseif ($order->shipping_method == 'utilitaire')
                            15 000 F CFA
                        @elseif ($order->shipping_method == 'cargo')
                            25 000 F CFA
                        @else
                            0 F CFA
                        @endif
                    </p>
                </div>
                <div>
                    <!-- Bouton pour imprimer un devis ou une facture -->
                    <a href="{{ route('order.devis', $order->id) }}" class="btn btn-secondary mb-2">Télécharger Devis</a>
                    <a href="{{ route('order.facture', $order->id) }}" class="btn btn-secondary mb-2">Télécharger Facture</a>
                </div>
            </div>
            <div class="card-body">
                <!-- Afficher les items de la commande -->
                <h4>Articles de la commande</h4>
                <table class="table table-striped">
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

                <h4 class="mt-4">Total de la commande : {{ number_format($order->total_amount, 2) }} F CFA</h4>
            </div>
            <div class="card-footer">
                <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="status" class="form-label">Statut de la commande</label>
                        <select name="status" id="status" class="form-control">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>En attente</option>
                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Expédiée</option>
                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Complétée
                            </option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Annulée
                            </option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </form>
            </div>
        </div>
    </div>
@endsection
