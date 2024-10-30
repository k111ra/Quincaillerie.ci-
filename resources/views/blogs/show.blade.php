@extends('layouts.layout')
@section('title', $post->title)

@section('content')
    <!-- Page Title -->
    <div class="ttm-page-title-row">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="page-title-heading">
                            <h1 class="title">{{ $post->title }}</h1>
                        </div>
                        <div class="breadcrumb-wrapper">
                            <span class="mr-1"><i class="ti ti-home"></i></span>
                            <a title="Homepage" href="/">Home</a>
                            <span class="ttm-bread-sep">&nbsp;/&nbsp;</span>
                            <span class="ttm-textcolor-skincolor">{{ $post->title }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Site Main -->
    <div class="site-main">
        <section class="sidebar ttm-sidebar-right clearfix">
            <div class="container">
                <div class="row">
                    <!-- Content Area -->
                    <div class="col-lg-9 content-area">
                        <article class="post ttm-blog-classic clearfix">
                            <!-- Featured Image -->
                            <div class="ttm-post-featured-wrapper ttm-featured-wrapper">
                                @if ($post->image && json_decode($post->image))
                                    <img class="img-fluid" src="{{ asset('storage/' . json_decode($post->image)[0]) }}"
                                        alt="{{ $post->title }}">
                                @else
                                    <img class="img-fluid" src="{{ asset('assets/images/blog/default.jpg') }}"
                                        alt="Default Image">
                                @endif
                                <div class="ttm-box-post-icon">
                                    <i class="ti ti-gallery"></i>
                                </div>
                            </div>

                            <!-- Post Content -->
                            <div class="ttm-blog-classic-content">
                                <div class="ttm-post-entry-header">
                                    <div class="post-meta">
                                        <span class="post-meta-line"><i class="fa fa-calendar"></i>
                                            {{ $post->created_at->format('F d, Y') }}</span>
                                        <span class="post-meta-line"><i class="fa fa-user"></i>
                                            {{ $post->user->name ?? 'Admin' }}</span>
                                    </div>
                                </div>

                                <div class="entry-content">
                                    <div class="ttm-box-desc-text">
                                        {!! $post->description !!}
                                    </div>
                                </div>

                                <!-- Tags and Share -->
                                <div class="ttm-blogbox-desc-footer mt-4">
                                    <div class="ttm-blogbox-footer-readmore">
                                        <div class="ttm-blogbox-footer-left">
                                            {{-- @foreach ($post->tags as $tag)
                                                <a class="ttm-btn ttm-btn-size-sm ttm-btn-shape-square ttm-btn-style-fill ttm-btn-color-skincolor"
                                                    href="#">{{ $tag->name }}</a>
                                            @endforeach --}}
                                        </div>
                                    </div>
                                    <div class="ttm-social-share-wrapper">
                                        <div class="ttm-social-share-title">Share This Post:</div>
                                        <div class="social-icons circle">
                                            <ul>
                                                <li>
                                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                                                        target="_blank" rel="noopener noreferrer">
                                                        <i class="fa fa-facebook"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($post->title) }}"
                                                        target="_blank" rel="noopener noreferrer">
                                                        <i class="fa fa-twitter"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->fullUrl()) }}"
                                                        target="_blank" rel="noopener noreferrer">
                                                        <i class="fa fa-linkedin"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </article>
                    </div>

                    <!-- Sidebar -->
                    <div class="col-lg-3 sidebar-right widget-area">
                        <!-- Search Widget -->
                        <aside class="widget widget-search">
                            <form role="search" method="get" class="search-form" action="#">
                                <input type="search" class="input-text" placeholder="Search …" name="s">
                                <button class="btn" type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </aside>

                        <!-- Categories Widget -->
                        <aside class="widget widget-categories">
                            <h3 class="widget-title">Categories</h3>
                            <ul>
                                @foreach ($categories as $category)
                                    <li><a
                                            href="#">{{ $category->name }}</a><span>{{ $category->products ? $category->products->count() : 0 }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </aside>

                        <!-- Recent Posts Widget -->
                        <aside class="widget widget-recent-post">
                            <h3 class="widget-title">Recent Posts</h3>
                            <ul class="widget-post ttm-recent-post-list">
                                @foreach ($recentPosts as $recent)
                                    <li>
                                        <a href="{{ route('posts.show', $recent->id) }}">
                                            <img src="{{ asset('storage/' . optional(json_decode($recent->image))[0]) }}"
                                                alt="Post Image" style="width: 60px; height: auto;">
                                        </a>
                                        <span class="post-date">{{ $recent->created_at->format('M d, Y') }}</span>
                                        <a
                                            href="{{ route('posts.show', $recent->id) }}">{{ \Illuminate\Support\Str::limit($recent->title, 20) }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </aside>

                        <!-- Tag Cloud Widget -->
                        <aside class="widget tagcloud-widget">
                            <h3 class="widget-title">Tags</h3>
                            <div class="tagcloud">
                                {{-- @foreach ($post->tags as $tag)
                                    <a href="#" class="tag-cloud-link">{{ $tag->name }}</a>
                                @endforeach --}}
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
