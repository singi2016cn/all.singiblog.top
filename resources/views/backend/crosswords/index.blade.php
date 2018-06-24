@extends('layouts.backend')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @component('component.alert') success @endcomponent
            <div class="panel panel-default">
                <div class="panel-heading">
                    填字游戏
                    <a style="float: right" href="{{ route('backend.crosswords.create') }}">创建</a>
                </div>
                <table class="table table-striped table-hover">
                  <tr>
                    <th>ID</th>
                    <th>所属号数</th>
                    <th>答案</th>
                    <th>提示</th>
                    <th>横/竖</th>
                    <th>序号</th>
                    <th>时间</th>
                    <th>操作</th>
                  </tr>
                    @forelse($data as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->crosswordsCounts['id'] }}</td>
                            <td>{{ $item->word }}</td>
                            <td title="{{ $item->tip }}">{{ mb_substr($item->tip,0,20,'utf-8') }}</td>
                            <td>{{ $item->is_h }}</td>
                            <td>{{ $item->seq }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                <a href="{{ route('backend.crosswords.show',['id'=>$item->id]) }}">显示</a>
                                <a href="{{ route('backend.crosswords.edit',['id'=>$item->id]) }}">编辑</a>
                                <a onclick="confirm_del({{ $item->id }})">删除</a>
                            </td>
                        </tr>
                        @empty
                        <tr class="text-center"><td>没有数据</td></tr>
                    @endforelse
                </table>
                <div class="panel-footer text-center" style="padding: 0">
                    {{ $data->render() }}
                </div>
            </div>
        </div>
    </div>
</div>

@foreach($data as $item)
<div class="modal fade" id="model-del-crosswords{{ $item->id }}" tabindex="-1" role="dialog">
    <form action="{{ route('backend.crosswords.destroy',['id'=>$item->id]) }}" method="post">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">确定删除</h4>
            </div>
            <div class="modal-body">
                <p>确定要删除吗？</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="submit" class="btn btn-primary">确定</button>
            </div>
        </div>
    </div>
    </form>
</div>
@endforeach
@endsection

@section('script')
    <script>
        function confirm_del(id){
            console.log(id);
            if (id < 1){
                return false;
            }else{
                $('#model-del-crosswords'+id).modal('show');
            }
        }
    </script>
@endsection
