<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="resources/streaming/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="resources/streaming/css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="resources/streaming/css/style.min.css" rel="stylesheet">
    <style type="text/css">
        @media (min-width: 800px) and (max-width: 850px) {
          .navbar:not(.top-nav-collapse) {
            background: #060606 !important;
          }
        }
    
    </style>
    <link rel="stylesheet" href="{{ asset('vendor/whatsapp/floating-wpp.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/share/css/contact-buttons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/up/css/floating-totop-button.css') }}">
    @laravelPWA
</head>
<body>
<!--Navbar -->
 <nav class="navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar">
    <a class="navbar-brand" href="#"><strong class="h5">STREAMING</strong></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4"
      aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
      {{-- <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">
            <i class="fab fa-facebook-f"></i> Facebook
            <span class="sr-only">(current)</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            <i class="fab fa-instagram"></i> Instagram</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-3" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user"></i> Profile </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink-3">
            <a class="dropdown-item white-text" href="#">My account</a>
            <a class="dropdown-item white-text" href="#">Log out</a>
          </div>
        </li>
      </ul> --}}
      <ul class="navbar-nav ml-auto">
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">
                      Ingresar
                    </a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">
                          Registrarme
                        </a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                      <a class="dropdown-item" href="/home">
                            Perfil
                        </a>

                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                            Salir
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
          </ul>
    </div>
</nav>
<!--/.Navbar -->
    
<!--Carousel Wrapper-->
<div id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel">

    <!--Indicators-->
    <ol class="carousel-indicators">
    <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-1z" data-slide-to="1"></li>
    <li data-target="#carousel-example-1z" data-slide-to="2"></li>
    </ol>
    <!--/.Indicators-->

    <!--Slides-->
    <div class="carousel-inner" role="listbox">

        <!--First slide-->
        <div class="carousel-item active">
        <div class="view" style="background-image: url('{{ voyager::Image($collection['carusel1_image']['value']) }}'); background-repeat: no-repeat; background-size: cover;">

            <!-- Mask & flexbox options-->
            <div class="mask rgba-black-strong d-flex justify-content-center align-items-center">

                <!-- Content -->
                <div class="text-center mx-5 wow fadeIn">
                <h1 style="font-size:10vw;">
                    <strong style="color: #ce0505">{{ $collection['carusel1_title']['value'] }}</strong>
                </h1>

                <p class="h6">
                    <strong>{{ $collection['carusel1_description']['value'] }}</strong>
                </p>

                <p class="mb-4 d-none d-md-block">
                    <strong>Sin Anuncio y ademas descargas.</strong>
                </p>

                <a target="_blank" href="{{ $collection['carusel1_action']['value'] }}" class="btn btn-lg " style="background-color: #ce0505">{{ $collection['carusel1_text_button']['value'] }}
                    <i class="fas fa-graduation-cap ml-2"></i>
                </a>
                </div>
                <!-- Content -->

            </div>
            <!-- Mask & flexbox options-->

            </div>
        </div>
        <!--/First slide-->

        <!--Second slide-->
        <div class="carousel-item">
            <div class="view" style="background-image: url('{{ voyager::Image($collection['carusel2_image']['value']) }}'); background-repeat: no-repeat; background-size: cover;">

            <!-- Mask & flexbox options-->
            <div class="mask rgba-black-strong d-flex justify-content-center align-items-center">

                <!-- Content -->
                <div class="text-center white-text mx-5 wow fadeIn">
                <h1 style="font-size:10vw;">
                    <strong style="color: #81b71a">{{ $collection['carusel2_title']['value'] }}</strong>
                </h1>

                <p>
                    <strong>{{ $collection['carusel2_description']['value'] }}</strong>
                </p>

                <p class="mb-4 d-none d-md-block">
                    <strong>Sin Anuncio y ademas descargas.</strong>
                </p>

                <a target="_blank" href="{{ $collection['carusel2_action']['value'] }}" class="btn  btn-lg" style="background-color:#81b71a" >{{ $collection['carusel2_text_button']['value'] }}
                    <i class="fas fa-graduation-cap ml-2"></i>
                </a>
                </div>
                <!-- Content -->

            </div>
            <!-- Mask & flexbox options-->

            </div>
        </div>
        <!--/Second slide-->

        <!--Third slide-->
        <div class="carousel-item">
            <div class="view" style="background-image: url('{{ voyager::Image($collection['carusel3_image']['value']) }}'); background-repeat: no-repeat; background-size: cover;">

            <!-- Mask & flexbox options-->
            <div class="mask rgba-black-strong d-flex justify-content-center align-items-center">

                <!-- Content -->
                <div class="text-center white-text mx-5 wow fadeIn">
                <h1 style="font-size:10vw;">
                    <strong>{{ $collection['carusel3_title']['value'] }}</strong>
                </h1>

                <p>
                    <strong>{{ $collection['carusel3_description']['value'] }}</strong>
                </p>

                <p class="mb-4 d-none d-md-block">
                    <strong>Sin Anuncio y ademas descargas.</strong>
                </p>

                <a target="_blank" href="{{ $collection['carusel3_action']['value'] }}" class="btn btn-outline-white btn-lg">{{ $collection['carusel3_text_button']['value'] }}
                    <i class="fas fa-graduation-cap ml-2"></i>
                </a>
                </div>
                <!-- Content -->
                

            </div>
            <!-- Mask & flexbox options-->

            </div>
        </div>
        <!--/Third slide-->

    </div>
    <!--/.Slides-->

    <!--Controls-->
    <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
    </a>
    <!--/.Controls-->
