<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta property="og:site_name" content="{{ setting('site.title') }}" />
        <meta property="og:title" content="{{ $page->name }}" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="{{ route('pages', $page->slug) }}" />
        <meta property="og:image" content="{{ Voyager::Image($page->image) }}" />
        <meta property="og:description" content="{{ $page->description }}" />
    
        <title>{{ $page->name }}</title>
    
        <link rel="icon" href="{{ asset('vendor/inti/img/favicon.png') }}">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ asset('vendor/inti/css/bootstrap.min.css') }}">
        <!-- animate CSS -->
        <link rel="stylesheet" href="{{ asset('vendor/inti/css/animate.css') }}">
        <!-- owl carousel CSS -->
        <link rel="stylesheet" href="{{ asset('vendor/inti/css/owl.carousel.min.css') }}">
        <!-- themify CSS -->
        <link rel="stylesheet" href="{{ asset('vendor/inti/css/themify-icons.css') }}">
        <!-- flaticon CSS -->
        <link rel="stylesheet" href="{{ asset('vendor/inti/css/flaticon.css') }}">
        <!-- font awesome CSS -->
        <link rel="stylesheet" href="{{ asset('vendor/inti/css/magnific-popup.css') }}">
        <!-- swiper CSS -->
        <link rel="stylesheet" href="{{ asset('vendor/inti/css/slick.css') }}">
        <!-- style CSS -->
        <link rel="stylesheet" href="{{ asset('vendor/inti/css/style.css') }}">
        
        @yield('css')
        @laravelPWA
        {{--  google analityc  --}}
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ setting('site.google_analytics_tracking_id') }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
    
            gtag('config', '{{ setting('site.google_analytics_tracking_id') }}');
        </script>
    </head>

    <body>

        <!-- header yield->
        @yield('header')
        <!-- header yield->

        <!-- content yield->
        @yield('content')
        <!-- content yield->

        <!-- footer include-->
        @include('inti::layouts.footer')
        <!-- footer include->

        <!-- jquery plugins here-->
        <!-- jquery -->
        <script src="{{ asset('vendor/inti/js/jquery-1.12.1.min.js') }}"></script>
        <!-- popper js -->
        <script src="{{ asset('vendor/inti/js/popper.min.js') }}"></script>
        <!-- bootstrap js -->
        <script src="{{ asset('vendor/inti/js/bootstrap.min.js') }}"></script>
        <!-- easing js -->
        <script src="{{ asset('vendor/inti/js/jquery.magnific-popup.js') }}"></script>
        <!-- swiper js -->
        <script src="{{ asset('vendor/inti/js/swiper.min.js') }}"></script>
        <!-- swiper js -->
        <script src="{{ asset('vendor/inti/js/masonry.pkgd.js') }}"></script>
        <!-- particles js -->
        <script src="{{ asset('vendor/inti/js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('vendor/inti/js/jquery.nice-select.min.js') }}"></script>
        <!-- swiper js -->
        <script src="{{ asset('vendor/inti/js/slick.min.js') }}"></script>
        <script src="{{ asset('vendor/inti/js/jquery.counterup.min.js') }}"></script>
        <script src="{{ asset('vendor/inti/js/waypoints.min.js') }}"></script>
        <!-- custom js -->
        <script src="{{ asset('vendor/inti/js/custom.js') }}"></script>
    </body>
</html>