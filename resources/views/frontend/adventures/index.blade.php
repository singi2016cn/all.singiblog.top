@extends('layouts.app')

@section('style')
    <style>
        .mr{margin-right: 2px}
    </style>
@endsection

@section('content')
<div class="container" id="app">
    <div class="row">
        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading">@{{ player.name }}</div>
                <div class="panel-body">
                    <div class="progress">
                        <div class="progress-bar progress-bar-success progress-bar-striped" :style="'width: '+palyer_hp_percentage+'%'">
                            <span>@{{ player.curr_hp }}</span>
                        </div>
                    </div>
                    <button v-for="attributes in player.attributes" class="btn btn-primary mr" type="button">@{{ attributes.attr }} <span class="badge">@{{ attributes.val }}</span></button>
                </div>
                <div class="panel-footer">
                    <span v-for="ability in player.abilities" :class="'mr label label-'+ability.cls">@{{ ability.val }}</span>
                </div>
                <div class="panel-body">
                    <span v-for="equipment in player.equipments" :class="'mr label label-'+equipment.cls">@{{ equipment.val }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="panel panel-default">
                <div class="panel-body text-center" style="font-size: 3em">VS</div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading">@{{ enemy.name }}</div>
                <div class="panel-body">
                    <div class="progress">
                        <div class="progress-bar progress-bar-success progress-bar-striped" :style="'width: '+enemy_hp_percentage+'%'">
                            <span>@{{ enemy.curr_hp }}</span>
                        </div>
                    </div>
                    <button v-for="attributes in enemy.attributes" class="btn btn-primary mr" type="button">@{{ attributes.attr }} <span class="badge">@{{ attributes.val }}</span></button>
                </div>
                <div class="panel-footer">
                    <span v-for="ability in enemy.abilities" :class="'mr label label-'+ability.cls">@{{ ability.val }}</span>
                </div>
                <div class="panel-body">
                    <span v-for="equipment in enemy.equipments" :class="'mr label label-'+equipment.cls">@{{ equipment.val }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">战斗</div>

                <div class="panel-body" id="fight">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        var app = new Vue({
            el: '#app',
            data: {
                des : '战斗开始...',
                player: {
                    name : 'singi',
                    hp : 30,
                    curr_hp : 30,
                    damage : 0,
                    attributes: [
                        {'attr':'攻击力','val': 10},
                        {'attr':'防御力','val': 5},
                        {'attr':'闪避','val': 1000},
                        {'attr':'必杀','val': 100}
                    ],
                    abilities: [
                        {'cls':'default','val': '格挡'},
                        {'cls':'primary','val': '突刺'},
                        {'cls':'success','val': '飞刀'},
                        {'cls':'info','val': '奋力一击'},
                        {'cls':'warning','val': '龙翔'},
                        {'cls':'danger','val': '冲锋'}
                    ],
                    equipments: [
                        {'cls':'default','val': '短剑'},
                        {'cls':'primary','val': '布甲'},
                        {'cls':'success','val': '皮盾'},
                        {'cls':'info','val': '披风'},
                    ]
                },
                enemy: {
                    name : '毒蛇',
                    hp : 20,
                    curr_hp : 20,
                    damage : 0,
                    attributes: [
                        {'attr':'攻击力','val': 7},
                        {'attr':'防御力','val': 8},
                        {'attr':'闪避','val': 1000},
                        {'attr':'必杀','val': 100}
                    ],
                    abilities: [
                        {'cls':'default','val': '毒液喷刺'},
                    ],
                    equipments: [
                        {'cls':'default','val': '毒液'},
                    ]
                },
            },
            computed:{
                palyer_hp_percentage: function () {
                    return this.player.curr_hp/this.player.hp*100;
                },
                enemy_hp_percentage: function () {
                    return this.enemy.curr_hp/this.enemy.hp*100;
                },
            },
            method:{
                player_damage:function(){
                    return this.enemy.attributes[0].val - this.player.attributes[1].val;
                },
                enemy_damage:function(){
                    return this.player.attributes[0].val - this.enemy.attributes[1].val;
                }
            }
        })


        show('战斗开始...');
        show(app.player.name + ' vs ' + app.enemy.name);

        app.player.damage = app.enemy.attributes[0].val - app.player.attributes[1].val;
        app.enemy.damage = app.player.attributes[0].val - app.enemy.attributes[1].val;


        var stopIntervalIndex = setInterval(function(){
            if (app.player.curr_hp <=0 || app.enemy.curr_hp <=0){
                show('战斗结束');
                clear();
                clearInterval(stopIntervalIndex);
                return false;
            }
            show(app.player.name + ' 攻击了 ' + app.enemy.name + ' 1次,造成了 ' + app.player.damage + ' 点伤害');
            app.player.curr_hp -= app.enemy.damage;
        },1000);

        function show(des){
            $('#fight').append('<p>'+des+'</p>');
        }
        function clear(){
            $('#fight').empty();
        }
    </script>
@endsection


