@extends('layouts.master')

@section('title')
    发送成功
@stop

@section('css')
    @parent
    <link rel="stylesheet" type="text/css" href="/dist/css/user/feedback/success.css" />
@stop

@section('js-lib')
    @parent
@stop

@section('js-common')
    @parent
@stop

@section('body-title')
    发送成功
@stop

@section('body-main')
    <div class="msg-wrap">
        <img class="hover-img" src="/images/icons/hover.png" />
        <div class="msg">
            <p>发送成功</p>
            <p>感谢您宝贵的意见!</p>
        </div>
    </div>
@stop