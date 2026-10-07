@extends('layouts.layout')
@section('title', $product->nom)
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($product->description), 160))
@section('canonical', route('product', $product->slug))
@section('og_type', 'product')

@php
  $seoImages = json_decode($product->images, true) ?: [];
  $seoImageUrl = !empty($seoImages) ? asset('storage/' . $seoImages[0]) : asset('front/assets/images/logo.png');
@endphp
@section('og_image', $seoImageUrl)

@section('structured_data')
<script type="application/ld+json">
{!! json_encode([
  '@context' => 'https://schema.org',
  '@type' => 'Product',
  'name' => $product->nom,
  'description' => \Illuminate\Support\Str::limit(strip_tags($product->description), 300, ''),
  'image' => $seoImageUrl,
  'sku' => (string) $product->id,
  'category' => optional($product->category)->name,
  'offers' => [
    '@type' => 'Offer',
    'price' => number_format((float) $product->prix, 0, '.', ''),
    'priceCurrency' => 'XOF',
    'availability' => ($product->quantite ?? 1) > 0
        ? 'https://schema.org/InStock'
        : 'https://schema.org/OutOfStock',
    'url' => route('product', $product->slug),
  ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endsection

@section('content')

    <!-- page-title -->
    <div class="ttm-page-title-row">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="page-title-heading">
                            <h1 class="title">{{ $product->nom }}</h1>
                        </div>
                        <div class="breadcrumb-wrapper">
                            <span class="mr-1"><i class="ti ti-home"></i></span>
                            <a title="Homepage" href="/">Accueil</a>
                            <span class="ttm-bread-sep">&nbsp;/&nbsp;</span>
                            <span class="ttm-textcolor-skincolor">Produit</span>
                            <span class="ttm-bread-sep">&nbsp;/&nbsp;</span>
                            <span class="ttm-textcolor-skincolor">{{ $product->nom }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- page-title end-->

    <!--site-main start-->
    <div class="site-main">

        <!-- single-product-section -->
        <section class="single-product-section layout-2 clearfix">
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ttm-single-product-details">
                            <div class="ttm-single-product-info clearfix">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 ml-auto mr-auto">
                                        <div class="product-gallery easyzoom-product-gallery clearfix">
                                            @php
                                                $images = $product->images;
                                                if (is_string($images)) {
                                                    $images = json_decode($images, true);
                                                }
                                                $images = is_array($images) ? $images : [];
                                            @endphp

                                            @if ($images && count($images) > 0)
                                                <div class="product-look-preview-plus left">
                                                    <div class="pr-35 res-767-pr-15">
                                                        <div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails">
                                                            <a href="{{ asset('storage/' . $images[0]) }}">
                                                                <img class="img-fluid"
                                                                    src="{{ asset('storage/' . $images[0]) }}"
                                                                    alt="{{ $product->nom }}"
                                                                    style="width: 100%; height: auto; object-fit: contain; display: block;" />
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <p>Aucune image disponible pour ce produit.</p>
                                            @endif

                                            <div class="product-look-views right">
                                                <div class="mt-35 mb-35">
                                                    <ul class="thumbnails easyzoom-gallery-slider"
                                                        data-slick='{"slidesToShow": 4, "slidesToScroll": 1, "arrows":true, "infinite":true, "vertical":true}'>
                                                        @if (count($images) > 0)
                                                            @foreach ($images as $image)
                                                                <li>
                                                                    <a href="{{ asset('storage/' . $image) }}"
                                                                        data-standard="{{ asset('storage/' . $image) }}">
                                                                        <img class="img-fluid"
                                                                            src="{{ asset('storage/' . $image) }}"
                                                                            alt="{{ $product->nom }}" />
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        @else
                                                            <p>Aucune image disponible</p>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="summary entry-summary pl-30 res-991-pl-0 res-991-pt-40">
                                            <h2 class="product_title entry-title">{{ $product->nom }}</h2>
                                            <div class="share-icons social-links">
                                                <span>Share :</span>
                                                <a href="#"><i class="ti ti-facebook"></i></a>
                                                <a href="#"><i class="ti ti-twitter-alt"></i></a>
                                                {{-- <a href="#"><i class="ti ti-google"></i></a> --}}
                                                <a href="#"><i class="ti ti-linkedin"></i></a>
                                            </div>
                                            <div class="comments-notes clearfix">
                                                &nbsp;&nbsp;<a href="javascript:void(0)" class="review-link"
                                                    rel="nofollow">(Aucun avis)</a>
                                                &nbsp;&nbsp;<a href="javascript:void(0)" class="review-link"
                                                    rel="nofollow">Écrire pour évaluer</a>
                                                {{-- <div class="product-rating clearfix">
                                                    <ul class="star-rating clearfix">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <li>
                                                                @if ($i <= round($product->averageRating()))
                                                                    <!-- méthode fictive -->
                                                                    <i class="fa fa-star"></i>
                                                                @else
                                                                    <i class="fa fa-star-o"></i>
                                                                @endif
                                                            </li>
                                                        @endfor
                                                    </ul>
                                                </div> --}}

                                            </div>
                                            <div class="product_in-stock"><i class="fa fa-check-circle"></i><span> en stock
                                                    Plus que 14 restants</span></div>
                                            <span class="price">
                                                <ins>
                                                    <span class="product-Price-amount">
                                                        {{ number_format($product->prix, 0, ',', ' ') . ' F CFA' }}
                                                    </span>
                                                </ins>
                                                @if ($product->reduction)
                                                    <!-- Si le produit a une réduction -->
                                                    <del>
                                                        <span class="product-Price-amount">
                                                            {{ number_format($product->prix_original, 0, ',', ' ') . ' F CFA' }}
                                                            <!-- prix original -->
                                                        </span>
                                                    </del>
                                                @endif
                                            </span>

                                            {{-- <div class="product-details__short-description">Raising a heavy fur muff that covered the whole of her lower arm towards the viewer regor then turned to look out the window</div> --}}
                                            {{-- <form action="{{ route('cart.update') }}" method="post"> --}}
                                            @if (session('success'))
                                                <div class="alert alert-success mt-2">
                                                    {{ session('success') }}
                                                </div>
                                            @endif
                                            <form action="{{ route('cart.add') }}" method="post">
                                                @csrf
                                                <div class="mt-15 mb-25">

                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <div class="quantity">
                                                        <label>Quantité: </label>
                                                        <input type="number" value="1" name="quantity" class="qty"
                                                            min="1" max="{{ $product->quantite }}">
                                                        <span class="inc quantity-button">+</span>
                                                        <span class="dec quantity-button">-</span>
                                                    </div>

                                                </div>
                                                <div class="actions flex-column">
                                                    <div class="add-to-cart mb-2">
                                                        <button type="submit"
                                                            class="ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-fill ttm-btn-color-skincolor w-100">
                                                            Acheter
                                                        </button>
                                                    </div>
                                                    <div class="go-to-cart mb-2">
                                                        <a class="ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-fill ttm-btn-color-skincolor w-100"
                                                            href="{{ route('cart') }}">
                                                            Allez au panier <i class="fa fa-shopping-cart"></i>
                                                        </a>
                                                    </div>
                                                    <div class="order-via-whatsapp">
                                                        <a class="ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-fill ttm-btn-color-skincolor w-100"
                                                            href="https://wa.me/2250747104513?text=Je%20souhaite%20commander%20ce%20produit:%20{{ $product->nom }}%20Quantité:%201%20Lien:%20http://quincaillerie.ci/product/{{ $product->slug }}">
                                                            Via WhatsApp <i class="fa fa-whatsapp"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </form>

                                            @auth
                                                <form action="{{ route('sponsoring.initiate', $product) }}" method="POST"
                                                    class="mt-3">
                                                    @csrf
                                                    <label for="partner_phone">Téléphone du partenaire (facultatif)</label>
                                                    <input type="text" name="partner_phone" id="partner_phone"
                                                        class="form-control mb-2" value="{{ old('partner_phone') }}"
                                                        maxlength="30">
                                                    @error('partner_phone')
                                                        <div class="text-danger mb-2">{{ $message }}</div>
                                                    @enderror
                                                    <button type="submit"
                                                        class="ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-fill ttm-btn-color-skincolor w-100">
                                                        ⭐ Sponsoriser ce produit — 2 000 FCFA / 5 jours
                                                    </button>
                                                </form>
                                            @endauth


                                            <div class="buttons">
                                                <a href="#" rel="nofollow" data-product-id="24006456"
                                                    data-product-type="simple" class="add_to_wishlist">
                                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                                    <span class="wishlist-text">Ajouter à la liste de souhaits</span>
                                                </a>
                                                <a href="#" class="compare button" data-product_id="24006456"
                                                    rel="nofollow">
                                                    <i class="fa fa-expand" aria-hidden="true"></i>
                                                    <span class="compare-text">Comparer</span>
                                                </a>
                                            </div>
                                            <div id="block-reassurance-1" class="block-reassurance">
                                                <ul>
                                                    <li>
                                                        <div class="block-reassurance-item">
                                                            <i class="fa fa-lock"></i>
                                                            <span>Politique de sécurité </span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="block-reassurance-item">
                                                            <i class="fa fa-truck"></i>
                                                            <span>Politique de livraison </span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="block-reassurance-item">
                                                            <i class="fa fa-arrows-h"></i>
                                                            <span>Politique de retour</span>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pt-30 pb-60 res-991-pt-0 res-991-pb-30">
                                <div class="row no-gutters ttm-bgcolor-grey border">
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <!-- featured-icon-box -->
                                        <div class="featured-icon-box style3 text-center">
                                            <div
                                                class="ttm-icon ttm-icon_element-color-skincolor ttm-icon_element-size-md">
                                                <i class="themifyicon ti-truck"></i>
                                            </div>
                                            <div class="featured-content">
                                                <div class="featured-title">
                                                    <h5>Achats rapides et gratuits</h5>
                                                </div>
                                                <div class="featured-desc">
                                                    <p>Toutes les commandes supérieures à 199 000f CFA</p>
                                                </div>
                                            </div>
                                        </div><!-- featured-icon-box end-->
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <!-- featured-icon-box -->
                                        <div class="featured-icon-box style3 text-center">
                                            <div
                                                class="ttm-icon ttm-icon_element-color-skincolor ttm-icon_element-size-md">
                                                <i class="themifyicon ti-reload"></i>
                                            </div>
                                            <div class="featured-content">
                                                <div class="featured-title">
                                                    <h5>Garantie de remboursement à 100 %</h5>
                                                </div>
                                                <div class="featured-desc">
                                                    <p>Remboursement sous 30 jours</p>
                                                </div>
                                            </div>
                                        </div><!-- featured-icon-box end-->
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <!-- featured-icon-box -->
                                        <div class="featured-icon-box style3 text-center">
                                            <div
                                                class="ttm-icon ttm-icon_element-color-skincolor ttm-icon_element-size-md">
                                                <i class="themifyicon ti-comments"></i>
                                            </div>
                                            <div class="featured-content">
                                                <div class="featured-title">
                                                    <h5>Assistance 24h/24 et 7j/7</h5>
                                                </div>
                                                <div class="featured-desc">
                                                    <p>Ligne directe : +225 05 94 77 56 90</p>
                                                </div>
                                            </div>
                                        </div><!-- featured-icon-box end-->
                                    </div>
                                </div>
                            </div>
                            <div class="ttm-tabs tabs-for-single-products" data-effect="fadeIn">
                                <ul class="tabs clearfix">
                                    <li class="tab active"><a href="#">Description du produit</a></li>
                                    {{-- <li class="tab"><a href="#">Privacy policy</a></li> --}}
                                    <li class="tab"><a href="#">Description du produit</a></li>
                                    {{-- <li class="tab"><a href="#">Terms Of Service</a></li> --}}
                                </ul>
                                <div class="content-tab">
                                    <!-- content-inner -->
                                    <div class="content-inner">
                                        {!! $product->description !!}
                                    </div>
                                    <!-- content-inner end-->
                                    <!-- content-inner -->
                                    <div class="content-inner">
                                        class 2
                                    </div><!-- content-inner end-->
                                    <!-- content-inner -->
                                    <div class="content-inner">
                                        <div id="reviews" class="woocommerce-Reviews">
                                            <div id="comments">
                                                <ol class="commentlist">
                                                    <li class="review">
                                                        <div class="comment_container">
                                                            <img class="avatar" src="images/blog/blog-comment-01.jpg"
                                                                alt="comment-img">
                                                            <div class="comment-text">
                                                                <ul class="star-rating">
                                                                    <li class="fa fa-star"></li>
                                                                    <li class="fa fa-star"></li>
                                                                    <li class="fa fa-star"></li>
                                                                    <li class="fa fa-star"></li>
                                                                    <li class="fa fa-star"></li>
                                                                </ul>
                                                                <p class="meta">
                                                                    <strong class="eview__author">Cherie </strong><span
                                                                        class="review__dash">–</span>
                                                                    <time class="woocommerce-review__published-date"
                                                                        datetime="2018-11-01T04:58:58+00:00">Apr 1,
                                                                        2019</time>
                                                                </p>
                                                                <div class="description">
                                                                    <p>Vestibulum tortor quam, feugiat vitae, ultricies
                                                                        eget, tempor sit amet, ante<br>Very good product and
                                                                        amazing quality.</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="review">
                                                        <div class="comment_container">
                                                            <img class="avatar" src="images/blog/blog-comment-02.jpg"
                                                                alt="comment-img">
                                                            <div class="comment-text">
                                                                <ul class="star-rating">
                                                                    <li class="fa fa-star"></li>
                                                                    <li class="fa fa-star"></li>
                                                                    <li class="fa fa-star"></li>
                                                                    <li class="fa fa-star"></li>
                                                                    <li class="fa fa-star"></li>
                                                                </ul>
                                                                <p class="meta">
                                                                    <strong class="eview__author">Cherie </strong><span
                                                                        class="review__dash">–</span>
                                                                    <time class="woocommerce-review__published-date"
                                                                        datetime="2018-11-01T04:58:58+00:00">Apr 1,
                                                                        2019</time>
                                                                </p>
                                                                <div class="description">
                                                                    <p>Vestibulum tortor quam, feugiat vitae, ultricies
                                                                        eget, tempor sit amet, ante<br>Very good product and
                                                                        amazing quality.</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ol>
                                            </div>
                                            <div id="review_form_wrapper">
                                                <div class="comment-respond">
                                                    <span class="comment-reply-title">Add a review
                                                        <small><a rel="nofollow" id="cancel-comment-reply-link"
                                                                href="#">Cancel reply</a></small>
                                                    </span>
                                                    <form action="#" method="post" id="commentform"
                                                        class="comment-form">
                                                        <p class="comment-notes">
                                                            <span id="email-notes">Your email address will not be
                                                                published.</span> Required fields are marked <span
                                                                class="required">*</span>
                                                        </p>
                                                        <div class="comment-form-rating">
                                                            <label for="rating">Your rating</label>
                                                            <ul class="stars">
                                                                <li class="fa fa-star-o"></li>
                                                                <li class="fa fa-star-o"></li>
                                                                <li class="fa fa-star-o"></li>
                                                                <li class="fa fa-star-o"></li>
                                                                <li class="fa fa-star-o"></li>
                                                            </ul>
                                                            <select name="rating" id="rating" required=""
                                                                tabindex="-1">
                                                                <option value="">Rate…</option>
                                                                <option value="5">Perfect</option>
                                                                <option value="4">Good</option>
                                                                <option value="3">Average</option>
                                                                <option value="2">Not that bad</option>
                                                                <option value="1">Very poor</option>
                                                            </select>
                                                        </div>
                                                        <p class="comment-form-comment">
                                                            <label for="comment">Your review&nbsp;<span
                                                                    class="required">*</span></label>
                                                            <textarea id="comment" name="comment" cols="45" rows="8" required=""></textarea>
                                                        </p>
                                                        <p class="comment-form-author">
                                                            <label for="author">Name&nbsp;<span
                                                                    class="required">*</span></label>
                                                            <input id="author" name="author" type="text"
                                                                value="" required="">
                                                        </p>
                                                        <p class="comment-form-email">
                                                            <label for="email">Email&nbsp;<span
                                                                    class="required">*</span></label>
                                                            <input id="email" name="email" type="email"
                                                                value="" required="">
                                                        </p>
                                                        <p class="form-submit">
                                                            <input name="submit" type="submit" class="submit"
                                                                value="Submit">
                                                        </p>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- content-inner -->
                                    <div class="content-inner">
                                        classe 4
                                    </div><!-- content-inner end-->
                                </div>
                            </div>
                        </div>
                        <div class="pt-35 related products">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="content-sec-head-style">
                                        <div class="content-area-sec-title">
                                            <h5>Produits similaires</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <!-- slick_slider -->
                                    <div class="slick_slider"
                                        data-slick='{"slidesToShow": 4, "slidesToScroll": 4, "arrows":true, "autoplay":true, "infinite":false}'>

                                        @foreach ($product->category->products->where('id', '!=', $product->id)->take(8) as $relatedProduct)
                                            <!-- product -->
                                            <div class="product">
                                                <div class="product-box">
                                                    <!-- product-box-inner -->
                                                    <div class="product-box-inner">
                                                        <div class="product-image-box">
                                                            @if ($relatedProduct->reduction)
                                                                <div class="onsale">Promo!</div>
                                                            @endif
                                                            @php
                                                                $images = json_decode($relatedProduct->images);
                                                            @endphp
                                                            @if ($images && count($images) > 0)
                                                                <img class="img-fluid pro-image-front"
                                                                    src="{{ asset('storage/' . $images[0]) }}"
                                                                    alt="{{ $relatedProduct->nom }}">
                                                                <img class="img-fluid pro-image-back"
                                                                    src="{{ asset('storage/' . ($images[1] ?? $images[0])) }}"
                                                                    alt="{{ $relatedProduct->nom }}">
                                                            @endif
                                                        </div>
                                                        <div class="product-btn-links-wrapper">
                                                            <div class="product-btn">
                                                                <a href="{{ route('cart.add', $relatedProduct->id) }}"
                                                                    class="add-to-cart-btn tooltip-top"
                                                                    data-tooltip="Ajouter au panier">
                                                                    <i class="ti ti-shopping-cart"></i>
                                                                </a>
                                                            </div>
                                                            <div class="product-btn">
                                                                <a href="/product/{{ $relatedProduct->slug }}"
                                                                    class="quick-view-btn tooltip-top"
                                                                    data-tooltip="Voir détails">
                                                                    <i class="ti ti-search"></i>
                                                                </a>
                                                            </div>
                                                            <div class="product-btn">
                                                                <a href="#" class="wishlist-btn tooltip-top"
                                                                    data-tooltip="Ajouter aux favoris">
                                                                    <i class="ti ti-heart"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="product-content-box">
                                                        <a class="product-title"
                                                            href="/product/{{ $relatedProduct->slug }}">
                                                            <h2>{{ $relatedProduct->nom }}</h2>
                                                        </a>
                                                        <span class="price">
                                                            @if ($relatedProduct->reduction)
                                                                <ins>
                                                                    <span class="product-Price-amount">
                                                                        {{ number_format($relatedProduct->prix, 0, ',', ' ') }}
                                                                        F CFA
                                                                    </span>
                                                                </ins>
                                                                <del>
                                                                    <span class="product-Price-amount">
                                                                        {{ number_format($relatedProduct->prix_original, 0, ',', ' ') }}
                                                                        F CFA
                                                                    </span>
                                                                </del>
                                                            @else
                                                                <span class="product-Price-amount">
                                                                    {{ number_format($relatedProduct->prix, 0, ',', ' ') }}
                                                                    F CFA
                                                                </span>
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div><!-- slick_slider end -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- row end -->
            </div>
        </section>
        <!-- single-product-section end -->


    </div><!--site-main end-->

@endsection
