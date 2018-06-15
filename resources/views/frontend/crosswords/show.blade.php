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
        .pst-span-b {
            position: absolute;
            bottom: -5px;
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
                            @foreach(json_decode($crosswords,true) as $crossword)
                                @if($crossword['is_h'] == 1)
                                    <div class="panel panel-default"  id="panel{{ $crossword['id'] }}">
                                        <div class="panel-heading">
                                            <div class="input-group">
                                                <span class="input-group-addon">{{ $crossword['seq'] }}</span>
                                                <input @click="focus_panel({{ $crossword['id'] }})" @blur="focus_out" @change="fill_cell({{ $crossword['id'] }})" type="text" name="word{{ $crossword['id'] }}" id="word{{ $crossword['id'] }}" class="form-control" maxlength="{{ count($crossword['cell_ids']) }}" placeholder="">
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            {{ $crossword['tip'] }}
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default panel-primary">
                            <div class="panel-heading">{{ $crosswords_counts->des }}</div>
                            <table class="table table-bordered">
                                <tr v-for="n in ns">
                                    <td v-for="m in 10" class="pst" :class="{'bg-black':!cell_exist_ids.includes(m+n)}">
                                        <span class="pst-span text-primary" v-if="cell0_exist_ids.includes(m+n)">@{{words_v[cell0_exist_ids.indexOf(m+n)].seq}}</span>
                                        <span class="pst-span-b text-danger" v-if="cell_b_exist_ids.includes(m+n)">@{{words_h[cell_b_exist_ids.indexOf(m+n)].seq}}</span>
                                        <input v-if="cell_exist_ids.includes(m+n)" @click="focus_cell(m+n)" @blur="focus_out()" @change="set_panel_input(m+n)" type="text" :name="m+n" :id="m+n" class="form-control" minlength="1" maxlength="1">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            @foreach(json_decode($crosswords,true) as $crossword)
                                @if($crossword['is_h'] == 0)
                                    <div class="panel panel-default"  id="panel{{ $crossword['id'] }}">
                                        <div class="panel-heading">
                                            <div class="input-group">
                                                <span class="input-group-addon">{{ $crossword['seq'] }}</span>
                                                <input @click="focus_panel({{ $crossword['id'] }})" @blur="focus_out" @change="fill_cell({{ $crossword['id'] }})" type="text" name="word{{ $crossword['id'] }}" id="word{{ $crossword['id'] }}" class="form-control" maxlength="{{ count($crossword['cell_ids']) }}" placeholder="">
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            {{ $crossword['tip'] }}
                                        </div>
                                    </div>
                                @endif
                            @endforeach
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
                'cell_exist_ids':[{!! implode(',',$cell_exist_ids) !!}],//所有有值的单元格
                'cell0_exist_ids':[{!! implode(',',$cell0_exist_ids) !!}],//所有有值单元格的第1个
                'cell_b_exist_ids':[{!! implode(',',$cell_b_exist_ids) !!}],//所有有值单元格的第1个
                'words':{!! $crosswords !!},
                'words_h':{!! $crosswords_h !!},
                'words_v':{!! $crosswords_v !!},
            },
            methods: {
                'focus_cell': function (id) {
                    if (this.words && id>0){
                        this.words.forEach(function(v){
                            if (v.cell_ids.includes(id+'')){
                                var cls = 'info';
                                if (v.is_h == true) cls = 'success';
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
                    $('td').removeClass('success info warning');
                    $('div.panel').removeClass('panel-success panel-info');
                },
                'focus_panel': function (id) {
                    if (this.words && id>0){
                        this.words.forEach(function(v){
                            if (v.id === id){
                                var cls = 'info';
                                if (v.is_h == true) cls = 'success';
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
                            if (v.cell_ids.includes(id+'')){
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
    </script>
@endsection

