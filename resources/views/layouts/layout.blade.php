<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from themetechmount.com/html/fixfellow/header-style-02.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 13 Feb 2023 10:58:19 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Ecommerce &raquo; HTML Template" />
    <meta name="author" content="https://www.themetechmount.com/" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Fixfellow &#8211; Tools Store Ecommerce Html Template</title>

    <!-- favicon icon -->
    <link rel="shortcut icon" href="images/favicon.png" />

    <!-- bootstrap -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}" />

    <!-- animate -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animate.css') }}" />

    <!-- fontawesome -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.css') }}" />

    <!-- themify -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themify-icons.css') }}" />

    <!-- slick -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/slick.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/slick-theme.css') }}">

    <!-- REVOLUTION LAYERS STYLES -->

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/revolution/css/layers.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/revolution/css/settings.css') }}">

    <!-- magnific-popup -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/magnific-popup.css') }}" />

    <!-- megamenu -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/megamenu.css') }}">

    <!-- shortcodes -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/shortcodes.css') }}" />

    <!-- main -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/main.css') }}" />

    <!-- responsive -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}" />

</head>

<body>

    <!--page start-->
    <div class="page">


        <!--newsletter_popup_wrap start-->
        @include('partials.newletter_pop_up')
        <!--newsletter_popup_wrap end-->


        <!--header start-->
        @include('partials.header')
        <!--header end-->

        @yield('content')


        <!--footer start-->
        @include('partials.footer')
        <!--footer end-->


        <!--back-to-top start-->
        <a id="totop" href="#top">
            <i class="fa fa-angle-up"></i>
        </a>
        <!--back-to-top end-->

        <div class="wrap-modal1 js-modal1">
            <div class="overlay-modal1 js-hide-modal1"></div>
            <div class="container">
                <div class="modal1-content">
                    <button class="close js-hide-modal1">
                        <i class="fa fa-close"></i>
                    </button>
                    <div class="row ttm-single-product-details ttm-bgcolor-white">
                        <div class="col-lg-6 col-md-6 col-sm-12 ml-auto mr-auto">
                            <div class="product-gallery easyzoom-product-gallery">
                                <div class="product-look-views left">
                                    <div class="mt-35 mb-35">
                                        <ul class="thumbnails easyzoom-gallery-slider"
                                            data-slick='{"slidesToShow": 4, "slidesToScroll": 1, "arrows":true, "infinite":true, "vertical":true}'>
                                            <li>
                                                <a href="images/product/pro-01-plus.png"
                                                    data-standard="images/product/pro-01-plus.png">
                                                    <img class="img-fluid" src="images/product/pro-01-plus.png"
                                                        alt="" />
                                                </a>
                                            </li>
                                            <li>
                                                <a href="images/product/pro-02-plus.png"
                                                    data-standard="images/product/pro-02-plus.png">
                                                    <img class="img-fluid" src="images/product/pro-02-plus.png"
                                                        alt="" />
                                                </a>
                                            </li>
                                            <li>
                                                <a href="images/product/pro-03-plus.png"
                                                    data-standard="images/product/pro-03-plus.png">
                                                    <img class="img-fluid" src="images/product/pro-03-plus.png"
                                                        alt="" />
                                                </a>
                                            </li>
                                            <li>
                                                <a href="images/product/pro-04-plus.png"
                                                    data-standard="images/product/pro-04-plus.png">
                                                    <img class="img-fluid" src="images/product/pro-04-plus.png"
                                                        alt="" />
                                                </a>
                                            </li>
                                            <li>
                                                <a href="images/product/pro-05-plus.png"
                                                    data-standard="images/product/pro-05-plus.png">
                                                    <img class="img-fluid" src="images/product/pro-05-plus.png"
                                                        alt="" />
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-look-preview-plus right">
                                    <div class="pl-35 res-767-pl-15">
                                        <div
                                            class="easyzoom easyzoom-model easyzoom--overlay easyzoom--with-thumbnails">
                                            <a href="images/product/pro-01-plus.png">
                                                <img class="img-fluid" src="images/product/pro-01-plus.png"
                                                    alt="" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="summary entry-summary pl-30 res-991-pl-0 res-991-pt-40">
                                <h2 class="product_title entry-title">DEWALT 4-Piece T-Shank Jig Saw Blade Case</h2>
                                <div class="share-icons social-links">
                                    <span>Share :</span>
                                    <a href="#"><i class="ti ti-facebook"></i></a>
                                    <a href="#"><i class="ti ti-twitter-alt"></i></a>
                                    <a href="#"><i class="ti ti-google"></i></a>
                                    <a href="#"><i class="ti ti-linkedin"></i></a>
                                </div>
                                <div class="comments-notes clearfix">
                                    &nbsp;&nbsp;<a href="javascript:void(0)" class="review-link"
                                        rel="nofollow">(No review)</a>
                                    &nbsp;&nbsp;<a href="javascript:void(0)" class="review-link"
                                        rel="nofollow">Write to Review</a>
                                    <div class="product-rating clearfix">
                                        <ul class="star-rating clearfix">
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_in-stock"><i class="fa fa-check-circle"></i><span> in Stock Only
                                        14 left</span></div>
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
                                <div class="product-details__short-description">Raising a heavy fur muff that covered
                                    the whole of her lower arm towards the viewer regor then turned to look out the
                                    window</div>
                                <div class="mt-30 mb-35">
                                    <div class="quantity">
                                        <label>Quantity: </label>
                                        <input type="text" value="1" name="quantity-number"
                                            class="qty">
                                        <span class="inc quantity-button">+</span>
                                        <span class="dec quantity-button">-</span>
                                    </div>
                                </div>
                                <div class="actions">
                                    <div class="add-to-cart">
                                        <a class="ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-fill ttm-btn-color-skincolor"
                                            href="#">Add to cart</a>
                                    </div>
                                </div>
                                <div class="buttons">
                                    <a href="#" rel="nofollow" data-product-id="24006456"
                                        data-product-type="simple" class="add_to_wishlist">
                                        <i class="fa fa-heart" aria-hidden="true"></i>
                                        <span class="wishlist-text">Add to Wish List</span>
                                    </a>
                                    <a href="#" class="compare button" data-product_id="24006456"
                                        rel="nofollow">
                                        <i class="fa fa-expand" aria-hidden="true"></i>
                                        <span class="compare-text">Compare</span>
                                    </a>
                                </div>
                                <div id="block-reassurance-1" class="block-reassurance">
                                    <ul>
                                        <li>
                                            <div class="block-reassurance-item">
                                                <i class="fa fa-lock"></i>
                                                <span>Security policy (edit with Customer reassurance module)</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="block-reassurance-item">
                                                <i class="fa fa-truck"></i>
                                                <span>Delivery policy (edit with Customer reassurance module)</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="block-reassurance-item">
                                                <i class="fa fa-arrows-h"></i>
                                                <span>Return policy (edit with Customer reassurance module)</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div><!-- page end -->


    <!-- Javascript -->

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/tether.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.easing.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-waypoints.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-validate.js') }}"></script>
    <script src="{{ asset('assets/js/numinate.min.js') }}"></script>
    <script src="{{ asset('assets/js/slick.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/price_range_script.js') }}"></script>
    <script src="{{ asset('assets/js/easyzoom.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Revolution Slider -->
    <script src="{{ asset('assets/revolution/js/jquery.themepunch.tools.min.js') }}"></script>
    <script src="{{ asset('assets/revolution/js/jquery.themepunch.revolution.min.js') }}"></script>
    <script src="{{ asset('assets/revolution/js/slider.js') }}"></script>

    <!-- SLIDER REVOLUTION 5.0 EXTENSIONS  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->

    <script src="{{ asset('assets/revolution/js/extensions/revolution.extension.actions.min.js') }}"></script>
    <script src="{{ asset('assets/revolution/js/extensions/revolution.extension.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/revolution/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
    <script src="{{ asset('assets/revolution/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
    <script src="{{ asset('assets/revolution/js/extensions/revolution.extension.migration.min.js') }}"></script>
    <script src="{{ asset('assets/revolution/js/extensions/revolution.extension.navigation.min.js') }}"></script>
    <script src="{{ asset('assets/revolution/js/extensions/revolution.extension.parallax.min.js') }}"></script>
    <script src="{{ asset('assets/revolution/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
    <!-- Javascript end-->

</body>


</html>