</div>
<!--/.Carousel Wrapper-->
<div id="app">
  <main>
      <div class="container">
      @foreach ($blocks as $item) 
    
        @include('streaming::blocks.'.$item->name, ['data' => json_decode($item->details)])
      @endforeach
      </div>
  </main>
</div>
<!--Footer-->
<footer class="page-footer text-center font-small mt-4 wow fadeIn">

    <!--Call to action-->
    <div class="pt-4">
      <a class="btn btn-outline-white" href="https://mdbootstrap.com/docs/jquery/getting-started/download/" target="_blank"
        role="button">Download MDB
        <i class="fas fa-download ml-2"></i>
      </a>
      <a class="btn btn-outline-white" href="https://mdbootstrap.com/education/bootstrap/" target="_blank" role="button">Start
        free tutorial
        <i class="fas fa-graduation-cap ml-2"></i>
      </a>
    </div>
    <!--/.Call to action-->

    <hr class="my-4">

    <!-- Social icons -->
    <div class="pb-4">
      <a href="https://www.facebook.com/mdbootstrap" target="_blank">
        <i class="fab fa-facebook-f mr-3"></i>
      </a>

      <a href="https://twitter.com/MDBootstrap" target="_blank">
        <i class="fab fa-twitter mr-3"></i>
      </a>

      <a href="https://www.youtube.com/watch?v=7MUISDJ5ZZ4" target="_blank">
        <i class="fab fa-youtube mr-3"></i>
      </a>

      <a href="https://plus.google.com/u/0/b/107863090883699620484" target="_blank">
        <i class="fab fa-google-plus-g mr-3"></i>
      </a>

      <a href="https://dribbble.com/mdbootstrap" target="_blank">
        <i class="fab fa-dribbble mr-3"></i>
      </a>

      <a href="https://pinterest.com/mdbootstrap" target="_blank">
        <i class="fab fa-pinterest mr-3"></i>
      </a>

      <a href="https://github.com/mdbootstrap/bootstrap-material-design" target="_blank">
        <i class="fab fa-github mr-3"></i>
      </a>

      <a href="http://codepen.io/mdbootstrap/" target="_blank">
        <i class="fab fa-codepen mr-3"></i>
      </a>
    </div>
    <!-- Social icons -->

    <!--Copyright-->
    <div class="footer-copyright py-3">
      © 2019 Copyright:
      <a href="https://loginweb.dev" target="_blank"> loginweb.dev </a>
    </div>
    <!--/.Copyright-->

</footer>
<div id="myWP"></div>
<!--/.Footer-->
<!-- SCRIPTS -->
<!-- JQuery -->
<script type="text/javascript" src="resources/streaming/js/jquery-3.4.1.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="resources/streaming/js/popper.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="resources/streaming/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="resources/streaming/js/mdb.min.js"></script>
<!-- Initializations -->
<script src="{{ asset('vendor/whatsapp/floating-wpp.js') }}"></script>
<script src="{{ asset('vendor/share/js/jquery.contact-buttons.js') }}"></script>
<script src="{{ asset('vendor/up/js/floating-totop-button.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script type="text/javascript">
// Animations initialization
new WOW().init();
// whatsapp ------------------------------------
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
      });

    Echo.channel('home').listen('NewMessage', (e) => {
      Swal.fire({
        title: 'CmsWeb v3.0',
        text: "Plantilla "+e.message+" Instalada.",
        icon: 'success',
        //showCancelButton: true,
        confirmButtonColor: '#3085d6',
        //cancelButtonColor: '#d33',
        confirmButtonText: 'Recargar'
      }).then((result) => {
        if (result.value) {
          location.reload();
        }
      })
    });
</script>
</body>
</html>