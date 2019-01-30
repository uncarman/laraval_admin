@extends('layouts.default')

@section('content')

    <div class="breadcrumb">
        <li><a href="/dashboard">首页</a></li>
        <li><a href="../monitor/summary">监测分析</a></li>
        <li><a href="../monitor/ammeter">电能监测</a></li>
        <li class="active">总用电概述</li>
    </div>

    <!-- Default box -->
    <div class="box">
        <div class="box-body mainbody">
            @include('layouts.errors')

            <div class="split-line" ng-click="ch_datas_on();"></div>

            <div class="box-left">
                <ul class="leftNav">
                    <li class="title"><span class="glyphicon glyphicon-flash"></span> 电能监测</li>
                    <li><a href="../monitor/ammeter"><span class="glyphicon glyphicon-star"></span> 总用电概述</a></li>
                    <li ng-class="datas.dgt==9 ? 'active' : ''">
                        <a href="../monitor/ammeterByType?dgt=9" ng-if="datas.dgt!=9">
                            <span class="glyphicon glyphicon-tint"></span> 按能耗分项监测
                        </a>
                        <b ng-if="datas.dgt==9">
                            <span class="glyphicon glyphicon-tint"></span> 按能耗分项监测
                        </b>
                    </li>
                    <li ng-class="datas.dgt==10 ? 'active' : ''">
                        <a href="../monitor/ammeterByType?dgt=10" ng-if="datas.dgt!=10">
                            <span class="glyphicon glyphicon-fire"></span> 按建筑区域监测
                        </a>
                        <b ng-if="datas.dgt==10">
                            <span class="glyphicon glyphicon-fire"></span> 按建筑区域监测
                        </b>
                    </li>
                    <li ng-class="datas.dgt==11 ? 'active' : ''">
                        <a href="../monitor/ammeterByType?dgt=11" ng-if="datas.dgt!=11">
                            <span class="glyphicon glyphicon-cloud"></span> 按组织机构监测
                        </a>
                        <b ng-if="datas.dgt==11">
                            <span class="glyphicon glyphicon-cloud"></span> 按组织机构监测
                        </b>
                    </li>
                    <li ng-class="datas.dgt==12 ? 'active' : ''">
                        <a href="../monitor/ammeterByType?dgt=12" ng-if="datas.dgt!=12">
                            <span class="glyphicon glyphicon-lamp"></span> 按自定义类别监测
                        </a>
                        <b ng-if="datas.dgt==12">
                            <span class="glyphicon glyphicon-lamp"></span> 按自定义类别监测
                        </b>
                    </li>
                </ul>
            </div>

            <div class="box-right">
                <ul class="nav nav-tabs tftab">
                    <li><span class="title"><span class="glyphicon glyphicon-star-empty"></span> 总用电概况 </span></li>
                    <li class="pull-right disabled">
                        <span>
                            <b>选择日期:  </b>
                            <span class="c-datepicker-date-editor J-datepicker-range-day">
                                <i class="c-datepicker-range__icon kxiconfont icon-clock"></i>
                                <input placeholder="开始日期" name="" class="c-datepicker-data-input only-date" ng-model="datas.fromDate">
                                <span class="c-datepicker-range-separator">-</span>
                                <input placeholder="结束日期" name="" class="c-datepicker-data-input only-date" ng-model="datas.toDate">
                            </span>
                            <button ng-click="refresh_datas();" class="btn btn-primary"><spam class="glyphicon glyphicon-refresh"></spam> 更新</button>
                        </span>
                    </li>
                </ul>
                <div class="nav-tabContents">

                    <div>
                        <h3 class="pull-left">图表展示:</h3>
                        <div class="form-inline pull-right mb15">
                            <div class="form-group">
                                <label class="">国标值:</label>
                                <input class="form-control w100" ng-model="datas.summaryData.internationalValue">
                            </div>
                            <div class="form-group">
                                <label class="">数据单位:</label>
                                <select class="form-control">
                                    <option ng-repeat="(o,n) in datas.summaryChartTypes"
                                            ng-value="o"
                                            ng-bind="n"
                                            ng-selected="datas.selectSummaryChartType==o"
                                    ></option>
                                </select>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div id="dailyChart" style="width:100%; height:400px;"></div>

                        <div class="clearfix"></div>

                    </div>

                    <div class="divider"></div>

                    <div>
                        <h3>
                            <span class="glyphicon glyphicon-time"></span>
                            <span ng-bind="datas.fromDate"></span> - <span ng-bind="datas.toDate"></span> 数据
                        </h3>
                        <table class="table table-bordered table-hover">
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

    <script type="application/javascript">
        angular.module("app",[])
            .config(function($interpolateProvider) {
                $interpolateProvider.startSymbol('{[{');
                $interpolateProvider.endSymbol('}]}');
            }).controller('pageCtrl', ['$scope', function($scope) {

            global.on_load_func($scope);

            // 当前页面默认值
            let datas = {
                leftOn: true,
                datePickerClassName: ".J-datepicker-range-day",
                fromDate: "2019-01-01",
                toDate: "2019-01-29",

                dgt: global.request("dgt"),

                startYear: "2018",

                summaryChartTypes: {
                    0: "能耗密度kwh/m2",
                    1: "能耗kwh",
                },
                selectSummaryChartType : 0,

                summaryData: {
                    internationalValue: 0.15,  // 国际能耗
                },

                summaryChartDatas: [
                    {
                        datas: [],
                        key: "date",
                        unit: "kwh",
                        name: "照明与插座",
                        val: "fee",
                    },
                    {
                        datas: [],
                        key: "date",
                        unit: "kwh",
                        name: "空调用电",
                        val: "fee",
                    },
                    {
                        datas: [],
                        key: "date",
                        unit: "kwh",
                        name: "动力用电",
                        val: "fee",
                    },
                    {
                        datas: [],
                        key: "date",
                        unit: "kwh",
                        name: "特殊用电",
                        val: "fee",
                    }
                ],

                summaryPieDatas: [
                    {
                        datas: "",
                        unit: "kwh",
                        name: "照明与插座",
                        val: "fee",
                    },
                    {
                        datas: "",
                        unit: "kwh",
                        name: "空调用电",
                        val: "fee",
                    },
                    {
                        datas: "",
                        unit: "kwh",
                        name: "动力用电",
                        val: "fee",
                    },
                    {
                        datas: "",
                        unit: "kwh",
                        name: "特殊用电",
                        val: "fee",
                    }
                ],

                summaryTableDatas: [],
            };
            $.extend(datas, settings.default_datas);
            $scope.datas = datas;

            $scope = global.init_base_scope($scope);

            $scope.init_page = function () {
                global.init_top_menu();
                global.init_left($scope);
                $scope.init_datepicker($scope.datas.datePickerClassName);
                console.log("init_page");

                $scope.dailyChart = echarts.init(document.getElementById("dailyChart"));
                $scope.dailyChartDraw();
                $scope.summaryChartTable();
            };

            var opts = {
                color: settings.colors,
                tooltip : {
                    trigger: 'axis'
                },
                legend: {
                    data:[]
                },
                calculable : true,
                xAxis : [
                    {
                        type : 'time',
                    }
                ],
                yAxis : [
                    {
                        type : 'value'
                    }
                ],
                series : [
//                    {
//                        name:'照明与插座',
//                        type:'line',
//                        stack: '总量',
//                        itemStyle: {normal: {areaStyle: {type: 'default'}}},
//                        data:[]
//                    },
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

            $scope.summaryChartTable = function () {
                $scope.datas.summaryTableDatas = [];
                for(var i = 0; i< moment($scope.datas.toDate).diff($scope.datas.fromDate, 'days'); i ++) {
                    var e = Math.random()*200 + 100;
                    var w = Math.random()*200 + 100;
                    var r = Math.random()*200 + 100;
                    var v = Math.random()*200 + 100;
                    var a = 960;
                    var d = {
                        "day": moment($scope.datas.fromDate).add(i, "day").format("YYYY-MM-DD"),
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
        }]);

    </script>
@stop
