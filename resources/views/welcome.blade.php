<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .content {
                text-align: center;
            }

            .web-group {
                margin-top: 6em;
                margin-bottom: 6em;
            }

            .space-links > a{
                margin-bottom: 3em;
            }

        </style>
    </head>
    <body>
        <div id="app" class="container content">
            <div class="web-group">
                <h1>Account Pages</h1>
                <div class="links">
                    <a href="/weather-text">Weather Text</a>
                </div>
            </div>

            <div class="web-group">
                <h1>Public Pages</h1>
                <div class="row space-links">
                    <a class="col-xs-6 col-md-4" href="/public/face">Face</a>
                    <a class="col-xs-6 col-md-4" href="/public/pathfinder">Pathfinder</a>
                    <a class="col-xs-6 col-md-4" href="/public/genetic-pathfinder">Genetic Pathfinder</a>
                    <a class="col-xs-6 col-md-4" href="/public/quoridor">Quoridor</a>
                    <a class="col-xs-6 col-md-4" href="/public/star-wars">Star Wars</a>
                    <a class="col-xs-6 col-md-4" href="/public/tiny-tables">Tiny Tables</a>
                    <a class="col-xs-6 col-md-4 col-md-offset-4" href="/public/loans">Loans</a>
                </div>
            </div>
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
