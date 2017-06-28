<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title>Asana Like</title>

    <!-- CSS  -->
    {!! Html::style('https://fonts.googleapis.com/icon?family=Material+Icons') !!}
    {!! Html::style('css/materialize.css') !!}
    {!! Html::style('css/style.css') !!}
</head>
<body>
<nav class="white" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="" class="brand-logo title_juice purple-text text-darken-4">AsanaLike</a>
        <ul class="right hide-on-med-and-down">
            <li><a class="purple-text text-darken-4" href="#LogInModal">Connexion</a></li>
            <li><a class="purple-text text-darken-4" href="#SignInModal">Inscription</a></li>
        </ul>
    </div>
</nav>

<!-- Modal Structure -->
<div id="SignInModal" class="modal">
    <div class="modal-content">
        <div class="row">
            <div>
                <h2 class="center-align">Sign In</h2>
            </div>
            {!! Form::open(['url' => 'signin']) !!}
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">account_circle</i>
                        {!! Form::text('login', null, ['class' => 'form-control']) !!}
                        <label for="login">Login</label>
                    </div>
                    <div class="input-field col s12">
                        <i class="material-icons prefix">https</i>
                        {!! Form::password('password', null, ['class' => 'form-control']) !!}
                        <label for="password">Password</label>
                    </div>
                    <div class="input-field col s12">
                        <i class="material-icons prefix">https</i>
                        {!! Form::password('password_bis', null, ['class' => 'form-control']) !!}
                        <label for="password">Password confirmation</label>
                    </div>
                    <button id="addButton" class="btn waves-effect waves-light right purple darken-4" type="submit" name="Add">S'inscrire
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
                        {!! Form::text('login', null, ['class' => 'form-control']) !!}
                        <label for="login">Login</label>
                    </div>
                    <div class="input-field col s12">
                        <i class="material-icons prefix">https</i>
                        {!! Form::password('password', null, ['class' => 'form-control']) !!}
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

<div class="section no-pad-bot red" id="index-banner">
    <div class="container">
        <br><br>
        <h1 class="header center white-text">Starter Template</h1>
        <div class="row center">
            <h5 class="header col s12 light white-text">A modern responsive front-end framework based on Material Design</h5>
        </div>
        <div class="row center">
            <a href="http://materializecss.com/getting-started.html" id="download-button" class="btn-large waves-effect waves-light purple darken-4">Get Started</a>
        </div>
        <br><br>

    </div>
</div>


<div class="container">
    <div class="section">

        <!--   Icon Section   -->
        <div class="row">
            <div class="col s12 m4">
                <div class="icon-block">
                    <h2 class="center purple-text text-darken-4"><i class="material-icons">flash_on</i></h2>
                    <h5 class="center">Speeds up development</h5>

                    <p class="light">We did most of the heavy lifting for you to provide a default stylings that incorporate our custom components. Additionally, we refined animations and transitions to provide a smoother experience for developers.</p>
                </div>
            </div>

            <div class="col s12 m4">
                <div class="icon-block">
                    <h2 class="center purple-text text-darken-4"><i class="material-icons">group</i></h2>
                    <h5 class="center">User Experience Focused</h5>

                    <p class="light">By utilizing elements and principles of Material Design, we were able to create a framework that incorporates components and animations that provide more feedback to users. Additionally, a single underlying responsive system across all platforms allow for a more unified user experience.</p>
                </div>
            </div>

            <div class="col s12 m4">
                <div class="icon-block">
                    <h2 class="center purple-text text-darken-4"><i class="material-icons">settings</i></h2>
                    <h5 class="center">Easy to work with</h5>

                    <p class="light">We have provided detailed documentation as well as specific code examples to help new users get started. We are also always open to feedback and can answer any questions a user may have about Materialize.</p>
                </div>
            </div>
        </div>

    </div>
    <br><br>
</div>

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


<!--  Scripts-->
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="js/materialize.js"></script>
<script src="js/init.js"></script>

</body>
</html>
