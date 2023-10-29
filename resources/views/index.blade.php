@extends('layouts.layout')
@section('title', 'Accueil')
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
                            <a href="#"><img class="img-fluid" src="{{ 'front/assets/images/banner-seven.jpg' }}"
                                    alt=""></a>
                        </div><!-- banner-image end -->
                    </div>
                    <div class="col-sm-6">
                        <!-- banner-image -->
                        <div class="banner-image pt-30">
                            <a href="#"><img class="img-fluid"
                                    src="{{ asset('front/assets/images/afficher-ici.png') }}" alt=""></a>
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
                            <h3 class="widget-title">Offres spéciales</h3>
                            <div class="ttm_info_widget">
                                <span>Outils de bricoleur</span>
                                <div class="title">
                                    <h3>Offres <strong>limitée!</strong></h3>
                                </div>
                                <div class="content">
                                    <p>C'est toute la puissance dont vous avez besoin!</p>
                                    <h4>Jusqu'à <strong>35%</strong> de reduction !</h4>
                                </div>
                                <a class="ttm-btn ttm-btn-size-sm ttm-btn-color-skincolor btn-inline" href="#">Acheter
                                    maintenant!</a>
                            </div>
                        </aside>
                        <aside class="widget products top-rated-products">
                            <h3 class="widget-title">Produits populaires</h3>
                            <ul class="product-list-widget product">
                                @foreach ($produitsPopulaires as $product)
                                    <li>
                                        <a href="#"><img src="{{ asset('storage/' . $product->image) }}"
                                                alt=""></a>
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
                                                <h2>{{ $product->nom }}</h2>
                                            </a>
                                            <span class="price">
                                                <span class="product-Price-amount">
                                                    <span class="product-Price-currencySymbol">{{ $product->prix }}</span> F
                                                    CFA
                                                </span>
                                            </span>
                                        </div>
                                    </li>
                                @endforeach


                            </ul>
                        </aside>
                        <aside class="widget widget-testimonial">
                            <h3 class="widget-title">Avis</h3>
                            <!-- wrap-testimonial -->
                            <!-- testimonial_slick_slider -->
                            <div class="testimonial_slick_slider"
                                data-slick='{"slidesToShow": 1, "slidesToScroll": 1, "arrows":false, "dots":true, "autoplay":false, "infinite":true}'>
                                <!-- testimonials -->
                                <div class="testimonials ttm-testimonial-box-view-style2">
                                    <div class="testimonial-content">
                                        <blockquote class="ttm-testimonial-text">Un client satisfait est la meilleur source
                                            de publicité et je suis l'un de ceux qui sont satisfaits.
                                        </blockquote>
                                        <div class="testimonial-avatar">
                                            <div class="testimonial-img">
                                                <img class="img-fluid" src="{{ 'assets/images/testimonial/01.jpg' }}"
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
                                        <blockquote class="ttm-testimonial-text">Un client satisfait est la meilleur source
                                            de publicité et je suis l'un de ceux qui sont satisfaits.
                                        </blockquote>
                                        <div class="testimonial-avatar">
                                            <div class="testimonial-img">
                                                <img class="img-fluid" src="{{ 'assets/images/testimonial/02.jpg' }}"
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
                                        <blockquote class="ttm-testimonial-text">Un client satisfait est la meilleur source
                                            de publicité et je suis l'un de ceux qui sont satisfaits.
                                        </blockquote>
                                        <div class="testimonial-avatar">
                                            <div class="testimonial-img">
                                                <img class="img-fluid" src="{{ 'assets/images/testimonial/03.jpg' }}"
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
                            <h3 class="widget-title">Produits populaires</h3>
                            <ul class="product-list-widget product">

                                @foreach ($produitsPopulaires as $product)
                                    <li>
                                        <a href="#"><img src="{{ asset('storage/' . $product->image) }}"
                                                alt=""></a>
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
                                                <h2>{{ $product->nom }}</h2>
                                            </a>
                                            <span class="price">
                                                <span class="product-Price-amount">
                                                    <span class="product-Price-currencySymbol">{{ $product->prix }}</span>
                                                    F
                                                    CFA
                                                </span>
                                            </span>
                                        </div>
                                    </li>
                                @endforeach


                            </ul>
                        </aside>
                        <aside class="widget widget_media_image banner-image">
                            <a href="#"><img class="img-fluid" src="{{ 'front/assets/images/widget-banner-one.jpg' }}"
                                    alt="widget-banner"></a>
                        </aside>
                        <aside class="widget widget_media_image banner-image">
                            <a href="#"><img class="img-fluid" src="{{ 'front/assets/images/side-banner1.png' }}"
                                    alt="widget-banner"></a>
                        </aside>
                    </div>
                    <div class="col-lg-9 content-area">
                        <div class="products products-fitter">

                            <div class="ttm-tabs">
                                <div class="content-sec-head-style">
                                    <div class="content-area-sec-title">
                                        <h5>Nos produits les plus vendus</h5>
                                    </div>
                                    <ul class="tabs text-right">
                                        @foreach ($bestseller->children as $best)
                                            <li class="tab"><a href="#{{ $best->slug }}">{{ $best->name }}</a>
                                            </li>
                                        @endforeach

                                    </ul>
                                </div>
                                <div class="content-tab">
                                    @foreach ($bestseller->children as $best)
                                        <div class="content-inner">
                                            <div class="products row">
                                                @foreach ($products as $product)
                                                    @if ($product->categorie_id == $best->id)
                                                        @include('partials.product')
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach


                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-12">
                                    <!-- banner-image -->
                                    <div class="banner-image mb-30 mt-5">
                                        <a href="#"><img class="img-fluid"
                                                src="{{ 'front/assets/images/banner-eight.jpg' }}" alt=""></a>
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
                                                <h5>Rapide &amp; Shopping gratuit</h5>
                                            </div>
                                            <div class="featured-desc">
                                                <p>Toute commande supérieure à 100.000 F CFA</p>
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
                                                <h5>100% Remboursement</h5>
                                            </div>
                                            <div class="featured-desc">
                                                <p>30 jours Cash Back</p>
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
                                                <h5>Assistance 24h/24 et 7j/7</h5>
                                            </div>
                                            <div class="featured-desc">
                                                <p>Ligne directe: +225 0747104513</p>
                                            </div>
                                        </div>
                                    </div><!-- featured-icon-box end-->
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
                                        @foreach ($produitsSpecial as $special)
                                            <!-- product -->
                                            <div class="product">
                                                <div class="product-box">
                                                    <!-- product-box-inner -->
                                                    <div class="product-box-inner">
                                                        <div class="product-image-box">
                                                            <img class="img-fluid pro-image-front"
                                                                src="{{ asset('storage/' . $special->image) }}"
                                                                alt="">
                                                            {{-- <img class="img-fluid pro-image-back"
                                                          src="{{ 'assets/images/product/pro-back-09.png' }}"
                                                          alt=""> --}}
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
                                                            <h2>{{ $special->nom }}</h2>
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
                                                                {{ number_format($special->prix, 0, ',', ' ') . 'F cfa' }}
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div><!-- product end -->
                                        @endforeach


                                    </div>
                                </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-12">
                                <div class="content-sec-head-style">
                                    <div class="content-area-sec-title">
                                        <h5>En Solde</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <!-- slick_slider -->
                                <div class="pro_slick_slider"
                                    data-slick='{"slidesToShow": 4, "slidesToScroll": 4, "arrows":true, "autoplay":true}'>
                                    @foreach ($produitsSolde as $solde)
                                        <!-- product -->
                                        <div class="product">
                                            <div class="product-box">
                                                <!-- product-box-inner -->
                                                <div class="product-box-inner">
                                                    <div class="product-image-box">
                                                        <img class="img-fluid pro-image-front"
                                                            src="{{ asset('storage/' . $solde->image) }}"
                                                            alt="">

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
                                                        <h2>{{ $solde->nom }}</h2>
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
                                                            {{ number_format($solde->prix, 0, ',', ' ') . 'F cfa' }}
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- product end -->
                                    @endforeach

                                </div>
                            </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- banner-image -->
                                    <div class="banner-image mb-30">
                                        <a href="#"><img class="img-fluid"
                                                src="{{ 'front/assets/images/banner-nine.jpg' }}" alt=""></a>
                                    </div><!-- banner-image end -->
                                </div>
                                <div class="col-sm-6">
                                    <!-- banner-image -->
                                    <div class="banner-image mb-30">
                                        <a href="#"><img class="img-fluid"
                                                src="{{ 'front/assets/images/banner-ten.jpg' }}" alt=""></a>
                                    </div><!-- banner-image end -->
                                </div>
                            </div>
                            <div class="row mb-35 res-991-mb-15">
                                <div class="col-lg-12">
                                    <div class="content-sec-head-style">
                                        <div class="content-area-sec-title">
                                            <h5>Nos dernières nouvelles et événements</h5>
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
                                                    <img class="img-fluid" src="{{ 'assets/images/blog/01.jpg' }}"
                                                        alt="">
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
                                                    <span class="ttm-meta-line tag-link"><i
                                                            class="fa fa-tag"></i>Éducation des enfants</span>
                                                </div>
                                                <div class="post-title featured-title">
                                                    <h5><a href="blog-single.html">Danger d'avoir une pression d'eau
                                                            élevée</a></h5>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- featured-imagebox-post end -->
                                        <!-- featured-imagebox-post -->
                                        <div class="featured-imagebox featured-imagebox-post ttm-box-view-top-image">
                                            <div class="ttm-post-featured-outer">
                                                <div class="ttm-post-thumbnail featured-thumbnail">
                                                    <img class="img-fluid" src="{{ 'assetsimages/blog/02.jpg' }}"
                                                        alt="">
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
                                                    <span class="ttm-meta-line tag-link"><i
                                                            class="fa fa-tag"></i>Éducation des enfants</span>
                                                </div>
                                                <div class="post-title featured-title">
                                                    <h5><a href="blog-single.html">Les erreurs de peinture les plus
                                                            courantes</a></h5>
                                                </div>
                                            </div>
                                        </div><!-- featured-imagebox-post end -->
                                        <!-- featured-imagebox-post -->
                                        <div class="featured-imagebox featured-imagebox-post ttm-box-view-top-image">
                                            <div class="ttm-post-featured-outer">
                                                <div class="ttm-post-thumbnail featured-thumbnail">
                                                    <img class="img-fluid" src="{{ 'assets/images/blog/03.jpg' }}"
                                                        alt="">
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
                                                    <span class="ttm-meta-line tag-link"><i
                                                            class="fa fa-tag"></i>Éducation des enfants</span>
                                                </div>
                                                <div class="post-title featured-title">
                                                    <h5><a href="blog-single.html">Choisir un matériau de toiture pour
                                                            Maison</a></h5>
                                                </div>
                                            </div>
                                        </div><!-- featured-imagebox-post end -->
                                        <!-- featured-imagebox-post -->
                                        <div class="featured-imagebox featured-imagebox-post ttm-box-view-top-image">
                                            <div class="ttm-post-featured-outer">
                                                <div class="ttm-post-thumbnail featured-thumbnail">
                                                    <img class="img-fluid" src="{{ 'assets/images/blog/04.jpg' }}"
                                                        alt="">
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
                                                    <span class="ttm-meta-line tag-link"><i
                                                            class="fa fa-tag"></i>Éducation des enfants</span>
                                                </div>
                                                <div class="post-title featured-title">
                                                    <h5><a href="blog-single.html">Équiper les chercheurs dans le
                                                            développement.</a></h5>
                                                </div>
                                            </div>
                                        </div><!-- featured-imagebox-post end-->
                                        <!-- featured-imagebox-post -->
                                        <div class="featured-imagebox featured-imagebox-post ttm-box-view-top-image">
                                            <div class="ttm-post-featured-outer">
                                                <div class="ttm-post-thumbnail featured-thumbnail">
                                                    <img class="img-fluid" src="{{ 'assets/images/blog/05.jpg' }}"
                                                        alt="">
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
                                                    <span class="ttm-meta-line tag-link"><i
                                                            class="fa fa-tag"></i>Chiucation des enfants</span>
                                                </div>
                                                <div class="post-title featured-title">
                                                    <h5><a href="blog-single.html">Étapes simples pour remplacer l'ancien
                                                            Carrelage </a></h5>
                                                </div>
                                            </div>
                                        </div><!-- featured-imagebox-post end-->
                                        <!-- featured-imagebox-post -->
                                        <div class="featured-imagebox featured-imagebox-post ttm-box-view-top-image">
                                            <div class="ttm-post-featured-outer">
                                                <div class="ttm-post-thumbnail featured-thumbnail">
                                                    <img class="img-fluid" src="{{ 'assets/images/blog/06.jpg' }}"
                                                        alt="">
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
                                                    <span class="ttm-meta-line tag-link"><i
                                                            class="fa fa-tag"></i>education des enfants</span>
                                                </div>
                                                <div class="post-title featured-title">
                                                    <h5><a href="blog-single.html">Vous avez une fuite ? Embauchez un
                                                            plombier expérimenté</a></h5>
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
