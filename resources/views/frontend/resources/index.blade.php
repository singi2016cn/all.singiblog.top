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
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="get" action="{{ route('resources.index') }}">
                            {{--<div class="form-group">
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
                            </div>--}}
                            <div class="form-group">
                                <label for="search" class="col-sm-2 control-label">搜索</label>
                                <div class="col-sm-8">
                                    <input type="text" name="search" class="form-control" id="search" value="{{ $search }}" placeholder="资源名称">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        资源列表
                    </div>
                    <table class="table table-striped table-hover">
                        <tr>
                            <th>ID</th>
                            <th>名称</th>
                            <th>类型</th>
                            <th>是否免费</th>
                            <th>下载次数</th>
                            <th>操作</th>
                        </tr>
                        @forelse($data as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                {{ $type_setting[$item->type] }}
                            </td>
                            <td>{{ $is_free_setting[$item->is_free] }}</td>
                            <td id="download_count_td{{ $item->id }}">{{ $item->download_count }}</td>
                            <td>
                                @if($item->is_free == 1)
                                    <a href="{{ $item->download_link }}" onclick="update_download_count({{$item->id}})" target="_blank">下载</a>
                                    @isset($item->download_password)
                                        <span class="label label-success" title="下载密码">{{ $item->download_password }}</span>
                                    @endisset
                                    @else

                                @endif
                            </td>
                        </tr>
                        @empty
                            <tr class="text-center">
                                <td colspan="6">
                                    哦，没有搜索到任何商品，试试别的搜索条件吧
                                </td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>
            <div class="row text-center">
                {{ $data->appends(['type'=>$type,'is_free'=>$is_free,'search' => $search])->links() }}
            </div>
        </div>
    </div>
    @section('abs_bar')
        <button data-toggle="modal" data-target="#weixin_model" type="button" class="btn btn-default"><i class="fa fa-weixin"></i></button>
        <button data-toggle="modal" data-target="#nansuo_model" type="button" class="btn btn-default"><i class="fa fa-shopping-cart"></i></button>
    @endsection

    <div class="modal fade" tabindex="-1" role="dialog" id="weixin_model">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">SG资源商店微信订阅号</h4>
          </div>
          <div class="modal-body">
              <div class="row">
                  <div class="col-sm-6">
                      <img src="{{ asset('imgs/qrcode_singistore.jpg') }}" width="200px" alt="SG资源商店微信订阅号">
                  </div>
                  <div class="col-sm-6" style="margin-top: 20px">
                      <p>欢迎关注</p>
                      <p>SG资源商店微信订阅号</p>
                      <p>更多资源等你来拿</p>
                  </div>
              </div>
          </div>
        </div>
      </div>
    </div>
<div class="modal fade" tabindex="-1" role="dialog" id="nansuo_model">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">南锁工作室淘宝店</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <img src="{{ asset('imgs/qrcode_nansuostudio.png') }}" style="width: 180px;margin-left: 10px" alt="南锁工作室淘宝店">
                    </div>
                    <div class="col-sm-6" style="margin-top: 20px">
                        <p>欢迎访问</p>
                        <p>南锁工作室淘宝店</p>
                        <p>更多优惠等你来拿</p>
                    </div>
                </div>
            </div>
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

        function update_download_count(id){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: '{{ route('api.resources.update_resources') }}',
                data: {id:id},
                success: function(res){
                    console.log(res);
                    $('#download_count_td'+id).text($('#download_count_td'+id).text()*1+1);
                },
                dataType: 'json'
            });
        }

    </script>
@endsection


