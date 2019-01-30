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
                    <li class="active"><span class="glyphicon glyphicon-star"></span> 总用电概述</li>
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
                    <div class="row summaryPanel">
                        <div class="col-xs-3">
                            <div class="row">
                                <div class="col-xs-12">
                                    <p class="t1">
                                        <em ng-bind="datas.summaryData.totalName">--</em>
                                        <b ng-bind="datas.summaryData.total" ng-class="compareClass(datas.summaryData.total, 'd');">--</b>
                                        <i ng-bind="datas.summaryData.totalUnit">--</i>
                                    </p>
                                    <p class="t2" ng-class="compareClass(datas.summaryData.totalCompareMonth, 't');">
                                        <em>环比:</em>
                                        <span class="glyphicon" ng-class="compareClass(datas.summaryData.totalCompareMonth, 'i');"></span>
                                        <b ng-bind="compareValue(datas.summaryData.totalCompareMonth);">--</b>
                                    </p>
                                    <p class="t3" ng-class="compareClass(datas.summaryData.totalCompareYear, 't');">
                                        <em>2018年同比:</em>
                                        <span class="glyphicon" ng-class="compareClass(datas.summaryData.totalCompareYear, 'i');"></span>
                                        <b ng-bind="compareValue(datas.summaryData.totalCompareYear);">--</b>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-9">
                            <div class="row">
                                <div class="col-xs-3">
                                    <p class="t1">
                                        <em ng-bind="datas.summaryData.total1Name">--</em>
                                        <b ng-bind="datas.summaryData.total1" ng-class="compareClass(datas.summaryData.total1, 'd');">--</b>
                                        <i ng-bind="datas.summaryData.total1Unit">--</i>
                                    </p>
                                    <p class="t2" ng-class="compareClass(datas.summaryData.totalCompare1Month, 't');">
                                        <em>环比:</em>
                                        <span class="glyphicon" ng-class="compareClass(datas.summaryData.totalCompare1Month, 'i');"></span>
                                        <b ng-bind="compareValue(datas.summaryData.totalCompare1Month);">--</b>
                                    </p>
                                    <p class="t3" ng-class="compareClass(datas.summaryData.totalCompare1Year, 't');">
                                        <em>2018年同比:</em>
                                        <span class="glyphicon" ng-class="compareClass(datas.summaryData.totalCompare1Year, 'i');"></span>
                                        <b ng-bind="compareValue(datas.summaryData.totalCompare1Year);">--</b>
                                    </p>
                                </div>
                                <div class="col-xs-3">
                                    <p class="t1">
                                        <em ng-bind="datas.summaryData.total2Name">--</em>
                                        <b ng-bind="datas.summaryData.total2" ng-class="compareClass(datas.summaryData.total2, 'd');">--</b>
                                        <i ng-bind="datas.summaryData.total2Unit">--</i>
                                    </p>
                                    <p class="t2" ng-class="compareClass(datas.summaryData.totalCompare2Month, 't');">
                                        <em>环比:</em>
                                        <span class="glyphicon" ng-class="compareClass(datas.summaryData.totalCompare2Month, 'i');"></span>
                                        <b ng-bind="compareValue(datas.summaryData.totalCompare2Month);">--</b>
                                    </p>
                                    <p class="t3" ng-class="compareClass(datas.summaryData.totalCompare2Year, 't');">
                                        <em>2018年同比:</em>
                                        <span class="glyphicon" ng-class="compareClass(datas.summaryData.totalCompare2Year, 'i');"></span>
                                        <b ng-bind="compareValue(datas.summaryData.totalCompare2Year);">--</b>
                                    </p>
                                </div>
                                <div class="col-xs-3">
                                    <p class="t1">
                                        <em ng-bind="datas.summaryData.total3Name">--</em>
                                        <b ng-bind="datas.summaryData.total3" ng-class="compareClass(datas.summaryData.total3, 'd');">--</b>
                                        <i ng-bind="datas.summaryData.total3Unit">--</i>
                                    </p>
                                    <p class="t2" ng-class="compareClass(datas.summaryData.totalCompare3Month, 't');">
                                        <em>环比:</em>
                                        <span class="glyphicon" ng-class="compareClass(datas.summaryData.totalCompare3Month, 'i');"></span>
                                        <b ng-bind="compareValue(datas.summaryData.totalCompare3Month);">--</b>
                                    </p>
                                    <p class="t3" ng-class="compareClass(datas.summaryData.totalCompare3Year, 't');">
                                        <em>2018年同比:</em>
                                        <span class="glyphicon" ng-class="compareClass(datas.summaryData.totalCompare3Year, 'i');"></span>
                                        <b ng-bind="compareValue(datas.summaryData.totalCompare3Year);">--</b>
                                    </p>
                                </div>
                                <div class="col-xs-3">
                                    <p class="t1">
                                        <em ng-bind="datas.summaryData.total4Name">--</em>
                                        <b ng-bind="datas.summaryData.total4" ng-class="compareClass(datas.summaryData.total4, 'd');">--</b>
                                        <i ng-bind="datas.summaryData.total4Unit">--</i>
                                    </p>
                                    <p class="t2" ng-class="compareClass(datas.summaryData.totalCompare4Month, 't');">
                                        <em>环比:</em>
                                        <span class="glyphicon" ng-class="compareClass(datas.summaryData.totalCompare4Month, 'i');"></span>
                                        <b ng-bind="compareValue(datas.summaryData.totalCompare4Month);">--</b>
                                    </p>
                                    <p class="t3" ng-class="compareClass(datas.summaryData.totalCompare4Year, 't');">
                                        <em>2018年同比:</em>
                                        <span class="glyphicon" ng-class="compareClass(datas.summaryData.totalCompare4Year, 'i');"></span>
                                        <b ng-bind="compareValue(datas.summaryData.totalCompare4Year);">--</b>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="divider"></div>

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

                        <div id="dailyChart" style="width:100%; height:360px; display: none;"></div>
                        <div id="summaryPieChart" class="pull-left" style="width:28%; height:400px;"></div>
                        <div id="summaryChart" class="pull-right" style="width:70%; height:400px;"></div>
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
            }).controller('pageCtrl', function($scope) {

            global.on_load_func($scope);

            // 当前页面默认值
            let datas = {
                leftOn: true,
                datePickerClassName: ".J-datepicker-range-day",
                fromDate: moment().format("YYYY-MM")+"-01",
                toDate: moment().format("YYYY-MM-DD"),

                startYear: "2018",

                summaryChartTypes: {
                    0: "能耗密度kwh/m2",
                    1: "能耗kwh",
                },
                selectSummaryChartType : 0,

                summaryData: {
                    totalName: "总用电量",
                    totalUnit: "kwh",
                    total: 12345,
                    totalCompareMonth: -2.14,
                    totalCompareYear: -12.54,

                    total1Name: "照明与插座",
                    total1Unit: "kwh",
                    total1: 2234,
                    totalCompare1Month: -1.14,
                    totalCompare1Year: -12.54,

                    total2Name: "空调用电",
                    total2Unit: "kwh",
                    total2: 3341,
                    totalCompare2Month: -0.32,
                    totalCompare2Year: -4.84,

                    total3Name: "动力用电",
                    total3Unit: "kwh",
                    total3: 654,
                    totalCompare3Month: 2.14,
                    totalCompare3Year: -7.14,

                    total4Name: "特殊用电",
                    total4Unit: "kwh",
                    total4: 0,
                    totalCompare4Month: 0,
                    totalCompare4Year: 0,

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
                global.init_top_menu($scope);
                global.init_left($scope, function () {
                    setTimeout(function(){
                        $scope.summaryChart.resize();
                        $scope.summaryPieChart.resize();
                        $scope.dailyChart.resize();
                    }, 500);
                });
                $scope.init_datepicker($scope.datas.datePickerClassName);
                console.log("init_page");

                $scope.summaryChart = echarts.init(document.getElementById("summaryChart"));
                $scope.summaryPieChart = echarts.init(document.getElementById("summaryPieChart"));
                $scope.dailyChart = echarts.init(document.getElementById("dailyChart"));
                $scope.dailyChartDraw();
                $scope.summaryChartDraw();
                $scope.summaryPieDraw();
                $scope.summaryChartTable();
            };

            $scope.refresh_datas = function () {
                $scope.datas.fromDate = $($scope.datas.datePickerClassName).find("input").eq(0).val();
                $scope.datas.toDate = $($scope.datas.datePickerClassName).find("input").eq(1).val();
                $scope.summaryChartDraw();
                $scope.summaryPieDraw();
                $scope.summaryChartTable();
            }

            $scope.ajaxCallback = function (data) {
                $scope.$apply(function(){
                    $scope.datas.datas = data.result;
                });
                return data;
            };

            $scope.ajaxCatch = function (e) {
                alert(e);
            }

            $scope.compareClass = function (d, t) {
                if(t == 't') {
                    return d > 0 ? 'up' : (d == 0 ? 'right' : 'down');
                } else if(t == 'i') {
                    return d > 0 ? 'glyphicon-arrow-up' : (d == 0 ? 'glyphicon-arrow-right' : 'glyphicon-arrow-down');
                } else if(t == 'd') {
                    return d == 0 ? 'grey' : '';
                }
            };
            $scope.compareValue = function(d) {
                return Math.abs(d).toFixed(2) + '%';
            };

            var option = {
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
                        type : 'category',
                        data: [],
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
//                        type:'bar',
//                        stack: '总量',
//                        data:[],
//                    },
                ]
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
                color: settings.colors,
                tooltip : {
                    trigger: 'item',
                    formatter: "{a} <br/>{b} : {c} ({d}%)"
                },
                legend: {
                    x : 'center',
                    data:[]
                },
                calculable : true,
                series : [
                    {
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
                // 初始化随机数据, php 生成的原始数据样式
                for(var i=0; i<$scope.datas.summaryChartDatas.length; i++) {
                    var d = [];
                    for(var j=0; j<12; j++) {
                        d.push({ "val": (Math.random()*700 + 1200 - i*300).toFixed(2), "key": moment($scope.datas.startYear).add("month", j).format("YYYY-MM")});
                    }
                    $scope.datas.summaryChartDatas[i].datas = d;
                }

                // 将原始数据画成图表
                var opt = angular.copy(option);
                var legend_data = [];
                for(var i =0; i<$scope.datas.summaryChartDatas.length; i++) {
                    legend_data.push($scope.datas.summaryChartDatas[i]["name"]);
                    var tempSeries = {
                        name: $scope.datas.summaryChartDatas[i]["name"],
                        type:'bar',
                        stack: '总量',
                        data: fmtEChartData($scope.datas.summaryChartDatas[i]),
                    }
                    opt.series.push(tempSeries);
                }
                opt.legend.data = legend_data;
                // 生成12个月的分组
                for(var i=0; i<12; i++) {
                    opt.xAxis[0].data.push(moment($scope.datas.startYear).add("month", i).format("YYYY-MM"));
                }
                console.log(opt);
                global.drawEChart($scope.summaryChart, opt);

                function fmtEChartData (data){
                    var tmpSeriesData = [];
                    data.datas.map(function (p) {
                        tmpSeriesData.push((p.val == "" ? 0 : parseFloat(p.val)))
                    });
                    return tmpSeriesData;
                }
            };

            $scope.summaryPieDraw = function () {
                // 初始化随机数据, php 生成的原始数据样式
                for(var i=0; i<$scope.datas.summaryPieDatas.length; i++) {
                    $scope.datas.summaryPieDatas[i].datas = (Math.random()*700 + 1200 - i*300).toFixed(2);
                }

                // 将原始数据画成图表
                var opt = angular.copy(pieOpt);
                var legend_data = [];
                var ds = [];
                for(var i =0; i<$scope.datas.summaryPieDatas.length; i++) {
                    legend_data.push($scope.datas.summaryPieDatas[i]["name"]);
                    ds.push({"value": $scope.datas.summaryPieDatas[i]["datas"], "name": $scope.datas.summaryPieDatas[i]["name"]});
                }
                opt.legend.data = legend_data;
                opt.series[0].name = "用电占比";
                opt.series[0].data = ds;
                console.log(opt);
                global.drawEChart($scope.summaryPieChart, opt);
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
        });

    </script>
@stop

