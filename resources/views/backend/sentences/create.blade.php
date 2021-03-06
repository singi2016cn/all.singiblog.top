@extends('layouts.backend')

@section('content')
<div class="container">
    <div class="row">
            <div class="col-md-12">
                @component('component.alert') success @endcomponent
                @component('component.error')  @endcomponent
                <div class="panel panel-default">
                    <div class="panel-heading">
                        创建
                        <a style="float: right" href="{{ route('backend.sentences.index') }}">返回</a>
                    </div>

                    <div class="panel-body">
                        <form action="{{ route('backend.sentences.store') }}" method="post">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="title">句子</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="句子">
                            </div>

                            <div class="form-group">
                                <label for="title">作者</label>
                                <input type="text" class="form-control" id="author" name="author" placeholder="作者">
                            </div>

                            <div class="form-group">
                                <label for="title">书籍</label>
                                <input type="text" class="form-control" id="book" name="book" placeholder="书籍">
                            </div>

                            <div class="form-group">
                                <label for="tag">标签</label>
                                <input type="text" class="form-control" id="tag" name="tag" placeholder="标签">
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
