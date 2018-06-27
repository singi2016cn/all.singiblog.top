@extends('layouts.backend')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">后台首页({{ date('Y-m-d H:i:s') }})</div>

                <table class="table table-striped table-hover" >
                    <tr><td>操作系统</td><td>{{ PHP_OS }}</td></tr>
                    <tr><td>PHP版本</td><td>{{ phpversion() }}</td></tr>
                    <tr><td>登录IP</td><td>{{ request()->ip() }}</td></tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
