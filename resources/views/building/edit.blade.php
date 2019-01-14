@extends('layouts.default')
@section('page_title', '编辑详情')

@section('content')
    <style>
        .form-group { margin-bottom: 15px; }
    </style>

    <!-- Default box -->
    <div class="box">
        <div class="box-body">

        <form action="{{ route('building.update',["building" => $building->id]) }}" method="post">
            <input type="hidden" name="_method" value="PUT"/>
            {{ csrf_field() }}
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">基本信息</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group col-sm-6">
                        <label class="col-sm-4 control-label">名字</label>
                        <div class="col-sm-8">
                            <input name="name" class="form-control" value="{{$building->name}}">
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label class="col-sm-4 control-label">面积</label>
                        <div class="col-sm-8">
                            <input name="area" class="form-control" value="{{$building->area}}">
                        </div>
                    </div>

                    <div class="form-group col-sm-6">
                        <label class="col-sm-4 control-label">容量</label>
                        <div class="col-sm-8">
                            <input name="capacity" class="form-control" value="{{$building->capacity}}">
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label class="col-sm-4 control-label">容量描述</label>
                        <div class="col-sm-8">
                            <input name="capacity_text" class="form-control" value="{{$building->capacity_text}}">
                        </div>
                    </div>

                    <div class="form-group col-sm-6">
                        <label class="col-sm-4 control-label">状态</label>
                        <div class="col-sm-8">
                            <input name="status" class="form-control" value="{{$building->status}}">
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label class="col-sm-4 control-label">类型</label>
                        <div class="col-sm-8">
                            <input name="type" class="form-control" value="{{$building->type}}">
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
                        <div class="col-sm-10">
                            <input name="address" class="form-control" value="{{$building->address}}">
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
                            <input type="file" name="photo">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="pull-right">
                <input type="submit" class="btn btn-primary" value="保存">
                <a onclick="window.history.back();" class="btn btn-default">返回</a>
            </div>
        </form>
        </div>
    </div>

    <script type="application/javascript">

    </script>
@stop
