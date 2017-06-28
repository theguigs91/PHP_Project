<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mon joli site</title>
    {!! Html::style('https://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css') !!}
    <style> textarea { resize: none; } </style>
</head>
<body>
    @yield('contenu')
</body>
</html>