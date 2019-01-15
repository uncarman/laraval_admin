@extends('layouts.default')
@section('page_title', '查看详情')

@section('content')
    <style>
        .form-group { margin-bottom: 15px; }
    </style>

    <!-- Default box -->
    <div class="box">
        <div class="box-body">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">基本信息</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group col-sm-6">
                        <label class="col-sm-4 control-label">名字</label>
                        <div class="col-sm-8">
                            {{$building->name}}
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label class="col-sm-4 control-label">面积</label>
                        <div class="col-sm-8">
                            {{$building->area}}
                        </div>
                    </div>

                    <div class="form-group col-sm-6">
                        <label class="col-sm-4 control-label">容量</label>
                        <div class="col-sm-8">
                            {{$building->capacity}}
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label class="col-sm-4 control-label">容量描述</label>
                        <div class="col-sm-8">
                            {{$building->capacity_text}}
                        </div>
                    </div>

                    <div class="form-group col-sm-6">
                        <label class="col-sm-4 control-label">状态</label>
                        <div class="col-sm-8">
                            {{$building->status}}
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label class="col-sm-4 control-label">类型</label>
                        <div class="col-sm-8">
                            {{$building->type}}
                        </div>
                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>


            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">地址信息</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group col-sm-12">
                        <label class="col-sm-2 control-label">地址</label>
                        <div class="col-sm-9">
                            @if(isset($building->province) && isset($building->city) && isset($plant->county))
                                {{ $building->province.'-'.$building->city.'-'.$plant->county }}-{{ $building->address }}
                            @else
                                {{ $building->address }}
                            @endif
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>


            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">图片信息</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group col-sm-12">
                        <label class="col-sm-2 control-label">地址</label>
                        <div class="col-sm-10">
                            <img src="{{$building->photo}}" width=200 />
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="pull-right">
                <a onclick="window.history.back();" class="btn btn-default">返回</a>
            </div>
        </div>
    </div>

    <script type="application/javascript">

    </script>
@stop