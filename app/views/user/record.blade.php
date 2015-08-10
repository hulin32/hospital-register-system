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

@section('js-specify')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.cancel').on( 'click', function( event ){
                event.preventDefault();

                var record_id = $(this).attr('record_id');

                $.ajax({
                    url: '/user/record/cancel',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        record_id: record_id
                    },
                    success: function( json ){
                        if ( json.error_code == 0 ){
                            $( '#' + record_id ).remove();
                        }
                        alert( json.message );
                    }
                });
                
            });
        });
    </script>
@stop

@section('body-title')
    挂号记录
@stop

@section('body-main')
    @foreach ( $records as $record )
        <div id="{{{ $record['id'] }}}">
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
                <div class="cancel-wrap clearfix">
                    <button record_id="{{{ $record['id'] }}}" class="btn cancel">
                        取消挂号
                    </button>
                </div>
            @endif
        </div>
    @endforeach
@stop
