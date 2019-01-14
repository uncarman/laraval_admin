@extends('forone::layouts.master')

@section('title', '编辑'.$page_name)

@section('main')

    {!! Form::panel_start('编辑'.$page_name) !!}
    {!! Form::model(Input::old() ? :$configDetail,['method'=>'PUT','route'=>[$uri.'.update',$configDetail['id']],'class'=>'form-horizontal']) !!}
    @include($uri.'.form', ['edit'=>true])
        {!! Form::panel_end([
            'submit'=>'更新',
            'callback'=>session('system_config_url',URL::previous())
        ]) !!}

@stop
