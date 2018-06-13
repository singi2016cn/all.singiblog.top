@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">创建填字游戏</div>

                    <div class="panel-body">
                        <form action="{{ route('backend.crosswords.store') }}" method="post">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-sm-7">
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
                                        <table class="table">
                                            @foreach ($ns as $n)
                                                <tr>
                                                    @for($i = 1;$i<=10;$i++)
                                                        <td><input type="checkbox" name="cell_ids[]" value="{{ $n+$i }}"></td>
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
