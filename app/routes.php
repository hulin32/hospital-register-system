<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// 医院模块
Route::group(array('prefix' => 'hospital'), function()
{
	Route::get('introduction', 'HospitalController@introduction');
    Route::get('traffic_guide', 'HospitalController@traffic_guide');

    // 资讯模块
    Route::group(array('prefix' => 'information'), function(){
        Route::get('preview', 'HospitalInformationController@preview');
        Route::get('detail', 'HospitalInformationController@detail');
    });

    // 诊室模块
    Route::group(array('prefix' => 'department'), function(){
        Route::get('overview', 'DepartmentController@overview');
        Route::get('detail', 'DepartmentController@detail');
    });
});

//用户模块
Route::group(array('prefix' => 'user'), function(){
    
    Route::get('check_verification_code', 'UserController@check_verification_code');
    Route::post('send_verification_code', 'UserController@send_verification_code');

    Route::get('register', 'UserController@register_get');
    Route::post('register', 'UserController@register_post');
    Route::get('login', 'UserController@login_get');
    Route::post('login', 'UserController@login_post');

    // 挂号记录模块
    Route::group(array('prefix' => 'record', 'before' => 'auth.user.is_in'), function(){
        Route::get('get_records', 'RegisterRecordController@get_records');
        Route::post('add_record', 'RegisterRecordController@add_record');
        Route::get('add_return_time', 'RegisterRecordController@add_return_time');
        Route::post('cancel', 'RegisterRecordController@cancel');
    });

    // 挂号账户模块
    Route::group(array('prefix' => 'register-account', 'before' => 'auth.user.is_in'), function(){
        Route::get('get_accounts', 'RegisterAccountController@get_accounts');
        Route::get('detail', 'RegisterAccountController@detail');
        Route::post('modify', 'RegisterAccountController@modify');
        Route::post('add_account', 'RegisterAccountController@add_account');
    });

    // 评论模块
    Route::group(array('prefix' => 'comment', 'before' => 'auth.user.is_in'), function(){
        Route::get('get_comments', 'CommentController@get_comments');
        Route::post('add_comment', 'CommentController@add_comment');
    });

    // 反馈模块
    Route::group(array('prefix' => 'feedback', 'before' => 'auth.user.is_in'), function(){
        Route::post('add_feedback', 'FeedbackController@add_feedback');
    });
});

// 挂号模块
Route::group(array('prefix' => 'register', 'before' => 'auth.user.is_in'), function(){
    Route::get('get_doctors', 'DoctorController@get_doctors');
    Route::get('get_schedules', 'ScheduleController@get_schedules');
    Route::get('get_periods', 'PeriodController@get_periods');
});