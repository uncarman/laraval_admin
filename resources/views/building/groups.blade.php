@extends('layouts.default')
@section('page_title', '分项示意图')

@section('content')

    <style>
        .big-echart {
            width: 1000px; height: 1000px;
        }
    </style>

    <!-- Default box -->
    <div class="box">
        <div class="box-body">
            @include('layouts.errors')

            <div id="treeMap" class="big-echart"></div>

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
            building_id: "{{ $building_id }}",
        };
        $scope.datas = { ...settings.default_datas, ...datas };

        $scope.init_page = function () {
            console.log("init_page");

            $scope.treeMap = echarts.init(document.getElementById("treeMap"));
            $scope.groupTree();
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

        var series = {
            name:'分项示意图',
            type:'tree',
            orient: 'horizontal',  // vertical horizontal
            rootLocation: {x: 100,y: 400}, // 根节点位置  {x: 100, y: 'center'}
            nodePadding: 20,
            layerPadding: 120,
            hoverable: true,
            roam: true,
            symbolSize: 10,
            itemStyle: {
                normal: {
                    label: {
                        show: true,
                        position: 'top',
                        textStyle: {
                            color: '#000',
                            fontSize: 16
                        }
                    },
                    lineStyle: {
                        color: '#ddd',
                        type: 'broken' // 'curve'|'broken'|'solid'|'dotted'|'dashed'

                    }
                }
            },
            data: []
        };
        var option = {
            series : []
        };

        $scope.ajaxGroupTree = function () {
            var param = {
                _method: 'get',
                _url: settings.ajax_func.ajaxGroupTree,
                _param: {
                    bid : $scope.datas.building_id
                }
            };
            return global.return_promise($scope, param);
        }
        $scope.groupTree = function (type) {
            $scope.ajaxGroupTree(type)
                .then($scope.ajaxCallback)
                .then($scope.drawMap)
                .catch($scope.ajaxCatch);
        };
        $scope.drawMap = function (data) {
            $scope.$apply(function () {
                var ci = 0;
                var res = data.result;
                var opt = angular.copy(option);
                for(var o in res) {
                    var s = angular.copy(series);
                    s.name = res[o].name;
                    s.rootLocation = {x: (50 + 450*o),y: 400}; // 根节点位置  {x: 100, y: 'center'}
                    for(var i in res[o].children) {
                        res[o].children[i].symbol = 'circle';
                        res[o].children[i].itemStyle = {
                            normal: {
                                color: colors[ci],
                                label: {
                                    show: true,
                                    position: 'top',
                                    textStyle: {
                                        color: colors[ci],
                                        fontSize: 16
                                    }
                                },
                            }
                        }
                        for(var j in res[o].children[i].children) {
                            res[o].children[i].children[j].symbol = 'circle';
                            res[o].children[i].children[j].itemStyle = {
                                normal: {
                                    color: colors[ci],
                                    label: {
                                        show: true,
                                        position: 'right',
                                        textStyle: {
                                            color: colors[ci],
                                            fontSize: 16
                                        }
                                    },
                                }
                            }
                        }
                        ci += 1;
                    }
                    s.data = [{"name":"大楼", "children": res[o].children}];
                    opt.series.push(s);
                }
                console.log(opt);
                $scope.treeMap.setOption(opt, true);
                $scope.treeMap.resize();

            });
        };

        $scope.init_page();
    });



</script>
@stop

