@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading">玩家</div>

                <div class="panel-body">
                    <button class="btn btn-primary" type="button">攻击力 <span class="badge">10</span></button>
                    <button class="btn btn-primary" type="button">防御力 <span class="badge">10</span></button>
                    <button class="btn btn-primary" type="button">闪避 <span class="badge">1000</span></button>
                    <button class="btn btn-primary" type="button">必杀 <span class="badge">1000</span></button>
                </div>
                <div class="panel-footer">
                    <span class="label label-default">格挡</span>
                    <span class="label label-primary">突刺</span>
                    <span class="label label-success">飞刀</span>
                    <span class="label label-info">奋力一击</span>
                    <span class="label label-warning">Warning</span>
                    <span class="label label-danger">Danger</span>
                </div>
                <div class="panel-body">
                    <span class="label label-default">短剑</span>
                    <span class="label label-primary">布甲</span>
                    <span class="label label-success">皮盾</span>
                    <span class="label label-info">披风</span>
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
                <div class="panel-heading">怪物</div>
                <div class="panel-body">
                    <button class="btn btn-primary" type="button">攻击力 <span class="badge">10</span></button>
                    <button class="btn btn-primary" type="button">防御力 <span class="badge">10</span></button>
                    <button class="btn btn-primary" type="button">闪避 <span class="badge">1000</span></button>
                    <button class="btn btn-primary" type="button">必杀 <span class="badge">1000</span></button>
                </div>
                <div class="panel-footer">
                    <span class="label label-success">毒液喷刺</span>
                </div>
                <div class="panel-body">
                    <span class="label label-success">毒液</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">战斗</div>

                <div class="panel-body">
                    战斗开始...
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


