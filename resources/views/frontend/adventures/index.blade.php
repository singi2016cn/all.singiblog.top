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
                        <div :class="'progress-bar progress-bar-'+player_cls_percentage+' progress-bar-striped'" :style="'width: '+player_hp_percentage+'%'">
                            <span>@{{ player.curr_hp }}</span>
                        </div>
                    </div>
                    <button v-for="attributes in player.attributes" class="btn btn-primary mr" type="button">@{{ attributes.attr }} <span class="badge">@{{ attributes.val }}</span></button>
                </div>
                {{--<div class="panel-footer">
                    <span v-for="ability in player.abilities" :class="'mr label label-'+ability.cls">@{{ ability.val }}</span>
                </div>
                <div class="panel-body">
                    <span v-for="equipment in player.equipments" :class="'mr label label-'+equipment.cls">@{{ equipment.val }}</span>
                </div>--}}
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
                        <div :class="'progress-bar progress-bar-'+enemy_cls_percentage+' progress-bar-striped'" :style="'width: '+enemy_hp_percentage+'%'">
                            <span>@{{ enemy.curr_hp }}</span>
                        </div>
                    </div>
                    <button v-for="attributes in enemy.attributes" class="btn btn-primary mr" type="button">@{{ attributes.attr }} <span class="badge">@{{ attributes.val }}</span></button>
                </div>
               {{-- <div class="panel-footer">
                    <span v-for="ability in enemy.abilities" :class="'mr label label-'+ability.cls">@{{ ability.val }}</span>
                </div>
                <div class="panel-body">
                    <span v-for="equipment in enemy.equipments" :class="'mr label label-'+equipment.cls">@{{ equipment.val }}</span>
                </div>--}}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">战斗</div>

                <div class="panel-body" id="fight">
                    <p v-for="i in des">@{{ i }}</p>
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
                des : [],
                player: {
                    name : 'singi',
                    hp : 200,
                    curr_hp : 200,
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
                player_hp_percentage: function () {
                    return this.player.curr_hp/this.player.hp*100;
                },
                player_cls_percentage: function () {
                    var ret = 'danger';
                    var percentage = this.player.curr_hp/this.player.hp*100;
                    if (percentage > 70 && percentage <= 100) {
                        ret = 'success';
                    } else if (percentage > 30 && percentage <= 70) {
                        ret = 'info';
                    } else if (percentage > 10 && percentage <= 30) {
                        ret = 'warning';
                    }
                    return ret;
                },
                enemy_hp_percentage: function () {
                    return this.enemy.curr_hp/this.enemy.hp*100;
                },
                enemy_cls_percentage: function () {
                    var ret = 'danger';
                    var percentage = this.enemy.curr_hp/this.enemy.hp*100;
                    if (percentage > 70 && percentage <= 100) {
                        ret = 'success';
                    } else if (percentage > 30 && percentage <= 70) {
                        ret = 'info';
                    } else if (percentage > 10 && percentage <= 30) {
                        ret = 'warning';
                    }
                    return ret;
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
        });

        function fight(){
            show('正在寻找敌人...');

            var player_data = localStorage.getItem('player');
            if (player_data) app.player = JSON.parse(player_data);

            find_enemy();
            show('遇到敌人'+app.enemy.name);

            show(app.player.name + ' vs ' + app.enemy.name+',战斗开始...');

            app.player.damage = app.player.attributes[0].val - app.enemy.attributes[1].val;
            if (app.player.damage < 0)  app.player.damage = 0;
            app.enemy.damage = app.enemy.attributes[0].val - app.player.attributes[1].val;
            if (app.enemy.damage < 0)  app.enemy.damage = 0;

            var stopIntervalIndex = setInterval(function(){
                if (app.player.curr_hp <=0 || app.enemy.curr_hp <=0){
                    show('战斗结束');
                    if (app.player.curr_hp <=0){
                        show(app.player.name + '被击败了');
                    }
                    if (app.enemy.curr_hp <=0) {
                        app.player.attributes[0].val += 5;
                        app.player.attributes[1].val += 5;
                        show(app.player.name + '胜利了,'+app.player.attributes[0].attr+'+5,'+app.player.attributes[1].attr+'+5');
                    }
                    localStorage.setItem('player',JSON.stringify(app.player));
                    clearInterval(stopIntervalIndex);

                    setInterval(function(){show('正在休息...')},1000);

                    setTimeout(function () {
                        location.reload();
                    },3000);
                    return false;
                }
                show(app.player.name + ' 攻击了 ' + app.enemy.name + ' 1次,造成了 ' + app.player.damage + ' 点伤害');
                app.player.curr_hp -= app.enemy.damage;
                if (app.player.curr_hp < 0) app.player.curr_hp = 0;

                show(app.enemy.name + ' 攻击了 ' + app.player.name + ' 1次,造成了 ' + app.enemy.damage + ' 点伤害');
                app.enemy.curr_hp -= app.player.damage;
                if (app.enemy.curr_hp < 0) app.enemy.curr_hp = 0;
            },1000);
        }

        fight();

        function show(des){
            app.des.unshift(des);
        }
        function find_enemy(){
            app.enemy.name = getName();
            app.enemy.attributes[0].val = randomNum(1,10);
            app.enemy.attributes[1].val = randomNum(1,10);
        }
        //生成从minNum到maxNum的随机数
        function randomNum(minNum,maxNum){
            switch(arguments.length){
                case 1:
                    return parseInt(Math.random()*minNum+1,10);
                    break;
                case 2:
                    return parseInt(Math.random()*(maxNum-minNum+1)+minNum,10);
                    break;
                default:
                    return 0;
                    break;
            }
        }
        function getName(){
            var familyNames = [
                "赵", "钱", "孙", "李", "周", "吴", "郑", "王", "冯", "陈",
                "褚", "卫", "蒋", "沈", "韩", "杨", "朱", "秦", "尤", "许",
                "何", "吕", "施", "张", "孔", "曹", "严", "华", "金", "魏",
                "陶", "姜", "戚", "谢", "邹", "喻", "柏", "水", "窦", "章",
                "云", "苏", "潘", "葛", "奚", "范", "彭", "郎", "鲁", "韦",
                "昌", "马", "苗", "凤", "花", "方", "俞", "任", "袁", "柳",
                "酆", "鲍", "史", "唐", "费", "廉", "岑", "薛", "雷", "贺",
                "倪", "汤", "滕", "殷", "罗", "毕", "郝", "邬", "安", "常",
                "乐", "于", "时", "傅", "皮", "卞", "齐", "康", "伍", "余",
                "元", "卜", "顾", "孟", "平", "黄", "和", "穆", "萧", "尹"
            ];
            var givenNames = [
                "子璇", "淼", "国栋", "夫子", "瑞堂", "甜", "敏", "尚", "国贤", "贺祥", "晨涛",
                "昊轩", "易轩", "益辰", "益帆", "益冉", "瑾春", "瑾昆", "春齐", "杨", "文昊",
                "东东", "雄霖", "浩晨", "熙涵", "溶溶", "冰枫", "欣欣", "宜豪", "欣慧", "建政",
                "美欣", "淑慧", "文轩", "文杰", "欣源", "忠林", "榕润", "欣汝", "慧嘉", "新建",
                "建林", "亦菲", "林", "冰洁", "佳欣", "涵涵", "禹辰", "淳美", "泽惠", "伟洋",
                "涵越", "润丽", "翔", "淑华", "晶莹", "凌晶", "苒溪", "雨涵", "嘉怡", "佳毅",
                "子辰", "佳琪", "紫轩", "瑞辰", "昕蕊", "萌", "明远", "欣宜", "泽远", "欣怡",
                "佳怡", "佳惠", "晨茜", "晨璐", "运昊", "汝鑫", "淑君", "晶滢", "润莎", "榕汕",
                "佳钰", "佳玉", "晓庆", "一鸣", "语晨", "添池", "添昊", "雨泽", "雅晗", "雅涵",
                "清妍", "诗悦", "嘉乐", "晨涵", "天赫", "玥傲", "佳昊", "天昊", "萌萌", "若萌"
            ];
            var i = randomNum(0,familyNames.length);
            var familyName = familyNames[i];
            var j = randomNum(0,givenNames.length);
            var givenName = givenNames[i];
            var name = familyName + givenName;
            return name;
        }
    </script>
@endsection


