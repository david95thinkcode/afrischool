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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
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
  </style>
</head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <!-- page content -->
        <div class="col-md-12">
          <div class="col-middle">
            <div class="text-center">
              <h1 class="error-number">500</h1>
              <h2>Internal Server Error</h2>
              <p>We track these errors automatically, but if the problem persists feel free to contact us. In the meantime, try refreshing. <a href="#">Report this?</a>
              </p>
              <div class="mid_center">
                <h3>Search</h3>
                <form>
                  <div class="col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Search for...">
                      <span class="input-group-btn">
                              <button class="btn btn-default" type="button">Go!</button>
                          </span>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
      </div>
    </div>

    <!-- Scripts -->
    <script src="{{mix('js/app.js')}}"></script>
    <script src="{{asset('js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <script src="{{asset('js/custom.min.js')}}"></script>
    <script src="{{asset('js/ie10-viewport-bug-workaround.js')}}"></script>
  </body>
</html>