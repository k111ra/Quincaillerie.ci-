{{-- Carte produit pour les carrousels (slider). Attend $product. --}}
@php
    $images = is_array($product->images)
        ? $product->images
        : json_decode($product->images ?? '[]');
@endphp
<div class="product">
    <div class="product-box">
        <div class="product-box-inner">
            <div class="product-image-box">
                @if ($product->is_sponsored ?? false)
                    <span class="badge badge-warning position-absolute m-2">
                        {{ ($product->is_shock ?? false) ? '🔥 Offre Choc' : '⭐ Produit certifié' }}
                    </span>
                @endif
                @if (!empty($images) && count($images) > 0)
                    <img class="img-fluid pro-image-front" src="{{ asset('storage/' . $images[0]) }}" alt="{{ $product->nom }}">
                    @if (isset($images[1]))
                        <img class="img-fluid pro-image-back" src="{{ asset('storage/' . $images[1]) }}" alt="{{ $product->nom }}">
                    @endif
                @else
                    <img class="img-fluid pro-image-front" src="{{ asset('front/assets/images/default-image.png') }}" alt="Default Image">
                @endif
            </div>
            <div class="product-btn-links-wrapper">
                <div class="product-btn">
                    <a href="{{ url('product/' . $product->slug) }}" class="add-to-cart-btn tooltip-top" data-tooltip="Voir">
                        <i class="ti ti-shopping-cart"></i>
                    </a>
                </div>
                <div class="product-btn">
                    <a href="javascript:void(0)" class="quick-view-btn js-show-modal1 tooltip-top" data-tooltip="Quick View"
                        data-product-id="{{ $product->id }}">
                        <i class="ti ti-search"></i>
                    </a>
                </div>
                <div class="product-btn">
                    <a href="#" class="wishlist-btn tooltip-top" data-tooltip="Add To Wishlist"><i class="ti ti-heart"></i></a>
                </div>
            </div>
        </div>
        <div class="product-content-box">
            <a class="product-title" href="{{ url('product/' . $product->slug) }}">
                <h2>{{ $product->nom }}</h2>
            </a>
            <div class="star-ratings">
                <ul class="rating">
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star-o"></i></li>
                    <li><i class="fa fa-star-o"></i></li>
                    <li><i class="fa fa-star-o"></i></li>
                </ul>
            </div>
            <span class="price">
                <a href="{{ url('product/' . $product->slug) }}">
                    <span class="product-Price-amount">{{ number_format($product->prix, 0, ',', ' ') . ' F CFA' }}</span>
                </a>
            </span>
            <form action="{{ route('cart.add') }}" method="post">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="quantity" value="1">
                <button type="submit" class="button action-button expand-center" data-tooltip="Ajouter au panier">
                    Acheter
                </button>
            </form>
        </div>
    </div>
</div>
