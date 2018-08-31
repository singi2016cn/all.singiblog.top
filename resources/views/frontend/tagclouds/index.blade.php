@extends('layouts.app')

@section('description')词云图展示有趣的数据@endsection
@section('keywords')词云图,数据,图表@endsection
@section('title')词云图@endsection

@section('style')
    <style>

    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="tagcloud-panel" class="panel panel-default">
                    <div class="panel-heading">
                        我的技能
                    </div>
                    <div class="panel-body">
                        <div id="mountNode" style="width: 100%"></div>
                    </div>
                    <div class="panel-footer">
                        <div class="social-share" data-image=""></div>
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

            },
        });
    </script>
    <script>/*Fixing iframe window.innerHeight 0 issue in Safari*/document.body.clientHeight;</script>
    <script src="https://gw.alipayobjects.com/os/antv/pkg/_antv.g2-3.2.7/dist/g2.min.js"></script>
    <script src="https://gw.alipayobjects.com/os/antv/pkg/_antv.data-set-0.8.9/dist/data-set.min.js"></script>
    <script>
        function getTextAttrs(cfg) {
            return _.assign({}, {
                fillOpacity: cfg.opacity,
                fontSize: cfg.origin._origin.size,
                rotate: cfg.origin._origin.rotate,
                text: cfg.origin._origin.text,
                textAlign: 'center',
                fontFamily: cfg.origin._origin.font,
                fill: cfg.color,
                textBaseline: 'Alphabetic'
            }, cfg.style);
        }

        // 给point注册一个词云的shape
        G2.Shape.registerShape('point', 'cloud', {
            drawShape: function drawShape(cfg, container) {
                var attrs = getTextAttrs(cfg);
                return container.addShape('text', {
                    attrs: _.assign(attrs, {
                        x: cfg.x,
                        y: cfg.y
                    })
                });
            }
        });
        var data = [
            {"value":999,"name":"Singi"},
            {"value":500,"name":"PHP"},
            {"value":450,"name":"Laravel-5.5.*"},
            {"value":400,"name":"ThinkPHP-5.*"},
            {"value":300,"name":"Jquery"},
            {"value":300,"name":"PHPStorm"},
            {"value":200,"name":"CentOS"},
            {"value":200,"name":"Swoole"},
            {"value":300,"name":"N3"},
            {"value":400,"name":"CET4"},
            {"value":400,"name":"http://all.singiblog.top"},
            {"value":300,"name":"http://hjly168.com"},
            {"value":100,"name":"https://antv.alipay.com"},
            {"value":300,"name":"VueJs"},
            {"value":300,"name":"Laragon"},
            {"value":100,"name":"Docker"},
            {"value":700,"name":"Mysql"},
            {"value":500,"name":"Redis"},
            {"value":500,"name":"HTML"},
            {"value":200,"name":"Javascript"},
            {"value":100,"name":"ES2015"},
            {"value":500,"name":"Git"},
            {"value":400,"name":"SVN"},
        ]
        var img = '{{ asset('imgs/logo.png') }}';
        var tagcloud_width = $('#tagcloud-panel').width()-30;
        var tagcloud_height = window.innerHeight - 230;

        var dv = new DataSet.View().source(data);
        var range = dv.range('value');
        var min = range[0];
        var max = range[1];
        var imageMask = new Image();
        imageMask.crossOrigin = '';
        imageMask.src = img;
        imageMask.onload = function() {
            dv.transform({
                type: 'tag-cloud',
                fields: ['name', 'value'],
                imageMask: imageMask,
                font: 'Verdana',
                size: [tagcloud_width, tagcloud_height], // 宽高设置最好根据 imageMask 做调整
                padding: 0,
                timeInterval: 5000, // max execute time
                rotate: function rotate() {
                    var random = ~~(Math.random() * 4) % 4;
                    if (random == 2) {
                        random = 0;
                    }
                    return random * 90; // 0, 90, 270
                },
                fontSize: function fontSize(d) {
                    return (d.value - min) / (max - min) * (64-8) + 8;
                }
            });
            var chart = new G2.Chart({
                container: 'mountNode',
                width: tagcloud_width, // 宽高设置最好根据 imageMask 做调整
                height: tagcloud_height,
                padding: 20
            });
            chart.source(dv, {
                x: {
                    nice: false
                },
                y: {
                    nice: false
                }
            });
            chart.legend(false);
            chart.axis(false);
            chart.tooltip({
                showTitle: false
            });
            chart.coord().reflect();
            chart.point().position('x*y').color('text').shape('cloud');
            chart.render();
        };

    </script>
@endsection


