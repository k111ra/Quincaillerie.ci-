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
                                    @foreach ($cartDetails as $cartItem)
                                        <tr class="cart_item" data-product-id="{{ $cartItem['id'] }}">
                                            <td class="product-thumbnail">
                                                <a href="{{ isset($cartItem['slug']) ? url('product/' . $cartItem['slug']) : '#' }}">
                                                    <img class="img-fluid"
                                                        src="{{ asset('storage/' . $cartItem['image']) }}"
                                                        alt="image-produit">
                                                </a>
                                            </td>
                                            <td class="product-name" data-title="Produit">
                                                <a
                                                    href="{{ isset($cartItem['slug']) ? url('product/' . $cartItem['slug']) : '#' }}">{{ $cartItem['nom'] }}</a>
                                                <span>{{ isset($cartItem['description']) ? $cartItem['description'] : 'N/A' }}</span>
                                            </td>
                                            <td class="product-price" data-title="Prix">
                                                <span class="Price-amount">
                                                    {{ $cartItem['prix'] }} <span class="Price-currencySymbol">F CFA</span>
                                                </span>
                                            </td>
                                            <td class="product-quantity" data-title="Quantité">
                                                <div class="quantity">
                                                    <input type="text"
                                                        value="{{ is_numeric($cartItem['quantity']) ? $cartItem['quantity'] : '' }}"
                                                        data-product-id="{{ $cartItem['id'] ?? '' }}" name="quantity-number"
                                                        class="qty" size="4">
                                                    <span class="inc quantity-button">+</span>
                                                    <span class="dec quantity-button">-</span>
                                                </div>
                                            </td>
                                            <td class="product-subtotal" data-title="Total">
                                                <span class="Price-amount">
                                                    {{ number_format($cartItem['total'], 2) }}
                                                    <span class="Price-currencySymbol">F CFA</span>
                                                </span>
                                            </td>
                                            <td class="product-remove">
                                                <a href="{{ isset($cartItem['id']) ? route('cart.remove', ['id' => $cartItem['id']]) : '#' }}"
                                                    class="remove">×</a>
                                            </td>
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
                                            <form id="update-cart-form" method="post" action="{{ route('cart.update') }}">
                                                @csrf
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
                                <div class="col-md-4">
                                    <div class="cart_shipping mt-30">
                                        <h5>Calculer les frais de livraison<span class="ti ti-angle-down"></span></h5>
                                        <p class="text-input orderby">
                                            <select>
                                                <option>Abidjan</option>
                                                <option>Autre</option>
                                            </select>
                                        </p>
                                        <p class="text-input"><input type="text" class="input-text zip-code"
                                                name="shipping_name" placeholder="Code postal / Zip"></p>
                                        <div class="pt-20">
                                            <p class="text-input"><input type="button"
                                                    class="ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-fill ttm-btn-color-skincolor"
                                                    name="update_cart" value="Mettre à jour le total"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="cart_discount mt-30">
                                        <h5>Réduction du coupon<span class="ti ti-angle-down"></span></h5>
                                        <p class="pt-10">Saisissez votre code coupon si vous en avez un.</p>
                                        <p class="text-input"><input type="text" class="input-text zip-code"
                                                name="shipping_name" placeholder="Code promo"></p>
                                        <div class="pt-20">
                                            <p class="text-input"><input type="button"
                                                    class="ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-fill ttm-btn-color-skincolor"
                                                    name="update_cart" value="Appliquer le coupon"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="cart_totals res-767-mt-30">
                                        <h5>Total du panier<span>$1450.00</span></h5>
                                        <h5>Expédition</h5>
                                        <p class="text-input">
                                            <input type="radio" name="grpShipping" value="Male"
                                                Checked>Standard<span>+ $10.00</span>
                                        </p>
                                        <p class="text-input">
                                            <input type="radio" name="grpShipping" value="Female">Standard<span>+
                                                $10.00</span>
                                        </p>
                                        <h5>Total<span>$1460.00</span></h5>
                                    </div>
                                    <div class="proceed-to-checkout">
                                        <a href="#" class="checkout-button button">Passer à la caisse</a>
                                    </div>
                                </div>
                            </div>
                        </div><!-- Fin des collatéraux du panier -->
                    </div>
                </div>
            </div>
        </section><!-- Fin de la section du panier -->

    </div><!-- Fin du site-main -->

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>



@endsection
