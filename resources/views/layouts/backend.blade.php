<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('favicon.ico') }}" rel="Shortcut Icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .text-truncate {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>
    @yield('style')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ route('backend') }}">
                        <img width="20px" alt="{{ config('app.name', 'Laravel') }}" src="{{ asset('logo.png') }}">
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <ul class="nav navbar-nav">
                        @if(Auth::guard('admin')->check())
                            <li class="@if(request()->is('backend')) active @endif"><a href="{{route('backend')}}">首页</a></li>
                            <li class="@if(request()->is('backend/crosswords_counts*')) active @endif"><a href="{{route('backend.crosswords_counts.index')}}">填字游戏号数</a></li>
                            <li class="@if(request()->is('backend/crosswords*')) active @endif"><a href="{{route('backend.crosswords.index')}}">填字游戏</a></li>
                            <li class="@if(request()->is('backend/sentences*')) active @endif"><a href="{{route('backend.sentences.index')}}">句心</a></li>
                            <li class="@if(request()->is('backend/resources*')) active @endif"><a href="{{route('backend.resources.index')}}">SG资源商店</a></li>
                        @endif
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        @guest('admin')
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    {{ Auth::guard('admin')->user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                        <form id="logout-form" action="{{ route('backend.logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    @yield('script')
</body>
</html>
