@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @forelse($crosswords_counts as $crosswords_count)
            <a href="{{route('crosswords.show',['id'=>$crosswords_count->id])}}">
                <div class="col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">第{{ $crosswords_count->id }}号</div>

                        <div class="panel-body">
                            {{ $crosswords_count->des }}
                        </div>
                    </div>
                </div>
            </a>
        @empty
            <div class="text-center">
                <a href="{{route('market.index')}}">哦，好像迷路了，到别处逛逛吧</a>
            </div>
        @endforelse
    </div>
    <div class="row text-center">
        {{ $crosswords_counts->links() }}
    </div>
</div>
@endsection
