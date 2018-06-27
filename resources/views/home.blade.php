@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @component('component.home.left_nav') @endcomponent
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">用户信息({{ request()->ip() }})</div>

                <div class="panel-body">
                    <div class="input-group" style="margin-bottom: 5px">
                        <span class="input-group-addon">昵称</span>
                        <input type="text" class="form-control" name="name" disabled value="{{ Auth::user()->name }}">
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">邮箱</span>
                        <input type="text" class="form-control" name="name" disabled value="{{ Auth::user()->email }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
