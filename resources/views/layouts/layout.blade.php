<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Sidik Slims" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="robots" content="index, follow" />
    <meta name="google-adsense-account" content="ca-pub-4238780729755314">

    {{-- Balises SEO (titre, description, canonical, Open Graph, Twitter, JSON-LD) --}}
    @include('partials.seo')

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4238780729755314"
        crossorigin="anonymous"></script>

    <!-- favicon icon -->
    <link rel="shortcut icon" href="{{ asset('front/assets/images/favicon.ico') }}" />
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
    <link rel="stylesheet" type="text/css"
        href="{{ asset('front/assets/css/shortcodes.css') }}?v={{ filemtime(public_path('front/assets/css/shortcodes.css')) }}" />

    <!-- main -->
    <link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/main.css') }}" />

    <!-- responsive -->
    <link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/responsive.css') }}" />
    <link rel="icon" href="{{ asset('front/assets/images/favicon.ico') }}" type="image/x-icon">
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-M526GHSVY1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-M526GHSVY1');
    </script>
    {{-- <script type="text/javascript" data-cmp-ab="1"
        src="https://cdn.consentmanager.net/delivery/autoblocking/675d362d114b2.js"
        data-cmp-host="c.delivery.consentmanager.net" data-cmp-cdn="cdn.consentmanager.net" data-cmp-codesrc="16"></script>
    <!-- Google Tag Manager --> --}}
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-WRPWSJW9');
    </script>
    <!-- End Google Tag Manager -->
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
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

    <script>
        (function() {
            function emitGoogleCtaClick(source, href) {
                var payload = {
                    event: 'google_cta_click',
                    cta_source: source || 'unknown',
                    cta_url: href || '',
                    page_path: window.location.pathname,
                    page_title: document.title
                };

                if (typeof window.gtag === 'function') {
                    window.gtag('event', 'google_cta_click', {
                        cta_source: payload.cta_source,
                        cta_url: payload.cta_url,
                        page_path: payload.page_path,
                        page_title: payload.page_title
                    });
                }

                if (Array.isArray(window.dataLayer)) {
                    window.dataLayer.push(payload);
                }

                try {
                    window.sessionStorage.setItem('google_cta_source', payload.cta_source);
                    window.sessionStorage.setItem('google_cta_clicked_at', String(Date.now()));
                } catch (e) {
                    // Ignore storage errors (private mode, quotas, policies).
                }
            }

            document.addEventListener('click', function(event) {
                var target = event.target;
                if (!target) {
                    return;
                }

                var link = target.closest('[data-google-cta="1"]');
                if (!link) {
                    return;
                }

                emitGoogleCtaClick(link.getAttribute('data-google-cta-source'), link.getAttribute('href'));
            });
        })();
    </script>
    <!-- Javascript end-->

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WRPWSJW9" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    {{-- Modale "Connexion rapide" : doit rester au niveau racine du document,
         sinon le contexte d'empilement du <header> la fait passer sous .modal-backdrop. --}}
@guest
    <div class="modal fade" id="googleLoginModal" tabindex="-1" role="dialog" aria-labelledby="googleLoginModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="googleLoginModalLabel">Connexion rapide</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Connectez-vous rapidement avec votre compte Google pour accéder a votre espace client.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <a href="{{ route('auth.google') }}" class="btn btn-danger" data-google-cta="1"
                        data-google-cta-source="header_modal">
                        <i class="fa fa-google"></i> Continuer avec Google
                        <span class="badge badge-light ml-2">Recommande</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endguest

</body>


</html>
