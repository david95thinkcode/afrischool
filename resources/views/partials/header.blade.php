<header class="site-header">
    <div class="top-header-bar">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-6 d-none d-md-flex flex-wrap justify-content-center justify-content-lg-start mb-3 mb-lg-0">
                    <div class="header-bar-email d-flex align-items-center">
                        <i class="fa fa-envelope"></i><a href="#">tuanna.design@gmail.com</a>
                    </div><!-- .header-bar-email -->

                    <div class="header-bar-text lg-flex align-items-center">
                        <p><i class="fa fa-phone"></i>001-1234-88888 </p>
                    </div><!-- .header-bar-text -->
                </div><!-- .col -->

                <div class="col-12 col-lg-6 d-flex flex-wrap justify-content-center justify-content-lg-end align-items-center">
                    @if (Auth::guest())
                        <nav class="my-2 my-md-0 mr-md-3">
                            <a class="p-2 text-dark" href="{{route('register')}}">Inscription</a>
                        </nav>
                        <a class="btn btn-outline-info" href="{{route('login')}}">Connexion</a>
                    @else
                        <a href="{{ route('logout') }}" class="btn btn-outline-info"
                           onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out"></i>
                            Se deconnecter
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    @endif
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container-fluid -->
    </div><!-- .top-header-bar -->

    <nav class="navbar navbar-light navbar-expand-sm border-bottom bg-transparent">
        <div class="navbar-brand">
            <div class="site-branding">
                <h1 class="site-title">
                    <a href="{{route('home')}}" rel="home">
                        Complexe Scolaire<span> Le Faucon</span>
                    </a>
                </h1>
            </div>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span style="font-size:20px;cursor:pointer;color:#d67118 !important;">&#9776; Menu</span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item px-2">
                    <a class="nav-link font-weight-bold" href="{{route('consultation.choix')}}">Mes enfants</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link font-weight-bold" href="{{route('fourniture.index')}}">Les fournitures</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link font-weight-bold text-18" href="{{route('contact.index')}}">Nous contacter</a>
                </li>
            </ul>
        </div>
    </nav>
</header>