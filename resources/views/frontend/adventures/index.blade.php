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
                <div class="panel-heading">
                    @{{ player.properties.name }}
                    <span class="badge" title="等级">@{{ player.properties.level }}</span>
                    <span class="badge" :title="player.phyle.description">@{{ player.phyle.name }}</span>
                </div>
                <div class="panel-body">
                    <div class="progress">
                        <div class="progress-bar progress-bar-primary progress-bar-striped" :style="'width: '+player_exp_percentage+'%'">
                            <span>@{{ player.properties.exp }}/@{{ level_setting[player.properties.level].exp }}</span>
                        </div>
                    </div>
                    <div class="progress">
                        <div :class="'progress-bar progress-bar-'+player_cls_percentage+' progress-bar-striped'" :style="'width: '+player_hp_percentage+'%'">
                            <span>@{{ player.hp }}/@{{ player.properties.hp }}</span>
                        </div>
                    </div>
                    <div style="margin-bottom: 15px">
                        <button class="btn btn-danger btn-sm mr" type="button">伤害<span class="badge">@{{ player.damage }}</span></button>
                        <button class="btn btn-danger btn-sm mr" type="button">攻击<span class="badge">@{{ player.attack }}</span></button>
                        <button class="btn btn-danger btn-sm mr" type="button">防御<span class="badge">@{{ player.defend }}</span></button>
                    </div>
                    <button class="btn btn-primary btn-sm mr" type="button">攻击<span class="badge">@{{ player.properties.attack }}</span></button>
                    <button class="btn btn-primary btn-sm mr" type="button">防御<span class="badge">@{{ player.properties.defend }}</span></button>
                    <button class="btn btn-primary btn-sm mr" type="button">闪避<span class="badge">@{{ player.properties.dodge }}</span></button>
                    <button class="btn btn-primary btn-sm mr" type="button">必杀<span class="badge">@{{ player.properties.kill }}</span></button>
                </div>
                <div class="panel-footer">
                    <span v-for="equipment in player.equipments" :key="equipment.id" :title="equipment.description" class="mr label label-primary">@{{ equipment.name }}</span>
                </div>
                <div class="panel-body">
                    <span v-for="ability in player.abilities" :key="ability.id" :title="ability.description" class="mr label label-warning">@{{ ability.name }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="panel panel-default"><div class="panel-body text-center" style="font-size: 3em">VS</div></div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    @{{ place_select_obj.name }}
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li v-for="(item,k) in this.place" :key="item.id"><a href="#" @click="place_select(k)">@{{ item.name }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body">@{{ place_select_obj.description }}</div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @{{ enemy.properties.name }}
                    <span class="badge" title="等级">@{{ enemy.properties.level }}</span>
                    <span class="badge" :title="enemy.phyle.description">@{{ enemy.phyle.name }}</span>
                </div>
                <div class="panel-body">
                    <div class="progress">
                        <div class="progress-bar progress-bar-primary progress-bar-striped" :style="'width: '+enemy_exp_percentage+'%'">
                            <span>@{{ enemy.exp }}/@{{ enemy.properties.exp }}</span>
                        </div>
                    </div>
                    <div class="progress">
                        <div :class="'progress-bar progress-bar-'+enemy_cls_percentage+' progress-bar-striped'" :style="'width: '+enemy_hp_percentage+'%'">
                            <span>@{{ enemy.hp }}/@{{ enemy.properties.hp }}</span>
                        </div>
                    </div>
                    <div style="margin-bottom: 15px">
                        <button class="btn btn-danger btn-sm mr" type="button">伤害<span class="badge">@{{ enemy.damage }}</span></button>
                        <button class="btn btn-danger btn-sm mr" type="button">攻击<span class="badge">@{{ enemy.attack }}</span></button>
                        <button class="btn btn-danger btn-sm mr" type="button">防御<span class="badge">@{{ enemy.defend }}</span></button>
                    </div>
                    <button class="btn btn-primary btn-sm mr" type="button">攻击<span class="badge">@{{ enemy.properties.attack }}</span></button>
                    <button class="btn btn-primary btn-sm mr" type="button">防御<span class="badge">@{{ enemy.properties.defend }}</span></button>
                    <button class="btn btn-primary btn-sm mr" type="button">闪避<span class="badge">@{{ enemy.properties.dodge }}</span></button>
                    <button class="btn btn-primary btn-sm mr" type="button">必杀<span class="badge">@{{ enemy.properties.kill }}</span></button>
                </div>
                <div class="panel-footer">
                    <span v-for="equipment in enemy.equipments" :key="equipment.id" :title="equipment.description" class="mr label label-primary">@{{ equipment.name }}</span>
                </div>
                <div class="panel-body">
                    <span v-for="ability in enemy.abilities" :key="ability.id" :title="ability.description" class="mr label label-warning">@{{ ability.name }}</span>
                </div>
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

        var kill_tpl = ' 触发了必杀,';
        var init_player = {'name':'singi','level':1,'exp':0,'hp':20,'attack':10,'defend':10,'dodge':5000,'kill':4000};

        var app = new Vue({
            el: '#app',
            data: {
                level_setting :[
                    {'level':1,'exp':0},
                    {'level':2,'exp':20},
                    {'level':3,'exp':50},
                    {'level':4,'exp':150},
                    {'level':5,'exp':350},
                    {'level':6,'exp':750},
                    {'level':7,'exp':1550},
                    {'level':8,'exp':3550},
                    {'level':9,'exp':13550},
                    {'level':10,'exp':1113550},
                    {'level':11,'exp':1113550},
                ],
                des : [],
                place : [
                    {'name':'起始之镇','description':'玩家游戏开始的地方','damage':1},
                    {'name':'荒漠平原','description':'一片荒凉的土地，马贼纵横','damage':10},
                ],
                place_select_obj : {'name':'起始之镇','description':'玩家游戏开始的地方','damage':1},
                player: {
                    hp : 20,
                    damage : 0,
                    attack : 0,
                    defend : 0,
                    passive_abilities:[
                        {'name':'闪避','attr':'dodge','description':'免受1次伤害','val':1000},
                        {'name':'必杀','attr':'kill','description':'造成3倍伤害','val':1000},
                    ],
                    phyle : {'name':'人类','description':'最常见的种族，各项能力都比较均衡','hp':10,'attack':5,'defend':5},
                    properties:{'name':'singi','level':1,'exp':0,'hp':20,'attack':10,'defend':10,'dodge':5000,'kill':4000},
                    abilities: [
                        {'name': '战吼','description':'常用的防御性技能,伤害+[30%,40%]','type':1,'damage':[30,40]},
                    ],
                    equipments: [
                        {'name': '短剑','type':1,'description':'普通的武器,攻击+[1,3]','attack':[1,3],'defend':[0,0]},
                        {'name': '布甲','type':2,'description':'普通的防具,防御+[1,3]','attack':[0,0],'defend':[1,3]}
                    ]
                },
                enemy: {
                    hp : 20,
                    damage : 0,
                    attack : 0,
                    defend : 0,
                    exp : 10,
                    phyle : {'name':'人类','description':'最常见的种族，各项能力都比较均衡','hp':10,'attack':5,'defend':5},
                    properties:{'name':'毒蛇','hp':20,'level':1,'exp':10,'attack':7,'defend':8,'dodge':1000,'kill':4000},
                    abilities: [
                        {'name': '战意','description':'本能,伤害+[1,2]倍','type':2,'damage':[30,40]},
                        {'name': '妖术','description':'一种妖术,伤害+[80,90]','type':1,'damage':[80,90]},
                    ],
                    equipments: [
                        {'name': '短剑','type':1,'description':'普通的武器,攻击+[1,3]','attack':[1,3],'defend':[0,0]},
                        {'name': '布甲','type':2,'description':'普通的防具,防御+[1,3]','attack':[0,0],'defend':[1,3]}
                    ]
                },
            },
            computed:{
                player_hp_percentage: function () {
                    return this.player.hp/this.player.properties.hp*100;
                },
                player_cls_percentage: function () {
                    var ret = 'danger';
                    var percentage = this.player.hp/this.player.properties.hp*100;
                    if (percentage > 70 && percentage <= 100) {
                        ret = 'success';
                    } else if (percentage > 30 && percentage <= 70) {
                        ret = 'info';
                    } else if (percentage > 10 && percentage <= 30) {
                        ret = 'warning';
                    }
                    return ret;
                },
                player_exp_percentage: function () {
                    return this.player.properties.exp/(this.level_setting[this.player.properties.level].exp)*100;
                },
                enemy_hp_percentage: function () {
                    return this.enemy.hp/this.enemy.properties.hp*100;
                },
                enemy_cls_percentage: function () {
                    var ret = 'danger';
                    var percentage = this.enemy.hp/this.enemy.properties.hp*100;
                    if (percentage > 70 && percentage <= 100) {
                        ret = 'success';
                    } else if (percentage > 30 && percentage <= 70) {
                        ret = 'info';
                    } else if (percentage > 10 && percentage <= 30) {
                        ret = 'warning';
                    }
                    return ret;
                },
                enemy_exp_percentage:function(){
                    return this.enemy.exp/this.enemy.properties.exp*100;
                }
            },
            methods:{
                p_is_dodge:function(){
                    return (randomNum(0,10000) <= app.player.properties.dodge);
                },
                e_is_dodge:function(){
                    return (randomNum(0,10000) <= app.enemy.properties.dodge);
                },
                place_select : function(i){
                    this.place_select_obj = this.place[i];
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

            stopIntervalIndex = setInterval(function(){
                //结束计算
                if (app.player.hp <=0 || app.enemy.hp <=0){
                    show('战斗结束');
                    if (app.player.hp <=0){
                        show(app.player.properties.name + '被击败了');
                    }
                    if (app.enemy.hp <=0) {
                        var is_level_up = app.player.properties.exp + app.enemy.properties.exp;
                        //是否升级
                        var level_des = '';
                        if (is_level_up >= app.level_setting[app.player.properties.level].exp){
                            //经验值先加满
                            app.player.properties.exp = app.level_setting[app.player.properties.level].exp;
                            app.player.properties.level +=1;
                            if (app.player.properties.level === app.level_setting[app.level_setting.length-2].level) {
                                end();
                                return false;
                            }
                            app.player.properties.exp = is_level_up;

                            app.player.properties.attack += app.player.phyle.attack;
                            app.player.properties.defend += app.player.phyle.defend;
                            level_des = ' 升级了,现在的等级是'+app.player.properties.level+',血量+'+app.player.phyle.hp+',攻击+'+app.player.phyle.attack+',防御+'+app.player.phyle.defend;
                        }else{
                            app.player.properties.exp = is_level_up;
                        }
                        app.enemy.exp = 0;
                        show(app.player.properties.name + '胜利了,获得经验值 '+app.enemy.properties.exp+level_des);
                    }

                    var count_down = 3;
                    stopIntervalIndex2 = setInterval(function(){
                        show('正在休息...('+count_down+')');
                        count_down -= 1;
                        if (count_down <=0){
                            app.player.properties.hp +=app.player.phyle.hp;
                            app.player.hp = app.player.properties.hp;
                            app.player.damage = 0;
                            app.player.attack = 0;
                            app.player.defend = 0;
                            app.enemy.damage = 0;
                            app.enemy.attack = 0;
                            app.enemy.defend = 0;
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

                //计算怪物闪避
                if (app.e_is_dodge()) {
                    show(app.player.properties.name +' 攻击了 ' + app.enemy.properties.name + ' 1次,但是被闪避');
                }else{
                    app.player.attack = app.player.properties.attack;
                    //计算装备加成
                    app.player.equipments.forEach(function(v){
                        if (v.attack[1] > 0){
                            app.player.attack += randomNum(v.attack[0],v.attack[1]);
                        }
                    });
                    app.enemy.defend = app.enemy.properties.defend;
                    //计算装备加成
                    app.enemy.equipments.forEach(function(v){
                        if (v.defend[1] > 0){
                            app.enemy.defend += randomNum(v.defend[0],v.defend[1]);
                        }
                    });
                    //计算基础伤害值
                    app.player.damage = app.player.attack - app.enemy.defend;
                    if (app.player.damage < 0)  app.player.damage = 0;
                    //计算技能伤害加成
                    var p_ability = app.player.abilities[randomNum(0,app.player.abilities.length-1)];
                    var p_ability_des = ' 使用了技能 '+p_ability.name+' ';
                    switch (p_ability.type){
                        case 1:
                            //百分比加成
                            if (p_ability.damage[1] > 0){
                                app.player.damage *= (1+randomNum(p_ability.damage[0],p_ability.damage[1])/100);
                                app.player.damage = Math.floor(app.player.damage);
                            }
                            break;
                        case 2:
                            //倍数加成
                            if (p_ability.damage[1] > 0){
                                app.player.damage *= randomNum(p_ability.damage[0],p_ability.damage[1]);
                            }
                            break;
                    }
                    //计算玩家必杀
                    var p_kill_des = '';
                    if (randomNum(0, 10000) <= app.player.properties.kill) {
                        app.player.damage *= 3;
                        p_kill_des = kill_tpl;
                    }
                    //玩家攻击
                    if (app.player.hp > 0) {
                        show(app.player.properties.name+ p_ability_des + p_kill_des + ' 攻击了 ' + app.enemy.properties.name + ' 1次,造成了 ' + app.player.damage + ' 点伤害');
                        app.enemy.hp -= app.player.damage;
                        if (app.enemy.hp < 0) app.enemy.hp = 0;
                    }
                }

                //计算玩家闪避
                if (app.p_is_dodge()) {
                    show(app.enemy.properties.name +' 攻击了 ' + app.player.properties.name + ' 1次,但是被闪避');
                }else{
                    app.enemy.attack = app.enemy.properties.attack;
                    //计算装备加成
                    app.enemy.equipments.forEach(function(v){
                        if (v.attack[1] > 0){
                            app.enemy.attack += randomNum(v.attack[0],v.attack[1]);
                        }
                    });
                    app.player.defend = app.player.properties.defend;
                    //计算装备加成
                    app.player.equipments.forEach(function(v){
                        if (v.defend[1] > 0){
                            app.player.defend += randomNum(v.defend[0],v.defend[1]);
                        }
                    });
                    //计算基础伤害值
                    app.enemy.damage = app.enemy.attack - app.player.defend;
                    if (app.enemy.damage < 0)  app.enemy.damage = 0;
                    //计算技能伤害加成
                    var e_ability = app.enemy.abilities[randomNum(0,app.enemy.abilities.length-1)];
                    var e_ability_des = ' 使用了技能 '+e_ability.name+' ';
                    switch (e_ability.type){
                        case 1:
                            //百分比加成
                            if (e_ability.damage[1] > 0){
                                app.enemy.damage *= (1+randomNum(e_ability.damage[0],e_ability.damage[1])/100);
                                app.enemy.damage = Math.floor(app.enemy.damage);
                            }
                            break;
                        case 2:
                            //倍数加成
                            if (e_ability.damage[1] > 0){
                                app.enemy.damage *= randomNum(e_ability.damage[0],e_ability.damage[1]);
                            }
                            break;
                    }
                    //计算怪物必杀
                    var e_kill_des = '';
                    if (randomNum(0,10000) <= app.enemy.properties.kill){
                        app.enemy.damage *= 3;
                        e_kill_des = kill_tpl;
                    }
                    //怪物攻击
                    if (app.enemy.hp > 0){
                        show(app.enemy.properties.name + e_ability_des + e_kill_des +' 攻击了 ' + app.player.properties.name + ' 1次,造成了 ' + app.enemy.damage + ' 点伤害');
                        app.player.hp -= app.enemy.damage;
                        if (app.player.hp < 0) app.player.hp = 0;
                    }
                }

                //如果双方伤害都为0，跳过此回合
                if (app.player.damage === 0 && app.enemy.damage === 0){
                    show('旗鼓相当的对手,重新开始...');
                    clear_show();
                    clearInterval(stopIntervalIndex);
                    app.player.damage = 0;
                    app.player.attack = 0;
                    app.player.defend = 0;
                    app.enemy.damage = 0;
                    app.enemy.attack = 0;
                    app.enemy.defend = 0;
                    fight();
                    return false;
                }
            },1000);
        }

        fight();

        function stop_fight(){
            app.player.damage = 0;
            app.player.attack = 0;
            app.player.defend = 0;
            app.enemy.damage = 0;
            app.enemy.attack = 0;
            app.enemy.defend = 0;
            clearInterval(stopIntervalIndex);
            clearInterval(stopIntervalIndex2);
            app.player.properties = init_player;
            find_enemy();
            app.player.hp = app.player.properties.hp;
            clear_show();
            localStorage.clear();
            fight();
        }

        function end() {
            app.player.damage = 0;
            app.player.attack = 0;
            app.player.defend = 0;
            app.enemy.damage = 0;
            app.enemy.attack = 0;
            app.enemy.defend = 0;
            clearInterval(stopIntervalIndex);
            clearInterval(stopIntervalIndex2);
            clear_show();
            show('你已成王!!!');
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
            app.enemy.properties.level = randomNum(1,app.player.properties.level+5);
            app.enemy.exp = app.enemy.properties.exp = randomNum(1,app.level_setting[app.player.properties.level].exp);
            app.enemy.hp = app.enemy.properties.hp = randomNum(1,app.player.properties.hp+10);
            app.enemy.properties.attack = randomNum(1,app.player.properties.attack+5);
            app.enemy.properties.defend = randomNum(1,app.player.properties.defend+5);
            app.enemy.phyle = {'name':'人类','description':'最常见的种族，各项能力都比较均衡','hp':10,'attack':5,'defend':5};
            app.enemy.abilities = [
                {'name': '战意','description':'本能,伤害+[1,2]倍','type':2,'damage':[30,40]},
                {'name': '妖术','description':'一种妖术,伤害+[80,90]','type':1,'damage':[80,90]},
            ];
            app.enemy.equipments = [
                {'name': '短剑','type':1,'description':'普通的武器,攻击+[1,3]','attack':[1,3],'defend':[0,0]},
                {'name': '布甲','type':2,'description':'普通的防具,防御+[1,3]','attack':[0,0],'defend':[1,3]}
            ];
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
            return familyNames[randomNum(0,familyNames.length-1)] + givenNames[randomNum(0,givenNames.length-1)];
        }
    </script>
@endsection


