@extends('layouts.master')

@section('title')
    注册
@stop

@section('css')
    @parent
    <link rel="stylesheet" type="text/css" href="/dist/css/user/register/index.css" />
@stop

@section('js-lib')
    @parent
@stop

@section('js-common')
    @parent
@stop

@section('body-title')
@stop

@section('body-main')
    <form class="register-form" method="post" action="/user/register/success">
        <div class="form-blk clearfix">
            <span class="input-key">用户名</span><span class="fucking-colon">：</span>
            <input class="input-box" placeholder="字母，数字，4-20位" name="username" type="text">
        </div>
        <div class="form-blk clearfix">
            <span class="input-key">密码</span><span class="fucking-colon">：</span>
            <input class="input-box" placeholder="6-16位字母、数字、符号的组合" name="password" type="password">
        </div>
        <div class="form-blk clearfix">
            <span class="input-key">确认密码</span><span class="fucking-colon">：</span>
            <input class="input-box" name="password_cfm" type="password">
        </div>
        <div class="form-blk clearfix">
            <span class="input-key">真实姓名</span><span class="fucking-colon">：</span>
            <input class="input-box" placeholder="真实填写，提交后无法修改" name="real_name" type="text">
        </div>
        <div class="form-blk clearfix">
            <span class="input-key">性别</span><span class="fucking-colon">：</span>
            <select class="sex-select" name="sex">
                <option value="男">男</option>
                <option value="女">女</option>
            </select>
        </div>
        <div class="form-blk clearfix">
            <span class="input-key">手机号码</span><span class="fucking-colon">：</span>
            <input class="input-box" placeholder="手机联系号码" name="phone" type="text">
        </div>
        <div class="form-blk clearfix">
            <span class="input-key">电子邮箱</span><span class="fucking-colon">：</span>
            <input class="input-box" placeholder="邮箱地址，用于密码找回" name="email" type="text">
        </div>
        <div class="captcha-wrap">
            <div class="form-blk clearfix">
                <span class="input-key">验证码</span><span class="fucking-colon">：</span>
                <input class="input-box" placeholder="" name="captcha" type="text">
            </div>
            <img class="captcha" src="/images/captcha.png">
        </div>
        <div class="form-blk clearfix">
            <span class="input-key">注册协议</span><span class="fucking-colon">：</span>
            <span class="user-protocol">
                <input class="checkbox" type="checkbox">
                <span>我已阅读并接受<a class="protocol-link" href="user/protocol">用户协议！</a></span>
            </span>
        </div>
        <input class="btn" type="submit" value="提交">
    </form>
@stop