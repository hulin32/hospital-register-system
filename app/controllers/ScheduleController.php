<?php

class ScheduleController extends BaseController{

    public function get_schedules(){

        $doctor = Doctor::find( Input::get( 'doctor_id' ) );

        if ( !isset( $doctor ) ){
            return Response::json(array( 'error_code' => 1, 'message' => '不存在该医生' ));
        }

        $schedules = $doctor->schedules()->with( 'periods' )->get();

        if ( !isset( $schedules ) ){
            return Response::json(array( 'error_code' => 2, 'message' => '没有排班' ));
        }

        $result = array();
        $current_date = date_create();
        $latest = (int)Input::get( 'latest' );

        $default_latest = 7;
        $latest = $latest >= isset( $latest ) ? $latest : $default_latest;

        foreach ( $schedules as $schedule ){
            $sd = date_create( $schedule->date );
            $diff = date_diff( $current_date, $sd );

            if ( $diff->d >= 0 && $diff->d < $latest ){
                $result[] = array(
                    'id'        => $schedule->id,
                    'date'      => $schedule->date,
                    'period'    => $schedule->period,
                    'is_full'   => $this->is_full( $schedule )
                );
            }
        }

        return Response::json(array( 'error_code' => 0, 'schedules' => $result ));
    }

    protected function is_full( $schedule ){
        foreach ( $schedule->periods as $period ){
            if ( $period->current < $period->total ){
                return false;
            }
        }

        return true;
    }

    public function add_schedule(){

    }

    public function modify_schedule(){
        
    }

    public function delete_schedule(){

    }
}