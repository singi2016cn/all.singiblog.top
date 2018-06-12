@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <a href="{{route('crosswords.show',['id'=>1])}}">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">第20180611期</div>

                    <div class="panel-body">
                        龙争虎斗
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection
