<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="@yield('description')">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | Afrischool</title>
    <link rel="icon" href="#">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" 
    rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 
    integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    @yield('custom-css')
    <link href="{{ asset('css/ie10-viewport-bug-workaround.css') }}" rel="stylesheet"> 
    <!--[if IE]>
        <link href="{{asset('css/bootstrap-ie9.css')}}" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/g/html5shiv@3.7.3"></script>   
    <![endif]-->
    <!--[if lt IE 9]>
        <link href="{{asset('css/bootstrap-ie8.css')}}" rel="stylesheet">
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    @include('partials.header')
        @yield('content')
    @include('partials.footer')
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
    @yield('custom-js')
    <script src="{{ asset('js/ie10-viewport-bug-workaround.js') }}"></script>
    @include('flashy::message')
    
</body>

</html>