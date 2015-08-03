@extends('layouts.master')

@section('title')
    个人中心
@stop

@section('css')
    @parent
    <link rel="stylesheet" type="text/css" href="/dist/css/user/center.css" />
@stop

@section('js-lib')
    @parent
@stop

@section('js-common')
    @parent
@stop

@section('body-title')
    我的账户
    <a class="setting-btn" href="user_setting.php">
        <img src="/images/icons/setting.png">
    </a>
@stop

@section('body-main')
    <div class="user-info-wrap clearfix">
        <div class="head-portrait-wrap">
            <img class="head-portrait" src="/images/users/head_portrait.png">
        </div>
        <p class="info-item">
            <span class="key">姓 名：</span>
            <span class="value">{{{ $account['name'] }}}</span>
        </p>
        <p class="info-item">
            <span class="key">性 别：</span>
            <span class="value">{{{ $account['gender'] }}}</span>
        </p>
        <p class="info-item">
            <span class="key">年 龄：</span>
            <span class="value">{{{ $account['age'] }}}</span>
        </p>
        <p class="info-item">
            <span class="key">体 重：</span>
            <span class="value">{{{ $account['weight'] }}}kg</span>
        </p>
        <p class="info-item">
            <span class="key">血 型：</span>
            <span class="value">{{{ $account['blood_type'] }}}</span>
        </p>
        <p class="info-item">
            <span class="key">身份证号码：</span>
            <span class="value">{{{ $account['id_card'] }}}</span>
        </p>
        <p class="info-item">
            <span class="key">手机号码：</span>
            <span class="value">{{{ $account['phone'] }}}</span>
        </p>
        <p class="info-item">
            <span class="key">紧急联系人姓名：</span>
            <span class="value">{{{ $account['emergency_name'] }}}</span>
        </p>
        <p class="info-item">
            <span class="key">紧急联系人号码：</span>
            <span class="value">{{{ $account['emergency_phone'] }}}</span>
        </p>
    </div>
@stop