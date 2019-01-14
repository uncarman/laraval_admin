@extends('layouts.default')
@section('page_title', '功能')
@section('content')

    <!-- Default box -->
    <div class="box">
        <div class="box-body">

            <div id="ajax_loading" ng-show="ajax_loading" class="iLoading_loading_pic"></div>
            <table class="table" ng-show="">
                <thead>
                <tr>
                    <th>表名</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="d in datas.tableList">
                        <td ng-bind="d.name"></td>
                        <td>
                            <button class="btn btn-default" ng-click="view_table(this, d.name);">查看</button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <table class="table" ng-show=""></table>

            <div class="debugInfo">
                <b style="line-height: 30px;">debug 信息:</b>
                <div ng-bind="datas | json"></div>
            </div>

        </div>
    </div>
    <!-- /.box -->

<script>
angular.module("app",[])
.config(function($interpolateProvider) {
    $interpolateProvider.startSymbol('{[{');
    $interpolateProvider.endSymbol('}]}');
}).controller('pageCtrl', function($scope) {

    global.on_load_func($scope);

    // 当前页面默认值
    let datas = {};
    $scope.datas = { ...settings.default_datas, ...datas };


    $scope.ajax_get_tables = function () {
        var param = {
            _method: 'get',
            _url: settings.ajax_func.baseTableList,
            _param: {}
        };
        return global.return_promise($scope, param);
    };
    $scope.get_tables_callback = function (data) {
        $scope.$apply(function(){
            $scope.datas.tableList = data.result;
        });
    };
    $scope.get_tables = function ($scope, page) {
        if (!$scope.ajax_loading) {
            $scope.ajax_loading = true;
            $scope.ajax_get_tables()
                .then($scope.get_tables_callback)
                .catch($scope.ajax_catch);
        }
    };


    $scope.ajax_get_table_detail = function () {
        var param = {
            _method: 'get',
            _url: settings.ajax_func.baseTableDetail,
            _param: {
                table_name : $scope.datas.selectedTableName
            }
        };
        return global.return_promise($scope, param);
    };
    $scope.ajax_get_table_data = function () {
        $scope.datas.cur_page = page || $scope.datas.page_default;
        var param = {
            _method: 'get',
            _url: settings.ajax_func.baseTableData,
            _param: {
                table_name : $scope.datas.selectedTableName,
                page: $scope.datas.cur_page;
            }
        };
        return global.return_promise($scope, param);
    };
    $scope.get_table_detail_callback = function (data) {
        $scope.$apply(function () {
            $scope.datas.tableDetail = data.result;
        });
        // 获取数据
        $scope.ajax_get_table_data()
            .then($scope.ajax_get_table_data_callback)
            .catch($scope.ajax_catch);
    };
    $scope.get_table_detail = function ($scope) {
        $scope.ajax_get_table_detail()
            .then($scope.ajax_get_table_detail())
            .catch($scope.ajax_catch);
    };
    $scope.view_table = function ($scope, tableName) {
        $scope.datas.selectedTableName = tableName;
        $scope.get_table_detail($scope);
    }



    // 执行函数
    $scope.get_tables($scope);
});
</script>
@endsection
