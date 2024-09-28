<!DOCTYPE html>
<html lang="❴❴ session()->get('locale') ?? app()->getLocale() ❵❵">

<!-- Mirrored from themetechmount.com/html/fixfellow/header-style-02.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 13 Feb 2023 10:58:19 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description"
        content="{{ config('variables.templateDescription') ? config('variables.templateDescription') : '' }}" />
    <meta name="keywords" content="{{ config('variables.templateKeyword') ? config('variables.templateKeyword') : '' }}">
    <meta name="author" content="Sidik Slims" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Quincaillerie - @yield('title')</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4238780729755314"
        crossorigin="anonymous"></script>

    <!-- favicon icon -->
    <link rel="shortcut icon" href="images/favicon.png" />
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Facebook -->
    <meta name="facebook-domain-verification" content="i78f42vrfi1go3v13c2e9ncgl5o7cd" />
    <!-- bootstrap -->
    <link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/bootstrap.min.css') }}" />

    <!-- animate -->
    <link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/animate.css') }}" />

    <!-- fontawesome -->
    <link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/font-awesome.css') }}" />

    <!-- themify -->
    <link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/themify-icons.css') }}" />

    <!-- slick -->
    <link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/slick.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/slick-theme.css') }}">

    <!-- REVOLUTION LAYERS STYLES -->

    <link rel="stylesheet" type="text/css" href="{{ asset('front/assets/revolution/css/layers.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('front/assets/revolution/css/settings.css') }}">

    <!-- magnific-popup -->
    <link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/magnific-popup.css') }}" />

    <!-- megamenu -->
    <link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/megamenu.css') }}">

    <!-- shortcodes -->
    <link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/shortcodes.css') }}" />

    <!-- main -->
    <link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/main.css') }}" />

    <!-- responsive -->
    <link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/responsive.css') }}" />
    <link rel="icon" href="{{ asset('front/assets/images/favicon.ico') }}" type="image/x-icon">


</head>

<body>

    <!--page start-->
    <div class="page">
        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Félicitations',
                    text: '{{ session('success') }}',
                    timer: 3000,
                    showConfirmButton: false
                });
            </script>
        @endif


        <!--newsletter_popup_wrap start-->
        {{-- @include('partials.newletter_pop_up') --}}
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



    </div>
    <!-- page end -->


    <!-- Javascript -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


    <script src="{{ asset('front/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('front/assets/js/tether.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="{{ asset('front/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('front/assets/js/jquery.easing.js') }}"></script>
    <script src="{{ asset('front/assets/js/jquery-waypoints.js') }}"></script>
    <script src="{{ asset('front/assets/js/jquery-validate.js') }}"></script>
    <script src="{{ asset('front/assets/js/numinate.min.js') }}"></script>
    <script src="{{ asset('front/assets/js/slick.js') }}"></script>
    <script src="{{ asset('front/assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('front/assets/js/price_range_script.js') }}"></script>
    <script src="{{ asset('front/assets/js/easyzoom.js') }}"></script>
    <script src="{{ asset('front/assets/js/main.js') }}"></script>

    <!-- Revolution Slider -->
    <script src="{{ asset('front/assets/revolution/js/jquery.themepunch.tools.min.js') }}"></script>
    <script src="{{ asset('front/assets/revolution/js/jquery.themepunch.revolution.min.js') }}"></script>
    <script src="{{ asset('front/assets/revolution/js/slider.js') }}"></script>

    <!-- SLIDER REVOLUTION 5.0 EXTENSIONS  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->

    <script src="{{ asset('front/assets/revolution/js/extensions/revolution.extension.actions.min.js') }}"></script>
    <script src="{{ asset('front/assets/revolution/js/extensions/revolution.extension.carousel.min.js') }}"></script>
    <script src="{{ asset('front/assets/revolution/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
    <script src="{{ asset('front/assets/revolution/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
    <script src="{{ asset('front/assets/revolution/js/extensions/revolution.extension.migration.min.js') }}"></script>
    <script src="{{ asset('front/assets/revolution/js/extensions/revolution.extension.navigation.min.js') }}"></script>
    <script src="{{ asset('front/assets/revolution/js/extensions/revolution.extension.parallax.min.js') }}"></script>
    <script src="{{ asset('front/assets/revolution/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
    <!-- Javascript end-->

</body>


</html>
