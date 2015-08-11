@extends('layouts.master')

@section('title')
    登陆
@stop

@section('css')
    @parent
    <link rel="stylesheet" type="text/css" href="/dist/css/user/login.css" />
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

            $('.login-form').on( 'submit', function( event ){
                event.preventDefault();
                $.ajax({
                    url: '/user/login',
                    type: 'POST',
                    dataType: 'json',
                    data: $(this).serialize(),
                    success: function ( json ){
                        alert( json.message );
                        if ( json.error_code == 0 ){
                            window.location.href = json.uri_before ? '/' + json.uri_before : '/user/center';    
                        }
                    }
                });
            });
        });
    </script>
@stop

@section('body-title')
    <a class="register" href="/user/register">注册</a>
@stop

@section('body-main')
    <form class="login-form" method="post" action="/user/login">
        <input class="input-blk form-blk" placeholder="手机号码" id="phone" name="phone" type="text">
        <input class="input-blk form-blk" placeholder="密码" id="password" name="password" type="password">
        <div class="form-mdl form-blk clearfix">
            <input id="rem-check" class="checkbox" type="checkbox">
            <span class="checkbox-text">记住用户名</span>
            <a class="recover-pwd" href="recover_password.php">找回密码 ></a>
        </div>
        <input class="btn form-blk" type="submit" value="登陆">
    </form>
@stop
