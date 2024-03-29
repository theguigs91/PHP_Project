<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Asana *</title>

    <!-- CSS  -->
    {!! Html::style('https://fonts.googleapis.com/icon?family=Material+Icons') !!}
    {!! Html::style('css/materialize.css') !!}
    {!! Html::style('css/style.css') !!}
</head>
<body>
    <nav class="white" role="navigation">
        <div class="nav-wrapper container">
            <a id="logo-container" href="http://localhost:8080/PHP_Project/public" class="siteHeader-logo brand-logo title_juice purple-text text-darken-4">
            </a>
            <!-- Dropdown Structure -->
            <ul id="dropdown" class="dropdown-content">
                <li><a href="{{ route('projects') }}" class="purple-text text-darken-4">Mes projets</a></li>
                <li class="divider"></li>
                <li>
                    <a href="{{ route('logout') }}" class="purple-text text-darken-4" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Se déconnecter
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>

            <ul class="right hide-on-med-and-down">
                @if (Route::has('login'))
                    <div class="top-right links">
                        @if (Auth::check())
                            <li><a class="purple-text text-darken-4" href="#">Contacts</a></li>
                            <li><a class="purple-text text-darken-4" href="#">A propos</a></li>
                            <li><a class='purple-text text-darken-4 dropdown-button' href='#' data-activates='dropdown'>{{ Auth::user()->name }}<i class="material-icons right">arrow_drop_down</i></a></li>
                        @else
                            <li><a class="purple-text text-darken-4" href={{route('projects')}}>Projects</a></li>
                            <li><a class="purple-text text-darken-4" href="#">Contact</a></li>
                            <li><a class="purple-text text-darken-4" href="#">A propos</a></li>
                            <li><a id="loginBtn" class="purple-text text-darken-4 white btn" href="#LogInModal">Connexion</a></li>
                            <li><a id="signinBtn" class="white-text purple darken-4 btn" href="#SignInModal">Inscription</a></li>
                        @endif
                    </div>
                @endif
            </ul>
        </div>
    </nav>

    <!-- Modal Structure -->
    <div id="SignInModal" class="modal">
        <div class="modal-content">
            <div class="row">
                <div>
                    <h2 class="center-align">Inscription</h2>
                </div>


                {!! Form::open(['url' => 'register']) !!}
                <div class="row">
                    <div class="input-field {{ $errors->has('name') ? ' has-error' : '' }}">
                        <i class="material-icons prefix">account_circle</i>
                        {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) !!}
                        <label for="name">Name</label>

                        @if ($errors->has('name'))
                            <span class="help-block right red-text">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="input-field {{ $errors->has('email') ? ' has-error' : '' }}">
                        <i class="material-icons prefix">account_circle</i>
                        {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'email']) !!}
                        <label for="email">Email</label>

                        @if ($errors->has('email'))
                            <span class="help-block right red-text">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="input-field {{ $errors->has('password') ? ' has-error' : '' }}">
                        <i class="material-icons prefix">https</i>
                        {!! Form::password('password', null, ['class' => 'form-control', 'id' => 'password']) !!}
                        <label for="password">Password</label>

                        @if ($errors->has('password'))
                            <span class="help-block right red-text">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="input-field">
                        <i class="material-icons prefix">https</i>
                        {!! Form::password('password_confirmation', null, ['class' => 'form-control', 'id' => 'password_confirmation']) !!}
                        <label for="password_confirmation">Confirmation Mot de Passe</label>
                    </div>
                </div>

                <div class="row">
                    <button id="addButton" class="btn waves-effect waves-light right purple darken-4" type="submit">S'inscrire
                        <i class="material-icons right">send</i>
                    </button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <!-- Modal Structure -->
    <div id="LogInModal" class="modal">
        <div class="modal-content">
            <div class="row">
                <div>
                    <h2 class="center-align">Log In</h2>
                </div>
                {!! Form::open(['url' => 'login']) !!}
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">account_circle</i>
                        {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'email']) !!}
                        <label for="email">Login</label>
                    </div>
                    <div class="input-field col s12">
                        <i class="material-icons prefix">https</i>
                        {!! Form::password('password', null, ['class' => 'form-control', 'id' => 'password']) !!}
                        <label for="password">Password</label>
                    </div>
                </div>
                <div class="row">
                    <button id="addButton" class="btn waves-effect waves-light right purple darken-4" type="submit" name="Add">Se Connecter
                        <i class="material-icons right">send</i>
                    </button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    @yield('content')

    <footer class="page-footer orange">
        <div class="container">
            <div class="row">
                <div class="col l6 s12">
                    <h5 class="white-text">Company Bio</h5>
                    <p class="grey-text text-lighten-4">We are a team of college students working on this project like it's our full time job. Any amount would help support and continue development on this project and is greatly appreciated.</p>


                </div>
                <div class="col l3 s12">
                    <h5 class="white-text">Settings</h5>
                    <ul>
                        <li><a class="white-text" href="#!">Link 1</a></li>
                        <li><a class="white-text" href="#!">Link 2</a></li>
                        <li><a class="white-text" href="#!">Link 3</a></li>
                        <li><a class="white-text" href="#!">Link 4</a></li>
                    </ul>
                </div>
                <div class="col l3 s12">
                    <h5 class="white-text">Connect</h5>
                    <ul>
                        <li><a class="white-text" href="#!">Link 1</a></li>
                        <li><a class="white-text" href="#!">Link 2</a></li>
                        <li><a class="white-text" href="#!">Link 3</a></li>
                        <li><a class="white-text" href="#!">Link 4</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
                Made by <a class="orange-text text-lighten-3" href="http://materializecss.com">Materialize</a>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    {!! Html::script('https://code.jquery.com/jquery-2.1.1.min.js') !!}
    {!! Html::script('js/materialize.js') !!}
    {!! Html::script('js/init.js') !!}
</body>
</html>
