@extends('layouts.app')

@section('style')
    <style>
        td {
            width: 50px;
        }
        .pst{
            position:relative;
        }
        .pst-span {
            position: absolute;
            top: -5px;
            left: 0;
        }
        .bg-black{
            background-color: gray;
        }
    </style>
@endsection

@section('content')
    <div id="app" style="margin-top: 20px">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="row">
                            <div class="panel panel-default" v-for="word in words" v-if="word.is_h === true" :id="'panel'+word.id">
                                <div class="panel-heading">
                                    <div class="input-group">
                                        <span class="input-group-addon">@{{ word.seq }}</span>
                                        <input @click="focus_panel(word.id)" @blur="focus_out" @change="fill_cell(word.id)" type="text" :name="'word'+word.id" :id="'word'+word.id" class="form-control" :maxlength="word.cell_ids.length" placeholder="">
                                    </div>
                                </div>
                                <div class="panel-body">
                                    @{{ word.tip }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">龙争虎斗</div>
                            <table class="table table-bordered">
                                <tr v-for="n in ns">
                                    <td v-for="m in 10" class="pst" :class="{'bg-black':!cell_exist_ids.includes(m+n)}">
                                        <span class="pst-span" v-if="cell0_exist_ids.includes(m+n)">@{{words[cell0_exist_ids.indexOf(m+n)].seq}}</span>
                                        <input v-if="cell_exist_ids.includes(m+n)" @click="focus_cell(m+n)" @blur="focus_out()" @change="set_panel_input(m+n)" type="text" :name="m+n" :id="m+n" class="form-control" minlength="1" maxlength="1">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="panel panel-default" v-for="word in words" v-if="word.is_h === false" :id="'panel'+word.id">
                                <div class="panel-heading">
                                    <div class="input-group">
                                        <span class="input-group-addon">@{{ word.seq }}</span>
                                        <input @click="focus_panel(word.id)" @blur="focus_out" @change="fill_cell(word.id)" type="text" :name="'word'+word.id" :id="'word'+word.id" class="form-control" :maxlength="word.cell_ids.length" placeholder="">
                                    </div>
                                </div>
                                <div class="panel-body">
                                    @{{ word.tip }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <hr>
        <div class="row text-center">
            <div class="btn btn-primary" @click="sub()">提交</div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        var app = new Vue({
            el: '#app',
            data: {
                'ns':[0,10,20,30,40,50,60,70,80,90],
                'cell_exist_ids':[2,3,13],//所有有值的单元格
                'cell0_exist_ids':[2,3],//所有有值单元格的第1个
                'words':[{
                    'id':1,
                    'is_h':true,
                    'tip':'你好',
                    'seq':'1',
                    'cell_ids':[2,3]
                },{
                    'id':2,
                    'is_h':false,
                    'tip':'你好',
                    'seq':'一',
                    'cell_ids':[3,13]
                }],
            },
            methods: {
                'focus_cell': function (id) {
                    if (this.words && id>0){
                        this.words.forEach(function(v){
                            if (v.cell_ids.includes(id)){
                                var cls = 'info';
                                if (v.is_h === true) cls = 'success';
                                if (v.cell_ids){
                                    v.cell_ids.forEach(function(v){
                                        $('#'+v).parent().addClass(cls);
                                    });
                                }
                                $('#'+id).parent().addClass('warning');
                                $('#panel'+v.id).addClass('panel-'+cls);
                            }
                        })
                    }
                },

                'focus_out': function () {
                    $('td').removeClass();
                    $('div.panel').removeClass('panel-success panel-info');
                },
                'focus_panel': function (id) {
                    if (this.words && id>0){
                        this.words.forEach(function(v){
                            if (v.id === id){
                                var cls = 'info';
                                if (v.is_h === true) cls = 'success';
                                if (v.cell_ids){
                                    v.cell_ids.forEach(function(v){
                                        $('#'+v).parent().addClass(cls);
                                    })
                                }
                                $('#panel'+v.id).addClass('panel-'+cls);
                            }
                        })
                    }
                },
                'fill_cell':function(id){
                    if (id < 1) return false;
                    var word = $('#word'+id).val();
                    if (word){
                        if (this.words){
                            this.words.forEach(function(v){
                                if (v.id === id){
                                    if (v.cell_ids){
                                        v.cell_ids.forEach(function(v,i){
                                            $('#'+v).val(word[i]);
                                        })
                                    }
                                    v.word = word;
                                }
                            })
                        }
                    }
                },
                'set_panel_input':function(id){
                    if (this.words && id>0){
                        this.words.forEach(function(v){
                            if (v.cell_ids.includes(id)){
                                var word = '';
                                v.cell_ids.forEach(function(v){
                                    word += $('#'+v).val();
                                });
                                $('#word'+v.id).val(word);
                                v.word = word;
                            }
                        })
                    }
                },
                'sub':function(){
                    console.log(this.words);
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "POST",
                        url: '{{ route('crosswords.check') }}',
                        data: {words:this.words},
                        success: function(res){
                            console.log(res);
                        },
                        dataType: 'json'
                    });
                }
            }
        })

        function sub(){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: '{{ route('crosswords.check') }}',
                data: {words:this.words},
                success: function(res){
                    console.log(res);
                },
                dataType: 'json'
            });
        }
    </script>
@endsection

