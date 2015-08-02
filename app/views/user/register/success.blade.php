@extends('layouts.master')

@section('title')
    注册成功
@stop

@section('css')
    @parent
    <link rel="stylesheet" type="text/css" href="/dist/css/user/register/success.css" />
@stop

@section('js-lib')
    @parent
@stop

@section('js-common')
    @parent
@stop

@section('body-title')
    <a class="register" href="/user/login">登录</a>
@stop

@section('body-main')
    <div class="msg-wrap clearfix">
        <img class="hover-img" src="/images/icons/hover.png" />
        注册成功，请登录
    </div>
@stop