@if(isset($edit))
{!! Form::group_text('id','ID','ID',0.5,false,true) !!}
@endif
{!! Form::group_text('key','参数名：','参数名') !!}
{!! Form::group_text('value','参数值：','参数值') !!}
{!! Form::group_text('remark','备注：','参数说明') !!}

@if(isset($edit))
    {!! Form::group_text('created_at','创建时间','创建时间',0.5,false,true) !!}
    {!! Form::group_text('updated_at','更新时间','更新时间',0.5,false,true) !!}
@endif

@section('js')
    @parent
@stop

