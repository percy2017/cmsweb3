<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
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

  <title>{{ setting('site.title') }}</title>

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <link href="resources/landingpage/css/bootstrap.min.css" rel="stylesheet">
  <link href="resources/landingpage/css/mdb.min.css" rel="stylesheet">

  <style type="text/css">
    html,
    body,
    header,
    .view.jarallax {
      height: 100%;
      min-height: 100%;
    }
  </style>

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

<body class="restaurant-lp">

  <!--Navigation & Intro-->
  <header>

    <!--Navbar-->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar">
      <div class="container">
        <a class="navbar-brand" href="#">
          <strong>{{ setting('site.title') }}</strong>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!--Links-->
          <ul class="navbar-nav mr-auto smooth-scroll">
            {{--  <li class="nav-item">
              <a class="nav-link" href="#home">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#about" data-offset="100">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#intro" data-offset="100">Intro</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#specials" data-offset="100">Specials</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#menu" data-offset="100">Menu</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#testimonials" data-offset="100">Opinions</a>
            </li>  --}}
            {{ menu('LandingPage', 'vendor.menus.LandingPage') }}
          </ul>

          <!--Social Icons-->
          <ul class="navbar-nav nav-flex-icons">
            {{--  <li class="nav-item">
              <a class="nav-link">
                <i class="fab fa-facebook-f light-green-text"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link">
                <i class="fab fa-twitter light-green-text"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link">
                <i class="fab fa-instagram light-green-text"></i>
              </a>
            </li>  --}}
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">
                      {{-- {{ __('Login') }} --}}
                      Ingresar
                    </a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">
                          {{-- {{ __('Register') }} --}}
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
    <!--/Navbar-->

    <!-- Intro Section -->
    <div id="home" class="view jarallax" data-jarallax='{"speed": 0.2}' style="background-image: url({{ voyager::Image($collection['image_header']['value']) }}); background-repeat: no-repeat; background-size: cover; background-position: center center;">
      <div class="mask rgba-black-slight">
        <div class="container h-100 d-flex justify-content-center align-items-center">
          <div class="row smooth-scroll">
            <div class="col-md-12 dark-grey-text text-center">
              <div class="wow fadeInDown" data-wow-delay="0.2s">
                <h2 class="display-3 font-weight-bold mb-2 mt-5 mt-xl-2">{{ $collection['title_header']['value'] }}</h2>
                <hr class="hr-dark">
                <h4 class="subtext-header mt-2 mb-3">{{ $collection['description_header']['value'] }}</h4>
                {{-- <h4 class="mb-5 clearfix d-none d-md-inline-block"> Deleniti consequuntur, nihil voluptatem modi nobis veniam.</h4> --}}
              </div>
              <a class="btn btn-deep-orange btn-rounded wow fadeInUp" data-wow-delay="0.2s">
                <i class="far fa-calendar-alt mr-2"></i>
                <span> {{ $collection['text_button']['value'] }}</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

  </header>
  <!--/Navigation & Intro-->

  <!--Main content-->
  <div id="app">
    <main>
      @foreach ($blocks as $item) 
        @include('restaurant::blocks.'.$item->name, ['data' => json_decode($item->details)])
      @endforeach
    </main>
  </div>
  <!--/Main content-->

  <!--Footer-->
  <footer class="page-footer text-center text-md-left pt-4">

    <!--Footer Links-->
    <div class="container mb-4">

      <!--First row-->
      <div class="row">

        <!--First column-->
        <div class="col-lg-4 pt-1 pb-3 wow fadeIn" data-wow-delay="0.3s">
          <!--About-->
          <h5 class="title mb-4">
            <strong>ABOUT RESTAURANT</strong>
          </h5>

          <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti
            atque corrupti.</p>

          <p class="mb-1-half"> Blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas
            molestias excepturi sint.</p>
          <!--/About -->

          <div class="footer-socials">

            <!--Facebook-->
            <a type="button" class="btn-floating green">
              <i class="fab fa-facebook-f"></i>
            </a>
            <!--Dribbble-->
            <a type="button" class="btn-floating green">
              <i class="fab fa-dribbble"></i>
            </a>
            <!--Twitter-->
            <a type="button" class="btn-floating green">
              <i class="fab fa-twitter"></i>
            </a>
            <!--Google +-->
            <a type="button" class="btn-floating green">
              <i class="fab fa-google-plus-g"></i>
            </a>
            <!--Linkedin-->

          </div>
        </div>
        <!--/First column-->

        <hr class="w-100 clearfix d-md-none">

        <!--Second column-->
        <div class="col-lg-4 pt-1 pb-1 col-md-6 wow fadeIn" data-wow-delay="0.3s">
          <!--Search-->
          <h5 class="text-uppercase mb-4">
            <strong>Search something</strong>
          </h5>

          <ul class="footer-search list-unstyled">
            <li>
              <form class="search-form" role="search">
                <div class="md-form">
                  <input type="text" class="form-control text-white" placeholder="Search">
                </div>
              </form>
            </li>
          </ul>

          <!--Info-->
          <p>
            <i class="fas fa-home mr-3"></i> New York, NY 10012, US</p>
          <p>
            <i class="fas fa-envelope mr-3"></i> info@example.com</p>
          <p>
            <i class="fas fa-phone mr-3"></i> + 01 234 567 88</p>
          <p>
            <i class="fas fa-print mr-3"></i> + 01 234 567 89</p>

        </div>
        <!--/Second column-->

        <hr class="w-100 clearfix d-md-none">

        <!--First column-->
        <div class="col-lg-4 pt-1 pb-1 col-md-6 wow fadeIn text-center" data-wow-delay="0.3s">

          <!--Title-->
          <h5 class="title mb-4 text-uppercase">
            <strong>Opening hours</strong>
          </h5>

          <!--Opening hours table-->
          <table class="table text-white">
            <tbody>
              <tr>
                <td>Mon - Thu:</td>
                <td>8am - 9pm</td>
              </tr>
              <tr>
                <td>Fri - Sat:</td>
                <td>8am - 1am</td>
              </tr>
              <tr>
                <td>Sunday:</td>
                <td>9am - 10pm</td>
              </tr>
            </tbody>
          </table>

        </div>
        <!--/First column-->

      </div>
      <!--/First row-->

    </div>
    <!--/Footer Links-->

    <!--Copyright-->
    <div class="footer-copyright py-3 text-center" data-wow-delay="0.3s">
      <div class="container-fluid">
        © 2019 Copyright: <a href="https://mdbootstrap.com/education/bootstrap/" target="_blank"> MDBootstrap.com </a>
      </div>
    </div>
    <!--/Copyright-->

  </footer>
  <!--/Footer-->


  <!-- SCRIPTS -->

  <!-- JQuery -->
  <script type="text/javascript" src="resources/landingpage/js/jquery-3.4.1.min.js"></script>

  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="resources/landingpage/js/popper.min.js"></script>

  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="resources/landingpage/js/bootstrap.min.js"></script>

  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="resources/landingpage/js/mdb.min.js"></script>

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

    // MDB Lightbox Init
    $(function () {
      $("#mdb-lightbox-ui").load("../mdb-addons/mdb-lightbox-ui.html");
    });

  </script>

</body>

</html>
