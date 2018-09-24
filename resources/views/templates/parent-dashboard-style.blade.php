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
        {!! Html::style('css/style.css') !!}
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
        @include('partials.header')

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 mt-5 pt-5">
                    <div class="pricing-header pt-md-5 pb-md-4 mx-auto text-center">
                        <h1 class="display-4" style="color: #19c880;">
                            @yield('main-title')
                        </h1>
                        <p class="lead">@yield('main-descriptive-text')</p>
                    </div>
                    @yield('content')
                </div>
            </div>
        </div>
        <br><br><br>
        <footer class="footer pt-2 pb-1 mt-5">
            <div class="container">
                <p class="wrap"><i class="fa fa-graduation-cap"></i> Afrikaschool | © Copyright 2018</p>
            </div>
        </footer>

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script type="text/javascript" language="javascript"
                src="https://code.jquery.com/jquery-3.3.1.js"></script>
        @yield('custom-js')
        {!! Html::script('bootstrap-4.1.1/dist/js/bootstrap.min.js') !!}
        {!! Html::script('js/popper.min.js') !!}
        @include('flashy::message')

    </body>

</html>
