@extends('layouts.layout')
@section('title', 'Accueil')
@section('content')

<!-- page-title -->
<div class="ttm-page-title-row">
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <div class="d-flex justify-content-between align-items-center">
                  <div class="page-title-heading">
                      <h1 class="title">{{ $category->name }}</h1>
                  </div>
                  <div class="breadcrumb-wrapper">
                      <span class="mr-1"><i class="ti ti-home"></i></span>
                      <a title="Homepage" href="index.html">Home</a>
                      <span class="ttm-bread-sep">&nbsp;/&nbsp;</span>
                      <span class="ttm-textcolor-skincolor">Shop</span>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div><!-- page-title end-->


<!--site-main start-->
<div class="site-main">

<!--shop-views-section-->
<section class="shop-views-section clearfix">
   <div class="container">
      <!-- row -->
      <div class="row">
          <div class="col-lg-12">
              <div class="ttm-shop-toolbar-wrapper">
                  <div class="row">
                      <div class="col-md-6 toolbar-left">
                          <div class="nav-tab-wrapper">
                              <ul class="nav nav-tabs" id="myTab" role="tablist">
                                  <li class="nav-item">
                                      <a class="nav-link active" data-toggle="tab" href="#grid" role="tab" aria-selected="true"><i class="ti ti-layout-grid2-alt"></i></a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link" data-toggle="tab" href="#list" role="tab" aria-selected="false"><i class="ti ti-menu-alt"></i></a>
                                  </li>
                              </ul>
                          </div>
                          <form class="products-result-count" method="get">
                              <div class="orderby">
                                  <label>Show: </label>
                                  <select name="orderby" class="select2-hidden-accessible">
                                      <option value="0" selected="selected">01</option>
                                      <option value="showtby">14</option>
                                      <option value="showtby">15</option>
                                      <option value="showtby">16</option>
                                      <option value="showtby">17</option>
                                      <option value="showtby">18</option>
                                      <option value="showtby">19</option>
                                  </select>
                              </div>
                          </form>
                      </div>
                      <div class="col-md-6 toolbar-right">
                          <form class="products-ordering text-right" method="get">
                              <div class="orderby">
                                  <label>Sort by: </label>
                                  <select name="orderby" class="select2-hidden-accessible">
                                      <option value="menu_order" selected="selected">Sales High To low</option>
                                      <option value="sortby">price: low to high</option>
                                      <option value="sortby">price: high to low</option>
                                  </select>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
              <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade active show" id="grid" role="tabpanel">
                      <div class="row">
                        @foreach ($products as $product )
                           <!-- product -->
                           <div class="product col-md-3 col-sm-6 col-xs-12">
                            <div class="product-box">
                                <!-- product-box-inner -->
                                <div class="product-box-inner">
                                    <div class="product-image-box">
                                        <img class="img-fluid pro-image-front" src="{{ asset('storage/' . $product->image) }}" alt="">
                                        {{-- <img class="img-fluid pro-image-back" src="images/product/pro-back-01.png" alt=""> --}}
                                    </div>
                                    <div class="product-btn-links-wrapper">
                                        <div class="product-btn"><a href="#" class="add-to-cart-btn tooltip-top" data-tooltip="Add To Cart"><i class="ti ti-shopping-cart"></i></a>
                                        </div>
                                        <div class="product-btn"><a href="#" class="quick-view-btn js-show-modal1 tooltip-top" data-tooltip="Quick View"><i class="ti ti-search"></i></a>
                                        </div>
                                        <div class="product-btn"><a href="#" class="wishlist-btn tooltip-top" data-tooltip="Add To Wishlist"><i class="ti ti-heart"></i></a>
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
                                          {{ $product->prix }}
                                            <span class="product-Price-currencySymbol">F CFA</span>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div><!-- product end -->
                        @endforeach

                      </div>
                  </div>
                  <div class="tab-pane fade" id="list" role="tabpanel">
                      <div class="product-list product res-991-pt-0">
                          <!-- product-box -->
                          <div class="product-box">
                              <div class="row">
                                  <div class="col-lg-3 col-md-4 col-sm-5">
                                      <!-- product-box-inner -->
                                      <div class="product-box-inner">
                                          <div class="product-image-box">
                                              <img class="img-fluid pro-image-front" src="images/product/pro-front-01.png" alt="">
                                              <img class="img-fluid pro-image-back" src="images/product/pro-back-01.png" alt="">
                                          </div>
                                      </div><!-- product-box-inner end -->
                                  </div>
                                  <div class="col-lg-9 col-md-8 col-sm-7">
                                      <div class="product-description">
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
                                              <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of looked up one of the more in classical Virginia, obscure Latin words.</p>
                                              <a class="ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-fill ttm-icon-btn-right ttm-btn-color-skincolor mt-15" href="#" title="">Add To Cart <i class="themifyicon ti-shopping-cart-full"></i></a>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div><!-- product-box end -->
                          <!-- product-box -->
                          <div class="product-box">
                              <div class="row">
                                  <div class="col-lg-3 col-sm-4">
                                      <!-- product-box-inner -->
                                      <div class="product-box-inner">
                                          <div class="product-image-box">
                                              <div class="onsale">Sale!</div>
                                              <img class="img-fluid pro-image-front" src="images/product/pro-front-04.png" alt="">
                                              <img class="img-fluid pro-image-back" src="images/product/pro-back-04.png" alt="">
                                          </div>
                                      </div><!-- product-box-inner end -->
                                  </div>
                                  <div class="col-lg-9 col-md-8 col-sm-7">
                                      <div class="product-description">
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
                                              <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of looked up one of the more in classical Virginia, obscure Latin words.</p>
                                              <a class="ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-fill ttm-icon-btn-right ttm-btn-color-skincolor mt-15" href="#" title="">Add To Cart <i class="themifyicon ti-shopping-cart-full"></i></a>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div><!-- product-box end -->
                          <!-- product-box -->
                          <div class="product-box">
                              <div class="row">
                                  <div class="col-lg-3 col-sm-4">
                                      <!-- product-box-inner -->
                                      <div class="product-box-inner">
                                          <div class="product-image-box">
                                              <img class="img-fluid pro-image-front" src="images/product/pro-front-03.png" alt="">
                                              <img class="img-fluid pro-image-back" src="images/product/pro-back-03.png" alt="">
                                          </div>
                                      </div><!-- product-box-inner end -->
                                  </div>
                                  <div class="col-lg-9 col-md-8 col-sm-7">
                                      <div class="product-description">
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
                                              <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of looked up one of the more in classical Virginia, obscure Latin words.</p>
                                              <a class="ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-fill ttm-icon-btn-right ttm-btn-color-skincolor mt-15" href="#" title="">Add To Cart <i class="themifyicon ti-shopping-cart-full"></i></a>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div><!-- product-box end -->
                      </div>
                  </div>
              </div>
              <div class="pagination-block res-991-mt-0">
                  <span class="page-numbers current">1</span>
                  <a class="page-numbers" href="#">2</a>
                  <a class="page-numbers" href="#">3</a>
                  <a class="next page-numbers" href="#"><i class="ti ti-arrow-right"></i></a>
              </div>
          </div>
      </div><!-- row end -->
  </div>
</section>
<!--team-section end-->


</div><!--site-main end-->
@endsection
