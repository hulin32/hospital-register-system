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

@section('js-specify')
    <script type="text/javascript">
        $(document).ready(function() {

            $('.btn-save').hide();

            $('.setting-btn').on('click', function(){
                $(this).hide();
                $('.btn-look-rec').hide();
                $('.btn-save').show();

                $('.input-box').prop('readonly', false);
                $('.gender-select').prop('readonly', false);
            });

            $('.account-form').on('submit', function( event ){
                event.preventDefault();
                
                $.ajax({
                    url: $('.account-form').prop('action'),
                    type: 'POST',
                    dataType: 'json',
                    data: $('.account-form').serialize(),
                    success: function( json ){
                        if ( json.error_code == 0 ){
                            alert( '保存成功' );
                            window.location.reload();
                        }else{
                            alert( json.messages[0] );
                        }
                    }
                });
                
            });

        });
    </script>
@stop

@section('body-title')
    我的账户
    <a class="setting-btn" href="#">
        <img src="/images/icons/setting.png">
    </a>
@stop

@section('body-main')
<div class="user-info-wrap clearfix">
    <div class="head-portrait-wrap">
        <img class="head-portrait" src="/images/users/head_portrait.png">
    </div>

    @if ( isset( $account ) )
    <form class="account-form" method="post" action="/user/register_account/modify_account">
        <input type="text" style="display:none" name="account_id" value="{{{ $account['id'] }}}">
        <div class="form-blk clearfix">
            <span class="input-key">姓 名：</span>
            <input class="input-box" id="name" name="name" type="text" value="{{{ $account['name'] }}}" readonly="readonly">
        </div>
        <div class="form-blk clearfix">
            <span class="input-key">性 别：</span>
            <select class="gender-select" name="gender" readonly="readonly">
                @if ( $account['gender'] )
                <option value="0">&nbsp&nbsp&nbsp&nbsp男</option>
                <option value="1" selected>&nbsp&nbsp&nbsp&nbsp女</option>
                @else
                <option value="0" selected>&nbsp&nbsp&nbsp&nbsp男</option>
                <option value="1">&nbsp&nbsp&nbsp&nbsp女</option>
                @endif
            </select>
        </div>
        <div class="form-blk clearfix">
            <span class="input-key">年 龄：</span>
            <input class="input-box" id="age" name="age" type="text" value="{{{ $account['age'] }}}" readonly="readonly">
        </div>
        <div class="form-blk clearfix">
            <span class="input-key">体 重：</span>
            <input class="input-box" name="weight" type="text" value="{{{ $account['weight'] }}}" readonly="readonly">
        </div>
        <div class="form-blk clearfix">
            <span class="input-key">血 型：</span>
            <input class="input-box" id="blood_type" name="blood_type" type="text" value="{{{ $account['blood_type'] }}}" readonly="readonly">
        </div>
        <div class="form-blk clearfix">
            <span class="input-key">手机号码：</span>
            <input class="input-box" id="phone" name="phone" type="text" value="{{{ $account['phone'] }}}" readonly="readonly">
        </div>
        <div class="form-blk clearfix">
            <span class="input-key">身份证号码：</span>
            <input class="input-box" id="id_card" name="id_card" type="text" value="{{{ $account['id_card'] }}}" readonly="readonly">
        </div>
        <div class="form-blk clearfix">
            <span class="input-key">紧急联系人姓名：</span>
            <input class="input-box" id="emergency_name" name="emergency_name" value="{{{ $account['emergency_name'] }}}" readonly="readonly">
        </div>
        <div class="form-blk clearfix">
            <span class="input-key">紧急联系人号码：</span>
            <input class="input-box" id="emergency_phone" name="emergency_phone" value="{{{ $account['emergency_phone'] }}}" readonly="readonly">
        </div>
        <button class="btn btn-look-rec">
            <a href="/user/record/get_records">查看我的挂号</a>
        </button>
        <input class="btn btn-save" value="保存" type="submit">
    </form>
    @else
    <form class="account-form" method="post" action="/user/register_account/add_account">
        <div class="form-blk clearfix">
            <span class="input-key">姓 名：</span>
            <input class="input-box" id="name" name="name" type="text">
        </div>
        <div class="form-blk clearfix">
            <span class="input-key">性 别：</span>
            <select class="gender-select" name="gender" readonly="readonly">
                <option value="0">&nbsp&nbsp&nbsp&nbsp男</option>
                <option value="1">&nbsp&nbsp&nbsp&nbsp女</option>
            </select>
        </div>
        <div class="form-blk clearfix">
            <span class="input-key">年 龄：</span>
            <input class="input-box" id="age" name="age" type="text">
        </div>
        <div class="form-blk clearfix">
            <span class="input-key">体 重：</span>
            <input class="input-box" name="weight" type="text">
        </div>
        <div class="form-blk clearfix">
            <span class="input-key">血 型：</span>
            <input class="input-box" id="blood_type" name="blood_type" type="text">
        </div>
        <div class="form-blk clearfix">
            <span class="input-key">手机号码：</span>
            <input class="input-box" id="phone" name="phone" type="text">
        </div>
        <div class="form-blk clearfix">
            <span class="input-key">身份证号码：</span>
            <input class="input-box" id="id_card" name="id_card" type="text">
        </div>
        <div class="form-blk clearfix">
            <span class="input-key">紧急联系人姓名：</span>
            <input class="input-box" id="emergency_name" name="emergency_name">
        </div>
        <div class="form-blk clearfix">
            <span class="input-key">紧急联系人号码：</span>
            <input class="input-box" id="emergency_phone" name="emergency_phone">
        </div>
        <button class="btn btn-look-rec">
            <a href="/user/record/get_records">查看我的挂号</a>
        </button>
        <input class="btn btn-save" value="保存" type="submit">
    </form>
    @endif
</div>
@stop