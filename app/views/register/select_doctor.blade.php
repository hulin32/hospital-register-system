@extends('layouts.master')

@section('title')
    预约挂号
@stop

@section('css')
    @parent
    <link rel="stylesheet" type="text/css" href="/dist/css/register/select_doctor.css" />
@stop

@section('js-lib')
    @parent
@stop

@section('js-common')
    @parent
@stop

@section('body-title')
    选医生
@stop

@section('body-main')
    <div class="description">
        <h3 class="title">{{{ $department['name'] }}}</h3>
        <div class="hospital-name">{{{ $hospital_name }}}</div>
        <div class="description-main l-grey">
            {{ $department['description'] }}
        </div>
    </div>
@stop

@section('body-bottom')   
    <div class="list-wrap">
        <div class="list-head l-grey">医生列表</div>
        <ul class="doc-list">
            @foreach ( $doctors as $doctor )
            <li class="doc-sg">
                <button class="btn">
                    <a class="doc-detail" href="/register/select_schedule?doctor_id={{{ $doctor['id'] }}}">
                        <div class="doctor-name">{{{ $doctor['name'] }}}</div>
                        <div class="doctor-title">{{{ $doctor['title'] }}}</div>
                    </a>
                </button>
            </li>
            @endforeach
        </ul>
    </div>
@stop