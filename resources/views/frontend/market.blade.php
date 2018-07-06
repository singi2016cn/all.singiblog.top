@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
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
    </div>
</div>
@endsection
