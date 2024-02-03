@extends('layouts.layout')
@section('title', $service->title)
@section('content')

    <!-- page-title -->
    <div class="ttm-page-title-row">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="page-title-heading">
                            <h1 class="title">{{ $service->title }}</h1>
                        </div>
                        <div class="breadcrumb-wrapper">
                            <span class="mr-1"><i class="ti ti-home"></i></span>
                            <a title="Homepage" href="index.html">Home</a>
                            <span class="ttm-bread-sep">&nbsp;/&nbsp;</span>
                            <span class="ttm-textcolor-skincolor">{{ $service->title }}</span>
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
                        <!-- post -->
                        <article class="post ttm-blog-classic clearfix">
                            <!-- post-featured-wrapper -->
                            <div class="ttm-post-featured-wrapper ttm-featured-wrapper">
                              <div id="carousel{{ $service->id }}" class="carousel slide" data-bs-ride="carousel">
                                  <div class="carousel-inner">
                                      @foreach ($service->images as $index => $image)
                                          <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                              <img src="{{ asset('storage/' . $image->path) }}" class="d-block w-100"
                                                  alt="Image {{ $index }}" style="width: 800px; height: 600px;object-fit: cover;">
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
                                        <span class="post-meta-line"><a href="#" tabindex="0"><i
                                                    class="fa fa-calendar"></i>January 16, 2019</a></span>
                                    </div>
                                    <div class="post-meta">
                                        <span class="post-meta-line"><a href="#" tabindex="0"><i
                                                    class="fa fa-comment"></i>Comments</a></span>
                                    </div>
                                </div>
                                <div class="entry-content">

                                    <div class="ttm-blogbox-desc-footer">
                                        <div class="ttm-blogbox-footer-readmore">
                                            <div class="ttm-blogbox-footer-left">
                                                <a class="ttm-btn ttm-btn-size-sm ttm-btn-shape-square ttm-btn-style-fill ttm-btn-color-skincolor"
                                                    href="https://wa.me/message/7Y7IEJZGVG7NA1">DEVIS</a>
                                            </div>
                                        </div>
                                        <div class="ttm-social-share-wrapper">
                                            <div class="ttm-social-share-title">Share This Post:</div>
                                            <div class="social-icons circle">
                                                <ul>
                                                    <li><a href="javascript:void(0)"><i class="fa fa-facebook"></i></a></li>
                                                    <li><a href="javascript:void(0)"><i class="fa fa-google-plus"></i></a>
                                                    </li>
                                                    <li><a href="javascript:void(0)"><i class="fa fa-linkedin"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ttm-blog-classic-box-comment">
                                        <div id="comments" class="comments-area">
                                            <h2 class="comments-title">3 Replies to “How much aspirin to take for stroke”
                                            </h2>
                                            <ol class="comment-list">
                                                <li>
                                                    <div class="comment-body">
                                                        <div class="comment-author vcard">
                                                            <img src="images/blog/blog-comment-01.jpg" class="avatar"
                                                                alt="comment-img">
                                                        </div>
                                                        <div class="comment-box">
                                                            <div class="comment-meta commentmetadata">
                                                                <cite class="ttm-comment-owner">Jhon Doe</cite>
                                                                <span>June 14, 2019 at 8:41 am</span>
                                                            </div>
                                                            <div class="reply">
                                                                <a rel="nofollow" class="comment-reply-link"
                                                                    href="#">Reply</a>
                                                            </div>
                                                            <div class="author-content-wrap">
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                                                    Laudantium eius, sunt porro corporis maiores ea,
                                                                    voluptatibus omnis maxime</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="children comment">
                                                    <div class="comment-body">
                                                        <div class="comment-author vcard">
                                                            <img src="images/blog/blog-comment-02.jpg" class="avatar"
                                                                alt="comment-img">
                                                        </div>
                                                        <div class="comment-box">
                                                            <div class="comment-meta">
                                                                <cite class="ttm-comment-owner">Cherieh</cite>
                                                                <span>June 14, 2019 at 8:42 am</span>
                                                            </div>
                                                            <div class="reply">
                                                                <a rel="nofollow" class="comment-reply-link"
                                                                    href="#">Reply</a>
                                                            </div>
                                                            <div class="author-content-wrap">
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                                                    Laudantium eius, sunt porro corporis maiores ea,
                                                                    voluptatibus omnis maxime</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="comment">
                                                    <div class="comment-body">
                                                        <div class="comment-author vcard">
                                                            <img src="images/blog/blog-comment-01.jpg" class="avatar"
                                                                alt="comment-img">
                                                        </div>
                                                        <div class="comment-box">
                                                            <div class="comment-meta">
                                                                <cite class="ttm-comment-owner">Jhon Doe</cite>
                                                                <span>June 14, 2019 at 8:43 am</span>
                                                            </div>
                                                            <div class="reply">
                                                                <a rel="nofollow" class="comment-reply-link"
                                                                    href="#">Reply</a>
                                                            </div>
                                                            <div class="author-content-wrap">
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                                                    Laudantium eius, sunt porro corporis maiores ea,
                                                                    voluptatibus omnis maxime</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ol>
                                            <div class="comment-respond">
                                                <h3 class="comment-reply-title">Leave a Reply</h3>
                                                <form action="#" method="post" id="commentform"
                                                    class="comment-form">
                                                    <p class="comment-notes">Your email address will not be published. </p>
                                                    <p class="comment-form-comment">
                                                        <textarea id="comment" placeholder="Comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
                                                    </p>
                                                    <p class="comment-form-author">
                                                        <input id="author" placeholder="Name (required)"
                                                            name="author" type="text" value="" size="30"
                                                            aria-required="true">
                                                    </p>
                                                    <p class="comment-form-email">
                                                        <input id="email" placeholder="Email (required)"
                                                            name="email" type="text" value="" size="30"
                                                            aria-required="true">
                                                    </p>
                                                    <p class="comment-form-url">
                                                        <input id="url" placeholder="Website" name="url"
                                                            type="text" value="" size="30">
                                                    </p>
                                                    <p class="form-submit mt-40">
                                                        <input name="submit" type="submit" id="submit"
                                                            class="submit ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-fill ttm-btn-color-skincolor"
                                                            value="Read More">
                                                    </p>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- ttm-blog-classic-content end -->
                        </article><!-- post end -->
                    </div>
                    <div class="col-lg-3 sidebar-right widget-area">
                        <aside class="widget widget-search">
                            <form role="search" method="get" class="search-form" action="#">
                                <label>
                                    <span class="screen-reader-text">Search for:</span>
                                    <input type="search" class="input-text" placeholder="Search …" value=""
                                        name="s">
                                </label>
                                <button class="btn" type="submit" value="Search"> <i class="fa fa-search"></i>
                                </button>
                            </form>
                        </aside>
                        <aside class="widget widget-categories">
                            <h3 class="widget-title">Categories</h3>
                            <ul>
                                <li><a href="#">Carpentry</a><span>3</span></li>
                                <li><a href="#">Electrical</a><span>3</span></li>
                                <li><a href="#">Flooring</a><span>3</span></li>
                                <li><a href="#">Home Maintenance</a><span>4</span></li>
                                <li><a href="#">Industrial</a><span>3</span></li>
                                <li><a href="#">Painting</a><span>2</span></li>
                                <li><a href="#">Plumber</a><span>5</span></li>
                            </ul>
                        </aside>
                        <aside class="widget widget-recent-post">
                            <h3 class="widget-title">Popular News</h3>
                            <ul class="widget-post ttm-recent-post-list">
                                <li>
                                    <a href="#"><img src="images/blog/01.jpg" alt="post-img"></a>
                                    <span class="post-date">Aug 06, 2019</span>
                                    <a href="#">Danger of Having High Water Pressure</a>
                                </li>
                                <li>
                                    <a href="#"><img src="images/blog/02.jpg" alt="post-img"></a>
                                    <span class="post-date">Aug 12, 2019</span>
                                    <a href="#">The Most Common Painting Mistakes</a>
                                </li>
                                <li>
                                    <a href="#"><img src="images/blog/03.jpg" alt="post-img"></a>
                                    <span class="post-date">Aug 15, 2019</span>
                                    <a href="#">Choosing Roofing Material for Home</a>
                                </li>
                            </ul>
                        </aside>
                        <aside class="widget flicker-widget">
                            <h3 class="widget-title">Flickr</h3>
                            <div class="ttm-flicker-widget-wrapper">
                                <a href="#"><img src="images/flicker/01.jpg" alt="A photo on Flickr"
                                        title="themetech-two"></a>
                                <a href="#"><img src="images/flicker/02.jpg" alt="A photo on Flickr"
                                        title="themetech-eight"></a>
                                <a href="#"><img src="images/flicker/03.jpg" alt="A photo on Flickr"
                                        title="themetech-four"></a>
                                <a href="#"><img src="images/flicker/04.jpg" alt="A photo on Flickr"
                                        title="themetech-six"></a>
                                <a href="#"><img src="images/flicker/05.jpg" alt="A photo on Flickr"
                                        title="themetech-one"></a>
                                <a href="#"><img src="images/flicker/06.jpg" alt="A photo on Flickr"
                                        title="themetech-seven"></a>
                                <a href="#"><img src="images/flicker/07.jpg" alt="A photo on Flickr"
                                        title="themetech-five"></a>
                                <a href="#"><img src="images/flicker/08.jpg" alt="A photo on Flickr"
                                        title="themeteh-nine"></a>
                                <a href="#"><img src="images/flicker/09.jpg" alt="A photo on Flickr"
                                        title="themetech-three"></a>
                            </div>
                        </aside>
                        <aside class="widget widget-latest-tweets">
                            <h3 class="widget-title">Latest Tweets</h3>
                            <div class="latest-tweets">
                                <ul>
                                    <li>
                                        <p class="tweet-text">All the Lorem Ipsum generators on the Internet </p>
                                        <a href="#" rel="nofollow">twitter.com/i/web/status/11191…</a>
                                        <p class="tweet-details"><a href="#"><time
                                                    datetime="2019-04-19 05:40:29+0000">April 19, 2019 5:40 am</time></a>
                                        </p>
                                    </li>
                                    <li>
                                        <p class="tweet-text">All the Lorem Ipsum generators on the Internet </p>
                                        <a href="#" rel="nofollow">twitter.com/i/web/status/11125…</a>
                                        <p class="tweet-details">
                                            <a href="#"><time datetime="2019-04-01 06:11:28+0000">April 1, 2019 6:11
                                                    am</time></a>
                                        </p>
                                    </li>
                                    <li>
                                        <p class="tweet-text">All the Lorem Ipsum generators on the Internet </p>
                                        <a href="#" rel="nofollow">twitter.com/i/web/status/11106…</a>
                                        <p class="tweet-details"><a href="#"><time
                                                    datetime="2019-04-19 05:40:29+0000">April 19, 2019 7:48 am</time></a>
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </aside>
                        <aside class="widget tagcloud-widget">
                            <h3 class="widget-title">Tags</h3>
                            <div class="tagcloud">
                                <a href="#" class="tag-cloud-link">Analytics</a>
                                <a href="#" class="tag-cloud-link">Business</a>
                                <a href="#" class="tag-cloud-link">Market</a>
                                <a href="#" class="tag-cloud-link">Innovation</a>
                                <a href="#" class="tag-cloud-link">Investing</a>
                                <a href="#" class="tag-cloud-link">Security</a>
                                <a href="#" class="tag-cloud-link">Development</a>
                            </div>
                        </aside>
                    </div>
                </div><!-- row end -->
            </div>
        </section>
        <!-- sidebar end -->

    </div><!--site-main end-->

@endsection
