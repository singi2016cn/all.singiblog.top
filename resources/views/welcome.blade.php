<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('favicon.ico') }}" rel="Shortcut Icon">
        <meta name="author" content="https://github.com/singi2016cn">
        <meta name="description" content="开启新世界的大门">
        <meta name="keywords" content="SG资源商店,句心,泰句心的冒险,填字游戏">
        <title>all of singi</title>
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth

                    @auth('admin')
                        <a href="{{ route('backend') }}">Backend-home</a>
                    @else
                        <a href="{{ route('backend.login') }}">Backend</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    All of singi
                </div>

                <div class="links">
                    <a href="{{ route('market.index') }}" style="font-size: 2em">开启新世界的大门</a>
                </div>
            </div>
        </div>
    </body>
</html>
