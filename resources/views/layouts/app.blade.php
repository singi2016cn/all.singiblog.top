<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="https://github.com/singi2016cn">
    <meta name="description" content="@section('description')创造一个全新的世界@show">
    <meta name="keywords" content="@section('keywords')SG资源商店,句心,泰句心的冒险,填字游戏@show">
    <title>@section('title'){{ config('app.name', 'Laravel') }}@show</title>
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdn.bootcss.com/animate.css/3.5.2/animate.min.css" rel="stylesheet">
    @yield('link')
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
        <nav class="navbar navbar-default navbar-static-top" style="background-color: white">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img width="20px" alt="{{ config('app.name', 'Laravel') }}" src="{{ asset('logo.png') }}">
                    </a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="@if(request()->is('market*')) active @endif"><a href="{{route('market.index')}}">广场</a></li>
                        <li class="@if(request()->is('resources*')) active @endif">
                            <a  href="{{route('resources.index')}}">SG资源商店<span class="glyphicon glyphicon-star text-danger"></span></a>
                        </li>
                        <li class="@if(request()->is('crosswords*')) active @endif"><a href="{{route('crosswords.index')}}">填字游戏</a></li>
                        <li class="@if(request()->is('adventures*')) active @endif"><a href="{{route('adventures.index')}}">泰句心的冒险</a></li>
                        <li class="@if(request()->is('sentences*')) active @endif"><a href="{{route('sentences.index')}}">句心</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        @guest
                            <li><a href="{{ route('login') }}">登录</a></li>
                            <li><a href="{{ route('register') }}">注册</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('home') }}">个人主页</a>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">退出</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
        <div style="position: fixed;bottom: 20px;right: 20px">
            <div class="btn-group-vertical" role="group">
                @section('abs_bar') @show
                <button data-toggle="modal" data-target="#feedback" type="button" class="btn btn-default"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></button>
                <a href="#" type="button" class="btn btn-default"><span class="glyphicon glyphicon-menu-up" aria-hidden="true"></span></a>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="feedback">
        <div class="modal-dialog" role="document">
            <form action="{{ route('feedbacks.store') }}" method="post">
                {{ csrf_field() }}
            <div class="modal-content modal-lg">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">轮到你表演的时候了，帮助我们做得更好</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="message-text" class="control-label">反馈建议</label>
                        <textarea class="form-control" rows="10" id="message-text" required name="content" placeholder="反馈建议，想找的资源，希望本站新增功能..."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">联系方式</label>
                        <input type="text" class="form-control" id="recipient-name" name="contact" placeholder="邮箱/手机号/QQ/微信/微博...">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">再想想</button>
                    <button type="submit" class="btn btn-primary">火速上报</button>
                </div>
            </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script>
        (function(){
            var bp = document.createElement('script');
            var curProtocol = window.location.protocol.split(':')[0];
            if (curProtocol === 'https') {
                bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';
            }
            else {
                bp.src = 'http://push.zhanzhang.baidu.com/push.js';
            }
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(bp, s);
        })();
    </script>

    @component('component/home/alert_timeout')@endcomponent

    @yield('script_src')
    @yield('script')
</body>
</html>
