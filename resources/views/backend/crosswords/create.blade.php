@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
            <div class="col-md-12">

                @if (session('status'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        {{ session('status') }}
                    </div>
                @endif

                <div class="panel panel-default">
                    <div class="panel-heading">创建填字游戏</div>

                    <div class="panel-body">
                        <form action="{{ route('backend.crosswords.store') }}" method="post">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <label for="word">第xx号</label>
                                        <select class="form-control" name="crosswords_counts_id" id="crosswords_counts_id" onchange="get_crosswords()">
                                            <option value="0">请选择</option>
                                            @foreach($crosswords_counts as $crosswords_count)
                                                <option value="{{ $crosswords_count->id }}">第{{ $crosswords_count->id }}号</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="word">答案</label>
                                        <input type="text" class="form-control" id="word" name="word" placeholder="答案">
                                    </div>

                                    <div class="form-group">
                                        <label for="tip">提示</label>
                                        <input type="text" class="form-control" id="tip" name="tip" placeholder="提示">
                                    </div>
                                    <div class="radio">
                                        <label><input type="radio" name="is_h" value="1" checked>横</label>
                                        <label><input type="radio" name="is_h" value="0">竖</label>
                                    </div>
                                    <div class="form-group">
                                        <label for="seq">横竖序号</label>
                                        <input type="text" class="form-control" id="seq" name="seq" placeholder="横:1,2,3;竖:一,二,三">
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="seq">选择单元格</label>
                                        <table class="table table-bordered">
                                            @foreach ($ns as $n)
                                                <tr class="text-center">
                                                    @for($i = 1;$i<=10;$i++)
                                                        <td style="position: relative">
                                                            <span style="position: absolute;top: -6px;left: 0" id="cell_span{{ $n+$i }}"></span>
                                                            <input type="checkbox" name="cell_ids[]" value="{{ $n+$i }}" id="{{ $n+$i }}">
                                                        </td>
                                                    @endfor
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row text-center">
                                <button type="submit" class="btn btn-default">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        function get_crosswords(){
            var id = $(':selected').val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: '{{ route('api.crosswords.get_crosswords') }}',
                data: {id:id},
                success: function(res){
                    console.log(res);
                    if (res.code === 200){
                        if (res.data){
                            for (var i=0; i<=100;i++){
                                $('#'+i).parent().removeClass('info success');
                                $('#'+i).show();
                                $('#cell_span'+i).html('');
                            }
                            res.data.forEach(function(v){
                                var cls = 'info';
                                if (v.is_h === 1) cls = 'success';
                                var cell_ids_arr = v.cell_ids.split(',');
                                var cell_span_html = $('#cell_span'+cell_ids_arr[0]).html();
                                if (cell_span_html) {
                                    $('#cell_span'+cell_ids_arr[0]).html(cell_span_html+','+v.seq);
                                }else{
                                    $('#cell_span'+cell_ids_arr[0]).html(v.seq);
                                }

                                cell_ids_arr.forEach(function(v){
                                    $('#'+v).parent().addClass(cls);
                                    $('#'+v).hide();
                                })
                            })
                        }
                    }
                },
                dataType: 'json'
            });
        }
    </script>
@endsection
