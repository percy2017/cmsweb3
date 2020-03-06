<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name') }}</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="resources/landingpage/css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="resources/landingpage/css/mdb.min.css" rel="stylesheet">
  <style type="text/css">
    html,
    body,
    header,
    .intro-2 {
      height: 100%;
    }

    @media (max-width: 740px) {

      html,
      body,
      header,
      .intro-2 {
        height: 900px;
      }
    }

    @media (min-width: 800px) and (max-width: 850px) {

      html,
      body,
      header,
      .intro-2 {
        height: 980px;
      }
    }

  </style>

  <link rel="stylesheet" href="{{ asset('vendor/whatsapp/floating-wpp.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/share/css/contact-buttons.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/up/css/floating-totop-button.css') }}">

  @laravelPWA
</head>

<body class="software-lp">

  <!--Main Navigation-->
  <header>

    <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top scrolling-navbar">
      <div class="container">
        <a class="navbar-brand" href="#"><strong>{{ setting('site.title') }}</strong></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-7"
          aria-controls="navbarSupportedContent-7" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent-7">
          <ul class="navbar-nav mr-auto">
            {{ menu('LandingPage', 'vendor.menus.LandingPage') }}
          </ul>
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
      </div>
    </nav>

    <!--Intro Section-->
    <section class="view intro-2 rgba-gradient">
      <div class="mask">
        <div class="container h-100 d-flex justify-content-center align-items-center">
          <div class="row flex-center pt-5 mt-3">
            <div class="col-md-12 col-lg-6 text-center text-md-left margins">
              <div class="white-text">
                <h1 class="h1-responsive font-weight-bold wow fadeInLeft" data-wow-delay="0.3s">{{ $collection['title']['value'] }}</h1>
                <hr class="hr-light wow fadeInLeft" data-wow-delay="0.3s">
                <h6 class="wow fadeInLeft" data-wow-delay="0.3s">{{ $collection['description']['value'] }}</h6>
                <br>
                <a href="{{ $collection['button_link1']['value'] }}" class="btn btn-white btn-rounded blue-text font-weight-bold ml-lg-0 wow fadeInLeft"
                  data-wow-delay="0.3s">{{ $collection['button_text1']['value'] }}</a>
                <a href="{{ $collection['button_link2']['value'] }}" class="btn btn-outline-white btn-rounded font-weight-bold wow fadeInLeft" data-wow-delay="0.3s">{{ $collection['button_text2']['value'] }}</a>
              </div>
            </div>

            <div class="col-md-12 col-lg-6  wow fadeInRight" data-wow-delay="0.3s">
              <img src="{{ voyager::Image($collection['image1']['value']) }}" alt="" class="img-fluid">
            </div>
          </div>
        </div>
      </div>
    </section>

  </header>
  <!--Main Navigation-->

  <main>
    @foreach ($blocks as $item) 
      @include('vendor.blocks.'.$item->name, ['data' => json_decode($item->details)])
    @endforeach
  </main>

  <!--Footer-->
  <footer class="page-footer text-center text-md-left blue-grey lighten-5 pt-0">

    <div style="background-color: #5991fb;">
      <div class="container">
        <!--Grid row-->
        <div class="row py-4 d-flex align-items-center">

          <!--Grid column-->
          <div class="col-12 col-md-5 text-left mb-md-0">
            <h6 class="mb-0 white-text text-center text-md-left"><strong>{{ setting('site.description') }}</strong></h6>
          </div>
          <!--Grid column-->

          <!--Grid column-->
          <div class="col-12 col-md-7 text-center text-md-right">
            <!--Facebook-->
            {{-- <a class="p-2 m-2 fa-lg fb-ic ml-0"><i class="fab fa-facebook-f white-text mr-lg-4"> </i></a> --}}
            <!--Twitter-->
            {{-- <a class="p-2 m-2 fa-lg tw-ic"><i class="fab fa-twitter white-text mr-lg-4"> </i></a> --}}
            <!--Google +-->
            {{-- <a class="p-2 m-2 fa-lg gplus-ic"><i class="fab fa-google-plus-g white-text mr-lg-4"> </i></a> --}}
            <!--Linkedin-->
            {{-- <a class="p-2 m-2 fa-lg li-ic"><i class="fab fa-linkedin-in white-text mr-lg-4"> </i></a> --}}
            <!--Instagram-->
            {{-- <a class="p-2 m-2 fa-lg ins-ic"><i class="fab fa-instagram white-text mr-lg-4"> </i></a> --}}
            {{ menu('social', 'vendor.menus.social') }}
          </div>
          
          <!--Grid column-->

        </div>
        <!--Grid row-->
      </div>
    </div>

    <!--Footer Links-->
    <div class="container mt-5 mb-4 text-center text-md-left">
      <div class="row mt-3">

        <!--First column-->
        <div class="col-md-3 col-lg-4 col-xl-3 mb-4 dark-grey-text">
          <h6 class="text-uppercase font-weight-bold"><strong>Company name</strong></h6>
          <hr class="blue mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
          <p>Here you can use rows and columns here to organize your footer content. Lorem ipsum dolor sit amet,
            consectetur
            adipisicing elit.</p>
        </div>
        <!--/.First column-->

        <!--Second column-->
        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4 dark-grey-text">
          <h6 class="text-uppercase font-weight-bold"><strong>Products</strong></h6>
          <hr class="blue mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
          <p><a href="#!" class="dark-grey-text">MDBootstrap</a></p>
          <p><a href="#!" class="dark-grey-text">MDWordPress</a></p>
          <p><a href="#!" class="dark-grey-text">BrandFlow</a></p>
          <p><a href="#!" class="dark-grey-text">Bootstrap Angular</a></p>
        </div>
        <!--/.Second column-->

        <!--Third column-->
        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4 dark-grey-text">
          <h6 class="text-uppercase font-weight-bold"><strong>Useful links</strong></h6>
          <hr class="blue mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
          <p><a href="#!" class="dark-grey-text">Your Account</a></p>
          <p><a href="#!" class="dark-grey-text">Become an Affiliate</a></p>
          <p><a href="#!" class="dark-grey-text">Shipping Rates</a></p>
          <p><a href="#!" class="dark-grey-text">Help</a></p>
        </div>
        <!--/.Third column-->

        <!--Fourth column-->
        <div class="col-md-4 col-lg-3 col-xl-3 dark-grey-text">
          <h6 class="text-uppercase font-weight-bold"><strong>Contact</strong></h6>
          <hr class="blue mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
          <p><i class="fas fa-home mr-3"></i> New York, NY 10012, US</p>
          <p><i class="fas fa-envelope mr-3"></i> info@example.com</p>
          <p><i class="fas fa-phone mr-3"></i> + 01 234 567 88</p>
          <p><i class="fas fa-print mr-3"></i> + 01 234 567 89</p>
        </div>
        <!--/.Fourth column-->

      </div>
    </div>
    <!--/.Footer Links-->

    <!-- Copyright-->
    <div class="footer-copyright py-3 text-center">
      <div class="container-fluid">
        © 2020 Copyright: <a href="#" target="_blank"> {{ setting('site.title') }} </a>
      </div>
    </div>
    <!--/.Copyright -->

  </footer>
  <!--/.Footer-->

  <div id="myWP"></div>
  
  <!-- SCRIPTS -->

  <!-- JQuery -->
   
  <script type="text/javascript" src="{{ asset('resources/landingpage/js/jquery-3.4.1.min.js') }}"></script>

  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="{{ asset('resources/landingpage/js/popper.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="{{ asset('resources/landingpage/js/bootstrap.min.js') }}"></script>

  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="{{ asset('resources/landingpage/js/mdb.min.js') }}"></script>


  <script src="{{ asset('vendor/whatsapp/floating-wpp.js') }}"></script>
  <script src="{{ asset('vendor/share/js/jquery.contact-buttons.js') }}"></script>
  <script src="{{ asset('vendor/up/js/floating-totop-button.js') }}"></script>
  

  <script>
    //Animation init
    new WOW().init();

    //Modal
    $('#myModal').on('shown.bs.modal', function () {
      $('#myInput').focus()
    })

    // Material Select Initialization
    $(document).ready(function () {
      $('.mdb-select').material_select();
    });



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

  </script>

  <script>
      Echo.channel('home').listen('NewMessage', (e) => {
          alert(e.message);
          console.log(e.message);
      });
  </script>

</body>

</html>
