<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="@yield('description')">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title') | {!! env('APP_NAME') !!}</title>
        <link href="https://fonts.googleapis.com/css?family=Raleway|Roboto" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        {!! Html::style('bootstrap-4.1.1/dist/css/bootstrap.min.css') !!}
        {!! Html::style('css/parent-dashboard.css') !!}
        @yield('custom-css')
        {!! Html::style('css/parent-dashboard.css') !!}
        <style>
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

        <header class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
            <h5 class="my-0 mr-md-auto font-weight-normal">Les Champions De Demain</h5>
            @if (Auth::guest())
                <nav class="my-2 my-md-0 mr-md-3">
                    <a class="p-2 text-dark" href="{{route('register')}}">Inscrption</a>
                </nav>
                <a class="btn btn-outline-info" href="{{route('login')}}">Connexion</a>
            @else
                <nav class="my-2 my-md-0 mr-md-3">
                    <a class="p-2 text-dark" href="{{route('consultation.choix')}}">Mes enfants</a>
                </nav>
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

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
                        <h1 class="display-4 main-title">@yield('main-title')</h1>
                        <p class="lead">@yield('main-descriptive-text')</p>
                    </div>
                    @yield('content')
                </div>                
            </div>        
        </div>
        <br><br><br>
        <footer class="container-fluid mt-4">
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
