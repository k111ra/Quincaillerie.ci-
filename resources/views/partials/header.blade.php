<header id="masthead" class="header ttm-header-style-02">
    <!-- top_bar -->
    <div class="top_bar">
        <div class="container">
            <div class="row">
                <div class="col d-md-flex flex-row">
                    <div class="top_bar_contact_item">Soldes jusqu'à <span class="ttm-textcolor-highlight"> 25% </span>
                        Utiliser le code promo <div class="coupen_code ttm-textcolor-highlight">“quin2023”</div>
                    </div>
                    <div class="top_bar_content ml-auto">
                        <div class="top_bar_user">
                            <div><a href="#">Favoris (0)</a></div>
                            <div class="top_bar_menu">
                                {{-- <ul class="top_bar_dropdown">
                                    <li><a href="#" data-toggle="dropdown">Monais</a>
                                        <ul>
                                            <li><a href="#">F CFA</a></li>
                                            <li><a href="#">EUR €</a></li>
                                            <li><a href="#">USD $</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#" data-toggle="dropdown"><img
                                                src="{{ asset('front/assets/images/flag.jpg') }}" alt="img">
                                            Langue</a>
                                        <ul>
                                            <li><a href="#"><span class="mr-2"><img
                                                            src="{{ asset('front/assets/images/English-icon.jpg') }}"
                                                            alt="img"></span>English</a></li>
                                            <li><a href="#"><span class="mr-2"><img
                                                            src="{{ asset('front/assets/images/French-icon.jpg') }}"
                                                            alt="img"></span>French</a></li>
                                        </ul>
                                    </li>
                                </ul> --}}
                            </div>
                            <div>
                                {{-- <a class="btn btn-primary" href="{{ route('cart') }}">
                                    Voir le panier
                                </a> --}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- top_bar end-->
    <div class="header_main">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-3 col-3 order-1">
                    <!-- site-branding -->
                    <div class="site-branding">
                        <a class="home-link" href="/" title="Quincaillerie.ci" rel="home">
                            <img id="logo-img" class="img-center" width="250px"
                                src="{{ asset('front/assets/images/white-logo.png') }}" alt="logo-img">
                        </a>
                    </div><!-- site-branding end -->
                </div>
                <div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
                    <div class="header_search">
                        <!-- header_search -->
                        <div class="header_search_content">
                            <div id="search_block_top" class="search_block_top">
                                <form id="searchbox" method="GET" action="{{ route('search') }}">
                                    <input class="search_query form-control" type="text" id="search_query_top"
                                        name="query" placeholder="Rechercher des achats..."
                                        value="{{ request('query') }}">
                                    <button type="submit" class="btn btn-default button-search">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- header_search end -->
                </div>
                <div class="col-lg-3 col-9 order-lg-3 order-2 text-lg-left text-right">
                    <!-- header_extra -->
                    <div
                        class="header_extra d-flex flex-column flex-lg-row align-items-lg-center justify-content-lg-end">
                        <ul class="navbar-nav ms-auto">
                            <!-- Authentication Links -->
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="" href="{{ route('login') }}">{{ __('Connexion') }}</a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="" href="{{ route('register') }}">{{ __('S\'inscrire') }}</a>
                                    </li>
                                @endif
                            @else
                                <div class="account dropdown">
                                    <div class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="account_icon">
                                            <i class="fa fa-user"></i>
                                        </div>
                                        <div class="account_content">
                                            <div class="account_text"><a href="#"> {{ Auth::user()->name }}</a></div>
                                        </div>
                                    </div>
                                    <div class="account_extra dropdown_link" data-toggle="dropdown">Mon compte</div>
                                    <aside class="widget_account dropdown_content">
                                        <div class="widget_account_content">
                                            <ul>
                                                <li><i class="fa fa-sign-in mr-2"></i><a
                                                        href="{{ route('user.dashboard') }}">Compte</a></li>
                                                <li>
                                                    <form action="{{ route('logout') }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-link">Déconnexion</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </aside>
                                </div>
                            @endguest
                        </ul>

                        <!-- Cart Section -->
                        <div class="cart dropdown mt-2 mt-lg-0">
                            <div class="dropdown_link d-flex flex-row align-items-center justify-content-end"
                                data-toggle="dropdown">
                                <div class="cart_icon">
                                    <i class="fa fa-shopping-cart"></i>
                                    <!-- Nombre d'articles dans le panier -->
                                    <div class="cart_count">{{ session('cart') ? count(session('cart')) : '00' }}</div>
                                </div>
                                <div class="cart_content">
                                    <div class="cart_text"><a href="#">Mon Panier</a></div>
                                    <!-- Prix total des articles dans le panier -->
                                    <div class="cart_price">{{ session('cart_total', 0) }} F CFA</div>
                                </div>
                            </div>

                            <!-- Dropdown cart content -->
                            <aside class="widget_shopping_cart dropdown_content" id="dropdownCartContent">
                                <ul class="cart-list">
                                    @if (session('cart'))
                                        @foreach (session('cart') as $id => $details)
                                            <li>
                                                <a href="#" class="photo">
                                                    <img src="{{ asset('storage/' . $details['image']) }}"
                                                        class="cart-thumb" alt="" />
                                                </a>
                                                <h6><a href="#">{{ $details['nom'] }}</a></h6>
                                                <p>{{ $details['quantity'] }}x - <span
                                                        class="price">{{ number_format($details['price'], 0) }}</span>
                                                    F CFA</p>
                                            </li>
                                        @endforeach
                                    @else
                                        <li>
                                            <p>Votre panier est vide</p>
                                        </li>
                                    @endif
                                    <li class="total">
                                        <!-- Total dynamique du panier -->
                                        <span class="pull-right"><strong>Total</strong>:
                                            {{ number_format(session('cart_total', 0), 0) }} F CFA</span>
                                        <a href="/cart/show" class="btn btn-default btn-cart">Panier</a>
                                    </li>
                                </ul>
                            </aside>
                        </div>
                    </div>
                    <!-- header_extra end -->
                </div>

            </div>
        </div>
    </div>
    <!-- haeder-main end -->
    <!-- site-header-menu -->
    <div id="site-header-menu" class="site-header-menu clearfix">
        <div class="site-header-menu-inner stickable-header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main_nav_content d-flex flex-row">
                            <div class="cat_menu_container">
                                <a href="#" class="cat_menu d-flex flex-row align-items-center">
                                    <div class="cat_icon"><i class="fa fa-bars"></i></div>
                                    <div class="cat_text">
                                        <h4>Toutes catégories</h4>
                                    </div>
                                </a>
                                <ul class="cat_menu_list menu-vertical">
                                    <li><a href="#" class="close-side"><i class="fa fa-times"></i></a></li>
                                    @foreach ($categories->take(10) as $category)
                                        <li class="parent">
                                            <a href="{{ route('shop', $category->slug) }}">{{ $category->name }}</a>
                                            @if ($category->children->count() > 0)
                                                <div class="sub-menu megamenu column3">
                                                    @foreach ($category->children as $child)
                                                        <ul class="list-unstyled childs_1">
                                                            <li class="title">
                                                                <a
                                                                    href="{{ route('shop', $child->slug) }}">{{ $child->name }}</a>
                                                                @if ($child->products->count() > 0)
                                                                    <div class="sub-menu">
                                                                        <ul class="list-unstyled childs_2">
                                                                            @foreach ($child->products as $product)
                                                                                <li><a
                                                                                        href="#">{{ $product->name }}</a>
                                                                                </li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </div>
                                                                @endif
                                                            </li>
                                                        </ul>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </li>
                                    @endforeach
                                    @if ($categories->count() > 10)
                                        <li class="parent-plus"><a href="#" id="show-more">Plus de
                                                catégories</a>
                                            <div class="plus-menu" id="more-categories" style="display: none;">
                                                <ul class="list-unstyled">
                                                    @foreach ($categories->skip(10) as $category)
                                                        <li class="parent">
                                                            <a
                                                                href="{{ route('shop', $category->slug) }}">{{ $category->name }}</a>
                                                            @if ($category->children->count() > 0)
                                                                <div class="sub-menu megamenu column3">
                                                                    @foreach ($category->children as $child)
                                                                        <ul class="list-unstyled childs_1">
                                                                            <li class="title">
                                                                                <a
                                                                                    href="{{ route('shop', $child->slug) }}">{{ $child->name }}</a>
                                                                                @if ($child->products->count() > 0)
                                                                                    <div class="sub-menu">
                                                                                        <ul
                                                                                            class="list-unstyled childs_2">
                                                                                            @foreach ($child->products as $product)
                                                                                                <li><a
                                                                                                        href="#">{{ $product->name }}</a>
                                                                                                </li>
                                                                                            @endforeach
                                                                                        </ul>
                                                                                    </div>
                                                                                @endif
                                                                            </li>
                                                                        </ul>
                                                                    @endforeach
                                                                </div>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </li>
                                    @endif
                                </ul>
                            </div>

                            <!--site-navigation -->
                            <div id="site-navigation" class="site-navigation">
                                <div class="btn-show-menu-mobile menubar menubar--squeeze">
                                    <span class="menubar-box">
                                        <span class="menubar-inner"></span>
                                    </span>
                                </div>
                                <!-- menu -->
                                <nav class="menu menu-mobile" id="menu">
                                    <ul class="nav" data-in="fadeInDown" data-out="fadeOutUp">
                                        <li><a href="{{ url('/') }}">Accueil</a></li>

                                        <li><a href="{{ url('/services') }}">Services</a></li>

                                        <li class="mega-menu-item megamenu-fw">
                                            <a href="#" class="mega-menu-link">Boutiques</a>
                                            <ul class="mega-submenu megamenu-content" role="menu">
                                                <li>
                                                    <div class="row">
                                                        @foreach ($categories as $category)
                                                            <div class="col-menu col-md-3">
                                                                <a class=""
                                                                    href="{{ route('shop', $category->slug) }}">{{ $category->name }}</a>

                                                                <div class="content">
                                                                    <ul class="menu-col">
                                                                        @foreach ($category->children as $child)
                                                                            <li><a
                                                                                    href="{{ route('shop', $child->slug) }}">{{ $child->name }}</a>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            </div><!-- end col-3 -->
                                                        @endforeach
                                                        <div class="col-menu col-md-3">
                                                            <div class="content">
                                                                <ul class="menu-col">
                                                                    <li><a href="shop.html">
                                                                            <img class="img-fluid"
                                                                                src="{{ asset('/front/assets/images/menu-item-banner.jpg') }}"
                                                                                alt="bimg">
                                                                        </a></li>
                                                                </ul>
                                                            </div>
                                                        </div><!-- end col-3 -->
                                                    </div><!-- end row -->
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="mega-menu-item">
                                            <a href="/posts" class="mega-menu-link">Blog</a>

                                        </li>
                                        <li><a href="{{ route('contact') }}">Contactez-nous</a></li>
                                    </ul>
                                </nav>
                                {{-- <nav class="menu menu-mobile" id="menu">
                                    <ul class="nav" data-in="fadeInDown" data-out="fadeOutUp">
                                        <li><a href="{{ url('/') }}">Accueil</a></li>
                                        <li><a href="{{ url('/services') }}">Services</a></li>
                                        <li class="mega-menu-item megamenu-fw">
                                            <a href="#" class="mega-menu-link">Boutiques</a>
                                            <ul class="mega-submenu megamenu-content" role="menu">
                                                <li>
                                                    <div class="row">
                                                        @foreach ($categories as $category)
                                                            <div class="col-menu col-md-3">
                                                                <h6 class="title">
                                                                    <a
                                                                        href="{{ route('shop', $category->slug) }}">{{ $category->name }}</a>
                                                                </h6>
                                                                @if ($category->children->count() > 0)
                                                                    <div class="content">
                                                                        <ul class="menu-col">
                                                                            @foreach ($category->children as $child)
                                                                                <li><a
                                                                                        href="{{ route('shop', $child->slug) }}">{{ $child->name }}</a>
                                                                                </li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </div>
                                                                @endif
                                                            </div><!-- end col-3 -->
                                                        @endforeach
                                                    </div><!-- end row -->
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="mega-menu-item">
                                            <a href="#" class="mega-menu-link">Blog</a>
                                        </li>
                                        <li><a href="{{ route('contact') }}">Contactez-nous</a></li>
                                    </ul>
                                </nav> --}}

                            </div><!-- site-navigation end-->
                            <div
                                class="user_zone_block d-flex flex-row align-items-center justify-content-end ml-auto">
                                <div class="icon"><i class="fa fa-gift"></i></div>
                                <h6 class="text">Nouvelle zone utilisateur</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- site-header-menu end -->
</header>
<script>
    $(document).ready(function() {
        $('#show-more').click(function() {
            $('#more-categories').slideToggle();
            $(this).text(function(i, text) {
                return text === "Plus de catégories" ? "Moins de catégories" :
                    "Plus de catégories";
            });
        });
    });
</script>
