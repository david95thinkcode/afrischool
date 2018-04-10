<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimal-ui"/>
    <title>Connexion | Afrischool</title>
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
        <div class="animate form login_form">
            <section class="login_content">
                <form method="POST" action="{{ route('login.req') }}">
                    {{ csrf_field() }}
                    <h1>Connexion</h1>
                    <div class="{{ $errors->has('username') ? ' has-error' : '' }}">
                        <input type="text" name="username" class="form-control" placeholder="Username" required=""/>

                        @if ($errors->has('username'))
                            <span class="help-block">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input type="password" name="password" class="form-control" placeholder="Mot de passe"
                               required=""/>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div>
                        <input type="submit" class="btn btn-default submit" value="Se connecter">
                        <a class="reset_pass" href="#">Mot de passe oublié?</a>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link">Nouveau sur le site?
                            <a href="#signup" class="to_register"> S'inscrire</a>
                        </p>

                        <div class="clearfix"></div>
                        <br/>

                        <div>
                            <h1><i class="fa fa-graduation-cap"></i> AfriSchool!</h1>
                            <p>©2018 All Rights Reserved. AfriSchool! Gestionnaire d'école. Privacy and Terms</p>
                        </div>
                </form>
            </section>
        </div>

        <div id="signup" class="animate form registration_form">
            <section class="login_content">
                <form method="POST" action="{{ route('register.req') }}">
                    {{ csrf_field() }}
                    <h1>Inscription</h1>
                    <div class="{{ $errors->has('username') ? ' has-error' : '' }}">
                        <input type="text" name="username" class="form-control" placeholder="Username" required=""/>

                        @if ($errors->has('username'))
                            <span class="help-block">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="{{ $errors->has('name') ? ' has-error' : '' }}">
                        <input type="text" name="name" class="form-control" placeholder="Nom et Prénom(s)" required=""/>

                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input type="email" name="email" class="form-control" placeholder="Email" required=""/>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input type="password" class="form-control" placeholder="Password" required=""/>

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
                    <div>
                        <input type="submit" class="btn btn-default submit" value="S'inscrire">
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link">Déjà un compte ?
                            <a href="#signin" class="to_register">Se connecter</a>
                        </p>

                        <div class="clearfix"></div>
                        <br/>

                        <div>
                            <h1><i class="fa fa-graduation-cap"></i> AfriSchool!</h1>
                            <p>©2018 All Rights Reserved. AfriSchool! Gestionnaire d'école. Privacy and Terms</p>
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
<script src="{{asset('js/ie10-viewport-bug-workaround.js')}}"></script>
</body>

</html>