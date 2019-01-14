@extends('layouts.default')
@section('page_title', '电站列表')

@section('content')

    <!-- Default box -->
    <div class="box">
        <div class="box-body">

            @include('layouts.errors')

            <div class="row">
                <div class="col-md-2 form-inline">
                    <a style="margin-right: 50px;" href="{{ route('building.create') }}" class="btn btn-primary"><i
                                class="fa fa-plus"></i> 添加</a>
                </div>
            </div>
            <br>

            <table class="table table-bordered pc-table">
                <tbody>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>图片</th>
                    <th>名称</th>
                    <th>容量</th>
                    <th>面积</th>
                    <th>地址信息</th>
                    <th>状态</th>
                    <th>类型</th>
                    <th>创建时间</th>
                    <th>备注</th>
                    <th>操作</th>
                </tr>
                @if(!empty($buildings))
                    @foreach($buildings as $plant)
                        <tr class='{{ $plant->status }}'>
                            <td>{{ $plant->id }}</td>
                            <td><img src="{{ $plant->photo }}" width="50" height="50"></td>
                            <td>{{ $plant->name }}</td>
                            <td>{{ $plant->capacity }}</td>
                            <td>{{ $plant->area }}</td>
                            <td>{{ $plant->address }}</td>
                            <td>{{ $plant->status }}</td>
                            <td>{{ $plant->type }}</td>
                            <td>{{ $plant->created_at}}</td>
                            <td>{{ $plant->note}}</td>
                            <td>
                                <li><a class="default" href="{{ route('building.show', $plant->id) }}">查看</a></li>
                                <li><a class="default" href="{{ route('building.edit', $plant->id) }}">编辑</a></li>

                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="8" style="text-align: center">没有电站</td>
                    </tr>
                @endif
                </tbody>
            </table>

            <!-- /.box-body -->
            @if(!empty($plants))
                <div class="box-footer clearfix">
                    {{ $plants->appends(request()->all())->render() }}
                </div>
            @endif

        </div>
    </div>

    <script type="application/javascript">

    </script>
@stop
