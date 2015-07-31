@extends('layouts.master')

@section('title')
    医院信息
@stop

@section('css')
    @parent
    <link rel="stylesheet" type="text/css" href="/dist/css/hospital/department/detail.css" />
@stop

@section('js-lib')
    @parent
@stop

@section('js-common')
    @parent
@stop

@section('body-title')
    科室介绍
@stop

@section('body-main')
    <img class="section-pic" src="{{{ $photo }}}" />

    <h3 class="section-name title">{{{ $name }}}</h3>
    <div class="hospital-name">{{{ $hospital_name }}}</div>

    <div class="description">
        {{ $content }}
    </div>

    @if ( isset( $doctor ) )
        <div class="doc-info">
            <img class="doc-pic" src="{{{ $doctor['photo'] }}}" />
            {{ $doctor['description'] }}
            {{ $doctor['specialty'] }}
        </div>
    @endif

    <button class="btn">返回顶部</button>
@stop