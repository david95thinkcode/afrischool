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
            background-image: url("/images/photo.jpg");
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
@include('partials.header')

<div class="content-overlay">
    <div class="jumbotron text-center">
        <h1 class="text-info font-weight-bold mt-5 pt-5">
            <i class="fa fa-graduation-cap"></i>
            AfrikaSchool
        </h1>
        <p class="text-white mx-auto font-weight-bold">AfrikaSchool est un logiciel de gestion d'école sur internet & intranet </p>
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
            <h1>Bienvenu à Les Champions De Demain</h1>
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
