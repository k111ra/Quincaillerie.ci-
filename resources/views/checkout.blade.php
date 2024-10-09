@extends('layouts.layout')
@section('title', 'Finalisez votre commande')
@section('content')

    <!-- page-title -->
    <div class="ttm-page-title-row">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="page-title-heading">
                            <h1 class="title">Finalisez votre commande</h1>
                        </div>
                        <div class="breadcrumb-wrapper">
                            <span class="mr-1"><i class="ti ti-home"></i></span>
                            <a title="Accueil" href="/">Accueil</a>
                            <span class="ttm-bread-sep">&nbsp;/&nbsp;</span>
                            <span class="ttm-textcolor-skincolor">Finalisez votre commande</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Fin du titre de la page -->

    <!--site-main start-->
    <div class="site-main">

        <!-- checkout-section -->
        <section class="checkout-section clearfix">
            <div class="container">
                <!-- row -->
                <div class="row">
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

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="col-lg-12">
                        <!-- Formulaire de commande -->
                        <form id="checkout-form" name="checkout" method="post" class="checkout row"
                            action="{{ route('checkout.store') }}">
                            @csrf <!-- Protection contre les attaques CSRF -->

                            <!-- Affichage des informations utilisateur -->
                            <div class="col-lg-12">
                                <div class="res-991-pt-50">
                                    <div>
                                        <span>Vos informations :</span>
                                        <h3>{{ Auth::user()->name }}</h3>
                                    </div>
                                </div>
                            </div>

                            <!-- Sélection de l'adresse de livraison -->
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="shipping_address">Adresse de livraison :</label>
                                    <input type="text" name="shipping_address" id="shipping_address"
                                        placeholder="Abidjan, Cocody..." required>
                                    {{-- <select name="shipping_address" id="shipping_address" class="form-control" required>
                                        <option value="">Sélectionnez une adresse</option>
                                        <option value="adresse_1">Adresse 1, Ville, Pays</option>
                                        <option value="adresse_2">Adresse 2, Ville, Pays</option>
                                        <option value="nouvelle_adresse">Entrer une nouvelle adresse</option>
                                    </select> --}}
                                </div>
                            </div>

                            <!-- Sélection du mode de livraison -->
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="shipping_method">Méthode de livraison :</label>
                                    <select name="shipping_method" id="shipping_method" class="form-control" required>
                                        <option value="">Sélectionnez un mode de livraison</option>
                                        <option value="standard">Livraison standard petit Objet (2 000)</option>
                                        <option value="express">Livraison express (5 000 F CFA)</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Récapitulatif de la commande -->
                            <div class="col-lg-12">
                                <div class="pt-30 res-991-pt-15">
                                    <div class="content-sec-head-style">
                                        <div class="content-area-sec-title">
                                            <h5>Vos commandes</h5>
                                        </div>
                                    </div>
                                    <div id="order_review" class="checkout-review-order">
                                        <table class="cart_table checkout-review-order-table">
                                            <thead>
                                                <tr>
                                                    <th class="product-name">Produit</th>
                                                    <th class="product-total">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (session('cart') && count(session('cart')) > 0)
                                                    <?php $total = 0; ?>
                                                    @foreach (session('cart') as $id => $details)
                                                        <?php $total += $details['price'] * $details['quantity']; ?>
                                                        <tr class="cart_item">
                                                            <td class="product-name">{{ $details['nom'] }}&nbsp;
                                                                <strong class="product-quantity">×
                                                                    {{ $details['quantity'] }}</strong>
                                                            </td>
                                                            <td class="product-total">
                                                                <span class="Price-amount">
                                                                    {{ number_format($details['price'] * $details['quantity'], 0) }}<span
                                                                        class="Price-currencySymbol"> F CFA</span>
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="2">Votre panier est vide.</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                            <tfoot>
                                                <tr class="cart-subtotal">
                                                    <th>Sous-total</th>
                                                    <td>
                                                        <span class="Price-amount amount">
                                                            {{ number_format($total, 0) }} F CFA
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr class="cart-shipping">
                                                    <th>Livraison</th>
                                                    <td>
                                                        <span class="Price-amount amount" id="shipping_cost">
                                                            Gratuit
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr class="order-total">
                                                    <th>Total</th>
                                                    <td><strong><span class="Price-amount amount" id="order_total">
                                                                {{ number_format($total, 0) }} F CFA
                                                            </span></strong>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Bouton pour passer la commande -->
                            <div class="col-lg-9"></div>
                            <div class="col-lg-3">
                                <div class="text-right place-order mt-30">
                                    <button type="button" class="button" id="place_order">Passer la commande</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- checkout-section end -->

    </div><!--site-main end-->

    <!-- SweetAlert pour confirmation -->
    <script>
        document.getElementById('place_order').addEventListener('click', function() {
            Swal.fire({
                title: 'Êtes-vous sûr ?',
                text: "Vous allez passer la commande.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, passer la commande!',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('checkout-form')
                        .submit(); // Soumettre le formulaire si confirmé
                }
            });
        });

        document.getElementById('shipping_method').addEventListener('change', function() {
            let shippingCost = 0;
            const method = this.value;
            const subtotal = {{ $total }};

            if (method === 'express') {
                shippingCost = 5000; // Exemple de coût pour livraison express
            }

            const total = subtotal + shippingCost;
            document.getElementById('shipping_cost').innerText = shippingCost >
                0 ? `${shippingCost.toLocaleString()} F CFA` : 'Gratuit';
            document.getElementById('order_total').innerText = `${total.toLocaleString()} F CFA`;
        });
    </script>

@endsection
