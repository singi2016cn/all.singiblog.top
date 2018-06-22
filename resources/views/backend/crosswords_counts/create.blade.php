@extends('layouts.backend')

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
                    <div class="panel-heading">创建填字游戏号数</div>

                    <div class="panel-body">
                        <form action="{{ route('backend.crosswords_counts.store') }}" method="post">
                            {{ csrf_field() }}

                            <div class="form-group @if ($errors->has('des')) has-error @endif">
                                <label for="des">描述</label>
                                <input type="text" class="form-control" id="des" name="des" placeholder="描述">
                                @if ($errors->has('des'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('des') }}</strong>
                                    </span>
                                @endif
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
