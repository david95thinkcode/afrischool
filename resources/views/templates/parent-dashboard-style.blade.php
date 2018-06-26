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
    </head>

    <body>

        <header class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
            <h5 class="my-0 mr-md-auto font-weight-normal">{!! env('APP_NAME') !!}</h5>
            <nav class="my-2 my-md-0 mr-md-3">
                <a class="p-2 text-dark" href="#">Mes enfants</a>
            </nav>
            <a class="btn btn-outline-primary" href="#">Connexion</a>
        </header>

        <div class="container-fluid">
            <div class="row">                
                <div class="col-sm-12">
                    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
                        <h1 class="display-4">@yield('main-title')</h1>
                        <p class="lead">@yield('main-descriptive-text')</p>
                    </div>
                    @yield('content')
                </div>                
            </div>        
        </div>
        
        {{-- @include('partials.footer') --}}
        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        {!! Html::script('js/jquery-3.2.1.min.js') !!}
        {!! Html::script('js/popper.min.js') !!}
        {!! Html::script('bootstrap-4.1.1/dist/js/bootstrap.min.js') !!}
        @yield('custom-js')

    </body>

</html>
