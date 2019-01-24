@extends('layouts.default')
@section('page_title', '控制面板')

@section('content')

    <style>
        .data-center-top {
        }
        .data-center-top li {
            height: 150px;
            border-radius: 3px;
            width: 17%;
            min-width:210px;
        }

        .data-center-top .first {
            width: 26%;
        }

        .clearfix {
            clear: both;
        }

        .data-center-top li, .data-center-middle li, .data-center-bottom li {
            box-shadow: 0 8px 25px rgba(0, 0, 0, .1);
            margin: 0 0.5%;
            float: left;
        }

        .data-center-middle, .data-center-bottom, .data-center-top {
            margin-top: 20px;
            min-width:1220px;
        }
    </style>

    <!-- Default box -->
    <div class="box">
        <div class="box-body">

            <ul class="data-center-top">
                <li class="first">
                    <div class="content-time">
                        <div class="content-left-date">
                            <em>安全运行天数<i>1124</i>天</em>
                        </div>
                        <div style="margin-top:1vh;">
                            <div class="content-left-week">
                                <i ng-bind="data.weekDay">--</i>
                                <i ng-bind="data.date">--</i>
                            </div>
                            <div class="content-left-time" ng-bind="data.time">--</div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </li>
                <li style="background:#C07AFF;">
                    <i class="icons left">
                        <img class="icons left" src="img/co2.png">
                    </i>
                    <div class="data-top-info left">
                        <span>二氧化碳减排(吨)</span>
                        <em ng-bind="(environment.co2/1000).toFixed(2)">--</em>
                    </div>
                </li>
                <li style="background:#FF947E;">
                    <i class="icons left">
                        <img class="icons left" src="img/so2.png">
                    </i>
                    <div class="data-top-info left">
                        <span>二氧化硫减排(吨)</span>
                        <em ng-bind="(environment.so2/1000).toFixed(2)">--</em>
                    </div>
                </li>
                <li style="background:#8593FD;">
                    <i class="icons left">
                        <img class="icons left" src="img/smoke.png">
                    </i>
                    <div class="data-top-info left">
                        <span>烟尘减排量(吨)</span>
                        <em ng-bind="(environment.smoke/1000).toFixed(2)">--</em>
                    </div>
                </li>
                <li style="background:#79BFFF;">
                    <i class="icons left">
                        <img class="icons left" src="img/coal.png">
                    </i>
                    <div class="data-top-info left">
                        <span>节约标准煤(吨)</span>
                        <em ng-bind="(environment.coal/1000).toFixed(2)">--</em>
                    </div>
                </li>
                <div class="clearfix"></div>
            </ul>


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
                existAmmeter: [],
            };
            $scope.datas = { ...settings.default_datas, ...datas };

            $scope.init_page = function () {
                $scope.ammeterHourBig = echarts.init(document.getElementById("ammeterHourBig"));
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

            $scope.ajaxGetUserSummary = function (type) {
                var param = {
                    _method: 'get',
                    _url: settings.ajax_func.ajaxGetUserSummary,
                    _param: {
                        type : type
                    }
                };
                return global.return_promise($scope, param);
            }
            $scope.getSummary = function (type) {
                $scope.ajaxGetSummary(type)
                    .then($scope.ajaxCallback)
                    .catch($scope.ajaxCatch);
            };


            $scope.ajaxGetMeters = function (type) {
                var param = {
                    _method: 'get',
                    _url: settings.ajax_func.ajaxGetMeters,
                    _param: {
                        type : type
                    }
                };
                return global.return_promise($scope, param);
            }
            $scope.getMeters = function (type) {
                $scope.ajaxGetMeters(type)
                    .then($scope.ajaxCallback)
                    .catch($scope.ajaxCatch);
            };


            $scope.ajaxGetMeterDatas = function (device_id, type, date_type, from, to) {
                var param = {
                    _method: 'get',
                    _url: settings.ajax_func.ajaxGetMeterDatas,
                    _param: {
                        type : type,
                        device_id: device_id,
                        date_type: date_type,
                        from: from,
                        to: to,
                    }
                };
                return global.return_promise($scope, param);
            }
            $scope.getMeterDatas = function (device_id, type, date_type, from, to) {
                $scope.ajaxGetMeterDatas(device_id, type, date_type, from, to)
                    .then($scope.ajaxCallback)
                    .then($scope.drawLine)
                    .catch($scope.ajaxCatch);
            };

            function fmtEChartData(data){
                var tmpSeriesData = [];
                data.datas.map(function (p) {
                    tmpSeriesData.push([
                        new Date(p.key),
                        (p.val == "" ? 0 : parseFloat(p.val).toFixed(2))
                    ])
                });
                return tmpSeriesData;
            }
            function drawEChart(echart, opt) {
                console.log(opt);
                echart.setOption(opt, true);
                echart.resize();
            }
            var series = {
                type:'line',
                smooth:true,
                symbol: 'circle',
                sampling: 'average',
                data: [],
            };
            var lineOption = {
                dataZoom: {
                    type: 'inside'
                },
                grid: {
                    left: '5%',
                    right: '5%',
                    bottom: '5%',
                    top: '12%',
                    containLabel: true
                },
                tooltip: {
                    trigger: 'axis',
                    position: function (pos, params, dom, rect, size) {
                        var obj = {top: 60};
                        return obj[['left', 'right'][+(pos[0] < size.viewSize[0] / 2)]] = 5;
                    }
                },
                legend: {
                    data: [],
                },
                xAxis: {
                    type: 'time',
                },
                yAxis: {
                    type: 'value',
                },
                series: [],
            };
            $scope.drawLine = function (data) {
                $scope.$apply(function () {
                    var chart = $scope.ammeterHourBig;
                    var opt = null;
                    try {
                        opt = chart.getOption();
                    } catch (e) {
                        opt = copy(lineOption);
                    }
                    var index = $scope.datas.existAmmeter.indexOf(data.result.id);
                    if(index >=0 ) {
                        opt.series[index].data = fmtEChartData(data.result);
                    } else {
                        $scope.datas.existAmmeter.push(data.result.id);
                        var temSeries = copy(series);
                        temSeries.name = data.result.id;
                        temSeries.data = fmtEChartData(data.result);
                        opt.legend = {data: $scope.datas.existAmmeter};
                        opt.series.push(temSeries);
                    }
                    drawEChart($scope.ammeterHourBig, opt);
                });

            };

            $scope.init_page();
        });

    </script>
@stop
