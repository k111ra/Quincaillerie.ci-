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
                                        <a href="{{ url('product/' . $product->slug) }}">
                                            @php
                                                $images = json_decode($product->images);
                                            @endphp
                                            @if (!empty($images) && isset($images[0]))
                                                <img src="{{ asset('storage/' . $images[0]) }}" alt="{{ $product->nom }}">
                                            @else
                                                <img src="{{ asset('front/assets/images/default-image.png') }}"
                                                    alt="Default Image">
                                            @endif
                                        </a>
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
                                            <a class="product-title" href="{{ url('product/' . $product->slug) }}">
                                                <h2>{{ $product->nom }}</h2>
                                            </a>
                                            <span class="price">
                                                <span class="product-Price-amount">
                                                    <span class="product-Price-currencySymbol">
                                                        {{ number_format($product->prix, 0, ',', ' ') . ' F CFA' }}
                                                    </span>
                                                </span>
                                            </span>
                                        </div>
                                    </li>
                                @endforeach


                            </ul>
                        </aside>
                        {{-- <aside class="widget widget-testimonial">
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
                        </aside> --}}
                        {{-- <aside class="widget products top-rated-products">
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
                        </aside> --}}
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

                            
                            @foreach ($homeSections as $homeSection)
                                <div class="mb-4">
                                    @include('partials.home_section', ['section' => $homeSection])
                                </div>
                            @endforeach


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
                                        @foreach ($posts as $post)
                                            <!-- featured-imagebox-post -->
                                            <div class="featured-imagebox featured-imagebox-post ttm-box-view-top-image">
                                                <div class="ttm-post-featured-outer">
                                                    <div class="ttm-post-thumbnail featured-thumbnail">
                                                        <!-- Image du post -->
                                                        @php
                                                            $images = json_decode($post->image);
                                                        @endphp

                                                        @if (!empty($images) && is_array($images) && isset($images[0]))
                                                            <img class="img-fluid"
                                                                src="{{ asset('storage/' . $images[0]) }}"
                                                                alt="{{ $post->title }}" width="250px" height="350px">
                                                        @else
                                                            <p>Image non disponible</p>
                                                            <!-- Message d'erreur si aucune image n'est disponible -->
                                                        @endif

                                                        <div class="ttm-box-post-date">
                                                            <span class="ttm-entry-date">
                                                                <time class="entry-date"
                                                                    datetime="{{ $post->created_at->toDateString() }}">
                                                                    {{ $post->created_at->format('d') }}
                                                                    <span
                                                                        class="entry-month">{{ $post->created_at->format('M') }}</span>
                                                                </time>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="featured-content featured-content-post">
                                                    <div class="post-meta">
                                                        <span class="ttm-meta-line byline"><i
                                                                class="fa fa-user"></i>{{ $post->user->name ?? 'Admin' }}</span>
                                                        {{-- <span class="ttm-meta-line tag-link"><i
                                                                class="fa fa-tag"></i>{{ $post->tags->pluck('name')->join(', ') }}</span> --}}
                                                    </div>
                                                    <div class="post-title featured-title">
                                                        <h5>
                                                            <a
                                                                href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>

                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- featured-imagebox-post end -->
                                        @endforeach
                                        <!-- featured-imagebox-post end -->

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
{{--
<script>
    $(document).ready(function() {
        // Ouvrir le modal lors du clic sur le bouton "Quick View"
        $('.quick-view-btn').on('click', function() {
            var productId = $(this).data('product-id');
            $('.wrap-modal1').hide(); // Masquer toutes les modals
            $('.modal-product-' + productId).show(); // Afficher la modal du produit spécifique
        });

        // Fermer le modal
        $('.js-hide-modal1').on('click', function() {
            $(this).closest('.wrap-modal1').hide(); // Masquer la modal
        });
    });
</script> --}}
