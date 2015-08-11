@extends('layouts.master')

@section('title')
    预约挂号
@stop

@section('css')
    @parent
    <link rel="stylesheet" type="text/css" href="/dist/css/register/select_schedule.css" />
@stop

@section('js-lib')
    @parent
@stop

@section('js-common')
    @parent
@stop

@section('body-title')
    预约时间
@stop

@section('body-main')    
    <div class="doc-info-wrap clearfix">
        <img class="doc-pic float-left" src="{{{ $doctor['photo'] }}}" alt="王磊" />
        <div class="doc-info-detail float-left">
            <div class="doc-name">{{{ $doctor['name'] }}}</div>
            <div class="doc-title">职称: {{{ $doctor['title'] }}}</div>
            <div class="doc-section">科室：{{{ $doctor['department'] }}}</div>
            <div class="doc-hospital">医院：{{{ $doctor['hospital'] }}}</div>
        </div>
    </div>
@stop
     
@section('body-bottom')   
    <div class="list-wrap">
        <div class="list-head l-grey">导源列表</div>
            <table class="schedule">
                
                <tr class="schedule-head">
                    <th>日期</th>
                    <th>上午</th>
                    <th>下午</th>
                </tr>

                @foreach ( $schedules as $schedule )
                    <tr class="schedule-data">
                        <th class="date">{{{ $schedule['date'] }}}</th>
                        @if ( array_key_exists( $schedule['date'], $schedules_map ) )
                            <td>
                                @if ( array_key_exists( 0, $schedules_map[ $schedule['date'] ] ) )
                                    @if ( $schedules_map[ $schedule['date'] ][0]['status'] )
                                        <button class="btn">
                                            <a href="/register/select_period?schedule_id={{{ $schedules_map[ $schedule['date'] ][0]['id'] }}}">
                                                挂号
                                            </a>
                                        </button>
                                    @else
                                        <button class="btn-disabled" disabled="disabled">
                                            已满
                                        </button>
                                    @endif
                                @endif
                            </td>
                            <td>
                                @if ( array_key_exists( 1, $schedules_map[ $schedule['date'] ] ) )
                                    @if ( $schedules_map[ $schedule['date'] ][1]['status'] )
                                        <button class="btn">
                                            <a href="/register/select_period?schedule_id={{{ $schedules_map[ $schedule['date'] ][1]['id'] }}}">
                                                挂号
                                            </a>
                                        </button>
                                    @else
                                         <button class="btn-disabled" disabled="disabled">
                                            已满
                                        </button>
                                    @endif
                                @endif
                            </td>
                        @else
                            <td></td>
                            <td></td>
                        @endif
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@stop