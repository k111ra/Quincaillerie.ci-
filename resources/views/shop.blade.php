@extends('layouts.layout')
@section('title', 'Shop')
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
                            <a title="Homepage" href="/">Accueil</a>
                            <span class="ttm-bread-sep">&nbsp;/&nbsp;</span>
                            <span class="ttm-textcolor-skincolor">Boutique</span>
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
                                                <a class="nav-link active" data-toggle="tab" href="#grid" role="tab"
                                                    aria-selected="true"><i class="ti ti-layout-grid2-alt"></i></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#list" role="tab"
                                                    aria-selected="false"><i class="ti ti-menu-alt"></i></a>
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
                                            <label>Trier Par: </label>
                                            <select name="orderby" onchange="this.form.submit()"
                                                class="select2-hidden-accessible">
                                                <option value="menu_order"
                                                    {{ request('orderby') == 'menu_order' ? 'selected' : '' }}>defaut
                                                </option>
                                                <option value="price_low_high"
                                                    {{ request('orderby') == 'price_low_high' ? 'selected' : '' }}>Prix: Du
                                                    moin au plus</option>
                                                <option value="price_high_low"
                                                    {{ request('orderby') == 'price_high_low' ? 'selected' : '' }}>Prix: Du
                                                    plus au moin</option>

                                            </select>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade active show" id="grid" role="tabpanel">
                                <div class="row">
                                    @foreach ($products as $product)
                                        <!-- product -->
                                        @include('partials.product', ['product' => $product])
                                        <!-- product end -->
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Pagination -->
                        <div class="pagination-block res-991-mt-0">
                            {{ $products->appends(request()->input())->links() }}
                        </div>

                    </div>
                </div><!-- row end -->
            </div>
        </section>
        <!--team-section end-->


    </div><!--site-main end-->
@endsection
