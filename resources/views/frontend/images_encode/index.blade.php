@extends('layouts.app')

@section('description')提供各种资源的下载@endsection
@section('keywords')资源,图书,游戏,电影,动漫,电视剧,软件,小说@endsection
@section('title')SG资源商店@endsection

@section('style')
    <style>

    </style>
@endsection

@section('content')
    <div class="container" id="app">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        上传图片
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="post" enctype="multipart/form-data" action="{{ url('images') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="col-sm-2 control-label">类型</label>
                                <div class="col-sm-8">
                                    <input type="file" class="form-control" name="file">
                                </div>
                            </div>
                            <div class="row text-center">
                                <button type="submit" class="btn btn-default">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
@endsection

@section('script')
    <script>

        var app = new Vue({
            el: '#app',
            data: {},
        });

    </script>
@endsection


