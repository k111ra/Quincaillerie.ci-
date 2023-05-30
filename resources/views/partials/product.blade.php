<!-- product -->
<div class="product col-md-3 col-sm-6 col-xs-12">
    <div class="product-box">
        <!-- product-box-inner -->
        <div class="product-box-inner">
            <div class="product-image-box">
                <img class="img-fluid pro-image-front" src="{{ asset('storage/' . $product->image) }}"
                    alt="">
                {{-- <img class="img-fluid pro-image-back" src="{{ 'front/assets/images/product/pro-back-09.png' }}"
                    alt=""> --}}
            </div>
            <div class="product-btn-links-wrapper">
                <div class="product-btn"><a href="#" class="add-to-cart-btn tooltip-top"
                        data-tooltip="Add To Cart"><i class="ti ti-shopping-cart"></i></a>
                </div>
                <div class="product-btn"><a href="#" class="quick-view-btn js-show-modal1 tooltip-top"
                        data-tooltip="Quick View"><i class="ti ti-search"></i></a>
                </div>
                <div class="product-btn"><a href="#" class="wishlist-btn tooltip-top"
                        data-tooltip="Add To Wishlist"><i class="ti ti-heart"></i></a>
                </div>
            </div>
        </div><!-- product-box-inner end -->
        <div class="product-content-box">
            <a class="product-title" href="product-layout1.html">
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
                <span class="product-Price-amount">
                    {{ number_format($product->prix, 0, ',', ' ') . 'F cfa' }}

                </span>
            </span>
        </div>
    </div>
</div>
<!-- product end -->
