@extends('layouts.default')
@section('page_title', '系统配置')
@section('content')

    <!-- Default box -->
    <div class="box">
        <div class="box-body">




        </div>
    </div>
    <!-- /.box -->

<script>
angular.module("app",[])
.config(function($interpolateProvider) {
    $interpolateProvider.startSymbol('{[{');
    $interpolateProvider.endSymbol('}]}');
}).controller('pageCtrl', function($scope) {

});
</script>
@endsection
