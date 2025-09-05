@extends('layouts.layout')
@section('content')


    <div class="container mt-4">
        <div class="row">
            <div class="col-md-3">
                <div class="list-group">
                    <a href="#panier" class="list-group-item list-group-item-action" data-toggle="tab">Mon panier</a>
                    <a href="#favoris" class="list-group-item list-group-item-action" data-toggle="tab">Mes favoris</a>
                    <a href="#commandes" class="list-group-item list-group-item-action" data-toggle="tab">Mes commandes</a>
                    <a href="#devis" class="list-group-item list-group-item-action" data-toggle="tab">Demandes de devis</a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="panier">
                        <h4>Mon panier</h4>
                        {{-- Affichage des produits du panier --}}
                        @if (session('cart'))
                            <ul>
                                @foreach (session('cart') as $id => $details)
                                    <li>
                                        <a href="#" class="photo">
                                            <img src="{{ asset('storage/' . $details['image']) }}" class="cart-thumb"
                                                alt="" width="200px" />
                                        </a>
                                        <h6><a href="#">{{ $details['nom'] }}</a></h6>
                                        <p>{{ $details['quantity'] }}x - <span
                                                class="price">{{ number_format($details['price'], 0) }}</span>
                                            F CFA</p>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>Votre panier est vide</p>
                        @endif
                    </div>
                    <div class="tab-pane fade" id="favoris">
                        <h4>Mes favoris</h4>
                        {{-- Affichage des favoris --}}
                        @if (isset($favorites) && is_iterable($favorites) && count($favorites) > 0)
                            <ul>
                                @foreach ($favorites as $fav)
                                    <li>{{ optional($fav->product)->name ?? 'Produit inconnu' }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p>Aucun favori enregistré.</p>
                        @endif
                    </div>
                    <div class="tab-pane fade" id="commandes">
                        <h4>Mes commandes</h4>
                        {{-- Affichage des commandes --}}
                        @if (isset($orders) && is_iterable($orders) && count($orders) > 0)
                            <ul>
                                @foreach ($orders as $order)
                                    <li>Commande #{{ $order->id }} -
                                        {{ $order->created_at ? $order->created_at->format('d/m/Y') : '' }} -
                                        {{ $order->status ?? '' }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p>Aucune commande passée.</p>
                        @endif
                    </div>
                    <div class="tab-pane fade" id="devis">
                        <h4>Demandes de devis</h4>
                        {{-- Affichage des demandes de devis --}}
                        @if (isset($quotes) && is_iterable($quotes) && count($quotes) > 0)
                            <ul>
                                @foreach ($quotes as $quote)
                                    <li>Devis #{{ $quote->id }} -
                                        {{ $quote->created_at ? $quote->created_at->format('d/m/Y') : '' }} -
                                        {{ $quote->status ?? '' }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p>Aucune demande de devis.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Activation des onglets Bootstrap
        document.querySelectorAll('.list-group-item').forEach(function(item) {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelectorAll('.tab-pane').forEach(function(tab) {
                    tab.classList.remove('show', 'active');
                });
                var target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.classList.add('show', 'active');
                }
            });
        });
    </script>

@endsection
