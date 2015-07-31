@extends('layouts.master')

@section('title')
    医院信息
@stop

@section('css')
    @parent
    <link rel="stylesheet" type="text/css" href="/dist/css/hospital/department/overview.css" />
@stop

@section('js-lib')
    @parent
@stop

@section('js-common')
    @parent
@stop

@section('body-title')
    科室介绍
@stop

@section('body-main')
    <ul class="department-wrap">
        @foreach ( $departments as $department )
            <li class="department-item">
                <button class="btn">
                    <a href="/hospital/department/detail?department_id={{{ $department->id }}}.php">
                        {{{ $department->name }}}
                    </a>
                </button>
            </li>
        @endforeach
    </ul>
@stop