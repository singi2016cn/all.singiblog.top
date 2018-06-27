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
                        <a style="float: right" href="{{ route('backend.crosswords_counts.index') }}">返回</a>
                    </div>

                    <div class="panel-body">
                        <form action="{{ route('backend.crosswords_counts.store') }}" method="post">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="des">描述</label>
                                <input type="text" class="form-control" id="des" name="des" placeholder="描述">
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
