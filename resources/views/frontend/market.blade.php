@extends('layouts.app')

@section('title')广场@endsection

@section('style')
    <style>
        .panel-body {
            color: black
        }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        {{--<div class="col-md-3">
            <div class="panel panel-success">
                <div class="panel-heading">数据酷(即将开放)</div>
                <div class="panel-body">
                    这里收集着来自世界各地的宝藏
                </div>
            </div>
        </div>--}}
        <a href="{{ route('resources.index') }}">
            <div class="col-md-3">
                <div class="panel panel-danger">
                    <div class="panel-heading">SG资源商店</div>
                    <div class="panel-body">
                        各种各样的资源在等着你。
                    </div>
                </div>
            </div>
        </a>
        <a href="{{ url('images') }}">
            <div class="col-md-3">
                <div class="panel panel-success">
                    <div class="panel-heading">图压</div>
                    <div class="panel-body">
                        缩小你的图片
                    </div>
                </div>
            </div>
        </a>
        <a href="{{ route('demands.index') }}">
            <div class="col-md-3">
                <div class="panel panel-success">
                    <div class="panel-heading">程需</div>
                    <div class="panel-body">
                        改变世界从一个小小的需求开始
                    </div>
                </div>
            </div>
        </a>
        <a href="{{ route('tagclouds.index') }}">
            <div class="col-md-3">
                <div class="panel panel-info">
                    <div class="panel-heading">词云</div>
                    <div class="panel-body">
                        是时候展示数据之美了
                    </div>
                </div>
            </div>
        </a>
        <a href="{{ route('sentences.index') }}">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">句心</div>
                    <div class="panel-body">
                        让句子震撼你的心灵。
                    </div>
                </div>
            </div>
        </a>
        <a href="{{ route('adventures.index') }}">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">泰句心的冒险</div>
                    <div class="panel-body">
                        嘿，冒险者，来玩一局文字游戏吧。
                    </div>
                </div>
            </div>
        </a>
        <a href="{{ route('crosswords.index') }}">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">填字游戏</div>
                    <div class="panel-body">
                        准备好你的脑袋,大战一场。
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection
