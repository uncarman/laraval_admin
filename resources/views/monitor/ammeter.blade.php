@extends('layouts.default')
@section('page_title', '用电监测')

@section('content')

    <style>
    </style>
    <!-- Default box -->
    <div class="box">
        <div class="box-body">
            @include('layouts.errors')

            <div class="row">
                <div class="col-xs-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">总能耗概况</div>
                        <div class="panel-body">
                            <div class="row summaryPanel">
                                <div class="col-xs-3">
                                    <p class="t1"><em>总耗电量:</em> <b>123341</b></p>
                                    <p class="t2 up"><em>环比:</em> <span class="glyphicon glyphicon-arrow-up"></span> <b>2.12% </b></p>
                                    <p class="t3 down"><em>2018年同比:</em> <span class="glyphicon glyphicon-arrow-down"></span> <b>12.52% </b></p>
                                </div>
                                <div class="col-xs-2">
                                    <p class="t1"><em>照明与插座:</em> <b>123341</b></p>
                                    <p class="t2 up"><em>环比:</em> <span class="glyphicon glyphicon-arrow-up"></span> <b>2.12% </b></p>
                                    <p class="t3 down"><em>2018年同比:</em> <span class="glyphicon glyphicon-arrow-down"></span> <b>12.52% </b></p>
                                </div>
                                <div class="col-xs-2">
                                    <p class="t1"><em>空调用电:</em> <b>123341</b></p>
                                    <p class="t2 up"><em>环比:</em> <span class="glyphicon glyphicon-arrow-up"></span> <b>2.12% </b></p>
                                    <p class="t3 down"><em>2018年同比:</em> <span class="glyphicon glyphicon-arrow-down"></span> <b>12.52% </b></p>
                                </div>
                                <div class="col-xs-2">
                                    <p class="t1"><em>动力用电:</em> <b>123341</b></p>
                                    <p class="t2 up"><em>环比:</em> <span class="glyphicon glyphicon-arrow-up"></span> <b>2.12% </b></p>
                                    <p class="t3 down"><em>2018年同比:</em> <span class="glyphicon glyphicon-arrow-down"></span> <b>12.52% </b></p>
                                </div>
                                <div class="col-xs-2">
                                    <p class="t1"><em>特殊用电:</em> <b>123341</b></p>
                                    <p class="t2 up"><em>环比:</em> <span class="glyphicon glyphicon-arrow-up"></span> <b>2.12% </b></p>
                                    <p class="t3 down"><em>2018年同比:</em> <span class="glyphicon glyphicon-arrow-down"></span> <b>12.52% </b></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3">
                    <div class="panel panel-primary">
                        <div class="panel-heading">日历</div>
                        <div class="panel-body" style="height: 360px; padding: 0px;">
                            <div id="calendar" class="calendar"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-9">
                    <div class="panel panel-primary">
                        <div class="panel-heading">用能监测</div>
                        <div class="panel-body" style="height: 360px;">
                            <div id="dailyChart" style="width:100%; height:360px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">年度消耗</div>
                        <div class="panel-body">
                            <div id="summaryPieChart" class="pull-left" style="width:25%; height:400px;"></div>
                            <div id="summaryChart" class="pull-right" style="width:75%; height:400px;"></div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">最近15天数据</div>
                        <div class="panel-body">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>日期</th>
                                    <th>照明与插座</th>
                                    <th>照明与插座密度</th>
                                    <th>空调用电</th>
                                    <th>空调用电密度</th>
                                    <th>动力用电</th>
                                    <th>动力用电密度</th>
                                    <th>特殊用电</th>
                                    <th>特殊用电密度</th>
                                    <th>总费用</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="d in datas.summaryTableDatas">
                                    <td ng-bind="d.day"></td>
                                    <td ng-bind="d.electric | number : 2"></td>
                                    <td ng-bind="d.electric_area | number : 2"></td>
                                    <td ng-bind="d.water | number : 2"></td>
                                    <td ng-bind="d.water_area | number : 2"></td>
                                    <td ng-bind="d.air | number : 2"></td>
                                    <td ng-bind="d.air_area | number : 2"></td>
                                    <td ng-bind="d.vapor | number : 2"></td>
                                    <td ng-bind="d.vapor_area | number : 2"></td>
                                    <td ng-bind="d.total | number : 2"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script type="application/javascript">
        angular.module("app",[])
            .config(function($interpolateProvider) {
                $interpolateProvider.startSymbol('{[{');
                $interpolateProvider.endSymbol('}]}');
            }).controller('pageCtrl', function($scope) {

            global.on_load_func($scope);

            // 当前页面默认值
            let datas = {};
            $scope.datas = { ...settings.default_datas, ...datas };

            $scope.init_page = function () {
                // 初始化日历
                $('#calendar').calendar({
                    ifSwitch: true, // 是否切换月份
                    hoverDate: false, // hover是否显示当天信息
                    backToday: true, // 是否返回当天
                    clickFunc: function (day) {
                        console.log(day);
                        $("#selectedDay").html(day);
                        $scope.dailyChartDraw();
                    },
                    markedDate: {
                        "item-warning": ["20190110","20190115", "20190117"]
                    },
                });
                console.log("init_page");

                $scope.summaryChart = echarts.init(document.getElementById("summaryChart"));
                $scope.summaryPieChart = echarts.init(document.getElementById("summaryPieChart"));
                $scope.dailyChart = echarts.init(document.getElementById("dailyChart"));
                $scope.dailyChartDraw();
                $scope.summaryChartDraw();
                $scope.summaryPieDraw();
                $scope.summaryChartTable();
            };

            $scope.ajaxCallback = function (data) {
                $scope.$apply(function(){
                    $scope.datas.datas = data.result;
                });
                return data;
            };

            $scope.ajaxCatch = function (e) {
                alert(e);
            }


            var colors = [
                "#ff7f50",
                "#87cefa",
                "#da70d6",
                "#32cd32",
                "#6495ed",
                "#ff69b4",
                "#ba55d3",
                "#cd5c5c",
                "#ffa500",
                "#40e0d0",
                "#1e90ff",
                "#ff6347",
                "#7b68ee",
                "#00fa9a",
                "#ffd700",
                "#6699FF",
                "#ff6666",
                "#3cb371",
                "#b8860b",
                "#30e0e0"
            ];
            var option = {
                tooltip : {
                    trigger: 'axis'
                },
                legend: {
                    data:['照明与插座','空调用电', '动力用电', '特殊用电']
                },
                calculable : true,
                xAxis : [
                    {
                        type : 'category',
                        data : ['2019-01','2019-02','2019-03','2019-04','2019-05','2019-06','2019-07','2019-08','2019-09','2019-10','2019-11','2019-12']
                    }
                ],
                yAxis : [
                    {
                        type : 'value'
                    }
                ],
                series : [
                    {
                        name:'照明与插座',
                        type:'bar',
                        stack: '总量',
                        data:[],
                    },
                    {
                        name:'空调用电',
                        type:'bar',
                        stack: '总量',
                        data:[],
                    },
                    {
                        name:'动力用电',
                        type:'bar',
                        stack: '总量',
                        data:[],
                    },
                    {
                        name:'特殊用电',
                        type:'bar',
                        stack: '总量',
                        data:[],
                    }
                ]
            };
            var opts = {
                tooltip : {
                    trigger: 'axis'
                },
                legend: {
                    data:['照明与插座','空调用电','动力用电','特殊用电']
                },
                calculable : true,
                xAxis : [
                    {
                        type : 'category',
                        boundaryGap : false,
                        data : ['01','02','03','04','05','06','07','08','09','10',
                            '11','12','13','14','15','16','17','18','19','20',
                            '21','22','23','24']
                    }
                ],
                yAxis : [
                    {
                        type : 'value'
                    }
                ],
                series : [
                    {
                        name:'照明与插座',
                        type:'line',
                        stack: '总量',
                        itemStyle: {normal: {areaStyle: {type: 'default'}}},
                        data:[]
                    },
                    {
                        name:'空调用电',
                        type:'line',
                        stack: '总量',
                        itemStyle: {normal: {areaStyle: {type: 'default'}}},
                        data:[]
                    },
                    {
                        name:'动力用电',
                        type:'line',
                        stack: '总量',
                        itemStyle: {normal: {areaStyle: {type: 'default'}}},
                        data:[]
                    },
                    {
                        name:'特殊用电',
                        type:'line',
                        stack: '总量',
                        itemStyle: {normal: {areaStyle: {type: 'default'}}},
                        data:[]
                    }
                ]
            };
            var pieOpt = {
                tooltip : {
                    trigger: 'item',
                    formatter: "{a} <br/>{b} : {c} ({d}%)"
                },
                legend: {
                    x : 'center',
                    data:['照明与插座','空调用电', '动力用电', '特殊用电']
                },
                calculable : true,
                series : [
                    {
                        name:'用电占比',
                        type:'pie',
                        radius : [30, 110],
                        center : ['50%', '50%'],
                        roseType : 'area',
                        x: '50%',               // for funnel
                        max: 40,                // for funnel
                        sort : 'ascending',     // for funnel
                        data:[]
                    }
                ]
            };

            $scope.dailyChartDraw = function () {
                var opt = angular.copy(opts);
                for(var i =0; i<4; i++) {
                    var d = [];
                    for(var j=0; j<24; j++) {
                        d.push((Math.random()*700 + 1200 - i*300).toFixed(2));
                    }
                    opt.series[i].data = d;
                }
                $scope.dailyChart.setOption(opt, true);
                $scope.dailyChart.resize();
            };

            $scope.summaryChartDraw = function () {
                var opt = angular.copy(option);
                for(var i =0; i<4; i++) {
                    var d = [];
                    for(var j=0; j<12; j++) {
                        d.push((Math.random()*700 + 1200 - i*300).toFixed(2));
                    }
                    opt.series[i].data = d;
                }
                $scope.summaryChart.setOption(opt, true);
                $scope.summaryChart.resize();
            };

            $scope.summaryPieDraw = function () {
                var opt = angular.copy(pieOpt);
                var d = [];
                for(var j=0; j<4; j++) {
                    d.push({value: (Math.random()*700 + 1200 - j*300).toFixed(2), "name": pieOpt.legend.data[j] });
                }
                opt.series[0].data = d;
                $scope.summaryPieChart.setOption(opt, true);
                $scope.summaryPieChart.resize();
            };

            $scope.summaryChartTable = function () {
                $scope.datas.summaryTableDatas = [];
                for(var i = -15; i< 0; i ++) {
                    var e = Math.random()*200 + 100;
                    var w = Math.random()*200 + 100;
                    var r = Math.random()*200 + 100;
                    var v = Math.random()*200 + 100;
                    var a = 960;
                    var d = {
                        "day": moment().add(i, "day").format("YYYY-MM-DD"),
                        "electric": e,
                        "electric_area": e/a,
                        "water": w/a,
                        "water_area": w/a,
                        "air": r/a,
                        "air_area": r/a,
                        "vapor": v/a,
                        "vapor_area": v/a,
                        "total": e*0.5+w*2.1+r*3.5+v*2.2,
                    };
                    $scope.datas.summaryTableDatas.push(d);
                }
            };

            $scope.init_page();
        });

    </script>
@stop
