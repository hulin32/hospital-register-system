@extends('layouts.master')

@section('title')
    预约挂号
@stop

@section('css')
    @parent
    <link rel="stylesheet" type="text/css" href="/dist/css/register/select_department.css" />
@stop

@section('js-lib')
    @parent
@stop

@section('js-common')
    @parent
@stop

@section('body-title')
    选科室
@stop

@section('body-main')

    <div class="clearfix desc-top">
        <div class="desc-name l-grey">{{{ $hospital['name'] }}}</div>
        <div class="desc-level">二级</div>
    </div>

    <div class="desc-wrap">
        <div class="desc-body clearfix">
            <div class="desc-left">
                <img class="logo" src="{{{ $hospital['logo'] }}}">
            </div>
            <div class="desc-main l-grey">
                <p>
                    专长：{{{ $hospital['specialty'] }}}
                </p>
                <p>
                    地址：{{{ $hospital['address'] }}}
                </p>
                <p>
                    预约时间：{{{ $hospital['register_start'] }}}～{{{ $hospital['register_end'] }}}
                </p>
                <p>
                    电话：{{{ $hospital['phone'] }}}
                </p>
            </div>
        </div>
                
        <fieldset class="section-wrap">
            <legend class="sec-top l-grey">选择科室</legend>
            
            <ul class="section-list clearfix">
                @foreach ( $departments as $department )
                    <li class="section-item">
                        <button class="btn">
                            <a href="/register/select_doctor?department_id={{{ $department['id'] }}}">{{{ $department['name'] }}}</a>
                        </button>
                    </li>
                @endforeach
            </ul>
        </fieldset>
                
    </div>

@stop