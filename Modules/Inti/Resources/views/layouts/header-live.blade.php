 <!--::header part start::-->
 <header class="main_menu single_page_menu">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand logo_1" href="/"> <img src="{{ asset('vendor/inti/img/single_page_logo.png') }}" alt="logo"> </a>
                    <a class="navbar-brand logo_2" href="/"> <img src="{{ asset('vendor/inti/img/logo.png') }}" alt="logo"> </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse main-menu-item justify-content-end"
                    id="navbarSupportedContent">
                    <ul class="navbar-nav align-items-center">
                        {{ menu('LandingPageInti', 'inti::vendor.MenuNavbar') }}
                        @guest    
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Login Inti
                            </a>
                           
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                 <a class="dropdown-item" href="{{ route('login') }}">Iniciar Sesión</a>
                            @if (Route::has('register'))
                                <a class="dropdown-item" href="{{ route('register') }}">Registrarme</a>
                            @endif    
                            </div>
                        </li>
                        @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                               
                                <a class="dropdown-item" href="/home">Ver Perfil</a>

                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                    Salir
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                        <li class="d-none d-lg-block">
                            <a class="btn_1" href="#">Obtener Cotizacion</a>
                        </li>

                    </ul>
                </div>
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- Header part end-->