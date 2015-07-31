@extends('layouts.master')

@section('title')
    医院信息
@stop

@section('css')
    @parent
    <link rel="stylesheet" type="text/css" href="/dist/css/hospital/introduction.css" />
@stop

@section('js-lib')
    @parent
@stop

@section('js-common')
    @parent
@stop

@section('body-title')
    医院简介
@stop

@section('body-main')
    <img class="hos-pic" src="{{{ $photo }}}" alt="{{{ $name }}}">

    <fieldset class="desc-bd">
        <legend class="desc-top">简介</legend>
        {{ $description }}
        <div class="desc-btm clearfix">
            <div class="line"></div>
            <div class="arrow-wrap">
                <img class="desc-btm-arrow" src="/images/icons/arrow_down.png" />
            </div>
            <div class="line"></div>
        </div>
    </fieldset>
@stop