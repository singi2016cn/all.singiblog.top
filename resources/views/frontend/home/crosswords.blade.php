@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @component('component.home.left_nav') @endcomponent
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">填字游戏累计得分</div>

                <div class="panel-body text-center text-success">
                    <span style="font-size: 5em">{{ Auth::user()->crosswords_score ?? 0 }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
