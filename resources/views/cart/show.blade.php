@extends('layouts.layout')
@section('title', 'Panier')
@section('content')

    <!-- page-title -->
    <div class="ttm-page-title-row">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="page-title-heading">
                            <h1 class="title">Panier</h1>
                        </div>
                        <div class="breadcrumb-wrapper">
                            <span class="mr-1"><i class="ti ti-home"></i></span>
                            <a title="Accueil" href="/">Accueil</a>
                            <span class="ttm-bread-sep">&nbsp;/&nbsp;</span>
                            <span class="ttm-textcolor-skincolor">Panier</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Fin du titre de la page -->

    <!-- Début du site-main -->
    <div class="site-main">

        <!-- Section du panier -->
        <section class="cart-section clearfix">
            <div class="container">
                <!-- Ligne -->
                <div class="row">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="col-lg-12">
                        @if ($cart && count($cart) > 0)

                            <!-- Tableau du panier -->
                            <table class="table cart_table shop_table_responsive">
                                <thead>
                                    <tr>
                                        <th class="product-thumbnail">&nbsp;</th>
                                        <th class="product-name">Produit</th>
                                        <th class="product-price">Prix</th>
                                        <th class="product-quantity">Quantité</th>
                                        <th class="product-subtotal">Total</th>
                                        <th class="product-remove">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (session('cart') as $id => $details)
                                        <tr>
                                            <td>
                                                @php
                                                    $image = $details['image']; // On récupère directement l'image stockée
                                                @endphp
                                                <img src="{{ asset('storage/' . $image) }}" width="50" height="50"
                                                    alt="Image du produit">
                                            </td>
                                            <td>{{ $details['nom'] }}</td>
                                            <td>{{ number_format($details['price'], 2) }} F CFA</td>
                                            <td>{{ $details['quantity'] }}</td>
                                            <td>{{ number_format($details['price'] * $details['quantity'], 2) }} F CFA</td>
                                        </tr>
                                    @endforeach

                                    <tr>
                                        <td colspan="6" class="actions">
                                            <div class="coupon">
                                                <a class="ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-fill ttm-icon-btn-left ttm-btn-color-skincolor"
                                                    href="{{ url('/') }}">
                                                    <i class="ti ti-arrow-left"></i>Retour à la boutique
                                                </a>
                                            </div>
                                            <br>
                                            <!-- Formulaire pour mettre à jour le panier -->
                                            <form id="update-cart-form" method="post" action="{{ route('cart.update') }}">
                                                @csrf
                                                <input type="hidden" name="productId" value="ID_DU_PRODUIT">
                                                <!-- Ajoutez la valeur dynamique appropriée -->
                                                <input type="number" name="quantity" value="QUANTITE_ACTUELLE">
                                                <!-- Ajoutez la valeur dynamique appropriée -->
                                                <button type="submit"
                                                    class="ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-fill ttm-icon-btn-left ttm-btn-color-skincolor">
                                                    <i class="ti ti-reload"></i>Mettre à jour
                                                </button>
                                            </form>

                                            <br>
                                            <form method="post" action="{{ route('cart.clear') }}">
                                                @csrf
                                                <button type="submit"
                                                    class="ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-fill ttm-icon-btn-left ttm-btn-color-skincolor">
                                                    <i class="ti ti-close"></i>Tout effacer
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        @else
                            <p>Votre panier est vide.</p>
                        @endif
                    </div>
                    <div class="col-lg-12">
                        <!-- Collatéraux du panier -->
                        <div class="cart-collaterals">
                            <div class="row">
                                <!-- Partie de livraison commentée -->
                                <!--
                                    <div class="col-md-4">
                                        <div class="cart_shipping mt-30">
                                            <h5>Calculer les frais de livraison<span class="ti ti-angle-down"></span></h5>
                                            <p class="text-input orderby">
                                                <select id="shipping-method">
                                                    <option value="standard" data-cost="10000">Standard (+ 10,000)</option>
                                                    <option value="express" data-cost="25000">Express (+ 25,000)</option>
                                                </select>
                                            </p>
                                            <p class="text-input"><input type="text" class="input-text zip-code"
                                                    name="shipping_name" placeholder="Code postal / Zip"></p>
                                            <div class="pt-20">
                                                <p class="text-input"><input type="button" id="update-total"
                                                        class="ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-fill ttm-btn-color-skincolor"
                                                        value="Mettre à jour le total"></p>
                                            </div>
                                        </div>
                                    </div>
                                    -->

                                <!-- Partie de coupon commentée -->
                                <!--
                                    <div class="col-md-4">
                                        <div class="cart_discount mt-30">
                                            <h5>Réduction du coupon<span class="ti ti-angle-down"></span></h5>
                                            <p class="pt-10">Saisissez votre code coupon si vous en avez un.</p>
                                            <p class="text-input"><input type="text" class="input-text zip-code"
                                                    name="coupon_code" placeholder="Code promo"></p>
                                            <div class="pt-20">
                                                <p class="text-input"><input type="button" id="apply-coupon"
                                                        class="ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-fill ttm-btn-color-skincolor"
                                                        value="Appliquer le coupon"></p>
                                            </div>
                                        </div>
                                    </div>
                                    -->

                                <div class="col-md-4">
                                    <div class="cart_totals res-767-mt-30">
                                        <h5>Total du panier<span
                                                id="cart-total">{{ number_format(session('cart_total', 0), 0) }} F
                                                CFA</span></h5>
                                        <!-- Livraison et total final retiré -->
                                        <h5>Total<span id="final-total">{{ number_format(session('cart_total', 0), 2) }} F
                                                CFA</span></h5>
                                    </div>
                                    <div class="proceed-to-checkout">
                                        <a href="{{ route('checkout') }}" class="checkout-button button">Passer à
                                            la caisse</a>
                                    </div>
                                </div>
                            </div>
                        </div><!-- Fin des collatéraux du panier -->
                    </div>
                </div>
            </div>
        </section><!-- Fin de la section du panier -->

    </div><!-- Fin du site-main -->

@endsection
