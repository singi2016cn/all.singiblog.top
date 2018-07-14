@extends('layouts.app')

@section('description')让句子震撼你的心灵@endsection
@section('keywords')句子,名句,思考@endsection
@section('title')句心@endsection

@section('style')
    <style>
        .bl{border-left: none;}
        .text-truncate {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>
@endsection

@section('content')
    <div class="container" id="app">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-primary text-center">
                    @forelse($sentences as $sentence)
                        <div class="panel-body">
                            <blockquote class="bl">
                                <p class="text-truncate">{{ $sentence->title }}</p>
                                @if($sentence->author || $sentence->book)
                                    <footer>
                                        {{ $sentence->author }}
                                        @isset($sentence->book)<cite title="Source Title">《{{ $sentence->book }}》</cite>@endisset
                                    </footer>
                                @endif
                                @forelse($sentence->tag as $t)
                                    <span class="label label-{{ array_random($color) }}">{{ $t }}</span>
                                @empty
                                @endforelse
                            </blockquote>
                        </div>
                        <hr style="margin: 0">
                        @empty
                        <div style="margin: 2em">
                            <a href="{{ route('market.index') }}">没有只言片语，还是去别处逛逛吧</a>
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="row text-center">
                {{ $sentences->links() }}
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>

        var app = new Vue({
            el: '#app',
            data: {},
        });

    </script>
@endsection


