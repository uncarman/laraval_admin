@extends('forone::layouts.master')

@section('title', '创建'.$page_name)

@section('main')

    {!! Form::panel_start('创建'.$page_name) !!}
    @if (isset($data['copy']))
        {!! Form::model($data,['method'=>'POST','url'=>route($uri.'.store'),'class'=>'form-horizontal']) !!}
        @include( $uri.'.form', ['create'=>true])
        @elseif(Input::old())
        {!! Form::model(Input::old(),['url'=>route($uri.'.store'),'class'=>'form-horizontal']) !!}
        @include( $uri.'.form')
    @else
        {!! Form::open(['url'=>route($uri.'.store'),'class'=>'form-horizontal']) !!}
        @include( $uri.'.form')
    @endif
    {!! Form::panel_end('创建') !!}
    {!! Form::close() !!}

@stop

