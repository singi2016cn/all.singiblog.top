@extends('layouts.app')

@section('description')提供各种资源的下载@endsection
@section('keywords')资源,图书,游戏,电影,动漫,电视剧,软件,小说@endsection
@section('title')SN商店@endsection

@section('style')
    <style>
        .tddd {
            display:block;
            width:60em;
            word-break:keep-all;
            white-space:nowrap;
            overflow:hidden;
            text-overflow:ellipsis;
        }
    </style>
@endsection

@section('content')
    <div class="container" id="app">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        搜索
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="get" action="{{ route('resources.index') }}">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">类型</label>
                                <div class="col-sm-8">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('resources.index',['type'=>'','is_free'=>$is_free,'search'=>$search])}}"  type="button" class="btn btn-default @if($type == '') active @endif">不限</a>
                                        @forelse($type_setting as $i=>$type_i)
                                            <a href="{{ route('resources.index',['type'=>$i,'is_free'=>$is_free,'search'=>$search])}}"  type="button" class="btn btn-default @if($type == $i) active @endif">{{ $type_i }}</a>
                                        @empty
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">是否免费</label>
                                <div class="col-sm-8">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('resources.index',['type'=>$type,'is_free'=>'','search'=>$search])}}" type="button" class="btn btn-default @if($is_free == '') active @endif">不限</a>
                                        <a href="{{ route('resources.index',['type'=>$type,'is_free'=>1,'search'=>$search])}}" type="button" class="btn btn-default @if($is_free == 1) active @endif">是</a>
                                        <a href="{{ route('resources.index',['type'=>$type,'is_free'=>2,'search'=>$search])}}" type="button" class="btn btn-default @if($is_free == 2) active @endif">否</a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="search" class="col-sm-2 control-label">搜索</label>
                                <div class="col-sm-8">
                                    <input type="text" name="search" class="form-control" id="search" value="{{ $search }}" placeholder="资源名称">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                @forelse($data as $item)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        资源列表
                    </div>
                    <table class="table">
                        <tr>
                            <th>ID</th>
                            <th>名称</th>
                            <th>类型</th>
                            <th>是否免费</th>
                            <th>下载次数</th>
                            <th>操作</th>
                        </tr>
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                {{ $type_setting[$item->type] }}
                            </td>
                            <td>{{ $is_free_setting[$item->is_free] }}</td>
                            <td>{{ $item->download_count }}</td>
                            <td>
                                @if($item->is_free == 1)
                                    <a href="{{ $item->download_link }}">下载</a>
                                    @isset($item->download_password)
                                        <span class="label label-success" title="下载密码">{{ $item->download_password }}</span>
                                    @endisset
                                    @else

                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
                @empty
                    <div class="text-center">
                        <a href="{{route('market.index')}}">哦，这里还没有任何商品，请去别处逛逛吧</a>
                    </div>
                @endforelse
            </div>
            <div class="row text-center">
                {{ $data->links() }}
            </div>
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


