@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
            <div class="col-md-12">
                @component('component.alert') success @endcomponent
                @component('component.error')  @endcomponent
                <div class="panel panel-default">
                    <div class="panel-heading">
                        创建
                        <a style="float: right" href="{{ route('demands.index') }}">返回</a>
                    </div>

                    <div class="panel-body">
                        <form action="{{ route('demands.store') }}" method="post">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="name">名称</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="名称">
                            </div>

                            <div class="form-group">
                                <label for="description">需求描述</label>
                                <textarea class="form-control" rows="8" id="description" name="description" placeholder="需求的描述，尽量明确地详细地描述您非凡的想法"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="type">类型</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="">请选择</option>
                                    @foreach($type_setting as $i=>$type)
                                        <option value="{{ $i }}">{{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="platform">平台</label>
                                <select name="platform" id="platform" class="form-control">
                                    <option value="">请选择</option>
                                    @foreach($platform_setting as $i=>$platform)
                                        <option value="{{ $i }}">{{ $platform }}</option>
                                    @endforeach
                                </select>
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
