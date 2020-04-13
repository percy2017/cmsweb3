<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="resources/landingpage/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="resources/landingpage/css/mdb.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('vendor/whatsapp/floating-wpp.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/share/css/contact-buttons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/up/css/floating-totop-button.css') }}">

  @laravelPWA
 {{--  <script>
    window.fbAsyncInit = function() {
      FB.init({
        appId      : '{{ setting('api.facebook.appId') }}',
        cookie     : true,
        xfbml      : true,
        version    : '{{ setting('api.facebook.version') }}'
      });
        
      FB.AppEvents.logPageView();   
        
    };
  
    (function(d, s, id){
       var js, fjs = d.getElementsByTagName(s)[0];
       if (d.getElementById(id)) {return;}
       js = d.createElement(s); js.id = id;
       js.src = "https://connect.facebook.net/en_US/sdk.js";
       fjs.parentNode.insertBefore(js, fjs);
     }(document, 'script', 'facebook-jssdk'));
  </script> --}}
</head>
<body>
    <div id="app">
        {{--  <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>  --}}

        {{--  <main class="py-4">  --}}
            @yield('content')
        {{--  </main>  --}}
    </div>


  <div id="myWP"></div>
  
  <!-- SCRIPTS -->
    @if(auth()->user())
        <script>
            window.user = {
                id: {{ auth()->id() }},
                name: "{{ auth()->user()->name }}"
            };
            window.csrfToken = "{{ csrf_token() }}";
        </script>
    @endif
  <!-- JQuery -->
  <script type="text/javascript" src="resources/landingpage/js/jquery-3.4.1.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="resources/landingpage/js/popper.min.js"></script>

  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="resources/landingpage/js/bootstrap.min.js"></script>

  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="resources/landingpage/js/mdb.min.js"></script>


  {{--  <script src="{{ asset('vendor/whatsapp/floating-wpp.js') }}"></script>
  <script src="{{ asset('vendor/share/js/jquery.contact-buttons.js') }}"></script>
  <script src="{{ asset('vendor/up/js/floating-totop-button.js') }}"></script>  --}}


  <script>


    // whatsapp ------------------------------------
    /*
      $('#myWP').floatingWhatsApp({
        phone: '{{ setting('whatsapp.phone') }}',
        popupMessage: '{{ setting('whatsapp.popupMessage') }}',
        message: '{{ setting('whatsapp.message') }}',
        showPopup: true,
        showOnIE: true,
        headerTitle: '{{ setting('whatsapp.headerTitle') }}',
        headerColor: '{{ setting('whatsapp.color') }}',
        backgroundColor: '{{ setting('whatsapp.color') }}',
        buttonImage: '<img src="{{ Voyager::Image(setting('whatsapp.buttonImage' )) }}" />',
        position: '{{ setting('whatsapp.position') }}',
        autoOpenTimeout: {{ setting('whatsapp.autoOpenTimeout') }},
        size: '{{ setting('whatsapp.size') }}'
      });

      // Initialize Share-Buttons
      $.contactButtons({
        effect  : 'slide-on-scroll',
        buttons : {
          'facebook':   { class: 'facebook', use: true, link: 'https://www.facebook.com/sharer/sharer.php?u='+window.location, extras: 'target="_blank"' },
          'twitter':   { class: 'twitter', use: true, link: 'https://twitter.com/home?status='+window.location, extras: 'target="_blank"' },
          'whatsapp':   { class: 'whatsapp', use: true, link: 'https://api.whatsapp.com/send?text='+window.location, extras: 'target="_blank"' }
        }
      });

      // buttun up
      $("body").toTopButton({
        // path to icons
        imagePath: 'vendor/up/img/icons/',
        // arrow, arrow-circle, caret, caret-circle, circle, circle-o, arrow-l, drop, rise, top
        // or your own SVG icon
        arrowType: 'arrow',

        // 'w' = white
        // 'b' = black
        iconColor: 'w',
        
        // icon shadow
        // from 1 to 16
        iconShadow: 6
      });*/

  </script>
</body>
</html>
