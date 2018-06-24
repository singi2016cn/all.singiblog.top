@extends('layouts.backend')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    详情
                    <a style="float: right" href="{{ route('backend.crosswords.index') }}">返回</a>
                </div>
                <table class="table table-striped table-hover">
                    <tr>
                        <td>ID</td>
                        <td>{{ $item->id }}</td>
                    </tr>
                    <tr>
                        <td>答案</td>
                        <td>{{ $item->word }}</td>
                    </tr>
                    <tr>
                        <td>提示</td>
                        <td>{{ $item->tip }}</td>
                    </tr>
                    <tr>
                        <td>横/竖</td>
                        <td>{{ $item->is_h }}</td>
                    </tr>
                    <tr>
                        <td>序号</td>
                        <td>{{ $item->seq }}</td>
                    </tr>
                    <tr>
                        <td>创建时间</td>
                        <td>{{ $item->created_at }}</td>
                    </tr>
                    <tr>
                        <td>操作</td>
                        <td>
                            <a href="{{ route('backend.crosswords.index') }}">返回</a>
                            <a onclick="confirm_del({{ $item->id }})">删除</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>


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
