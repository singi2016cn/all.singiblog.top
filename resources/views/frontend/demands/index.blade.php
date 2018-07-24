@extends('layouts.app')

@section('description')提供各种资源的下载@endsection
@section('keywords')资源,图书,游戏,电影,动漫,电视剧,软件,小说@endsection
@section('title')SG资源商店@endsection

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
                        <a style="float: right;" href="{{ route('demands.create') }}">发布新需求</a>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="get" action="{{ route('demands.index') }}">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">类型</label>
                                <div class="col-sm-8">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('demands.index',['type'=>'','platform'=>$platform,'search'=>$search])}}"  type="button" class="btn btn-default @if($type == '') active @endif">不限</a>
                                        @forelse($type_setting as $i=>$type_i)
                                            <a href="{{ route('demands.index',['type'=>$i,'platform'=>$platform,'search'=>$search])}}"  type="button" class="btn btn-default @if($type == $i) active @endif">{{ $type_i }}</a>
                                        @empty
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">平台</label>
                                <div class="col-sm-8">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('demands.index',['type'=>$type,'platform'=>'','search'=>$search])}}"  type="button" class="btn btn-default @if($platform == '') active @endif">不限</a>
                                        @forelse($platform_setting as $i=>$platform_i)
                                            <a href="{{ route('demands.index',['type'=>$type,'platform'=>$i,'search'=>$search])}}"  type="button" class="btn btn-default @if($platform == $i) active @endif">{{ $platform_i }}</a>
                                        @empty
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="search" class="col-sm-2 control-label">搜索</label>
                                <div class="col-sm-8">
                                    <input type="text" name="search" class="form-control" id="search" value="{{ $search }}" placeholder="需求名称">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        需求列表
                    </div>
                    <table class="table table-striped table-hover">
                        <tr>
                            <th>ID</th>
                            <th>名称</th>
                            <th>类型</th>
                            <th>平台</th>
                            @auth()
                            <th>描述</th>
                            @endauth()
                        </tr>
                        @forelse($data as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                {{ $type_setting[$item->type] }}
                            </td>
                            <td>{{ $platform_setting[$item->platform] }}</td>
                            @auth()
                                <td>
                                    <a onclick="find({{ $item->id }})">发现</a>
                                </td>
                            @endauth()
                        </tr>
                        @empty
                            <tr class="text-center">
                                <td colspan="6">
                                    哦，没有搜索到任何需求，试试别的搜索条件吧
                                </td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>
            <div class="row text-center">
                {{ $data->appends(['type'=>$type,'platform'=>$platform,'search' => $search])->links() }}
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="find">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">需求详情</h4>
          </div>
          <div class="modal-body">
              <p id="description"></p>
          </div>
        </div>
      </div>
    </div>
@endsection

@section('script')
    <script>
        var app = new Vue({
            el: '#app',
            data: {

            },
        });
        function find(id){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: '{{ route('api.demands.find') }}',
                data: {id:id},
                success: function(res){
                    console.log(res);
                    $('#description').text(res.data);
                    $('#find').modal('show');
                },
                dataType: 'json'
            });
        }
    </script>
@endsection


