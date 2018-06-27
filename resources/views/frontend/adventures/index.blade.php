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
                <div class="panel-heading">@{{ player.properties.name }}</div>
                <div class="panel-body">
                    <div class="progress">
                        <div :class="'progress-bar progress-bar-'+player_cls_percentage+' progress-bar-striped'" :style="'width: '+player_hp_percentage+'%'">
                            <span>@{{ player.curr_hp }}</span>
                        </div>
                    </div>
                    <button class="btn btn-primary mr" type="button">攻击<span class="badge">@{{ player.properties.attack }}</span></button>
                    <button class="btn btn-primary mr" type="button">防御<span class="badge">@{{ player.properties.defend }}</span></button>
                    <button class="btn btn-primary mr" type="button">闪避<span class="badge">@{{ player.properties.dodge }}</span></button>
                    <button class="btn btn-primary mr" type="button">必杀<span class="badge">@{{ player.properties.kill }}</span></button>
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
                <div class="panel-heading">@{{ enemy.properties.name }}</div>
                <div class="panel-body">
                    <div class="progress">
                        <div :class="'progress-bar progress-bar-'+enemy_cls_percentage+' progress-bar-striped'" :style="'width: '+enemy_hp_percentage+'%'">
                            <span>@{{ enemy.curr_hp }}</span>
                        </div>
                    </div>
                    <button class="btn btn-primary mr" type="button">攻击<span class="badge">@{{ enemy.properties.attack }}</span></button>
                    <button class="btn btn-primary mr" type="button">防御<span class="badge">@{{ enemy.properties.defend }}</span></button>
                    <button class="btn btn-primary mr" type="button">闪避<span class="badge">@{{ enemy.properties.dodge }}</span></button>
                    <button class="btn btn-primary mr" type="button">必杀<span class="badge">@{{ enemy.properties.kill }}</span></button>
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
    <div class="row navbar-fixed-bottom text-center" style="margin-bottom: 20px">
        <button onclick="stop_fight()" class="btn btn-primary">重新开始</button>
    </div>
</div>
@endsection

@section('script')
    <script>

        var stopIntervalIndex,stopIntervalIndex2;

        var app = new Vue({
            el: '#app',
            data: {
                des : [],
                player: {
                    curr_hp : 20,
                    damage : 0,
                    properties:{'name':'singi','hp':20,'attack':10,'defend':10,'dodge':1000,'kill':1000},
                    abilities: [
                        {'name': '格挡','type':'主动','description':'常用的防御性技能','attack':0,'defend':3},
                    ],
                    equipments: [
                        {'name': '短剑','type':'武器','description':'普通的武器','attack':1,'defend':0},
                        {'name': '布甲','type':'护甲','description':'普通的武器','attack':0,'defend':1}
                    ]
                },
                enemy: {
                    curr_hp : 20,
                    damage : 0,
                    properties:{'name':'毒蛇','hp':20,'attack':7,'defend':8,'dodge':1000,'kill':1000},
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
                    return this.player.curr_hp/this.player.properties.hp*100;
                },
                player_cls_percentage: function () {
                    var ret = 'danger';
                    var percentage = this.player.curr_hp/this.player.properties.hp*100;
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
                    return this.enemy.curr_hp/this.enemy.properties.hp*100;
                },
                enemy_cls_percentage: function () {
                    var ret = 'danger';
                    var percentage = this.enemy.curr_hp/this.enemy.properties.hp*100;
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
                    return this.enemy.properties.attack - this.player.properties.attack;
                },
                enemy_damage:function(){
                    return this.player.properties.attack - this.enemy.properties.attack;
                }
            }
        });

        function fight(){
            show('正在寻找敌人...');

            var player_data = localStorage.getItem('player');
            if (player_data) app.player = JSON.parse(player_data);

            find_enemy();
            show('遇到敌人'+app.enemy.properties.name);

            show(app.player.properties.name + ' vs ' + app.enemy.properties.name+',战斗开始...');
            //计算基础伤害值
            app.player.damage = app.player.properties.attack - app.enemy.properties.defend;
            if (app.player.damage < 0)  app.player.damage = 0;
            app.enemy.damage = app.enemy.properties.attack - app.player.properties.defend;
            if (app.enemy.damage < 0)  app.enemy.damage = 0;

            if (app.player.damage == 0 && app.enemy.damage == 0){
                show('旗鼓相当的对手,重新开始...');
                fight();
                return false;
            }

            stopIntervalIndex = setInterval(function(){
                if (app.player.curr_hp <=0 || app.enemy.curr_hp <=0){
                    show('战斗结束');
                    if (app.player.curr_hp <=0){
                        show(app.player.name + '被击败了');
                    }
                    if (app.enemy.curr_hp <=0) {
                        app.player.properties.attack += 5;
                        app.player.properties.defend += 5;
                        show(app.player.name + '胜利了,'+app.player.properties.attack+'+5,'+app.player.properties.defend+'+5');
                    }

                    var count_down = 3;
                    stopIntervalIndex2 = setInterval(function(){
                        show('正在休息...('+count_down+')');
                        count_down -= 1;
                        if (count_down <=0){
                            app.player.properties.hp +=10;
                            app.player.curr_hp = app.player.properties.hp;
                            localStorage.setItem('player',JSON.stringify(app.player));
                            //TODO 更新服务器数据
                            clear_show();
                            clearInterval(stopIntervalIndex2);
                            fight();
                        }
                    },1000);
                    clearInterval(stopIntervalIndex);
                    return false;
                }

                //计算闪避
                if (randomNum(0,10000) <= app.player.properties.dodge) app.enemy.damage = 0;
                if (randomNum(0,10000) <= app.enemy.properties.dodge) app.player.damage = 0;

                //计算必杀
                var kill_des = '';
                if (randomNum(0,10000) <= app.player.properties.kill){
                    app.player.damage *= 3;
                    kill_des = ',触发了必杀';
                }
                if (randomNum(0,10000) <= app.enemy.properties.kill){
                    app.enemy.damage *= 3;
                    kill_des = ',触发了必杀';
                }
                
                show(app.player.properties.name + ' 攻击了 ' + app.enemy.properties.name + ' 1次,造成了 ' + app.player.damage + ' 点伤害'+kill_des);
                app.enemy.curr_hp -= app.player.damage;
                if (app.enemy.curr_hp < 0) app.enemy.curr_hp = 0;

                show(app.enemy.properties.name + ' 攻击了 ' + app.player.properties.name + ' 1次,造成了 ' + app.enemy.damage + ' 点伤害'+kill_des);
                app.player.curr_hp -= app.enemy.damage;
                if (app.player.curr_hp < 0) app.player.curr_hp = 0;
            },1000);
        }

        fight();

        function stop_fight(){
            localStorage.clear();
            clearInterval(stopIntervalIndex);
            clearInterval(stopIntervalIndex2);
            fight();
        }

        function show(des){
            app.des.unshift(des);
        }
        function clear_show(){
            app.des = [];
        }
        //获取敌人
        function find_enemy(){
            app.enemy.properties.name = getName();
            app.enemy.curr_hp = app.enemy.properties.hp = randomNum(1,app.player.properties.hp+10);
            app.enemy.properties.attack = randomNum(1,app.player.properties.attack+10);
            app.enemy.properties.defend = randomNum(1,app.player.properties.defend+10);
        }
        //生成从[min,max]的随机数
        function randomNum(min, max) {
            min = Math.ceil(min*1);
            max = Math.floor(max*1);
            return Math.floor(Math.random() * (max - min + 1)) + min;
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


