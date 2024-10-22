<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimal-ui"/>
    <title>inscription | Afrikaschool</title>
    <link rel="icon" href="#">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="{{asset('css/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/custom.min.css')}}" rel="stylesheet">
    @yield('css')
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
</head>

<body class="login">
<div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">
        <div id="signup" class="animate form login_form">
            <section class="login_content">
                <form method="POST" action="{{ route('register.req') }}">
                    {{ csrf_field() }}
                    <h1>Inscription</h1>

                    <div class="{{ $errors->has('secret_code') ? ' has-error' : '' }}">
                        {{ Form::text('secret_code', old('secret_code'), ['class' => 'form-control', 'placeholder' => 'Code secret', 'required' => '']) }}
                        @if ($errors->has('secret_code'))
                            <span class="help-block">
                                <strong>{{ $errors->first('secret_code') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="{{ $errors->has('tel') ? ' has-error' : '' }}">
                        {{ Form::text('tel', old('tel'), ['class' => 'form-control', 'placeholder' => 'Téléphone', 'required' => '']) }}
                        @if ($errors->has('tel'))
                            <span class="help-block">
                                <strong>{{ $errors->first('tel') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input type="password" name="password" class="form-control" placeholder="Mot de passe" required=""/>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div>
                        <input id="password-confirm" type="password" class="form-control"
                               placeholder="Confirmer mot de passe" name="password_confirmation" required>
                    </div>
                    <div class="col-md-offset-3 col-xs-offset-3">
                        <input type="submit" class="btn btn-default btn-lg submit" value="S'inscrire">
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link mb-2">Déjà un compte ?
                            <a href="{{route('login')}}" class="to_register"> <strong>Se connecter</strong> </a>
                        </p>

                        <div>
                            <h1><i class="fa fa-graduation-cap"></i> AfrikaSchool!</h1>
                            <p>©2018 All Rights Reserved. AfrikaSchool! Gestionnaire d'école. Privacy and Terms</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="{{mix('js/app.js')}}"></script>
<script src="{{asset('js/custom.min.js')}}"></script>
@include('flashy::message')
<script src="{{asset('js/ie10-viewport-bug-workaround.js')}}"></script>
</body>

</html>