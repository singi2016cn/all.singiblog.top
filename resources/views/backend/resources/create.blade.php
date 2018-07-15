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
                        <a style="float: right" href="{{ route('backend.resources.index') }}">返回</a>
                    </div>

                    <div class="panel-body">
                        <form action="{{ route('backend.resources.store') }}" method="post">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="name">名称</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="名称">
                            </div>

                            <div class="form-group">
                                <label>类型</label>
                                <div>
                                    @forelse($type_setting as $i=>$type)
                                        <label class="radio-inline">
                                            <input type="radio" name="type" value="{{ $i }}" @if($i == 1) checked @endif> {{ $type }}
                                        </label>
                                    @empty
                                    @endforelse
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="download_link">下载链接</label>
                                <input type="text" class="form-control" id="download_link" name="download_link" placeholder="下载链接[以及密码]">
                            </div>

                            <div class="form-group">
                                <label for="download_password">下载密码</label>
                                <input type="text" class="form-control" id="download_password" name="download_password" placeholder="下载密码">
                            </div>

                            <div class="form-group">
                                <label>是否免费</label>
                                <div>
                                    @forelse($is_free_setting as $i2=>$is_free)
                                        <label class="radio-inline">
                                            <input type="radio" name="is_free" value="{{ $i2 }}" @if($i2 == 1) checked @endif> {{ $is_free }}
                                        </label>
                                    @empty
                                    @endforelse
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
