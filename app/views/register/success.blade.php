@extends('layouts.master')

@section('title')
    预约挂号
@stop

@section('css')
    @parent
    <link rel="stylesheet" type="text/css" href="/dist/css/register/success.css" />
@stop

@section('js-lib')
    @parent
@stop

@section('js-common')
    @parent
@stop

@section('body-title')
    挂号成功
@stop

@section('body-main')
    <div class="msg-wrap clearfix">
        <img class="hover-img" src="/images/icons/hover.png" />
        挂号成功
    </div>

    <button class="btn"><a href="/user/record/get_records">查看我的挂号记录</a></button>
@stop