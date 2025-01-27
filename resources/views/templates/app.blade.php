<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimal-ui" />
    <title>@yield('title') | Afrischool</title>
    <link rel="icon" href="#">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @hassection('robot')
        @yield('robot')
    @else
        <meta name="robots" content="nofollow, noindex" />
    @endif
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="{{mix('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/jquery.mCustomScrollbar.min.css')}}" rel="stylesheet"> 
    <link href="{{asset('css/custom.min.css')}}" rel="stylesheet">
    @yield('custom-css')
    <link href="{{asset('css/ie10-viewport-bug-workaround.css')}}" rel="stylesheet"> 
    <!--[if IE]>
        <link href="{{asset('css/bootstrap-ie9.css')}}" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/g/html5shiv@3.7.3"></script>   
    <![endif]-->
    <!--[if lt IE 9]>
        <link href="{{asset('css/bootstrap-ie8.css')}}" rel="stylesheet">
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .table-del-btn {
            display: inline;
        }
        span.required{
            color: red;
            font-size: 16px;
        }
        .badge-success {
            background-color: #29c88a !important;
        }
    </style>
</head>

<body class="nav-md">
    <div class="container body" id="app">
        <div class="main_container">
            @include('partials._sidemenu')

            <!-- top navigation -->
            @include('partials._topnav')
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="row">
                        <h3 class="text-center">@yield('section-title')</h3>
                        <hr>
                    </div>

                    <div class="row">
                        <div class="col-sm-offset-3 col-sm-6">
                            @include('partials.session-messages')
                        </div>
                    </div>

                    <div class="row" id='vue-app'>
                        @yield('content')
                    </div>

                </div>
            </div>
            <!-- /page content -->

            <!-- footer content -->
            @include('partials.footer')
            <!-- /footer content -->
        </div>
    </div>
    
    <!-- Scripts -->
    <script src="{{mix('js/app.js')}}"></script>
    <script src="{{asset('js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <script src="{{asset('js/custom.min.js')}}"></script>
    @yield('custom-js')
    @include('flashy::message')
    <script src="{{asset('js/ie10-viewport-bug-workaround.js')}}"></script>
</body>

</html>