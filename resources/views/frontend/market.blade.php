@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <a href="{{ route('crosswords.index') }}">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">填字游戏</div>
                    <div class="panel-body">
                        准备好你的脑袋,大战一场
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection
