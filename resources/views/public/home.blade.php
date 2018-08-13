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
    {!! Html::style('css/parent-dashboard.css') !!}
    <style>
        .jumbotron {
            text-align: center !important;
            background-color: transparent !important;
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

<header class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 bg-white border-bottom box-shadow">
    <h5 class="my-0 mr-md-auto text-info font-weight-normal">Les Champions De Demain</h5>

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
</header>


<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img style="height: 500px; width: 100%;" src="{{asset('images/photo1.jpg')}}" alt="First slide">
            <div class="carousel-caption d-none d-md-block">
                <h1 class="text-info font-weight-bold">
                    <i class="fa fa-graduation-cap"></i>
                    Les Champions De Demain
                </h1>
                <p class="lead mx-auto text-info font-weight-bold">AfrikaSchool est un logiciel de gestion d'école sur internet & intranet </p>
                <p><a class="btn btn-lg btn-outline-info" href="{{route('login')}}" role="button"> Se connecter </a></p>
            </div>
        </div>
        <div class="carousel-item">
            <img style="height: 500px; width: 100%;" src="{{asset('images/photo2.jpg')}}" alt="Second slide">
            <div class="carousel-caption d-none d-md-block">
                <h1 class="text-info font-weight-bold">
                    <i class="fa fa-graduation-cap"></i>
                    {!! env('APP_NAME') !!}
                </h1>
                <p class="lead mx-auto text-info font-weight-bold">AfrikaSchool est un logiciel de gestion d'école sur internet & intranet </p>
                <p><a class="btn btn-lg btn-outline-info" href="{{route('login')}}" role="button"> Se connecter </a></p>
            </div>
        </div>
        <div class="carousel-item">
            <img style="height: 500px; width: 100%;" src="{{asset('images/photo3.jpg')}}" alt="Third slide">
            <div class="carousel-caption d-none d-md-block">
                <h1 class="text-info font-weight-bold">
                    <i class="fa fa-graduation-cap"></i>
                    {!! env('APP_NAME') !!}
                </h1>
                <p class="lead mx-auto text-info font-weight-bold">AfrikaSchool est un logiciel de gestion d'école sur internet & intranet </p>
                <p><a class="btn btn-lg btn-outline-info" href="{{route('login')}}" role="button"> Se connecter </a></p>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<main class="container-fluid">
    <div class="row mt-2 pt-5">
        <div class="col-md-4">
            <div class="col-md-12 text-center">
                <i class="fa fa-laptop fa-4x text-info"></i>
            </div>
            <h3 class="col-md-12 text-center">Une application complètement en ligne</h3>
            <p>
                AfrikaSchool est une application web se composant d'un site web disponibe à tous les
                internautes, véritable vitrine pour votre école et un site à accès restreint pour les parents les
                enseignants et le personnel de l'école, disponible 24h/24 et 7j/7. Un véritable environnement de partage
                et d'échange autour de la vie scolaire
            </p>
        </div>
        <div class="col-md-4">
            <div class="col-md-12 text-center">
                <i class="fa fa-grav fa-4x text-info"></i>
            </div>
            <h3 class="text-center">Un autre regard sur l'établissement</h3>
            <p class="col-md-12">
                Avec AfrikaSchool chacun est conduit à porter un autre regard sur l'établissement. En premier lieu les
                personnels, administratifs ou enseignants, qui, grâce à de nombreux tableaux de bord
                disposent en un clic d'informations crucials. Les parents peuvent prendre
                chaque jour, la mesure de tout le travail accompli par l'ensemble des personnels, enseignants ou
                personnels de surveillance. A travers le carnet de liaison électronique, ils restent au plus près du
                suivi de leur enfant
            </p>
        </div>
        <div class="col-md-4">
            <div class="col-md-12 text-center">
                <i class="fa fa-pie-chart fa-4x text-info"></i>
            </div>
            <h3 class="col-md-12 text-center">Une solution économique et rentable</h3>
            <p>
                En permettant l'acquisition d'un site web vitrine et d'une application en ligne de suivie de la
                scolarité, en offrant des interfaces qui ne nécessitent pratiquement aucune formation, en rendant
                possible l'intercation avec les parents par le biais de AfrikaSchool, en produisant une même solution
                pour
                tout type d'établissement, AfrikaSchool réduit considérablement le coût par an et par élève de la
                gestion de
                leur suivi.
            </p>
        </div>
    </div>
</main>
<br><br><br>
<footer class="container-fluid">
    <div class="row pt-5">
        <div class="col-md-6">
            <p class="pull-left">
                <i class="fa fa-graduation-cap"></i>
                Les Champions De Demain | © Copyright 2018
            </p>
        </div>
        <div class="col-md-6">
            <p class="pull-right text-info">By AfrikaSchool</p>
        </div>
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
