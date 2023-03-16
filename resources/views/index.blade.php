@extends('layouts.layout')
@section('content')
    @include('partials.slider')


    <!--site-main start-->
    <div class="site-main">

        <!-- banner-top-section -->
        <section class="banner-top-section pt-10 res-991-pt-0 clearfix">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <!-- banner-image -->
                        <div class="banner-image pt-30">
                            <a href="#"><img class="img-fluid" src="{{ ("assets/images/banner-six.jpg") }}" alt=""></a>
                        </div><!-- banner-image end -->
                    </div>
                    <div class="col-sm-6">
                        <!-- banner-image -->
                        <div class="banner-image pt-30">
                            <a href="#"><img class="img-fluid" src="{{ ("assets/images/banner-seven.jpg") }}" alt=""></a>
                        </div><!-- banner-image end -->
                    </div>
                </div><!-- row end -->
            </div>
        </section>
        <!-- banner-top-section end -->


        <!-- sidebar -->
        <div class="sidebar ttm-sidebar-left pt-40 pb-40 clearfix">
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-lg-3 widget-area sidebar-left">
                        <aside class="widget widget-text">
                            <h3 class="widget-title">Special Offers</h3>
                            <div class="ttm_info_widget">
                                <span>Handyman Tools</span>
                                <div class="title">
                                    <h3>Limited Time <strong>Offers!</strong></h3>
                                </div>
                                <div class="content">
                                    <p>It’s All Power You Need!</p>
                                    <h4>Up To <strong>35%</strong> Off!</h4>
                                </div>
                                <a class="ttm-btn ttm-btn-size-sm ttm-btn-color-skincolor btn-inline"
                                    href="#">Shopping Now!</a>
                            </div>
                        </aside>
                        <aside class="widget products top-rated-products">
                            <h3 class="widget-title">Featured Products</h3>
                            <ul class="product-list-widget product">
                                <li>
                                    <a href="#"><img src="{{ ("assets/images/product/pro-front-09.png") }}" alt=""></a>
                                    <div class="product-content-box">
                                        <div class="star-ratings">
                                            <ul class="rating">
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                            </ul>
                                        </div>
                                        <a class="product-title" href="product-layout1.html">
                                            <h2>Hammer Drill</h2>
                                        </a>
                                        <span class="price">
                                            <span class="product-Price-amount">
                                                <span class="product-Price-currencySymbol">$</span>77.00
                                            </span>
                                        </span>
                                    </div>
                                </li>
                                <li>
                                    <a href="#"><img src="{{ ("assets/images/product/pro-front-02.png") }}" alt=""></a>
                                    <div class="product-content-box">
                                        <div class="star-ratings">
                                            <ul class="rating">
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                            </ul>
                                        </div>
                                        <a class="product-title" href="product-layout1.html">
                                            <h2>Impact Wrench</h2>
                                        </a>
                                        <span class="price">
                                            <ins><span class="product-Price-amount">
                                                    <span class="product-Price-currencySymbol">$</span>110.00
                                                </span>
                                            </ins>
                                            <del><span class="product-Price-amount">
                                                    <span class="product-Price-currencySymbol">$</span>123.00
                                                </span>
                                            </del>
                                        </span>
                                    </div>
                                </li>
                                <li>
                                    <a href="#"><img src="{{ ("assets/images/product/pro-front-08.png") }}" alt=""></a>
                                    <div class="product-content-box">
                                        <div class="star-ratings">
                                            <ul class="rating">
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                            </ul>
                                        </div>
                                        <a class="product-title" href="product-layout1.html">
                                            <h2>Tape Measure</h2>
                                        </a>
                                        <span class="price">
                                            <span class="product-Price-amount">
                                                <span class="product-Price-currencySymbol">$</span>24.00
                                            </span>
                                        </span>
                                    </div>
                                </li>
                                <li>
                                    <a href="#"><img src="{{ ("assets/images/product/pro-front-06.png") }}" alt=""></a>
                                    <div class="product-content-box">
                                        <div class="star-ratings">
                                            <ul class="rating">
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                            </ul>
                                        </div>
                                        <a class="product-title" href="product-layout1.html">
                                            <h2>Circular Saw</h2>
                                        </a>
                                        <span class="price">
                                            <ins><span class="product-Price-amount">
                                                    <span class="product-Price-currencySymbol">$</span>124.00
                                                </span>
                                            </ins>
                                            <del><span class="product-Price-amount">
                                                    <span class="product-Price-currencySymbol">$</span>111.00
                                                </span>
                                            </del>
                                        </span>
                                    </div>
                                </li>
                            </ul>
                        </aside>
                        <aside class="widget widget-testimonial">
                            <h3 class="widget-title">Testimonial</h3>
                            <!-- wrap-testimonial -->
                            <!-- testimonial_slick_slider -->
                            <div class="testimonial_slick_slider"
                                data-slick='{"slidesToShow": 1, "slidesToScroll": 1, "arrows":false, "dots":true, "autoplay":false, "infinite":true}'>
                                <!-- testimonials -->
                                <div class="testimonials ttm-testimonial-box-view-style2">
                                    <div class="testimonial-content">
                                        <blockquote class="ttm-testimonial-text">Satisfied customer is the best
                                            source of advertise &shy;ment, & I'm one of those custom satisfied.
                                        </blockquote>
                                        <div class="testimonial-avatar">
                                            <div class="testimonial-img">
                                                <img class="img-fluid" src="{{ ('assets/images/testimonial/01.jpg') }}"
                                                    alt="testimonial-img">
                                            </div>
                                            <div class="testimonial-caption">
                                                <h5>Leax May</h5>
                                                <label>Web Canst</label>
                                                <div class="star-ratings">
                                                    <ul class="rating">
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- testimonials end -->
                                <!-- testimonials -->
                                <div class="testimonials ttm-testimonial-box-view-style2">
                                    <div class="testimonial-content">
                                        <blockquote class="ttm-testimonial-text">Satisfied customer is the best
                                            source of advertise &shy;ment, & I'm one of those custom satisfied.
                                        </blockquote>
                                        <div class="testimonial-avatar">
                                            <div class="testimonial-img">
                                                <img class="img-fluid" src="{{ ("assets/images/testimonial/02.jpg") }}"
                                                    alt="testimonial-img">
                                            </div>
                                            <div class="testimonial-caption">
                                                <h5>Alan Sears</h5>
                                                <label>Web Canst</label>
                                                <div class="star-ratings">
                                                    <ul class="rating">
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- testimonials end -->
                                <!-- testimonials -->
                                <div class="testimonials ttm-testimonial-box-view-style2">
                                    <div class="testimonial-content">
                                        <blockquote class="ttm-testimonial-text">Satisfied customer is the best
                                            source of advertise &shy;ment, & I'm one of those custom satisfied.
                                        </blockquote>
                                        <div class="testimonial-avatar">
                                            <div class="testimonial-img">
                                                <img class="img-fluid" src="{{ ("assets/images/testimonial/03.jpg") }}"
                                                    alt="testimonial-img">
                                            </div>
                                            <div class="testimonial-caption">
                                                <h5>Alex Jones</h5>
                                                <label>Web Canst</label>
                                                <div class="star-ratings">
                                                    <ul class="rating">
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- testimonials end -->
                            </div><!-- wrap-testimonial end-->
                        </aside>
                        <aside class="widget products top-rated-products">
                            <h3 class="widget-title">Featured Products</h3>
                            <ul class="product-list-widget product">
                                <li>
                                    <a href="#"><img src="{{ ("assets/images/product/pro-front-10.png") }}" alt=""></a>
                                    <div class="product-content-box">
                                        <div class="star-ratings">
                                            <ul class="rating">
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                            </ul>
                                        </div>
                                        <a class="product-title" href="product-layout1.html">
                                            <h2>Rotary Hammer</h2>
                                        </a>
                                        <span class="price">
                                            <span class="product-Price-amount">
                                                <span class="product-Price-currencySymbol">$</span>80.00
                                            </span>
                                        </span>
                                    </div>
                                </li>
                                <li>
                                    <a href="#"><img src="{{ ('assets/images/product/pro-front-02.png') }}" alt=""></a>
                                    <div class="product-content-box">
                                        <div class="star-ratings">
                                            <ul class="rating">
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                            </ul>
                                        </div>
                                        <a class="product-title" href="product-layout1.html">
                                            <h2>Impact Wrench</h2>
                                        </a>
                                        <span class="price">
                                            <ins><span class="product-Price-amount">
                                                    <span class="product-Price-currencySymbol">$</span>110.00
                                                </span>
                                            </ins>
                                            <del><span class="product-Price-amount">
                                                    <span class="product-Price-currencySymbol">$</span>123.00
                                                </span>
                                            </del>
                                        </span>
                                    </div>
                                </li>
                                <li>
                                    <a href="#"><img src="{{ ("assets/images/product/pro-front-08.png") }}" alt=""></a>
                                    <div class="product-content-box">
                                        <div class="star-ratings">
                                            <ul class="rating">
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                            </ul>
                                        </div>
                                        <a class="product-title" href="product-layout1.html">
                                            <h2>Tape Measure</h2>
                                        </a>
                                        <span class="price">
                                            <span class="product-Price-amount">
                                                <span class="product-Price-currencySymbol">$</span>24.00
                                            </span>
                                        </span>
                                    </div>
                                </li>
                                <li>
                                    <a href="#"><img src="{{ ("assets/images/product/pro-front-06.png") }}" alt=""></a>
                                    <div class="product-content-box">
                                        <div class="star-ratings">
                                            <ul class="rating">
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                            </ul>
                                        </div>
                                        <a class="product-title" href="product-layout1.html">
                                            <h2>Circular Saw</h2>
                                        </a>
                                        <span class="price">
                                            <ins><span class="product-Price-amount">
                                                    <span class="product-Price-currencySymbol">$</span>124.00
                                                </span>
                                            </ins>
                                            <del><span class="product-Price-amount">
                                                    <span class="product-Price-currencySymbol">$</span>111.00
                                                </span>
                                            </del>
                                        </span>
                                    </div>
                                </li>
                            </ul>
                        </aside>
                        <aside class="widget widget_media_image banner-image">
                            <a href="#"><img class="img-fluid" src="{{ ("assets/images/widget-banner-one.jpg") }}"
                                    alt="widget-banner"></a>
                        </aside>
                        <aside class="widget widget_media_image banner-image">
                            <a href="#"><img class="img-fluid" src="{{ ("assets/images/widget-banner-two.jpg") }}"
                                    alt="widget-banner"></a>
                        </aside>
                    </div>
                    <div class="col-lg-9 content-area">
                        <div class="products products-fitter">
                            <div class="ttm-tabs">
                                <div class="content-sec-head-style">
                                    <div class="content-area-sec-title">
                                        <h5>Our Top Selling Products</h5>
                                    </div>
                                    <ul class="tabs text-right">
                                        <li class="tab active"><a href="#">New Product</a></li>
                                        <li class="tab"><a href="#">Special</a></li>
                                        <li class="tab"><a href="#">Onsale</a></li>
                                    </ul>
                                </div>
                                <div class="content-tab">
                                    <div class="content-inner">
                                        <div class="products row">
                                            <!-- product -->
                                            <div class="product col-md-3 col-sm-6 col-xs-12">
                                                <div class="product-box">
                                                    <!-- product-box-inner -->
                                                    <div class="product-box-inner">
                                                        <div class="product-image-box">
                                                            <img class="img-fluid pro-image-front"
                                                                src="{{ ("assets/images/product/pro-front-09.png") }}" alt="">
                                                            <img class="img-fluid pro-image-back"
                                                                src="{{ ("assets/images/product/pro-back-09.png") }}" alt="">
                                                        </div>
                                                        <div class="product-btn-links-wrapper">
                                                            <div class="product-btn"><a href="#"
                                                                    class="add-to-cart-btn tooltip-top"
                                                                    data-tooltip="Add To Cart"><i
                                                                        class="ti ti-shopping-cart"></i></a>
                                                            </div>
                                                            <div class="product-btn"><a href="#"
                                                                    class="quick-view-btn js-show-modal1 tooltip-top"
                                                                    data-tooltip="Quick View"><i
                                                                        class="ti ti-search"></i></a>
                                                            </div>
                                                            <div class="product-btn"><a href="#"
                                                                    class="wishlist-btn tooltip-top"
                                                                    data-tooltip="Add To Wishlist"><i
                                                                        class="ti ti-heart"></i></a>
                                                            </div>
                                                        </div>
                                                    </div><!-- product-box-inner end -->
                                                    <div class="product-content-box">
                                                        <a class="product-title" href="product-layout1.html">
                                                            <h2>Hammer Drill</h2>
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
                                                                <span class="product-Price-currencySymbol">$</span>77.00
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div><!-- product end -->
                                            <!-- product -->
                                            <div class="product col-md-3 col-sm-6 col-xs-12">
                                                <div class="product-box">
                                                    <!-- product-box-inner -->
                                                    <div class="product-box-inner">
                                                        <div class="product-image-box">
                                                            <img class="img-fluid pro-image-front"
                                                                src="{{ ("assets/images/product/pro-front-05.png") }}" alt="">
                                                            <img class="img-fluid pro-image-back"
                                                                src="{{ ("assets/images/product/pro-back-05.png") }}" alt="">
                                                        </div>
                                                        <div class="product-btn-links-wrapper">
                                                            <div class="product-btn"><a href="#"
                                                                    class="add-to-cart-btn tooltip-top"
                                                                    data-tooltip="Add To Cart"><i
                                                                        class="ti ti-shopping-cart"></i></a>
                                                            </div>
                                                            <div class="product-btn"><a href="#"
                                                                    class="quick-view-btn js-show-modal1 tooltip-top"
                                                                    data-tooltip="Quick View"><i
                                                                        class="ti ti-search"></i></a>
                                                            </div>
                                                            <div class="product-btn"><a href="#"
                                                                    class="wishlist-btn tooltip-top"
                                                                    data-tooltip="Add To Wishlist"><i
                                                                        class="ti ti-heart"></i></a>
                                                            </div>
                                                        </div>
                                                    </div><!-- product-box-inner end -->
                                                    <div class="product-content-box">
                                                        <a class="product-title" href="product-layout1.html">
                                                            <h2>Folding Hex Key Set</h2>
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
                                                                <span class="product-Price-currencySymbol">$</span>62.00
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div><!-- product end -->
                                            <!-- product -->
                                            <div class="product col-md-3 col-sm-6 col-xs-12">
                                                <div class="product-box">
                                                    <!-- product-box-inner -->
                                                    <div class="product-box-inner">
                                                        <div class="product-image-box">
                                                            <div class="onsale">Sale!</div>
                                                            <img class="img-fluid pro-image-front"
                                                                src="{{ ("assets/images/product/pro-front-02.png") }}" alt="">
                                                            <img class="img-fluid pro-image-back"
                                                                src="{{ ("assets/images/product/pro-back-02.png") }}" alt="">
                                                        </div>
                                                        <div class="product-btn-links-wrapper">
                                                            <div class="product-btn"><a href="#"
                                                                    class="add-to-cart-btn tooltip-top"
                                                                    data-tooltip="Add To Cart"><i
                                                                        class="ti ti-shopping-cart"></i></a>
                                                            </div>
                                                            <div class="product-btn"><a href="#"
                                                                    class="quick-view-btn js-show-modal1 tooltip-top"
                                                                    data-tooltip="Quick View"><i
                                                                        class="ti ti-search"></i></a>
                                                            </div>
                                                            <div class="product-btn"><a href="#"
                                                                    class="wishlist-btn tooltip-top"
                                                                    data-tooltip="Add To Wishlist"><i
                                                                        class="ti ti-heart"></i></a>
                                                            </div>
                                                        </div>
                                                    </div><!-- product-box-inner end -->
                                                    <div class="product-content-box">
                                                        <a class="product-title" href="product-layout1.html">
                                                            <h2>Impact Wrench</h2>
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
                                                            <ins><span class="product-Price-amount">
                                                                    <span
                                                                        class="product-Price-currencySymbol">$</span>110.00
                                                                </span>
                                                            </ins>
                                                            <del><span class="product-Price-amount">
                                                                    <span
                                                                        class="product-Price-currencySymbol">$</span>123.00
                                                                </span>
                                                            </del>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div><!-- product end -->
                                            <!-- product -->
                                            <div class="product col-md-3 col-sm-6 col-xs-12">
                                                <div class="product-box">
                                                    <!-- product-box-inner -->
                                                    <div class="product-box-inner">
                                                        <div class="product-image-box">
                                                            <img class="img-fluid pro-image-front"
                                                                src="{{ ("assets/images/product/pro-front-08.png") }}" alt="">
                                                            <img class="img-fluid pro-image-back"
                                                                src="{{ ("assets/images/product/pro-back-08.png") }}" alt="">
                                                        </div>
                                                        <div class="product-btn-links-wrapper">
                                                            <div class="product-btn"><a href="#"
                                                                    class="add-to-cart-btn tooltip-top"
                                                                    data-tooltip="Add To Cart"><i
                                                                        class="ti ti-shopping-cart"></i></a>
                                                            </div>
                                                            <div class="product-btn"><a href="#"
                                                                    class="quick-view-btn js-show-modal1 tooltip-top"
                                                                    data-tooltip="Quick View"><i
                                                                        class="ti ti-search"></i></a>
                                                            </div>
                                                            <div class="product-btn"><a href="#"
                                                                    class="wishlist-btn tooltip-top"
                                                                    data-tooltip="Add To Wishlist"><i
                                                                        class="ti ti-heart"></i></a>
                                                            </div>
                                                        </div>
                                                    </div><!-- product-box-inner end -->
                                                    <div class="product-content-box">
                                                        <a class="product-title" href="product-layout1.html">
                                                            <h2>Tape Measure</h2>
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
                                                                <span class="product-Price-currencySymbol">$</span>24.00
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div><!-- product end -->
                                            <!-- product -->
                                            <div class="product col-md-3 col-sm-6 col-xs-12">
                                                <div class="product-box">
                                                    <!-- product-box-inner -->
                                                    <div class="product-box-inner">
                                                        <div class="product-image-box">
                                                            <img class="img-fluid pro-image-front"
                                                                src="{{ ("assets/images/product/pro-front-01.png") }}" alt="">
                                                            <img class="img-fluid pro-image-back"
                                                                src="{{ ("assets/images/product/pro-back-01.png") }}" alt="">
                                                        </div>
                                                        <div class="product-btn-links-wrapper">
                                                            <div class="product-btn"><a href="#"
                                                                    class="add-to-cart-btn tooltip-top"
                                                                    data-tooltip="Add To Cart"><i
                                                                        class="ti ti-shopping-cart"></i></a>
                                                            </div>
                                                            <div class="product-btn"><a href="#"
                                                                    class="quick-view-btn js-show-modal1 tooltip-top"
                                                                    data-tooltip="Quick View"><i
                                                                        class="ti ti-search"></i></a>
                                                            </div>
                                                            <div class="product-btn"><a href="#"
                                                                    class="wishlist-btn tooltip-top"
                                                                    data-tooltip="Add To Wishlist"><i
                                                                        class="ti ti-heart"></i></a>
                                                            </div>
                                                        </div>
                                                    </div><!-- product-box-inner end -->
                                                    <div class="product-content-box">
                                                        <a class="product-title" href="product-layout1.html">
                                                            <h2>Reel Fiberglass Tape</h2>
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
                                                                <span class="product-Price-currencySymbol">$</span>40.00
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div><!-- product end -->
                                            <!-- product -->
                                            <div class="product col-md-3 col-sm-6 col-xs-12">
                                                <div class="product-box">
                                                    <!-- product-box-inner -->
                                                    <div class="product-box-inner">
                                                        <div class="onsale">Sale!</div>
                                                        <div class="product-image-box">
                                                            <img class="img-fluid pro-image-front"
                                                                src="{{ ("assets/images/product/pro-front-06.png") }}" alt="">
                                                            <img class="img-fluid pro-image-back"
                                                                src="{{ ("assets/images/product/pro-back-06.png") }}" alt="">
                                                        </div>
                                                        <div class="product-btn-links-wrapper">
                                                            <div class="product-btn"><a href="#"
                                                                    class="add-to-cart-btn tooltip-top"
                                                                    data-tooltip="Add To Cart"><i
                                                                        class="ti ti-shopping-cart"></i></a>
                                                            </div>
                                                            <div class="product-btn"><a href="#"
                                                                    class="quick-view-btn js-show-modal1 tooltip-top"
                                                                    data-tooltip="Quick View"><i
                                                                        class="ti ti-search"></i></a>
                                                            </div>
                                                            <div class="product-btn"><a href="#"
                                                                    class="wishlist-btn tooltip-top"
                                                                    data-tooltip="Add To Wishlist"><i
                                                                        class="ti ti-heart"></i></a>
                                                            </div>
                                                        </div>
                                                    </div><!-- product-box-inner end -->
                                                    <div class="product-content-box">
                                                        <a class="product-title" href="product-layout1.html">
                                                            <h2>Circular Saw</h2>
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
                                                            <ins><span class="product-Price-amount">
                                                                    <span
                                                                        class="product-Price-currencySymbol">$</span>124.00
                                                                </span>
                                                            </ins>
                                                            <del><span class="product-Price-amount">
                                                                    <span
                                                                        class="product-Price-currencySymbol">$</span>111.00
                                                                </span>
                                                            </del>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div><!-- product end -->
                                            <!-- product -->
                                            <div class="product col-md-3 col-sm-6 col-xs-12">
                                                <div class="product-box">
                                                    <!-- product-box-inner -->
                                                    <div class="product-box-inner">
                                                        <div class="product-image-box">
                                                            <img class="img-fluid pro-image-front"
                                                                src="{{ ("assets/images/product/pro-front-03.png") }}" alt="">
                                                            <img class="img-fluid pro-image-back"
                                                                src="{{ ("assets/images/product/pro-back-03.png") }}" alt="">
                                                        </div>
                                                        <div class="product-btn-links-wrapper">
                                                            <div class="product-btn"><a href="#"
                                                                    class="add-to-cart-btn tooltip-top"
                                                                    data-tooltip="Add To Cart"><i
                                                                        class="ti ti-shopping-cart"></i></a>
                                                            </div>
                                                            <div class="product-btn"><a href="#"
                                                                    class="quick-view-btn js-show-modal1 tooltip-top"
                                                                    data-tooltip="Quick View"><i
                                                                        class="ti ti-search"></i></a>
                                                            </div>
                                                            <div class="product-btn"><a href="#"
                                                                    class="wishlist-btn tooltip-top"
                                                                    data-tooltip="Add To Wishlist"><i
                                                                        class="ti ti-heart"></i></a>
                                                            </div>
                                                        </div>
                                                    </div><!-- product-box-inner end -->
                                                    <div class="product-content-box">
                                                        <a class="product-title" href="product-layout1.html">
                                                            <h2>Demolition Breaker</h2>
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
                                                                <span class="product-Price-currencySymbol">$</span>38.00
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div><!-- product end -->
                                            <!-- product -->
                                            <div class="product col-md-3 col-sm-6 col-xs-12">
                                                <div class="product-box">
                                                    <!-- product-box-inner -->
                                                    <div class="product-box-inner">
                                                        <div class="product-image-box">
                                                            <div class="onsale">Sale!</div>
                                                            <img class="img-fluid pro-image-front"
                                                                src="{{ ("assets/images/product/pro-front-04.png") }}" alt="">
                                                            <img class="img-fluid pro-image-back"
                                                                src="{{ ("assets/images/product/pro-back-04.png") }}" alt="">
                                                        </div>
                                                        <div class="product-btn-links-wrapper">
                                                            <div class="product-btn"><a href="#"
                                                                    class="add-to-cart-btn tooltip-top"
                                                                    data-tooltip="Add To Cart"><i
                                                                        class="ti ti-shopping-cart"></i></a>
                                                            </div>
                                                            <div class="product-btn"><a href="#"
                                                                    class="quick-view-btn js-show-modal1 tooltip-top"
                                                                    data-tooltip="Quick View"><i
                                                                        class="ti ti-search"></i></a>
                                                            </div>
                                                            <div class="product-btn"><a href="#"
                                                                    class="wishlist-btn tooltip-top"
                                                                    data-tooltip="Add To Wishlist"><i
                                                                        class="ti ti-heart"></i></a>
                                                            </div>
                                                        </div>
                                                    </div><!-- product-box-inner end -->
                                                    <div class="product-content-box">
                                                        <a class="product-title" href="product-layout1.html">
                                                            <h2>Cordless Drywall Cutter</h2>
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
                                                            <ins><span class="product-Price-amount">
                                                                    <span
                                                                        class="product-Price-currencySymbol">$</span>99.00
                                                                </span>
                                                            </ins>
                                                            <del><span class="product-Price-amount">
                                                                    <span
                                                                        class="product-Price-currencySymbol">$</span>82.00
                                                                </span>
                                                            </del>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div><!-- product end -->
                                        </div>
                                    </div>
                                    <!-- content-inner -->
                                    <div class="content-inner">
                                        <div class="products row">
                                            <!-- product -->
                                            <div class="product col-md-3 col-sm-6 col-xs-12">
                                                <div class="product-box">
                                                    <!-- product-box-inner -->
                                                    <div class="product-box-inner">
                                                        <div class="product-image-box">
                                                            <img class="img-fluid pro-image-front"
                                                                src="{{ ("assets/images/product/pro-front-01.png") }}" alt="">
                                                            <img class="img-fluid pro-image-back"
                                                                src="{{ ("assets/images/product/pro-back-01.png") }}" alt="">
                                                        </div>
                                                        <div class="product-btn-links-wrapper">
                                                            <div class="product-btn"><a href="#"
                                                                    class="add-to-cart-btn tooltip-top"
                                                                    data-tooltip="Add To Cart"><i
                                                                        class="ti ti-shopping-cart"></i></a>
                                                            </div>
                                                            <div class="product-btn"><a href="#"
                                                                    class="quick-view-btn js-show-modal1 tooltip-top"
                                                                    data-tooltip="Quick View"><i
                                                                        class="ti ti-search"></i></a>
                                                            </div>
                                                            <div class="product-btn"><a href="#"
                                                                    class="wishlist-btn tooltip-top"
                                                                    data-tooltip="Add To Wishlist"><i
                                                                        class="ti ti-heart"></i></a>
                                                            </div>
                                                        </div>
                                                    </div><!-- product-box-inner end -->
                                                    <div class="product-content-box">
                                                        <a class="product-title" href="product-layout1.html">
                                                            <h2>Reel Fiberglass Tape</h2>
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
                                                                <span class="product-Price-currencySymbol">$</span>40.00
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div><!-- product end -->
                                            <!-- product -->
                                            <div class="product col-md-3 col-sm-6 col-xs-12">
                                                <div class="product-box">
                                                    <!-- product-box-inner -->
                                                    <div class="product-box-inner">
                                                        <div class="product-image-box">
                                                            <div class="onsale">Sale!</div>
                                                            <img class="img-fluid pro-image-front"
                                                                src="{{ ("assets/images/product/pro-front-02.png") }}" alt="">
                                                            <img class="img-fluid pro-image-back"
                                                                src="{{ ("assets/images/product/pro-back-02.png") }}" alt="">
                                                        </div>
                                                        <div class="product-btn-links-wrapper">
                                                            <div class="product-btn"><a href="#"
                                                                    class="add-to-cart-btn tooltip-top"
                                                                    data-tooltip="Add To Cart"><i
                                                                        class="ti ti-shopping-cart"></i></a>
                                                            </div>
                                                            <div class="product-btn"><a href="#"
                                                                    class="quick-view-btn js-show-modal1 tooltip-top"
                                                                    data-tooltip="Quick View"><i
                                                                        class="ti ti-search"></i></a>
                                                            </div>
                                                            <div class="product-btn"><a href="#"
                                                                    class="wishlist-btn tooltip-top"
                                                                    data-tooltip="Add To Wishlist"><i
                                                                        class="ti ti-heart"></i></a>
                                                            </div>
                                                        </div>
                                                    </div><!-- product-box-inner end -->
                                                    <div class="product-content-box">
                                                        <a class="product-title" href="product-layout1.html">
                                                            <h2>Impact Wrench</h2>
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
                                                            <ins><span class="product-Price-amount">
                                                                    <span
                                                                        class="product-Price-currencySymbol">$</span>110.00
                                                                </span>
                                                            </ins>
                                                            <del><span class="product-Price-amount">
                                                                    <span
                                                                        class="product-Price-currencySymbol">$</span>123.00
                                                                </span>
                                                            </del>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div><!-- product end -->
                                            <!-- product -->
                                            <div class="product col-md-3 col-sm-6 col-xs-12">
                                                <div class="product-box">
                                                    <!-- product-box-inner -->
                                                    <div class="product-box-inner">
                                                        <div class="product-image-box">
                                                            <img class="img-fluid pro-image-front"
                                                                src="{{ ("assets/images/product/pro-front-03.png") }}" alt="">
                                                            <img class="img-fluid pro-image-back"
                                                                src="{{ ("assets/images/product/pro-back-03.png") }}" alt="">
                                                        </div>
                                                        <div class="product-btn-links-wrapper">
                                                            <div class="product-btn"><a href="#"
                                                                    class="add-to-cart-btn tooltip-top"
                                                                    data-tooltip="Add To Cart"><i
                                                                        class="ti ti-shopping-cart"></i></a>
                                                            </div>
                                                            <div class="product-btn"><a href="#"
                                                                    class="quick-view-btn js-show-modal1 tooltip-top"
                                                                    data-tooltip="Quick View"><i
                                                                        class="ti ti-search"></i></a>
                                                            </div>
                                                            <div class="product-btn"><a href="#"
                                                                    class="wishlist-btn tooltip-top"
                                                                    data-tooltip="Add To Wishlist"><i
                                                                        class="ti ti-heart"></i></a>
                                                            </div>
                                                        </div>
                                                    </div><!-- product-box-inner end -->
                                                    <div class="product-content-box">
                                                        <a class="product-title" href="product-layout1.html">
                                                            <h2>Demolition Breaker</h2>
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
                                                                <span class="product-Price-currencySymbol">$</span>38.00
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div><!-- product end -->
                                            <!-- product -->
                                            <div class="product col-md-3 col-sm-6 col-xs-12">
                                                <div class="product-box">
                                                    <!-- product-box-inner -->
                                                    <div class="product-box-inner">
                                                        <div class="product-image-box">
                                                            <div class="onsale">Sale!</div>
                                                            <img class="img-fluid pro-image-front"
                                                                src="{{ ("assets/images/product/pro-front-04.png") }}" alt="">
                                                            <img class="img-fluid pro-image-back"
                                                                src="{{ ("assets/images/product/pro-back-04.png") }}" alt="">
                                                        </div>
                                                        <div class="product-btn-links-wrapper">
                                                            <div class="product-btn"><a href="#"
                                                                    class="add-to-cart-btn tooltip-top"
                                                                    data-tooltip="Add To Cart"><i
                                                                        class="ti ti-shopping-cart"></i></a>
                                                            </div>
                                                            <div class="product-btn"><a href="#"
                                                                    class="quick-view-btn js-show-modal1 tooltip-top"
                                                                    data-tooltip="Quick View"><i
                                                                        class="ti ti-search"></i></a>
                                                            </div>
                                                            <div class="product-btn"><a href="#"
                                                                    class="wishlist-btn tooltip-top"
                                                                    data-tooltip="Add To Wishlist"><i
                                                                        class="ti ti-heart"></i></a>
                                                            </div>
                                                        </div>
                                                    </div><!-- product-box-inner end -->
                                                    <div class="product-content-box">
                                                        <a class="product-title" href="product-layout1.html">
                                                            <h2>Cordless Drywall Cutter</h2>
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
                                                            <ins><span class="product-Price-amount">
                                                                    <span
                                                                        class="product-Price-currencySymbol">$</span>99.00
                                                                </span>
                                                            </ins>
                                                            <del><span class="product-Price-amount">
                                                                    <span
                                                                        class="product-Price-currencySymbol">$</span>82.00
                                                                </span>
                                                            </del>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div><!-- product end -->
                                            <!-- product -->
                                            <div class="product col-md-3 col-sm-6 col-xs-12">
                                                <div class="product-box">
                                                    <!-- product-box-inner -->
                                                    <div class="product-box-inner">
                                                        <div class="product-image-box">
                                                            <img class="img-fluid pro-image-front"
                                                                src="{{ ("assets/images/product/pro-front-05.png") }}" alt="">
                                                            <img class="img-fluid pro-image-back"
                                                                src="{{ ("assets/images/product/pro-back-05.png") }}" alt="">
                                                        </div>
                                                        <div class="product-btn-links-wrapper">
                                                            <div class="product-btn"><a href="#"
                                                                    class="add-to-cart-btn tooltip-top"
                                                                    data-tooltip="Add To Cart"><i
                                                                        class="ti ti-shopping-cart"></i></a>
                                                            </div>
                                                            <div class="product-btn"><a href="#"
                                                                    class="quick-view-btn js-show-modal1 tooltip-top"
                                                                    data-tooltip="Quick View"><i
                                                                        class="ti ti-search"></i></a>
                                                            </div>
                                                            <div class="product-btn"><a href="#"
                                                                    class="wishlist-btn tooltip-top"
                                                                    data-tooltip="Add To Wishlist"><i
                                                                        class="ti ti-heart"></i></a>
                                                            </div>
                                                        </div>
                                                    </div><!-- product-box-inner end -->
                                                    <div class="product-content-box">
                                                        <a class="product-title" href="product-layout1.html">
                                                            <h2>Folding Hex Key Set</h2>
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
                                                                <span class="product-Price-currencySymbol">$</span>62.00
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div><!-- product end -->
                                            <!-- product -->
                                            <div class="product col-md-3 col-sm-6 col-xs-12">
                                                <div class="product-box">
                                                    <!-- product-box-inner -->
                                                    <div class="product-box-inner">
                                                        <div class="onsale">Sale!</div>
                                                        <div class="product-image-box">
                                                            <img class="img-fluid pro-image-front"
                                                                src="{{ ("assets/images/product/pro-front-06.png") }}" alt="">
                                                            <img class="img-fluid pro-image-back"
                                                                src="{{ ("assets/images/product/pro-back-06.png") }}" alt="">
                                                        </div>
                                                        <div class="product-btn-links-wrapper">
                                                            <div class="product-btn"><a href="#"
                                                                    class="add-to-cart-btn tooltip-top"
                                                                    data-tooltip="Add To Cart"><i
                                                                        class="ti ti-shopping-cart"></i></a>
                                                            </div>
                                                            <div class="product-btn"><a href="#"
                                                                    class="quick-view-btn js-show-modal1 tooltip-top"
                                                                    data-tooltip="Quick View"><i
                                                                        class="ti ti-search"></i></a>
                                                            </div>
                                                            <div class="product-btn"><a href="#"
                                                                    class="wishlist-btn tooltip-top"
                                                                    data-tooltip="Add To Wishlist"><i
                                                                        class="ti ti-heart"></i></a>
                                                            </div>
                                                        </div>
                                                    </div><!-- product-box-inner end -->
                                                    <div class="product-content-box">
                                                        <a class="product-title" href="product-layout1.html">
                                                            <h2>Circular Saw</h2>
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
                                                            <ins><span class="product-Price-amount">
                                                                    <span
                                                                        class="product-Price-currencySymbol">$</span>124.00
                                                                </span>
                                                            </ins>
                                                            <del><span class="product-Price-amount">
                                                                    <span
                                                                        class="product-Price-currencySymbol">$</span>111.00
                                                                </span>
                                                            </del>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div><!-- product end -->
                                            <!-- product -->
                                            <div class="product col-md-3 col-sm-6 col-xs-12">
                                                <div class="product-box">
                                                    <!-- product-box-inner -->
                                                    <div class="product-box-inner">
                                                        <div class="product-image-box">
                                                            <img class="img-fluid pro-image-front"
                                                                src="{{ ("assets/images/product/pro-front-07.png") }}" alt="">
                                                            <img class="img-fluid pro-image-back"
                                                                src="{{ ("assets/images/product/pro-back-07.png") }}" alt="">
                                                        </div>
                                                        <div class="product-btn-links-wrapper">
                                                            <div class="product-btn"><a href="#"
                                                                    class="add-to-cart-btn tooltip-top"
                                                                    data-tooltip="Add To Cart"><i
                                                                        class="ti ti-shopping-cart"></i></a>
                                                            </div>
                                                            <div class="product-btn"><a href="#"
                                                                    class="quick-view-btn js-show-modal1 tooltip-top"
                                                                    data-tooltip="Quick View"><i
                                                                        class="ti ti-search"></i></a>
                                                            </div>
                                                            <div class="product-btn"><a href="#"
                                                                    class="wishlist-btn tooltip-top"
                                                                    data-tooltip="Add To Wishlist"><i
                                                                        class="ti ti-heart"></i></a>
                                                            </div>
                                                        </div>
                                                    </div><!-- product-box-inner end -->
                                                    <div class="product-content-box">
                                                        <a class="product-title" href="product-layout1.html">
                                                            <h2>Impact Driver Kit</h2>
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
                                                                <span class="product-Price-currencySymbol">$</span>149.00
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div><!-- product end -->
                                            <!-- product -->
                                            <div class="product col-md-3 col-sm-6 col-xs-12">
                                                <div class="product-box">
                                                    <!-- product-box-inner -->
                                                    <div class="product-box-inner">
                                                        <div class="product-image-box">
                                                            <img class="img-fluid pro-image-front"
                                                                src="{{ ("assets/images/product/pro-front-08.png") }}" alt="">
                                                            <img class="img-fluid pro-image-back"
                                                                src="{{ ("assets/images/product/pro-back-08.png") }}" alt="">
                                                        </div>
                                                        <div class="product-btn-links-wrapper">
                                                            <div class="product-btn"><a href="#"
                                                                    class="add-to-cart-btn tooltip-top"
                                                                    data-tooltip="Add To Cart"><i
                                                                        class="ti ti-shopping-cart"></i></a>
                                                            </div>
                                                            <div class="product-btn"><a href="#"
                                                                    class="quick-view-btn js-show-modal1 tooltip-top"
                                                                    data-tooltip="Quick View"><i
                                                                        class="ti ti-search"></i></a>
                                                            </div>
                                                            <div class="product-btn"><a href="#"
                                                                    class="wishlist-btn tooltip-top"
                                                                    data-tooltip="Add To Wishlist"><i
                                                                        class="ti ti-heart"></i></a>
                                                            </div>
                                                        </div>
                                                    </div><!-- product-box-inner end -->
                                                    <div class="product-content-box">
                                                        <a class="product-title" href="product-layout1.html">
                                                            <h2>Tape Measure</h2>
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
                                                                <span class="product-Price-currencySymbol">$</span>24.00
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div><!-- product end -->
                                        </div>
                                    </div><!-- content-inner end -->
                                    <!-- content-inner -->
                                    <div class="content-inner">
                                        <div class="products row">
                                            <!-- product -->
                                            <div class="product col-md-3 col-sm-6 col-xs-12">
                                                <div class="product-box">
                                                    <!-- product-box-inner -->
                                                    <div class="product-box-inner">
                                                        <div class="product-image-box">
                                                            <img class="img-fluid pro-image-front"
                                                                src="{{ ("assets/images/product/pro-front-05.png") }}" alt="">
                                                            <img class="img-fluid pro-image-back"
                                                                src="{{ ("assets/images/product/pro-back-05.png") }}" alt="">
                                                        </div>
                                                        <div class="product-btn-links-wrapper">
                                                            <div class="product-btn"><a href="#"
                                                                    class="add-to-cart-btn tooltip-top"
                                                                    data-tooltip="Add To Cart"><i
                                                                        class="ti ti-shopping-cart"></i></a>
                                                            </div>
                                                            <div class="product-btn"><a href="#"
                                                                    class="quick-view-btn js-show-modal1 tooltip-top"
                                                                    data-tooltip="Quick View"><i
                                                                        class="ti ti-search"></i></a>
                                                            </div>
                                                            <div class="product-btn"><a href="#"
                                                                    class="wishlist-btn tooltip-top"
                                                                    data-tooltip="Add To Wishlist"><i
                                                                        class="ti ti-heart"></i></a>
                                                            </div>
                                                        </div>
                                                    </div><!-- product-box-inner end -->
                                                    <div class="product-content-box">
                                                        <a class="product-title" href="product-layout1.html">
                                                            <h2>Folding Hex Key Set</h2>
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
                                                                <span class="product-Price-currencySymbol">$</span>62.00
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div><!-- product end -->
                                            <!-- product -->
                                            <div class="product col-md-3 col-sm-6 col-xs-12">
                                                <div class="product-box">
                                                    <!-- product-box-inner -->
                                                    <div class="product-box-inner">
                                                        <div class="product-image-box">
                                                            <div class="onsale">Sale!</div>
                                                            <img class="img-fluid pro-image-front"
                                                                src="{{ ("assets/images/product/pro-front-02.png") }}" alt="">
                                                            <img class="img-fluid pro-image-back"
                                                                src="{{ ("assets/images/product/pro-back-02.png") }}" alt="">
                                                        </div>
                                                        <div class="product-btn-links-wrapper">
                                                            <div class="product-btn"><a href="#"
                                                                    class="add-to-cart-btn tooltip-top"
                                                                    data-tooltip="Add To Cart"><i
                                                                        class="ti ti-shopping-cart"></i></a>
                                                            </div>
                                                            <div class="product-btn"><a href="#"
                                                                    class="quick-view-btn js-show-modal1 tooltip-top"
                                                                    data-tooltip="Quick View"><i
                                                                        class="ti ti-search"></i></a>
                                                            </div>
                                                            <div class="product-btn"><a href="#"
                                                                    class="wishlist-btn tooltip-top"
                                                                    data-tooltip="Add To Wishlist"><i
                                                                        class="ti ti-heart"></i></a>
                                                            </div>
                                                        </div>
                                                    </div><!-- product-box-inner end -->
                                                    <div class="product-content-box">
                                                        <a class="product-title" href="product-layout1.html">
                                                            <h2>Impact Wrench</h2>
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
                                                            <ins><span class="product-Price-amount">
                                                                    <span
                                                                        class="product-Price-currencySymbol">$</span>110.00
                                                                </span>
                                                            </ins>
                                                            <del><span class="product-Price-amount">
                                                                    <span
                                                                        class="product-Price-currencySymbol">$</span>123.00
                                                                </span>
                                                            </del>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div><!-- product end -->
                                            <!-- product -->
                                            <div class="product col-md-3 col-sm-6 col-xs-12">
                                                <div class="product-box">
                                                    <!-- product-box-inner -->
                                                    <div class="product-box-inner">
                                                        <div class="product-image-box">
                                                            <img class="img-fluid pro-image-front"
                                                                src="{{ ("assets/images/product/pro-front-07.png") }}" alt="">
                                                            <img class="img-fluid pro-image-back"
                                                                src="{{ ("assets/images/product/pro-back-07.png") }}" alt="">
                                                        </div>
                                                        <div class="product-btn-links-wrapper">
                                                            <div class="product-btn"><a href="#"
                                                                    class="add-to-cart-btn tooltip-top"
                                                                    data-tooltip="Add To Cart"><i
                                                                        class="ti ti-shopping-cart"></i></a>
                                                            </div>
                                                            <div class="product-btn"><a href="#"
                                                                    class="quick-view-btn js-show-modal1 tooltip-top"
                                                                    data-tooltip="Quick View"><i
                                                                        class="ti ti-search"></i></a>
                                                            </div>
                                                            <div class="product-btn"><a href="#"
                                                                    class="wishlist-btn tooltip-top"
                                                                    data-tooltip="Add To Wishlist"><i
                                                                        class="ti ti-heart"></i></a>
                                                            </div>
                                                        </div>
                                                    </div><!-- product-box-inner end -->
                                                    <div class="product-content-box">
                                                        <a class="product-title" href="product-layout1.html">
                                                            <h2>Impact Driver Kit</h2>
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
                                                                <span class="product-Price-currencySymbol">$</span>149.00
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div><!-- product end -->
                                            <!-- product -->
                                            <div class="product col-md-3 col-sm-6 col-xs-12">
                                                <div class="product-box">
                                                    <!-- product-box-inner -->
                                                    <div class="product-box-inner">
                                                        <div class="product-image-box">
                                                            <img class="img-fluid pro-image-front"
                                                                src="{{ ("assets/images/product/pro-front-08.png") }}" alt="">
                                                            <img class="img-fluid pro-image-back"
                                                                src="{{ ("assets/images/product/pro-back-08.png") }}" alt="">
                                                        </div>
                                                        <div class="product-btn-links-wrapper">
                                                            <div class="product-btn"><a href="#"
                                                                    class="add-to-cart-btn tooltip-top"
                                                                    data-tooltip="Add To Cart"><i
                                                                        class="ti ti-shopping-cart"></i></a>
                                                            </div>
                                                            <div class="product-btn"><a href="#"
                                                                    class="quick-view-btn js-show-modal1 tooltip-top"
                                                                    data-tooltip="Quick View"><i
                                                                        class="ti ti-search"></i></a>
                                                            </div>
                                                            <div class="product-btn"><a href="#"
                                                                    class="wishlist-btn tooltip-top"
                                                                    data-tooltip="Add To Wishlist"><i
                                                                        class="ti ti-heart"></i></a>
                                                            </div>
                                                        </div>
                                                    </div><!-- product-box-inner end -->
                                                    <div class="product-content-box">
                                                        <a class="product-title" href="product-layout1.html">
                                                            <h2>Tape Measure</h2>
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
                                                                <span class="product-Price-currencySymbol">$</span>24.00
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div><!-- product end -->
                                            <!-- product -->
                                            <div class="product col-md-3 col-sm-6 col-xs-12">
                                                <div class="product-box">
                                                    <!-- product-box-inner -->
                                                    <div class="product-box-inner">
                                                        <div class="product-image-box">
                                                            <img class="img-fluid pro-image-front"
                                                                src="{{ ("assets/images/product/pro-front-01.png") }}" alt="">
                                                            <img class="img-fluid pro-image-back"
                                                                src="{{ ("assets/images/product/pro-back-01.png") }}" alt="">
                                                        </div>
                                                        <div class="product-btn-links-wrapper">
                                                            <div class="product-btn"><a href="#"
                                                                    class="add-to-cart-btn tooltip-top"
                                                                    data-tooltip="Add To Cart"><i
                                                                        class="ti ti-shopping-cart"></i></a>
                                                            </div>
                                                            <div class="product-btn"><a href="#"
                                                                    class="quick-view-btn js-show-modal1 tooltip-top"
                                                                    data-tooltip="Quick View"><i
                                                                        class="ti ti-search"></i></a>
                                                            </div>
                                                            <div class="product-btn"><a href="#"
                                                                    class="wishlist-btn tooltip-top"
                                                                    data-tooltip="Add To Wishlist"><i
                                                                        class="ti ti-heart"></i></a>
                                                            </div>
                                                        </div>
                                                    </div><!-- product-box-inner end -->
                                                    <div class="product-content-box">
                                                        <a class="product-title" href="product-layout1.html">
                                                            <h2>Reel Fiberglass Tape</h2>
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
                                                                <span class="product-Price-currencySymbol">$</span>40.00
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div><!-- product end -->
                                            <!-- product -->
                                            <div class="product col-md-3 col-sm-6 col-xs-12">
                                                <div class="product-box">
                                                    <!-- product-box-inner -->
                                                    <div class="product-box-inner">
                                                        <div class="product-image-box">
                                                            <img class="img-fluid pro-image-front"
                                                                src="{{ ("assets/images/product/pro-front-03.png") }}" alt="">
                                                            <img class="img-fluid pro-image-back"
                                                                src="{{ ("assets/images/product/pro-back-03.png") }}" alt="">
                                                        </div>
                                                        <div class="product-btn-links-wrapper">
                                                            <div class="product-btn"><a href="#"
                                                                    class="add-to-cart-btn tooltip-top"
                                                                    data-tooltip="Add To Cart"><i
                                                                        class="ti ti-shopping-cart"></i></a>
                                                            </div>
                                                            <div class="product-btn"><a href="#"
                                                                    class="quick-view-btn js-show-modal1 tooltip-top"
                                                                    data-tooltip="Quick View"><i
                                                                        class="ti ti-search"></i></a>
                                                            </div>
                                                            <div class="product-btn"><a href="#"
                                                                    class="wishlist-btn tooltip-top"
                                                                    data-tooltip="Add To Wishlist"><i
                                                                        class="ti ti-heart"></i></a>
                                                            </div>
                                                        </div>
                                                    </div><!-- product-box-inner end -->
                                                    <div class="product-content-box">
                                                        <a class="product-title" href="product-layout1.html">
                                                            <h2>Demolition Breaker</h2>
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
                                                                <span class="product-Price-currencySymbol">$</span>38.00
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div><!-- product end -->
                                            <!-- product -->
                                            <div class="product col-md-3 col-sm-6 col-xs-12">
                                                <div class="product-box">
                                                    <!-- product-box-inner -->
                                                    <div class="product-box-inner">
                                                        <div class="product-image-box">
                                                            <div class="onsale">Sale!</div>
                                                            <img class="img-fluid pro-image-front"
                                                                src="{{ ("assets/images/product/pro-front-04.png") }}" alt="">
                                                            <img class="img-fluid pro-image-back"
                                                                src="{{ ("assets/images/product/pro-back-04.png") }}" alt="">
                                                        </div>
                                                        <div class="product-btn-links-wrapper">
                                                            <div class="product-btn"><a href="#"
                                                                    class="add-to-cart-btn tooltip-top"
                                                                    data-tooltip="Add To Cart"><i
                                                                        class="ti ti-shopping-cart"></i></a>
                                                            </div>
                                                            <div class="product-btn"><a href="#"
                                                                    class="quick-view-btn js-show-modal1 tooltip-top"
                                                                    data-tooltip="Quick View"><i
                                                                        class="ti ti-search"></i></a>
                                                            </div>
                                                            <div class="product-btn"><a href="#"
                                                                    class="wishlist-btn tooltip-top"
                                                                    data-tooltip="Add To Wishlist"><i
                                                                        class="ti ti-heart"></i></a>
                                                            </div>
                                                        </div>
                                                    </div><!-- product-box-inner end -->
                                                    <div class="product-content-box">
                                                        <a class="product-title" href="product-layout1.html">
                                                            <h2>Cordless Drywall Cutter</h2>
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
                                                            <ins><span class="product-Price-amount">
                                                                    <span
                                                                        class="product-Price-currencySymbol">$</span>99.00
                                                                </span>
                                                            </ins>
                                                            <del><span class="product-Price-amount">
                                                                    <span
                                                                        class="product-Price-currencySymbol">$</span>82.00
                                                                </span>
                                                            </del>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div><!-- product end -->
                                            <!-- product -->
                                            <div class="product col-md-3 col-sm-6 col-xs-12">
                                                <div class="product-box">
                                                    <!-- product-box-inner -->
                                                    <div class="product-box-inner">
                                                        <div class="onsale">Sale!</div>
                                                        <div class="product-image-box">
                                                            <img class="img-fluid pro-image-front"
                                                                src="{{ ("assets/images/product/pro-front-06.png") }}" alt="">
                                                            <img class="img-fluid pro-image-back"
                                                                src="{{ ("assets/images/product/pro-back-06.png") }}" alt="">
                                                        </div>
                                                        <div class="product-btn-links-wrapper">
                                                            <div class="product-btn"><a href="#"
                                                                    class="add-to-cart-btn tooltip-top"
                                                                    data-tooltip="Add To Cart"><i
                                                                        class="ti ti-shopping-cart"></i></a>
                                                            </div>
                                                            <div class="product-btn"><a href="#"
                                                                    class="quick-view-btn js-show-modal1 tooltip-top"
                                                                    data-tooltip="Quick View"><i
                                                                        class="ti ti-search"></i></a>
                                                            </div>
                                                            <div class="product-btn"><a href="#"
                                                                    class="wishlist-btn tooltip-top"
                                                                    data-tooltip="Add To Wishlist"><i
                                                                        class="ti ti-heart"></i></a>
                                                            </div>
                                                        </div>
                                                    </div><!-- product-box-inner end -->
                                                    <div class="product-content-box">
                                                        <a class="product-title" href="product-layout1.html">
                                                            <h2>Circular Saw</h2>
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
                                                            <ins><span class="product-Price-amount">
                                                                    <span
                                                                        class="product-Price-currencySymbol">$</span>124.00
                                                                </span>
                                                            </ins>
                                                            <del><span class="product-Price-amount">
                                                                    <span
                                                                        class="product-Price-currencySymbol">$</span>111.00
                                                                </span>
                                                            </del>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div><!-- product end -->
                                        </div>
                                    </div><!-- content-inner end -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <!-- banner-image -->
                                    <div class="banner-image mb-30 mt-5">
                                        <a href="#"><img class="img-fluid" src="{{ ("assets/images/banner-eight.jpg") }}"
                                                alt=""></a>
                                    </div><!-- banner-image end -->
                                </div>
                            </div>
                            <div class="row no-gutters ttm-bgcolor-grey border mb-25">
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <!-- featured-icon-box -->
                                    <div class="featured-icon-box style3 text-center">
                                        <div class="ttm-icon ttm-icon_element-color-skincolor ttm-icon_element-size-md">
                                            <i class="themifyicon ti-truck"></i>
                                        </div>
                                        <div class="featured-content">
                                            <div class="featured-title">
                                                <h5>Fast &amp; Free Shopping</h5>
                                            </div>
                                            <div class="featured-desc">
                                                <p>All Order Over $199</p>
                                            </div>
                                        </div>
                                    </div><!-- featured-icon-box end-->
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <!-- featured-icon-box -->
                                    <div class="featured-icon-box style3 text-center">
                                        <div class="ttm-icon ttm-icon_element-color-skincolor ttm-icon_element-size-md">
                                            <i class="themifyicon ti-reload"></i>
                                        </div>
                                        <div class="featured-content">
                                            <div class="featured-title">
                                                <h5>100% Money Back</h5>
                                            </div>
                                            <div class="featured-desc">
                                                <p>30 Days Money Return</p>
                                            </div>
                                        </div>
                                    </div><!-- featured-icon-box end-->
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <!-- featured-icon-box -->
                                    <div class="featured-icon-box style3 text-center">
                                        <div class="ttm-icon ttm-icon_element-color-skincolor ttm-icon_element-size-md">
                                            <i class="themifyicon ti-comments"></i>
                                        </div>
                                        <div class="featured-content">
                                            <div class="featured-title">
                                                <h5>Support 24/7 Days</h5>
                                            </div>
                                            <div class="featured-desc">
                                                <p>Hot Line: +123 456 789</p>
                                            </div>
                                        </div>
                                    </div><!-- featured-icon-box end-->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="content-sec-head-style">
                                        <div class="content-area-sec-title">
                                            <h5>Best Sellers</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <!-- slick_slider -->
                                    <div class="pro_slick_slider"
                                        data-slick='{"slidesToShow": 4, "slidesToScroll": 4, "arrows":true, "autoplay":true}'>
                                        <!-- product -->
                                        <div class="product">
                                            <div class="product-box">
                                                <!-- product-box-inner -->
                                                <div class="product-box-inner">
                                                    <div class="product-image-box">
                                                        <img class="img-fluid pro-image-front"
                                                            src="{{ ("assets/images/product/pro-front-09.png") }}" alt="">
                                                        <img class="img-fluid pro-image-back"
                                                            src="{{ ("assets/images/product/pro-back-09.png") }}" alt="">
                                                    </div>
                                                    <div class="product-btn-links-wrapper">
                                                        <div class="product-btn"><a href="#"
                                                                class="add-to-cart-btn tooltip-top"
                                                                data-tooltip="Add To Cart"><i
                                                                    class="ti ti-shopping-cart"></i></a>
                                                        </div>
                                                        <div class="product-btn"><a href="#"
                                                                class="quick-view-btn js-show-modal1 tooltip-top"
                                                                data-tooltip="Quick View"><i
                                                                    class="ti ti-search"></i></a>
                                                        </div>
                                                        <div class="product-btn"><a href="#"
                                                                class="wishlist-btn tooltip-top"
                                                                data-tooltip="Add To Wishlist"><i
                                                                    class="ti ti-heart"></i></a>
                                                        </div>
                                                    </div>
                                                </div><!-- product-box-inner end -->
                                                <div class="product-content-box">
                                                    <a class="product-title" href="product-layout1.html">
                                                        <h2>Hammer Drill</h2>
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
                                                            <span class="product-Price-currencySymbol">$</span>77.00
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- product end -->
                                        <!-- product -->
                                        <div class="product">
                                            <div class="product-box">
                                                <!-- product-box-inner -->
                                                <div class="product-box-inner">
                                                    <div class="product-image-box">
                                                        <img class="img-fluid pro-image-front"
                                                            src="{{ ("assets/images/product/pro-front-10.png") }}" alt="">
                                                        <img class="img-fluid pro-image-back"
                                                            src="{{ ("assets/images/product/pro-back-10.png") }}" alt="">
                                                    </div>
                                                    <div class="product-btn-links-wrapper">
                                                        <div class="product-btn"><a href="#"
                                                                class="add-to-cart-btn tooltip-top"
                                                                data-tooltip="Add To Cart"><i
                                                                    class="ti ti-shopping-cart"></i></a>
                                                        </div>
                                                        <div class="product-btn"><a href="#"
                                                                class="quick-view-btn js-show-modal1 tooltip-top"
                                                                data-tooltip="Quick View"><i
                                                                    class="ti ti-search"></i></a>
                                                        </div>
                                                        <div class="product-btn"><a href="#"
                                                                class="wishlist-btn tooltip-top"
                                                                data-tooltip="Add To Wishlist"><i
                                                                    class="ti ti-heart"></i></a>
                                                        </div>
                                                    </div>
                                                </div><!-- product-box-inner end -->
                                                <div class="product-content-box">
                                                    <a class="product-title" href="product-layout1.html">
                                                        <h2>Rotary Hammer</h2>
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
                                                            <span class="product-Price-currencySymbol">$</span>80.00
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- product end -->
                                        <!-- product -->
                                        <div class="product">
                                            <div class="product-box">
                                                <!-- product-box-inner -->
                                                <div class="product-box-inner">
                                                    <div class="product-image-box">
                                                        <img class="img-fluid pro-image-front"
                                                            src="{{ ("assets/images/product/pro-front-01.png") }}" alt="">
                                                        <img class="img-fluid pro-image-back"
                                                            src="{{ ("assets/images/product/pro-back-01.png") }}" alt="">
                                                    </div>
                                                    <div class="product-btn-links-wrapper">
                                                        <div class="product-btn"><a href="#"
                                                                class="add-to-cart-btn tooltip-top"
                                                                data-tooltip="Add To Cart"><i
                                                                    class="ti ti-shopping-cart"></i></a>
                                                        </div>
                                                        <div class="product-btn"><a href="#"
                                                                class="quick-view-btn js-show-modal1 tooltip-top"
                                                                data-tooltip="Quick View"><i
                                                                    class="ti ti-search"></i></a>
                                                        </div>
                                                        <div class="product-btn"><a href="#"
                                                                class="wishlist-btn tooltip-top"
                                                                data-tooltip="Add To Wishlist"><i
                                                                    class="ti ti-heart"></i></a>
                                                        </div>
                                                    </div>
                                                </div><!-- product-box-inner end -->
                                                <div class="product-content-box">
                                                    <a class="product-title" href="product-layout1.html">
                                                        <h2>Reel Fiberglass Tape</h2>
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
                                                            <span class="product-Price-currencySymbol">$</span>40.00
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- product end -->
                                        <!-- product -->
                                        <div class="product">
                                            <div class="product-box">
                                                <!-- product-box-inner -->
                                                <div class="product-box-inner">
                                                    <div class="product-image-box">
                                                        <div class="onsale">Sale!</div>
                                                        <img class="img-fluid pro-image-front"
                                                            src="{{ ("assets/images/product/pro-front-02.png") }}" alt="">
                                                        <img class="img-fluid pro-image-back"
                                                            src="{{ ("assets/images/product/pro-back-02.png") }}" alt="">
                                                    </div>
                                                    <div class="product-btn-links-wrapper">
                                                        <div class="product-btn"><a href="#"
                                                                class="add-to-cart-btn tooltip-top"
                                                                data-tooltip="Add To Cart"><i
                                                                    class="ti ti-shopping-cart"></i></a>
                                                        </div>
                                                        <div class="product-btn"><a href="#"
                                                                class="quick-view-btn js-show-modal1 tooltip-top"
                                                                data-tooltip="Quick View"><i
                                                                    class="ti ti-search"></i></a>
                                                        </div>
                                                        <div class="product-btn"><a href="#"
                                                                class="wishlist-btn tooltip-top"
                                                                data-tooltip="Add To Wishlist"><i
                                                                    class="ti ti-heart"></i></a>
                                                        </div>
                                                    </div>
                                                </div><!-- product-box-inner end -->
                                                <div class="product-content-box">
                                                    <a class="product-title" href="product-layout1.html">
                                                        <h2>Impact Wrench</h2>
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
                                                        <ins><span class="product-Price-amount">
                                                                <span class="product-Price-currencySymbol">$</span>110.00
                                                            </span>
                                                        </ins>
                                                        <del><span class="product-Price-amount">
                                                                <span class="product-Price-currencySymbol">$</span>123.00
                                                            </span>
                                                        </del>
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- product end -->
                                        <!-- product -->
                                        <div class="product">
                                            <div class="product-box">
                                                <!-- product-box-inner -->
                                                <div class="product-box-inner">
                                                    <div class="product-image-box">
                                                        <img class="img-fluid pro-image-front"
                                                            src="{{ ("assets/images/product/pro-front-03.png") }}" alt="">
                                                        <img class="img-fluid pro-image-back"
                                                            src="{{ ("assets/images/product/pro-back-03.png") }}" alt="">
                                                    </div>
                                                    <div class="product-btn-links-wrapper">
                                                        <div class="product-btn"><a href="#"
                                                                class="add-to-cart-btn tooltip-top"
                                                                data-tooltip="Add To Cart"><i
                                                                    class="ti ti-shopping-cart"></i></a>
                                                        </div>
                                                        <div class="product-btn"><a href="#"
                                                                class="quick-view-btn js-show-modal1 tooltip-top"
                                                                data-tooltip="Quick View"><i
                                                                    class="ti ti-search"></i></a>
                                                        </div>
                                                        <div class="product-btn"><a href="#"
                                                                class="wishlist-btn tooltip-top"
                                                                data-tooltip="Add To Wishlist"><i
                                                                    class="ti ti-heart"></i></a>
                                                        </div>
                                                    </div>
                                                </div><!-- product-box-inner end -->
                                                <div class="product-content-box">
                                                    <a class="product-title" href="product-layout1.html">
                                                        <h2>Demolition Breaker</h2>
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
                                                            <span class="product-Price-currencySymbol">$</span>38.00
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- product end -->
                                        <!-- product -->
                                        <div class="product">
                                            <div class="product-box">
                                                <!-- product-box-inner -->
                                                <div class="product-box-inner">
                                                    <div class="product-image-box">
                                                        <div class="onsale">Sale!</div>
                                                        <img class="img-fluid pro-image-front"
                                                            src="{{ ("assets/images/product/pro-front-04.png") }}" alt="">
                                                        <img class="img-fluid pro-image-back"
                                                            src="{{ ("assets/images/product/pro-back-04.png") }}" alt="">
                                                    </div>
                                                    <div class="product-btn-links-wrapper">
                                                        <div class="product-btn"><a href="#"
                                                                class="add-to-cart-btn tooltip-top"
                                                                data-tooltip="Add To Cart"><i
                                                                    class="ti ti-shopping-cart"></i></a>
                                                        </div>
                                                        <div class="product-btn"><a href="#"
                                                                class="quick-view-btn js-show-modal1 tooltip-top"
                                                                data-tooltip="Quick View"><i
                                                                    class="ti ti-search"></i></a>
                                                        </div>
                                                        <div class="product-btn"><a href="#"
                                                                class="wishlist-btn tooltip-top"
                                                                data-tooltip="Add To Wishlist"><i
                                                                    class="ti ti-heart"></i></a>
                                                        </div>
                                                    </div>
                                                </div><!-- product-box-inner end -->
                                                <div class="product-content-box">
                                                    <a class="product-title" href="product-layout1.html">
                                                        <h2>Cordless Drywall Cutter</h2>
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
                                                        <ins><span class="product-Price-amount">
                                                                <span class="product-Price-currencySymbol">$</span>99.00
                                                            </span>
                                                        </ins>
                                                        <del><span class="product-Price-amount">
                                                                <span class="product-Price-currencySymbol">$</span>82.00
                                                            </span>
                                                        </del>
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- product end -->
                                        <!-- product -->
                                        <div class="product">
                                            <div class="product-box">
                                                <!-- product-box-inner -->
                                                <div class="product-box-inner">
                                                    <div class="product-image-box">
                                                        <img class="img-fluid pro-image-front"
                                                            src="{{ ("assets/images/product/pro-front-05.png") }}" alt="">
                                                        <img class="img-fluid pro-image-back"
                                                            src="{{ ("assets/images/product/pro-back-05.png") }}" alt="">
                                                    </div>
                                                    <div class="product-btn-links-wrapper">
                                                        <div class="product-btn"><a href="#"
                                                                class="add-to-cart-btn tooltip-top"
                                                                data-tooltip="Add To Cart"><i
                                                                    class="ti ti-shopping-cart"></i></a>
                                                        </div>
                                                        <div class="product-btn"><a href="#"
                                                                class="quick-view-btn js-show-modal1 tooltip-top"
                                                                data-tooltip="Quick View"><i
                                                                    class="ti ti-search"></i></a>
                                                        </div>
                                                        <div class="product-btn"><a href="#"
                                                                class="wishlist-btn tooltip-top"
                                                                data-tooltip="Add To Wishlist"><i
                                                                    class="ti ti-heart"></i></a>
                                                        </div>
                                                    </div>
                                                </div><!-- product-box-inner end -->
                                                <div class="product-content-box">
                                                    <a class="product-title" href="product-layout1.html">
                                                        <h2>Folding Hex Key Set</h2>
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
                                                            <span class="product-Price-currencySymbol">$</span>62.00
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- product end -->
                                        <!-- product -->
                                        <div class="product">
                                            <div class="product-box">
                                                <!-- product-box-inner -->
                                                <div class="product-box-inner">
                                                    <div class="onsale">Sale!</div>
                                                    <div class="product-image-box">
                                                        <img class="img-fluid pro-image-front"
                                                            src="{{ ("assets/images/product/pro-front-06.png") }}" alt="">
                                                        <img class="img-fluid pro-image-back"
                                                            src="{{ ("assets/images/product/pro-back-06.png") }}" alt="">
                                                    </div>
                                                    <div class="product-btn-links-wrapper">
                                                        <div class="product-btn"><a href="#"
                                                                class="add-to-cart-btn tooltip-top"
                                                                data-tooltip="Add To Cart"><i
                                                                    class="ti ti-shopping-cart"></i></a>
                                                        </div>
                                                        <div class="product-btn"><a href="#"
                                                                class="quick-view-btn js-show-modal1 tooltip-top"
                                                                data-tooltip="Quick View"><i
                                                                    class="ti ti-search"></i></a>
                                                        </div>
                                                        <div class="product-btn"><a href="#"
                                                                class="wishlist-btn tooltip-top"
                                                                data-tooltip="Add To Wishlist"><i
                                                                    class="ti ti-heart"></i></a>
                                                        </div>
                                                    </div>
                                                </div><!-- product-box-inner end -->
                                                <div class="product-content-box">
                                                    <a class="product-title" href="product-layout1.html">
                                                        <h2>Circular Saw</h2>
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
                                                        <ins><span class="product-Price-amount">
                                                                <span class="product-Price-currencySymbol">$</span>124.00
                                                            </span>
                                                        </ins>
                                                        <del><span class="product-Price-amount">
                                                                <span class="product-Price-currencySymbol">$</span>111.00
                                                            </span>
                                                        </del>
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- product end -->
                                        <!-- product -->
                                        <div class="product">
                                            <div class="product-box">
                                                <!-- product-box-inner -->
                                                <div class="product-box-inner">
                                                    <div class="product-image-box">
                                                        <img class="img-fluid pro-image-front"
                                                            src="{{ ("assets/images/product/pro-front-07.png") }}" alt="">
                                                        <img class="img-fluid pro-image-back"
                                                            src="{{ ("assets/images/product/pro-back-07.png") }}" alt="">
                                                    </div>
                                                    <div class="product-btn-links-wrapper">
                                                        <div class="product-btn"><a href="#"
                                                                class="add-to-cart-btn tooltip-top"
                                                                data-tooltip="Add To Cart"><i
                                                                    class="ti ti-shopping-cart"></i></a>
                                                        </div>
                                                        <div class="product-btn"><a href="#"
                                                                class="quick-view-btn js-show-modal1 tooltip-top"
                                                                data-tooltip="Quick View"><i
                                                                    class="ti ti-search"></i></a>
                                                        </div>
                                                        <div class="product-btn"><a href="#"
                                                                class="wishlist-btn tooltip-top"
                                                                data-tooltip="Add To Wishlist"><i
                                                                    class="ti ti-heart"></i></a>
                                                        </div>
                                                    </div>
                                                </div><!-- product-box-inner end -->
                                                <div class="product-content-box">
                                                    <a class="product-title" href="product-layout1.html">
                                                        <h2>Impact Driver Kit</h2>
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
                                                            <span class="product-Price-currencySymbol">$</span>149.00
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- product end -->
                                        <!-- product -->
                                        <div class="product">
                                            <div class="product-box">
                                                <!-- product-box-inner -->
                                                <div class="product-box-inner">
                                                    <div class="product-image-box">
                                                        <img class="img-fluid pro-image-front"
                                                            src="{{ ("assets/images/product/pro-front-08.png") }}" alt="">
                                                        <img class="img-fluid pro-image-back"
                                                            src="{{ ("assets/images/product/pro-back-08.png") }}" alt="">
                                                    </div>
                                                    <div class="product-btn-links-wrapper">
                                                        <div class="product-btn"><a href="#"
                                                                class="add-to-cart-btn tooltip-top"
                                                                data-tooltip="Add To Cart"><i
                                                                    class="ti ti-shopping-cart"></i></a>
                                                        </div>
                                                        <div class="product-btn"><a href="#"
                                                                class="quick-view-btn js-show-modal1 tooltip-top"
                                                                data-tooltip="Quick View"><i
                                                                    class="ti ti-search"></i></a>
                                                        </div>
                                                        <div class="product-btn"><a href="#"
                                                                class="wishlist-btn tooltip-top"
                                                                data-tooltip="Add To Wishlist"><i
                                                                    class="ti ti-heart"></i></a>
                                                        </div>
                                                    </div>
                                                </div><!-- product-box-inner end -->
                                                <div class="product-content-box">
                                                    <a class="product-title" href="product-layout1.html">
                                                        <h2>Tape Measure</h2>
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
                                                            <span class="product-Price-currencySymbol">$</span>24.00
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- product end -->
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="content-sec-head-style">
                                        <div class="content-area-sec-title">
                                            <h5>Specials</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <!-- slick_slider -->
                                    <div class="pro_slick_slider"
                                        data-slick='{"slidesToShow": 4, "slidesToScroll": 4, "arrows":true, "autoplay":true}'>
                                        <!-- product -->
                                        <div class="product">
                                            <div class="product-box">
                                                <!-- product-box-inner -->
                                                <div class="product-box-inner">
                                                    <div class="product-image-box">
                                                        <img class="img-fluid pro-image-front"
                                                            src="{{ ("assets/images/product/pro-front-10.png") }}" alt="">
                                                        <img class="img-fluid pro-image-back"
                                                            src="{{ ("assets/images/product/pro-back-10.png") }}" alt="">
                                                    </div>
                                                    <div class="product-btn-links-wrapper">
                                                        <div class="product-btn"><a href="#"
                                                                class="add-to-cart-btn tooltip-top"
                                                                data-tooltip="Add To Cart"><i
                                                                    class="ti ti-shopping-cart"></i></a>
                                                        </div>
                                                        <div class="product-btn"><a href="#"
                                                                class="quick-view-btn js-show-modal1 tooltip-top"
                                                                data-tooltip="Quick View"><i
                                                                    class="ti ti-search"></i></a>
                                                        </div>
                                                        <div class="product-btn"><a href="#"
                                                                class="wishlist-btn tooltip-top"
                                                                data-tooltip="Add To Wishlist"><i
                                                                    class="ti ti-heart"></i></a>
                                                        </div>
                                                    </div>
                                                </div><!-- product-box-inner end -->
                                                <div class="product-content-box">
                                                    <a class="product-title" href="product-layout1.html">
                                                        <h2>Rotary Hammer</h2>
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
                                                            <span class="product-Price-currencySymbol">$</span>80.00
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- product end -->
                                        <!-- product -->
                                        <div class="product">
                                            <div class="product-box">
                                                <!-- product-box-inner -->
                                                <div class="product-box-inner">
                                                    <div class="product-image-box">
                                                        <img class="img-fluid pro-image-front"
                                                            src="{{ ("assets/images/product/pro-front-01.png") }}" alt="">
                                                        <img class="img-fluid pro-image-back"
                                                            src="images/product/pro-back-01.png" alt="">
                                                    </div>
                                                    <div class="product-btn-links-wrapper">
                                                        <div class="product-btn"><a href="#"
                                                                class="add-to-cart-btn tooltip-top"
                                                                data-tooltip="Add To Cart"><i
                                                                    class="ti ti-shopping-cart"></i></a>
                                                        </div>
                                                        <div class="product-btn"><a href="#"
                                                                class="quick-view-btn js-show-modal1 tooltip-top"
                                                                data-tooltip="Quick View"><i
                                                                    class="ti ti-search"></i></a>
                                                        </div>
                                                        <div class="product-btn"><a href="#"
                                                                class="wishlist-btn tooltip-top"
                                                                data-tooltip="Add To Wishlist"><i
                                                                    class="ti ti-heart"></i></a>
                                                        </div>
                                                    </div>
                                                </div><!-- product-box-inner end -->
                                                <div class="product-content-box">
                                                    <a class="product-title" href="product-layout1.html">
                                                        <h2>Reel Fiberglass Tape</h2>
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
                                                            <span class="product-Price-currencySymbol">$</span>40.00
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- product end -->
                                        <!-- product -->
                                        <div class="product">
                                            <div class="product-box">
                                                <!-- product-box-inner -->
                                                <div class="product-box-inner">
                                                    <div class="product-image-box">
                                                        <div class="onsale">Sale!</div>
                                                        <img class="img-fluid pro-image-front"
                                                            src="{{ ("assets/images/product/pro-front-02.png") }}" alt="">
                                                        <img class="img-fluid pro-image-back"
                                                            src="{{ ("assets/images/product/pro-back-02.png") }}" alt="">
                                                    </div>
                                                    <div class="product-btn-links-wrapper">
                                                        <div class="product-btn"><a href="#"
                                                                class="add-to-cart-btn tooltip-top"
                                                                data-tooltip="Add To Cart"><i
                                                                    class="ti ti-shopping-cart"></i></a>
                                                        </div>
                                                        <div class="product-btn"><a href="#"
                                                                class="quick-view-btn js-show-modal1 tooltip-top"
                                                                data-tooltip="Quick View"><i
                                                                    class="ti ti-search"></i></a>
                                                        </div>
                                                        <div class="product-btn"><a href="#"
                                                                class="wishlist-btn tooltip-top"
                                                                data-tooltip="Add To Wishlist"><i
                                                                    class="ti ti-heart"></i></a>
                                                        </div>
                                                    </div>
                                                </div><!-- product-box-inner end -->
                                                <div class="product-content-box">
                                                    <a class="product-title" href="product-layout1.html">
                                                        <h2>Impact Wrench</h2>
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
                                                        <ins><span class="product-Price-amount">
                                                                <span class="product-Price-currencySymbol">$</span>110.00
                                                            </span>
                                                        </ins>
                                                        <del><span class="product-Price-amount">
                                                                <span class="product-Price-currencySymbol">$</span>123.00
                                                            </span>
                                                        </del>
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- product end -->
                                        <!-- product -->
                                        <div class="product">
                                            <div class="product-box">
                                                <!-- product-box-inner -->
                                                <div class="product-box-inner">
                                                    <div class="product-image-box">
                                                        <img class="img-fluid pro-image-front"
                                                            src="{{ ("assets/images/product/pro-front-09.png") }}" alt="">
                                                        <img class="img-fluid pro-image-back"
                                                            src="{{ ("assets/images/product/pro-back-09.png") }}" alt="">
                                                    </div>
                                                    <div class="product-btn-links-wrapper">
                                                        <div class="product-btn"><a href="#"
                                                                class="add-to-cart-btn tooltip-top"
                                                                data-tooltip="Add To Cart"><i
                                                                    class="ti ti-shopping-cart"></i></a>
                                                        </div>
                                                        <div class="product-btn"><a href="#"
                                                                class="quick-view-btn js-show-modal1 tooltip-top"
                                                                data-tooltip="Quick View"><i
                                                                    class="ti ti-search"></i></a>
                                                        </div>
                                                        <div class="product-btn"><a href="#"
                                                                class="wishlist-btn tooltip-top"
                                                                data-tooltip="Add To Wishlist"><i
                                                                    class="ti ti-heart"></i></a>
                                                        </div>
                                                    </div>
                                                </div><!-- product-box-inner end -->
                                                <div class="product-content-box">
                                                    <a class="product-title" href="product-layout1.html">
                                                        <h2>Hammer Drill</h2>
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
                                                            <span class="product-Price-currencySymbol">$</span>77.00
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- product end -->
                                        <!-- product -->
                                        <div class="product">
                                            <div class="product-box">
                                                <!-- product-box-inner -->
                                                <div class="product-box-inner">
                                                    <div class="product-image-box">
                                                        <img class="img-fluid pro-image-front"
                                                            src="{{ ("assets/images/product/pro-front-03.png") }}" alt="">
                                                        <img class="img-fluid pro-image-back"
                                                            src="{{ ("assets/images/product/pro-back-03.png") }}" alt="">
                                                    </div>
                                                    <div class="product-btn-links-wrapper">
                                                        <div class="product-btn"><a href="#"
                                                                class="add-to-cart-btn tooltip-top"
                                                                data-tooltip="Add To Cart"><i
                                                                    class="ti ti-shopping-cart"></i></a>
                                                        </div>
                                                        <div class="product-btn"><a href="#"
                                                                class="quick-view-btn js-show-modal1 tooltip-top"
                                                                data-tooltip="Quick View"><i
                                                                    class="ti ti-search"></i></a>
                                                        </div>
                                                        <div class="product-btn"><a href="#"
                                                                class="wishlist-btn tooltip-top"
                                                                data-tooltip="Add To Wishlist"><i
                                                                    class="ti ti-heart"></i></a>
                                                        </div>
                                                    </div>
                                                </div><!-- product-box-inner end -->
                                                <div class="product-content-box">
                                                    <a class="product-title" href="product-layout1.html">
                                                        <h2>Demolition Breaker</h2>
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
                                                            <span class="product-Price-currencySymbol">$</span>38.00
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- product end -->
                                        <!-- product -->
                                        <div class="product">
                                            <div class="product-box">
                                                <!-- product-box-inner -->
                                                <div class="product-box-inner">
                                                    <div class="product-image-box">
                                                        <img class="img-fluid pro-image-front"
                                                            src="{{ ("assets/images/product/pro-front-07.png") }}" alt="">
                                                        <img class="img-fluid pro-image-back"
                                                            src="{{ ("assets/images/product/pro-back-07.png") }}" alt="">
                                                    </div>
                                                    <div class="product-btn-links-wrapper">
                                                        <div class="product-btn"><a href="#"
                                                                class="add-to-cart-btn tooltip-top"
                                                                data-tooltip="Add To Cart"><i
                                                                    class="ti ti-shopping-cart"></i></a>
                                                        </div>
                                                        <div class="product-btn"><a href="#"
                                                                class="quick-view-btn js-show-modal1 tooltip-top"
                                                                data-tooltip="Quick View"><i
                                                                    class="ti ti-search"></i></a>
                                                        </div>
                                                        <div class="product-btn"><a href="#"
                                                                class="wishlist-btn tooltip-top"
                                                                data-tooltip="Add To Wishlist"><i
                                                                    class="ti ti-heart"></i></a>
                                                        </div>
                                                    </div>
                                                </div><!-- product-box-inner end -->
                                                <div class="product-content-box">
                                                    <a class="product-title" href="product-layout1.html">
                                                        <h2>Impact Driver Kit</h2>
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
                                                            <span class="product-Price-currencySymbol">$</span>149.00
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- product end -->
                                        <!-- product -->
                                        <div class="product">
                                            <div class="product-box">
                                                <!-- product-box-inner -->
                                                <div class="product-box-inner">
                                                    <div class="product-image-box">
                                                        <div class="onsale">Sale!</div>
                                                        <img class="img-fluid pro-image-front"
                                                            src="{{ ("assets/images/product/pro-front-04.png") }}" alt="">
                                                        <img class="img-fluid pro-image-back"
                                                            src="{{ ("assets/images/product/pro-back-04.png") }}" alt="">
                                                    </div>
                                                    <div class="product-btn-links-wrapper">
                                                        <div class="product-btn"><a href="#"
                                                                class="add-to-cart-btn tooltip-top"
                                                                data-tooltip="Add To Cart"><i
                                                                    class="ti ti-shopping-cart"></i></a>
                                                        </div>
                                                        <div class="product-btn"><a href="#"
                                                                class="quick-view-btn js-show-modal1 tooltip-top"
                                                                data-tooltip="Quick View"><i
                                                                    class="ti ti-search"></i></a>
                                                        </div>
                                                        <div class="product-btn"><a href="#"
                                                                class="wishlist-btn tooltip-top"
                                                                data-tooltip="Add To Wishlist"><i
                                                                    class="ti ti-heart"></i></a>
                                                        </div>
                                                    </div>
                                                </div><!-- product-box-inner end -->
                                                <div class="product-content-box">
                                                    <a class="product-title" href="product-layout1.html">
                                                        <h2>Cordless Drywall Cutter</h2>
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
                                                        <ins><span class="product-Price-amount">
                                                                <span class="product-Price-currencySymbol">$</span>99.00
                                                            </span>
                                                        </ins>
                                                        <del><span class="product-Price-amount">
                                                                <span class="product-Price-currencySymbol">$</span>82.00
                                                            </span>
                                                        </del>
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- product end -->
                                        <!-- product -->
                                        <div class="product">
                                            <div class="product-box">
                                                <!-- product-box-inner -->
                                                <div class="product-box-inner">
                                                    <div class="product-image-box">
                                                        <img class="img-fluid pro-image-front"
                                                            src="{{ ("assets/images/product/pro-front-05.png") }}" alt="">
                                                        <img class="img-fluid pro-image-back"
                                                            src="{{ ("assets/images/product/pro-back-05.png") }}" alt="">
                                                    </div>
                                                    <div class="product-btn-links-wrapper">
                                                        <div class="product-btn"><a href="#"
                                                                class="add-to-cart-btn tooltip-top"
                                                                data-tooltip="Add To Cart"><i
                                                                    class="ti ti-shopping-cart"></i></a>
                                                        </div>
                                                        <div class="product-btn"><a href="#"
                                                                class="quick-view-btn js-show-modal1 tooltip-top"
                                                                data-tooltip="Quick View"><i
                                                                    class="ti ti-search"></i></a>
                                                        </div>
                                                        <div class="product-btn"><a href="#"
                                                                class="wishlist-btn tooltip-top"
                                                                data-tooltip="Add To Wishlist"><i
                                                                    class="ti ti-heart"></i></a>
                                                        </div>
                                                    </div>
                                                </div><!-- product-box-inner end -->
                                                <div class="product-content-box">
                                                    <a class="product-title" href="product-layout1.html">
                                                        <h2>Folding Hex Key Set</h2>
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
                                                            <span class="product-Price-currencySymbol">$</span>62.00
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- product end -->
                                        <!-- product -->
                                        <div class="product">
                                            <div class="product-box">
                                                <!-- product-box-inner -->
                                                <div class="product-box-inner">
                                                    <div class="onsale">Sale!</div>
                                                    <div class="product-image-box">
                                                        <img class="img-fluid pro-image-front"
                                                            src="{{ ("assets/images/product/pro-front-06.png") }}" alt="">
                                                        <img class="img-fluid pro-image-back"
                                                            src="{{ ("assets/images/product/pro-back-06.png") }}" alt="">
                                                    </div>
                                                    <div class="product-btn-links-wrapper">
                                                        <div class="product-btn"><a href="#"
                                                                class="add-to-cart-btn tooltip-top"
                                                                data-tooltip="Add To Cart"><i
                                                                    class="ti ti-shopping-cart"></i></a>
                                                        </div>
                                                        <div class="product-btn"><a href="#"
                                                                class="quick-view-btn js-show-modal1 tooltip-top"
                                                                data-tooltip="Quick View"><i
                                                                    class="ti ti-search"></i></a>
                                                        </div>
                                                        <div class="product-btn"><a href="#"
                                                                class="wishlist-btn tooltip-top"
                                                                data-tooltip="Add To Wishlist"><i
                                                                    class="ti ti-heart"></i></a>
                                                        </div>
                                                    </div>
                                                </div><!-- product-box-inner end -->
                                                <div class="product-content-box">
                                                    <a class="product-title" href="product-layout1.html">
                                                        <h2>Circular Saw</h2>
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
                                                        <ins><span class="product-Price-amount">
                                                                <span class="product-Price-currencySymbol">$</span>124.00
                                                            </span>
                                                        </ins>
                                                        <del><span class="product-Price-amount">
                                                                <span class="product-Price-currencySymbol">$</span>111.00
                                                            </span>
                                                        </del>
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- product end -->
                                        <!-- product -->
                                        <div class="product">
                                            <div class="product-box">
                                                <!-- product-box-inner -->
                                                <div class="product-box-inner">
                                                    <div class="product-image-box">
                                                        <img class="img-fluid pro-image-front"
                                                            src="{{ ("assets/images/product/pro-front-08.png") }}" alt="">
                                                        <img class="img-fluid pro-image-back"
                                                            src="{{ ("assets/images/product/pro-back-08.png") }}" alt="">
                                                    </div>
                                                    <div class="product-btn-links-wrapper">
                                                        <div class="product-btn"><a href="#"
                                                                class="add-to-cart-btn tooltip-top"
                                                                data-tooltip="Add To Cart"><i
                                                                    class="ti ti-shopping-cart"></i></a>
                                                        </div>
                                                        <div class="product-btn"><a href="#"
                                                                class="quick-view-btn js-show-modal1 tooltip-top"
                                                                data-tooltip="Quick View"><i
                                                                    class="ti ti-search"></i></a>
                                                        </div>
                                                        <div class="product-btn"><a href="#"
                                                                class="wishlist-btn tooltip-top"
                                                                data-tooltip="Add To Wishlist"><i
                                                                    class="ti ti-heart"></i></a>
                                                        </div>
                                                    </div>
                                                </div><!-- product-box-inner end -->
                                                <div class="product-content-box">
                                                    <a class="product-title" href="product-layout1.html">
                                                        <h2>Tape Measure</h2>
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
                                                            <span class="product-Price-currencySymbol">$</span>24.00
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- product end -->
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- banner-image -->
                                    <div class="banner-image mb-30">
                                        <a href="#"><img class="img-fluid" src="{{ ("assets/images/banner-nine.jpg") }}"
                                                alt=""></a>
                                    </div><!-- banner-image end -->
                                </div>
                                <div class="col-sm-6">
                                    <!-- banner-image -->
                                    <div class="banner-image mb-30">
                                        <a href="#"><img class="img-fluid" src="{{ ("assets/images/banner-ten.jpg") }}"
                                                alt=""></a>
                                    </div><!-- banner-image end -->
                                </div>
                            </div>
                            <div class="row mb-35 res-991-mb-15">
                                <div class="col-lg-12">
                                    <div class="content-sec-head-style">
                                        <div class="content-area-sec-title">
                                            <h5>Our Latest News & Events</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <!-- slick_slider -->
                                    <div class="slick_slider"
                                        data-slick='{"slidesToShow": 3, "slidesToScroll": 3, "arrows":false, "autoplay":true}'>
                                        <!-- featured-imagebox-post -->
                                        <div class="featured-imagebox featured-imagebox-post ttm-box-view-top-image">
                                            <div class="ttm-post-featured-outer">
                                                <div class="ttm-post-thumbnail featured-thumbnail">
                                                    <img class="img-fluid" src="{{ ("assets/images/blog/01.jpg") }}" alt="">
                                                    <div class="ttm-box-post-date">
                                                        <span class="ttm-entry-date">
                                                            <time class="entry-date"
                                                                datetime="2019-07-28T07:07:55+00:00">28<span
                                                                    class="entry-month">Jul</span></time>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="featured-content featured-content-post">
                                                <div class="post-meta">
                                                    <span class="ttm-meta-line byline"><i
                                                            class="fa fa-user"></i>Admin</span>
                                                    <span class="ttm-meta-line tag-link"><i class="fa fa-tag"></i>Child
                                                        Education</span>
                                                </div>
                                                <div class="post-title featured-title">
                                                    <h5><a href="blog-single.html">Danger of Having High Water
                                                            Pressure</a></h5>
                                                </div>
                                            </div>
                                        </div><!-- featured-imagebox-post end -->
                                        <!-- featured-imagebox-post -->
                                        <div class="featured-imagebox featured-imagebox-post ttm-box-view-top-image">
                                            <div class="ttm-post-featured-outer">
                                                <div class="ttm-post-thumbnail featured-thumbnail">
                                                    <img class="img-fluid" src="{{ ("assetsimages/blog/02.jpg") }}" alt="">
                                                    <div class="ttm-box-post-date">
                                                        <span class="ttm-entry-date">
                                                            <time class="entry-date"
                                                                datetime="2019-08-10T07:07:55+00:00">10<span
                                                                    class="entry-month">Aug</span></time>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="featured-content featured-content-post">
                                                <div class="post-meta">
                                                    <span class="ttm-meta-line byline"><i
                                                            class="fa fa-user"></i>Admin</span>
                                                    <span class="ttm-meta-line tag-link"><i class="fa fa-tag"></i>Child
                                                        Education</span>
                                                </div>
                                                <div class="post-title featured-title">
                                                    <h5><a href="blog-single.html">The Most Common Painting
                                                            Mistakes</a></h5>
                                                </div>
                                            </div>
                                        </div><!-- featured-imagebox-post end -->
                                        <!-- featured-imagebox-post -->
                                        <div class="featured-imagebox featured-imagebox-post ttm-box-view-top-image">
                                            <div class="ttm-post-featured-outer">
                                                <div class="ttm-post-thumbnail featured-thumbnail">
                                                    <img class="img-fluid" src="{{ ("assets/images/blog/03.jpg") }}" alt="">
                                                    <div class="ttm-box-post-date">
                                                        <span class="ttm-entry-date">
                                                            <time class="entry-date"
                                                                datetime="2019-08-21T07:07:55+00:00">21<span
                                                                    class="entry-month">Aug</span></time>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="featured-content featured-content-post">
                                                <div class="post-meta">
                                                    <span class="ttm-meta-line byline"><i
                                                            class="fa fa-user"></i>Admin</span>
                                                    <span class="ttm-meta-line tag-link"><i class="fa fa-tag"></i>Child
                                                        Education</span>
                                                </div>
                                                <div class="post-title featured-title">
                                                    <h5><a href="blog-single.html">Choosing Roofing Material for
                                                            Home</a></h5>
                                                </div>
                                            </div>
                                        </div><!-- featured-imagebox-post end -->
                                        <!-- featured-imagebox-post -->
                                        <div class="featured-imagebox featured-imagebox-post ttm-box-view-top-image">
                                            <div class="ttm-post-featured-outer">
                                                <div class="ttm-post-thumbnail featured-thumbnail">
                                                    <img class="img-fluid" src="{{ ("assets/images/blog/04.jpg") }}" alt="">
                                                    <div class="ttm-box-post-date">
                                                        <span class="ttm-entry-date">
                                                            <time class="entry-date"
                                                                datetime="2019-08-26T07:07:55+00:00">26<span
                                                                    class="entry-month">Aug</span></time>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="featured-content featured-content-post">
                                                <div class="post-meta">
                                                    <span class="ttm-meta-line byline"><i
                                                            class="fa fa-user"></i>Admin</span>
                                                    <span class="ttm-meta-line tag-link"><i class="fa fa-tag"></i>Child
                                                        Education</span>
                                                </div>
                                                <div class="post-title featured-title">
                                                    <h5><a href="blog-single.html">Equipping Researchers in the
                                                            Developing.</a></h5>
                                                </div>
                                            </div>
                                        </div><!-- featured-imagebox-post end-->
                                        <!-- featured-imagebox-post -->
                                        <div class="featured-imagebox featured-imagebox-post ttm-box-view-top-image">
                                            <div class="ttm-post-featured-outer">
                                                <div class="ttm-post-thumbnail featured-thumbnail">
                                                    <img class="img-fluid" src="{{ ("assets/images/blog/05.jpg") }}" alt="">
                                                    <div class="ttm-box-post-date">
                                                        <span class="ttm-entry-date">
                                                            <time class="entry-date"
                                                                datetime="2019-09-06T07:07:55+00:00">06<span
                                                                    class="entry-month">Sep</span></time>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="featured-content featured-content-post">
                                                <div class="post-meta">
                                                    <span class="ttm-meta-line byline"><i
                                                            class="fa fa-user"></i>Admin</span>
                                                    <span class="ttm-meta-line tag-link"><i class="fa fa-tag"></i>Child
                                                        Education</span>
                                                </div>
                                                <div class="post-title featured-title">
                                                    <h5><a href="blog-single.html">Simple Steps for Replacing old
                                                            Tiling</a></h5>
                                                </div>
                                            </div>
                                        </div><!-- featured-imagebox-post end-->
                                        <!-- featured-imagebox-post -->
                                        <div class="featured-imagebox featured-imagebox-post ttm-box-view-top-image">
                                            <div class="ttm-post-featured-outer">
                                                <div class="ttm-post-thumbnail featured-thumbnail">
                                                    <img class="img-fluid" src="{{ ("assets/images/blog/06.jpg") }}" alt="">
                                                    <div class="ttm-box-post-date">
                                                        <span class="ttm-entry-date">
                                                            <time class="entry-date"
                                                                datetime="2019-09-12T07:07:55+00:00">12<span
                                                                    class="entry-month">Sep</span></time>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="featured-content featured-content-post">
                                                <div class="post-meta">
                                                    <span class="ttm-meta-line byline"><i
                                                            class="fa fa-user"></i>Admin</span>
                                                    <span class="ttm-meta-line tag-link"><i class="fa fa-tag"></i>Child
                                                        Education</span>
                                                </div>
                                                <div class="post-title featured-title">
                                                    <h5><a href="blog-single.html">Got a Leaking? Hire an
                                                            experienced Plumber</a></h5>
                                                </div>
                                            </div>
                                        </div><!-- featured-imagebox-post end-->
                                    </div><!-- slick_slider end -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- row end -->
            </div>
        </div>
        <!-- sidebar end -->

    </div>
    <!--site-main end-->
@endsection
