<!DOCTYPE html>
<html lang="fr">
<head>
    {!! Html::style('css/materialize.css') !!}

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script>

    <title>Asana Like</title>
    {!! Html::style('https://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css') !!}
    <style> textarea { resize: none; } </style>
</head>
<body>
<nav>
    <div class="nav-wrapper">
        <a href="#" class="brand-logo">Asana Like</a>
        <ul class="right hide-on-med-and-down">
            <li><a href="#">Accueil</a></li>
            <li><a href={{route('tasks')}}>Projets</a></li>
            <li><a href="#">A propos</a></li>
        </ul>
    </div>
</nav>
@yield('contenu')
</body>
</html>
