<?php

class PeriodController extends BaseController{

    public function get_periods(){
        
        $schedule = Schedule::find( Input::get( 'schedule_id' ) );
        
        if ( !isset( $schedule ) ){
            return Response::json(array( 'error_code' => 1, 'message' => '不存在该排班' ));
        }

        $periods = $schedule->periods;

        if ( !isset( $periods ) ){
            return Response::json(array( 'error_code' => 2, 'message' => '该排班无日期' ));
        }

        return Response::json(array( 'error_code' => 0, 'periods' => $periods ));
    }

    public function add_period(){

    }

    public function modify_period(){
        
    }

    public function delete_period(){

    }
}