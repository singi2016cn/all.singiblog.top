@extends('layouts.app')

@section('style')
    <style>
        td {
            width: 50px;
        }
    </style>
@endsection

@section('content')
    <div id="app" style="margin-top: 20px">
        <form action="">
            <div class="container">
                <div class="row">
                    <div class="col-md-2">
                        <div class="panel panel-default">
                            <div class="panel-heading">期数</div>
                            <div class="list-group">
                                <a href="#" class="list-group-item active">第20180611期</a>
                                <a href="#" class="list-group-item">第20180610期</a>
                                <a href="#" class="list-group-item">第20180609期</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-offset-1">
                        <div class="panel panel-default">
                            <div class="panel-heading">龙争虎斗</div>
                            <table class="table table-bordered">
                                <tr>
                                    <td></td>
                                    <td>
                                        <input @click="show_tip(2)" @blur="hide_tip()" type="text" name="2" id="2"
                                               class="form-control" minlength="1" maxlength="1"></td>
                                    <td><input @click="show_tip(3)" @blur="hide_tip()" type="text" name="3" id="3"
                                               class="form-control" minlength="1" maxlength="1"></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><input @click="show_tip(12)" @blur="hide_tip()" type="text" name="12" id="12"
                                               class="form-control" minlength="1" maxlength="1"></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row" v-if="seen">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="panel panel-default">
                            <div class="panel-heading">提示</div>
                            <div v-if="h_seen" class="panel-body">
                                横@{{  h_num }}: @{{ h_tip }}
                            </div>
                            <hr v-if="v_seen" style="margin:0">
                            <div v-if="v_seen" class="panel-body">
                                竖@{{  v_num }}: @{{ v_tip }}
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row text-center">
                    <input class="btn btn-primary" type="submit" value="提交">
                </div>
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script>
        var app = new Vue({
            el: '#app',
            data: {
                seen: false,
                h_seen: false,
                v_seen: false,
                h_tip: '',
                v_tip: '',
                h_num: '',
                v_num: '',
                cells: [{
                    'at': 2,
                    'h': [3],
                    'v': [12],
                    'h_num':1,
                    'v_num':'一',
                    'h_tip': '你好',
                    'v_tip': '很好',
                },
                    {
                        'at': 3,
                        'h': [2],
                        'v': [],
                        'h_num':1,
                        'v_num':'',
                        'h_tip': '你好',
                        'v_tip': '',
                    },
                    {
                        'at': 12,
                        'h': [],
                        'v': [2],
                        'h_num':'',
                        'v_num':'一',
                        'h_tip': '',
                        'v_tip': '很好',
                    }]
            },
            methods: {
                'show_tip': function (id) {
                    this.seen = true;
                    for (var i in this.cells){
                        if (this.cells[i].at === id){
                            if (this.cells[i].h_tip) {
                                this.h_tip = this.cells[i].h_tip;
                                this.h_num = this.cells[i].h_num;
                                this.h_seen = true;
                            }
                            if (this.cells[i].v_tip) {
                                this.v_tip = this.cells[i].v_tip;
                                this.v_num = this.cells[i].v_num;
                                this.v_seen = true;
                            }
                            $('#'+id).parent().addClass('warning');
                            var h = this.cells[i].h;
                            if (h){
                                for(var hi in h){
                                    $('#'+h[hi]).parent().addClass('info');
                                }
                            }
                            var v = this.cells[i].v;
                            if (v){
                                for(var vi in v){
                                    $('#'+v[vi]).parent().addClass('success');
                                }
                            }
                            break;
                        }
                    }

                },
                'hide_tip': function () {
                    this.seen = false;
                    this.h_seen = false;
                    this.v_seen = false;
                    this.h_tip = '';
                    this.v_tip = '';
                    $('td').removeClass();
                }
            }
        })
    </script>
@endsection

