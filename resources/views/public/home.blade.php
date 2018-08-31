<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="@yield('description')">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Accueil | {!! env('APP_NAME') !!}</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway|Roboto" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    {!! Html::style('bootstrap-4.1.1/dist/css/bootstrap.min.css') !!}
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>
        .jumbotron {
            text-align: center !important;
            width: 100% !important;
            height: 500px;
            background-image: url("/images/photo.png");
            background-color: rgba(21, 20, 33, .5);
            background-repeat: no-repeat;
            background-size: contain;
            background-size: 100% 100%;
        }

        .footer {
            border-top: solid 1px #bfbfbf;
        }
    </style>
    <link href="{{ asset('css/ie10-viewport-bug-workaround.css') }}" rel="stylesheet">
    <!--[if IE]>
    <script src="https://cdn.jsdelivr.net/g/html5shiv@3.7.3"></script>
    <![endif]-->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
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
                            <a class="p-2 text-dark" href="{{route('register')}}">Inscrption</a>
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
                        AU<span>PIAIRE</span>
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
                    <a class="nav-link font-weight-bold" href="#agence">Mes enfants</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link font-weight-bold" href="#agence">les fournitures</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link font-weight-bold text-18" href="#service">Nous contacter</a>
                </li>
            </ul>
        </div>
    </nav>
</header>

<div class="content-overlay">
    <div class="jumbotron text-center">
        <h1 class="text-info font-weight-bold mt-5 pt-5">
            <i class="fa fa-graduation-cap"></i>
            AfrikaSchool
        </h1>
        <p class="lead mx-auto">AfrikaSchool est un logiciel de gestion d'école sur internet & intranet </p>
        <p><a class="btn btn-lg btn-outline-info" href="{{route('login')}}" role="button"> Se connecter </a></p>
    </div>
</div>

<main class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card align-items-center" style="background: #ff4500; top: -80px;">
                <div class="card-header">
                    <img class="card-img-top" src="{{asset('images/slide-bottom-01.png')}}" alt="Card image cap">
                </div>
                <div class="card-body">
                    <h4>Professeurs certifiés</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card align-items-center" style="background: #007fac; top: -80px;">
                <div class="card-header">
                    <img class="card-img-top" src="{{asset('images/slide-bottom-02.png')}}" alt="Card image cap">
                </div>
                <div class="card-body">
                    <h4>Information en ligne</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card align-items-center" style="background: #ffa63d; top: -80px;">
                <div class="card-header">
                    <img class="card-img-top" src="{{asset('images/slide-bottom-03.png')}}" alt="Card image cap">
                </div>
                <div class="card-body bg-orange">
                    <h4>Information en ligne</h4>
                </div>
            </div>
        </div>
    </div>
</main>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1>Bienvenu à AUPIAIRE</h1>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium ex excepturi illo ipsum nisi.
                Cumque harum ipsa libero temporibus ullam. Beatae consequatur corporis cupiditate dicta dolor eos est
                necessitatibus nesciunt!
            </p>
        </div>
        <div class="col-md-6">
            <img src="{{asset("images/photo3.jpg")}}" class="img-fluid" alt="">
        </div>
    </div>
</div>

<footer class="footer pt-2 pb-1">
    <div class="container">
        <p class="wrap"><i class="fa fa-graduation-cap"></i> Afrikaschool | © Copyright 2018</p>
    </div>
</footer>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
{!! Html::script('js/jquery-3.2.1.min.js') !!}
{!! Html::script('js/popper.min.js') !!}
{!! Html::script('bootstrap-4.1.1/dist/js/bootstrap.min.js') !!}
@yield('custom-js')

</body>

</html>
