@extends('layouts.layout')
@section('title', 'Contacts')
@section('content')
    <!-- page-title -->
    <div class="ttm-page-title-row">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="page-title-heading">
                            <h1 class="title">Services</h1>
                        </div>
                        <div class="breadcrumb-wrapper">
                            <span class="mr-1"><i class="ti ti-home"></i></span>
                            <a title="Homepage" href="index.html">Accueil</a>
                            <span class="ttm-bread-sep">&nbsp;/&nbsp;</span>
                            <span class="ttm-textcolor-skincolor">Service</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- page-title end-->

    <!--site-main start-->
    <div class="site-main">

        <!-- sidebar -->
        <section class="sidebar ttm-sidebar-right clearfix">
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-lg-9 content-area">
                        @foreach ($services as $service)
                            <!-- post -->
                            <article class="post ttm-blog-classic clearfix">
                                <!-- post-featured-wrapper -->
                                <div class="ttm-post-featured-wrapper ttm-featured-wrapper">
                                    <div id="carousel{{ $service->id }}" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            @foreach ($service->images as $index => $image)
                                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                    <img src="{{ asset('storage/' . $image->path) }}" class="d-block w-100"
                                                        alt="Image {{ $index }}"
                                                        style="width: 800px; height: 600px;object-fit: cover;">
                                                </div>
                                            @endforeach
                                        </div>
                                        <button class="carousel-control-prev" type="button"
                                            data-bs-target="#carousel{{ $service->id }}" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button"
                                            data-bs-target="#carousel{{ $service->id }}" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                    <div class="ttm-box-post-icon">
                                        <i class="ti ti-gallery"></i>
                                    </div>
                                </div><!-- post-featured-wrapper end -->
                                <!-- ttm-blog-classic-content -->
                                <div class="ttm-blog-classic-content">
                                    <div class="ttm-post-entry-header">
                                        <div class="post-meta">
                                            <span class="ttm-meta-line byline"><i
                                                    class="fa fa-user"></i>{{ $service->user->name }}</span>
                                            <span class="ttm-meta-line tag-link"><i
                                                    class="fa fa-tag"></i>{{ $service->category ? $service->category->name : 'Catégorie inconnue' }}</span>
                                        </div>
                                        <header class="entry-header">
                                            <h2 class="entry-title"><a href="#">{{ $service->title }}</a></h2>
                                        </header>
                                    </div>
                                    <div class="entry-content">
                                        {{-- <div class="ttm-box-desc-text">
                                            <p>{!! $service->description !!}</p>
                                        </div> --}}
                                        <div class="ttm-blogbox-desc-footer">
                                            <div class="ttm-blogbox-footer-readmore">
                                                <a class="ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-border ttm-icon-btn-right ttm-btn-color-black"
                                                    href="{{ route('services.show', $service->slug) }}" title="">Voir
                                                    Plus <i class="ti ti-angle-double-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- ttm-blog-classic-content end -->
                            </article><!-- post end -->
                        @endforeach

                        <div class="pagination-block">
                            <span class="page-numbers current">1</span>
                            <a class="page-numbers" href="#">2</a>
                            <a class="next page-numbers" href="#"><i class="ti ti-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 sidebar-right widget-area">
                        <!-- Reste du code de la sidebar -->
                    </div>
                </div><!-- row end -->
            </div>
        </section>
        <!-- sidebar end -->

    </div><!--site-main end-->
@endsection
