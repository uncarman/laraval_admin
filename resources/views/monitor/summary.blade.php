@extends('layouts.default')
@section('page_title', '监测分析')

@section('content')

    <div class="breadcrumb">
        <li><a href="/dashboard">首页</a></li>
        <li class="active">监测分析</li>
        <li>电能监测</li>
    </div>

    <!-- Default box -->
    <div class="box">
        <div class="box-body left-on" ng-class="datas.leftOn ? 'left-on': 'left-off'">
            @include('layouts.errors')

            <div class="split-line" ng-click="ch_datas_on();"></div>

            <div class="box-left">
                <ul class="leftNav">
                    <li class="title">监测分析</li>
                    <li>总体用能概述</li>
                    <li>总体用能概述</li>
                </ul>

                <div class="divider"></div>

                <ul class="leftNav">
                    <li class="title">选择时间范围</li>
                    <li>总体用能概述</li>
                    <li>总体用能概述</li>
                </ul>
            </div>

            <div class="box-right">

                <ul class="nav nav-tabs tftab">
                    <li><span class="title"><span class="glyphicon glyphicon-star-empty"></span> 总能耗概况 </span></li>
                    <li class="pull-right disabled">
                        <span>
                            <b>选择日期: &nbsp; </b>
                            <span class="c-datepicker-date-editor J-datepicker-range-day">
                                <i class="c-datepicker-range__icon kxiconfont icon-clock"></i>
                                <input placeholder="开始日期" name="" class="c-datepicker-data-input only-date" value="2019-01-01">
                                <span class="c-datepicker-range-separator">-</span>
                                <input placeholder="结束日期" name="" class="c-datepicker-data-input only-date" value="2019-01-28">
                            </span>
                            <button type="submit" class="btn btn-primary"><spam class="glyphicon glyphicon-refresh"></spam> 更新</button>
                        </span>
                    </li>
                </ul>
                <div class="nav-tabContents">
                    <div class="row summaryPanel">
                        <div class="col-xs-3">
                            <p class="t1"><em>总用费用:</em> <b>1212</b> <i>度</i></p>
                            <p class="t2 down"><em>环比:</em> <span class="glyphicon glyphicon-arrow-down"></span> <b>2% </b></p>
                            <p class="t3 down"><em>2018年同比:</em> <span class="glyphicon glyphicon-arrow-down"></span> <b>11% </b></p>
                        </div>
                        <div class="col-xs-2">
                            <p class="t1"><em>总用电量:</em> <b>2234</b> <i>度</i></p>
                            <p class="t2 down"><em>环比:</em> <span class="glyphicon glyphicon-arrow-down"></span> <b>2.12% </b></p>
                            <p class="t3 down"><em>2018年同比:</em> <span class="glyphicon glyphicon-arrow-down"></span> <b>12.52% </b></p>
                        </div>
                        <div class="col-xs-2">
                            <p class="t1"><em>总用水量:</em> <b>3341</b> <i>吨</i></p>
                            <p class="t2 up"><em>环比:</em> <span class="glyphicon glyphicon-arrow-up"></span> <b>2.12% </b></p>
                            <p class="t3 down"><em>2018年同比:</em> <span class="glyphicon glyphicon-arrow-down"></span> <b>12.52% </b></p>
                        </div>
                        <div class="col-xs-2">
                            <p class="t1"><em>总用燃气量:</em> <b class="grey">0</b> <i>立方米</i></p>
                            <p class="t2 right"><em>环比:</em> <span class="glyphicon glyphicon-arrow-right"></span> <b>0% </b></p>
                            <p class="t3 right"><em>2018年同比:</em> <span class="glyphicon glyphicon-arrow-right"></span> <b>0% </b></p>
                        </div>
                        <div class="col-xs-2">
                            <p class="t1"><em>总用蒸汽量:</em> <b class="grey">0</b> <i>立方米</i></p>
                            <p class="t2 right"><em>环比:</em> <span class="glyphicon glyphicon-arrow-right"></span> <b>0% </b></p>
                            <p class="t3 right"><em>2018年同比:</em> <span class="glyphicon glyphicon-arrow-right"></span> <b>0% </b></p>
                        </div>
                    </div>

                    <div class="divider"></div>

                    <div>
                        <h3 class="pull-left">图表展示:</h3>
                        <div class="form-inline pull-right mb15">
                            <div class="form-group">
                                <label class="">国标值:</label>
                                <input class="form-control w100" value="0.15">
                            </div>
                            <div class="form-group">
                                <label class="">数据单位:</label>
                                <select class="form-control">
                                    <option>能耗密度KWh/m2</option>
                                    <option>能耗KWh</option>
                                </select>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div id="dailyChart" style="width:100%; height:360px; display: none;"></div>
                        <div id="summaryPieChart" class="pull-left" style="width:28%; height:400px;"></div>
                        <div id="summaryChart" class="pull-right" style="width:70%; height:400px;"></div>
                        <div class="clearfix"></div>

                    </div>

                    <div class="divider"></div>

                    <div>
                        <h3>最近15天数据:</h3>
                        <table class="table table-bordered table-hover" style="margin-bottom: 5px;">
                            <thead>
                            <tr>
                                <th>日期</th>
                                <th>总用电量(KWh)</th>
                                <th>电耗密度(KWh/m2)</th>
                                <th>总用水量(T)</th>
                                <th>水耗密度(T/m2)</th>
                                <th>总燃气量(m3)</th>
                                <th>燃气耗密度(m3/m2)</th>
                                <th>总蒸汽量(m3)</th>
                                <th>蒸汽耗密度(m3/m2)</th>
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

    <script type="application/javascript">
        angular.module("app",[])
            .config(function($interpolateProvider) {
                $interpolateProvider.startSymbol('{[{');
                $interpolateProvider.endSymbol('}]}');
            }).controller('pageCtrl', function($scope) {

            global.on_load_func($scope);

            // 当前页面默认值
            let datas = {
                leftOn: true,
            };
            $scope.datas = { ...settings.default_datas, ...datas };

            $scope.ch_datas_on = function () {
                $scope.datas.leftOn = !$scope.datas.leftOn;
                setTimeout(function () {
                    $scope.summaryChart.resize();
                    $scope.summaryPieChart.resize();
                    $scope.dailyChart.resize();
                }, 300);
            };


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
                $scope.init_datepicker();
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
                    data:['用电量','用水量', '用燃气量', '用蒸汽量'],
                    y: "10px",
                },
                grid: {
                    top: "0",
                    left: "0",
                    right: "0",
                    bottom: "0",
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
                        name:'用电量',
                        type:'bar',
                        data:[2.0, 4.9, 7.0, 23.2, 25.6, 76.7, 135.6, 162.2, 32.6, 20.0, 6.4, 3.3],
                        markPoint : {
                            data : [
                                {type : 'max', name: '最大值'},
                            ]
                        },
                        markLine : {
                            data : [
                                {type : 'average', name: '平均值'}
                            ]
                        }
                    },
                    {
                        name:'用水量',
                        type:'bar',
                        data:[2.6, 5.9, 9.0, 26.4, 28.7, 70.7, 175.6, 182.2, 48.7, 18.8, 6.0, 2.3],
                        markPoint : {
                            data : [
                                {type : 'max', name: '最大值'},
                            ]
                        },
                        markLine : {
                            data : [
                                {type : 'average', name : '平均值'}
                            ]
                        }
                    },
                    {
                        name:'用燃气量',
                        type:'bar',
                        data:[],
                    },
                    {
                        name:'用蒸汽量',
                        type:'bar',
                        data:[],
                    }
                ]
            };
            var opts = {
                tooltip : {
                    trigger: 'axis'
                },
                legend: {
                    data:['电','水','燃气','蒸汽'],
                    y: "10px",
                },
                grid: {
                    top: "0",
                    left: "0",
                    right: "0",
                    bottom: "0",
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
                        name:'电',
                        type:'line',
                        stack: '总量',
                        data:[]
                    },
                    {
                        name:'水',
                        type:'line',
                        stack: '总量',
                        data:[]
                    },
                    {
                        name:'燃气',
                        type:'line',
                        stack: '总量',
                        data:[]
                    },
                    {
                        name:'蒸汽',
                        type:'line',
                        stack: '总量',
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
                    data:['电','水','燃气','蒸汽'],
                    x : 'center',
                    y: "10px",
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
                        if(i<2) {
                            d.push((Math.random()*700 + 1200 - i*300).toFixed(2));
                        } else {
                            d.push(0);
                        }
                    }
                    opt.series[i].data = d;
                }
                $scope.dailyChart.setOption(opt, true);
                $scope.dailyChart.resize();
            };

            $scope.summaryChartDraw = function () {
                var opt = angular.copy(option);
                for(var i =0; i<2; i++) {
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
                    if(j<2) {
                        d.push({value: (Math.random()*700 + 1200 - j*300).toFixed(2), "name": pieOpt.legend.data[j] });
                    } else {
                        d.push({value: 0, "name": pieOpt.legend.data[j] });
                    }
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

            //年月日范围
            function shortcutMonth () {
                // 当月
                var nowDay = moment().get('date');
                var prevMonthFirstDay = moment().subtract(1, 'months').set({ 'date': 1 });
                var prevMonth2FirstDay = moment().subtract(2, 'months').set({ 'date': 1 });
                var prevMonth3FirstDay = moment().subtract(3, 'months').set({ 'date': 1 });
                var prevMonthDay = moment().diff(prevMonthFirstDay, 'days');
                var prevMonth2Day = moment().diff(prevMonth2FirstDay, 'days');
                var prevMonth3Day = moment().diff(prevMonth3FirstDay, 'days');
                return {
                    now: '-' + (nowDay-1) + ',0',
                    prev: '-' + prevMonthDay + ',-' + nowDay,
                    prev2: '-' + prevMonth2Day + ',-' + (prevMonthDay+1),
                    prev3: '-' + prevMonth3Day + ',-' + (prevMonth2Day+1)
                }
            }
            var sm = shortcutMonth();
            var rangeShortcutOption = [
                {
                    name: '昨天',
                    day: '-1,0',
                },
                {
                    name: '最近7天',
                    day: '-7,0'
                },
                {
                    name: '最近30天',
                    day: '-30,0'
                },
                {
                    name: '最近90天',
                    day: '-90, 0'
                },
                {
                    name: '这一月',
                    day: sm.now,
                },
                {
                    name: '上一个月',
                    day: sm.prev,
                },
                {
                    name: '上二个月',
                    day: sm.prev2,
                },
                {
                    name: '上三个月',
                    day: sm.prev3,
                }
            ];
            $scope.init_datepicker = function () {
                $(function(){
                    $('.J-datepicker-range-day').datePicker({
                        isRange: true,
                        hasShortcut: true,
                        format: "YYYY-MM-DD",
                        shortcutOptions: rangeShortcutOption
                    });
                });
            };

            $scope.init_page();
        });

    </script>
@stop

