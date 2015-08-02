@extends('layouts.master')

@section('title')
    预约挂号
@stop

@section('css')
    @parent
    <link rel="stylesheet" type="text/css" href="/dist/css/user/pay_record.css" />
@stop

@section('js-lib')
    @parent
@stop

@section('js-common')
    @parent
@stop

@section('body-title')
    缴费记录
@stop

@section('body-main')
    <div class="msg-wrap">
        <img class="hover-img" src="/images/icons/pay_record.png" />
        <div class="msg">
            暂无缴费记录
        </div>
    </div>
@stop