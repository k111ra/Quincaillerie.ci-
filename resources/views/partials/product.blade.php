<!-- product -->
<div class="product col-md-3 col-sm-6 col-xs-12">

    <div class="product-box">
        <!-- product-box-inner -->
        <div class="product-box-inner">
            <a href="{{ url('product/' . $product->slug) }}">
                <div class="product-image-box">
                    @php
                        $images = json_decode($product->images);
                    @endphp

                    @if (!empty($images) && count($images) > 0)
                        <img class="img-fluid pro-image-front" src="{{ asset('storage/' . $images[0]) }}"
                            alt="Image Front">

                        @if (isset($images[1]))
                            <img class="img-fluid pro-image-back" src="{{ asset('storage/' . $images[1]) }}"
                                alt="Image Back">
                        @endif
                    @else
                        <img class="img-fluid pro-image-front"
                            src="{{ asset('front/assets/images/default-image.png') }}" alt="Default Image">
                    @endif
                </div>
            </a>


            <div class="product-btn-links-wrapper">
                <div class="product-btn"><a href="/add-to-cart/{{ $product->id }}" class="add-to-cart-btn tooltip-top"
                        data-tooltip="Add To Cart" data-product-id="{{ $product->id }}"><i
                            class="ti ti-shopping-cart"></i></a>
                </div>
                <div class="product-btn"><a href="{{ url('product/' . $product->slug) }}"
                        class="quick-view-btn js-show-modal1 tooltip-top" data-tooltip="Quick View"><i
                            class="ti ti-search"></i></a>
                </div>
                <div class="product-btn"><a href="#" class="wishlist-btn tooltip-top"
                        data-tooltip="Add To Wishlist"><i class="ti ti-heart"></i></a>
                </div>
            </div>
        </div><!-- product-box-inner end -->
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
                    <span class="product-Price-amount">
                        {{ number_format($product->prix, 0, ',', ' ') . 'F cfa' }}

                    </span>
                </a>

            </span>
        </div>
    </div>


</div>
<!-- product end -->
