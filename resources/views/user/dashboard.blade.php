@extends('layouts.layout')
@section('content')


    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (session('warning'))
            <div class="alert alert-warning">
                {{ session('warning') }}
            </div>
        @endif

        @if (session('info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        @endif

        @if (!empty($user->tel ?? auth()->user()->tel))
            <div class="alert alert-light border d-flex flex-column flex-md-row align-items-md-center justify-content-between">
                <div class="mb-2 mb-md-0">
                    Simplifiez vos prochaines connexions avec l'option Google en un clic.
                </div>
                <a href="{{ route('auth.google') }}" class="btn btn-danger btn-sm">
                    <i class="fa fa-google"></i> Continuer avec Google
                </a>
            </div>
        @endif

        <div class="row">
            <div class="col-md-3">
                <div class="list-group">
                    <a href="#profil" class="list-group-item list-group-item-action active" data-toggle="tab">Mon profil</a>
                    <a href="#panier" class="list-group-item list-group-item-action" data-toggle="tab">Mon panier</a>
                    <a href="#favoris" class="list-group-item list-group-item-action" data-toggle="tab">Mes favoris</a>
                    <a href="#commandes" class="list-group-item list-group-item-action" data-toggle="tab">Mes commandes</a>
                    <a href="#devis" class="list-group-item list-group-item-action" data-toggle="tab">Demandes de devis</a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="profil">
                        <h4>Mes informations personnelles</h4>
                        <form action="{{ route('user.profile.update') }}" method="POST" class="mt-3" id="profile-form">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Nom complet</label>
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $user->name ?? auth()->user()->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Adresse email</label>
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email', $user->email ?? auth()->user()->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Téléphone</label>
                                <input type="text" name="tel" class="form-control @error('tel') is-invalid @enderror"
                                    value="{{ old('tel', $user->tel ?? auth()->user()->tel) }}">
                                @error('tel')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Enregistrer mes modifications</button>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="panier">
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
