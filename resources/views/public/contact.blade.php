<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="@yield('description')">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Contact | {!! env('APP_NAME') !!}</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway|Roboto" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    {!! Html::style('bootstrap-4.1.1/dist/css/bootstrap.min.css') !!}
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
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
<br><br>
<div class="container">
    <div class="row">
        <div class=" col-md-6 mx-auto justify-content-center mt-5 pt-5">
            <div class="card">
                <div class="card-body">
                    <div class="card-title text-center">
                        <div class="text-sm pb-1">
                            Vous pouvez nous contacter par ce formulaire de contact en ligne
                            <hr>
                            <span class="text-danger">*</span> Champ requis
                        </div>
                    </div>
                    <form class="form-horizontal" method="POST" action="{{ route('contact.post') }}">
                        {{ csrf_field() }}
                        <input type="text" class="d-none" name="hpet" value="">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('name') ? ' text-danger' : '' }}">
                                    <label for="name">Nom & Prénom(s) <span class="text-danger">*</span></label>
                                    <input id="name" type="text" class="form-control" name="name"
                                           value="{{ old('name') }}" required>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('phone') ? ' text-danger' : '' }}">
                                    <label for="phone">Téléphone <span class="text-danger">*</span></label>
                                    <input id="phone" type="text" class="form-control" name="phone"
                                           value="{{ old('phone') }}" required>
                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group{{ $errors->has('email') ? ' text-danger' : '' }}">
                                    <label for="email">E-Mail Address</label>

                                    <input id="email" type="email" class="form-control" name="email"
                                           value="{{ old('email') }}" >
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12" data-for="message">
                                <label for="message">Votre message <span class="text-danger">*</span></label>
                                <textarea id="message" class="form-control" name="message" rows="3"
                                          placeholder="Votre message">{{old('message')}}</textarea>
                                @if ($errors->has('message'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="input-group-btn col-md-12" style="margin-top: 10px;">
                                <button type="submit" class="btn btn-outline-info">
                                    Envoyer message
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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
