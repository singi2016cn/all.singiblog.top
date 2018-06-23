@extends('layouts.app')



@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2">
            <div class="panel panel-default">
                <div class="panel-heading">项目</div>

                <div class="list-group text-nowrap" style="overflow: hidden">
                    <a href="#" class="list-group-item active">个人主页</a>
                    <a href="#" class="list-group-item">填字游戏</a>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">用户信息</div>

                <div class="panel-body">
                    <div class="input-group">
                        <span class="input-group-addon">用户名</span>
                        <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}">
                        <span class="input-group-btn"><button class="btn btn-default" type="button">修改</button></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
