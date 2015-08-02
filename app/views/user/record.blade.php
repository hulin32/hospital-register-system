@extends('layouts.master')

@section('title')
    个人中心
@stop

@section('css')
    @parent
    <link rel="stylesheet" type="text/css" href="/dist/css/user/record.css" />
@stop

@section('js-lib')
    @parent
@stop

@section('js-common')
    @parent
@stop

@section('body-title')
    挂号记录
@stop

@section('body-main')
    @foreach ( $records as $record )
        <div class="record-wrap">
            <div class="record-item">
                <div class="item-wrap clearfix">
                    <span class="item-key">时间</span>
                    <span class="colon">：</span>
                    <span class="item-value">
                        {{{ $record['date'] }}} {{{ $record['period']}}} {{{ $record['start'] }}}-{{{ $record['end'] }}}
                    </span>
                </div>
            </div>
            <div class="record-item">
                <div class="item-wrap clearfix">
                    <span class="item-key">科室</span>
                    <span class="colon">：</span>
                    <span class="item-value">{{{ $record['department'] }}}</span>
                </div>
            </div>
            <div class="record-item">
                <div class="item-wrap clearfix">
                    <span class="item-key">主治医师</span>
                    <span class="colon">：</span>
                    <span class="item-value">{{{ $record['doctor']['title'] }}}{{{ $record['doctor']['name'] }}}</span>
                </div>
            </div>
            <div class="record-item">
                <div class="item-wrap clearfix">
                    <span class="item-key">状态</span>
                    <span class="colon">：</span>
                    <button class="btn" disabled="disable">{{{ $record['status'] }}}</button>
                </div>
            </div>
        </div>
        @if ( $record['can_be_canceled'] )
            <div record_id="{{{ $record['id'] }}}" class="cancel-wrap clearfix">
                <button class="btn cancel">
                    取消挂号
                </button>
            </div>
        @endif
    @endforeach
@stop
