<!-- product -->
<div class="product col-md-3 col-sm-6 col-xs-12">
    <div class="product-box">
        <!-- product-box-inner -->
        <div class="product-box-inner">
            <a href="{{ url('product/' . $product->slug) }}">
                <div class="product-image-box">
                    @if ($product->is_sponsored ?? false)
                        <span class="badge badge-warning position-absolute m-2">
                            {{ ($product->is_shock ?? false) ? '🔥 Offre Choc' : '⭐ Produit certifié' }}
                        </span>
                    @endif
                    @php
                        $images = is_array($product->images)
                            ? $product->images
                            : json_decode($product->images ?? '[]');
                    @endphp

                    @if (!empty($images) && count($images) > 0)
                        <img class="img-fluid pro-image-front" src="{{ asset('storage/' . $images[0]) }}"
                            alt="Image Front" style="width: 100%; height: 250px; object-fit: cover;">
                        @if (isset($images[1]))
                            <img class="img-fluid pro-image-back" src="{{ asset('storage/' . $images[1]) }}"
                                alt="Image Back" style="width: 100%; height: 250px; object-fit: cover;">
                        @endif
                    @else
                        <img class="img-fluid pro-image-front"
                            src="{{ asset('front/assets/images/default-image.png') }}" alt="Default Image" style="width: 100%; height: 250px; object-fit: cover;">
                    @endif
                </div>
            </a>

            <!-- Action Buttons -->
            <div class="product-btn-links-wrapper">
                {{-- <div class="product-btn">
                    <form action="{{ route('cart.add') }}" method="post">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="add-to-cart-btn tooltip-top" data-tooltip="Add To Cart">
                            <i class="ti ti-shopping-cart"></i>
                        </button>
                    </form>
                </div> --}}
                {{-- <div class="product-btn">
                    <a href="{{ url('product/' . $product->slug) }}" class="add-to-cart-btn tooltip-top"
                        data-tooltip="Add To Cart" data-product-id="{{ $product->id }}">
                        <i class="ti ti-shopping-cart"></i>
                    </a>
                </div> --}}
                <!-- Button to trigger the modal -->
                <div class="product-btn">
                    <a href="javascript:void(0)" class="quick-view-btn js-show-modal1 tooltip-top"
                        data-tooltip="Quick View" data-product-id="{{ $product->id }}">
                        <i class="ti ti-search"></i>
                    </a>
                </div>
                <div class="product-btn">
                    <a href="#" class="wishlist-btn tooltip-top" data-tooltip="Add To Wishlist">
                        <i class="ti ti-heart"></i>
                    </a>
                </div>
            </div>
        </div><!-- product-box-inner end -->

        <!-- Product Information -->
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
                    <span
                        class="product-Price-amount">{{ number_format($product->prix, 0, ',', ' ') . ' F CFA' }}</span>
                </a>
            </span>
            <form action="{{ route('cart.add') }}" method="post">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="quantity" value="1">
                <button type="submit" class="button action-button expand-center " data-tooltip="Ajouter au panier">
                    Acheter
                </button>
            </form>
        </div>
    </div>

    <!-- Modal specific to each product -->
    <div class="wrap-modal1 js-modal1 modal-product-{{ $product->id }}" style="display: none;">
        <div class="overlay-modal1 js-hide-modal1"></div>
        <div class="container">
            <div class="modal1-content">
                <button class="close js-hide-modal1">
                    <i class="fa fa-close"></i>
                </button>
                <div class="row ttm-single-product-details ttm-bgcolor-white">
                    <div class="col-lg-6 col-md-6 col-sm-12 ml-auto mr-auto">
                        <div class="product-gallery easyzoom-product-gallery">
                            <div class="product-look-preview-plus right">
                                <div class="pl-35 res-767-pl-15">
                                    <div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails">
                                        @if (!empty($images) && is_array($images) && isset($images[0]))
                                            <a href="{{ asset('storage/' . $images[0]) }}">
                                                <img class="img-fluid" src="{{ asset('storage/' . $images[0]) }}"
                                                    alt="{{ $product->nom }}"
                                                    style="width: 265px; height: 265px;object-fit: cover;" />
                                            </a>
                                        @else
                                            <p>Aucune image disponible.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="summary entry-summary pl-30 res-991-pl-0 res-991-pt-40">
                            <h2 class="product_title entry-title">{{ $product->nom }}</h2>
                            <span class="price">
                                <ins><span
                                        class="product-Price-amount">{{ number_format($product->prix, 0, ',', ' ') }} F
                                        CFA</span></ins>
                            </span>
                            <div class="product-details__short-description">{{ $product->description }}</div>
                            <div class="mt-30 mb-35">
                                <div class="quantity">
                                    <label>Quantité: </label>
                                    <input type="text" value="1" name="quantity-number" class="qty">
                                    <span class="inc quantity-button">+</span>
                                    <span class="dec quantity-button">-</span>
                                </div>
                            </div>
                            <div class="actions">
                                <div class="add-to-cart">
                                    <a type="submit" href="{{ url('product/' . $product->slug) }}"
                                        class="ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-fill ttm-btn-color-skincolor">Acheter</a>
                                </div>
                                <br>
                                <a class="ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-fill ttm-btn-color-skincolor"
                                    href="{{ route('cart') }}">
                                    Allez au panier . <i class="fa fa-shopping-cart"></i>
                                </a>
                            </div>
                            <div class="buttons">
                                <a href="#" rel="nofollow" data-product-id="{{ $product->id }}"
                                    class="add_to_wishlist">
                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                    <span class="wishlist-text">Favorie</span>
                                </a>
                                <a href="#" class="compare button" data-product_id="{{ $product->id }}"
                                    rel="nofollow">
                                    <i class="fa fa-expand" aria-hidden="true"></i>
                                    <span class="compare-text">Comparer</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal end -->

</div>
<!-- product end -->
