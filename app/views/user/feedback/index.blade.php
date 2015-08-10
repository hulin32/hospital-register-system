@extends('layouts.master')

@section('title')
    个人中心
@stop

@section('css')
    @parent
    <link rel="stylesheet" type="text/css" href="/dist/css/user/feedback/index.css" />
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
            $('.feedback-form').on('submit', function( event ){
                event.preventDefault();

                $.ajax({
                    url: '/user/feedback/add_feedback',
                    type: 'POST',
                    dataType: 'json',
                    data: $(this).serialize(),
                    success: function( json ){
                        if ( json.error_code == 0 ){
                            window.location.href = '/user/feedback/success';
                        }else{
                            alert( json.message );
                        }
                    }
                });
            });
        });
    </script>
@stop

@section('body-title')
    反馈建议
@stop

@section('body-main')
    <form method="post" class="feedback-form" action="/user/feedback/add_feedback">
        <div class="input-title-wrap clearfix">
            <textarea class="input-value" placeholder="请输入主题" name="title"></textarea>
            <span class="input-key">主题：</span>
        </div>
        <div class="input-content-wrap clearfix">
            <textarea class="input-value" placeholder="请输入内容" name="content"></textarea>
            <span class="input-key">内容：</span>
            <div class="input-note">字数在200字以内</div>
        </div>
        <input class="sub-btn btn" type="submit" value="发送">
    </form>
@stop
