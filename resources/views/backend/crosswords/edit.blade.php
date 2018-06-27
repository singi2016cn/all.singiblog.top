@extends('layouts.backend')

@section('content')
<div class="container">
    <div class="row">
            <div class="col-md-12">
                @component('component.alert') success @endcomponent
                @component('component.error')  @endcomponent
                <div class="panel panel-default">
                    <div class="panel-heading">
                        编辑
                        <a style="float: right" href="{{ route('backend.crosswords.index') }}">返回</a>
                    </div>

                    <div class="panel-body">
                        <form action="{{ route('backend.crosswords.update',['id'=>$item->id]) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <div class="form-group">
                                <label for="word">答案</label>
                                <input type="text" class="form-control" id="word" name="word" value="{{ old('word') ?? $item->word }}" placeholder="答案">
                            </div>
                            <div class="form-group">
                                <label for="tip">提示</label>
                                <input type="text" class="form-control" id="tip" name="tip" value="{{ old('tip') ?? $item->tip }}" placeholder="提示">
                            </div>
                            <div class="radio">
                                <label><input type="radio" name="is_h" value="1" @if($item->is_h == 1)checked @endif>横</label>
                                <label><input type="radio" name="is_h" value="0" @if($item->is_h == 0)checked @endif>竖</label>
                            </div>
                            <div class="form-group">
                                <label for="seq">横竖序号</label>
                                <input type="text" class="form-control" id="seq" name="seq" value="{{ old('seq') ?? $item->seq }}" placeholder="横:一,二,三;竖:1,2,3">
                            </div>

                            <div class="row text-center">
                                <button type="submit" class="btn btn-default">提交</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection
