<?php

class RegisterController extends BaseController{
    
    public function select_department(){

        $hospital = Hospital::find( Input::get( 'hospital_id', 1 ) );

        if ( !isset( $hospital ) ){
            // ...
        }

        $departments = $hospital->departments;

        if ( !isset( $departments ) ){
            // ...
        }

        return View::make( 'register.select_department', 
                           array( 'hospital' => $hospital, 'departments' => $departments->toArray() ));
    }

    public function select_doctor(){

        $department = Department::find( Input::get( 'department_id' ) );

        if ( !isset( $department ) ){
            // ..
        }

        $doctors = $department->doctors()->with('title')->get();

        if ( !isset( $doctors ) ){
            // ..
        }

        foreach ( $doctors as $doctor ){
            $doctor['title'] = $doctor->title->name;
        }

        return View::make( 'register.select_doctor',
                           array( 'hospital_name' => $department->hospital->name,
                                  'department' => $department,
                                  'doctors' => $doctors ));
    }

    // 需要改进下。。。
    public function select_schedule(){

        $doctor = Doctor::find( Input::get( 'doctor_id' ) );

        if ( !isset( $doctor ) ){
            // ..
        }

        $schedules = $doctor->schedules()->with( 'periods' )->get();

        $schedules_map = array();
        foreach( $schedules as $schedule ){
            if ( !array_key_exists( $schedule->date , $schedules_map ) ){
                $schedules_map[ $schedule->date ] = array();
            }

            foreach ( $schedule->periods as $period ){
                if ( $period->current < $period->total ){
                     $schedules_map[ $schedule->date ][ $schedule->period ] = true;
                     break;
                }
            }

            $schedules_map[ $schedule->date ][ $schedule->period ] = false;
        }

        $schedules_all = array();

        $date_from = 0;
        $date_to = 7;

        $current_date = date_create();

        for ( $i = $date_from; $i < $date_to; ++$i ){
            $schedules_all[ $i ] = array(
                'date' => date_format( date_create( '@'.strtotime( '+'.$i.' day' ) ), 'Y-m-d' ),
            );
        }

        return View::make( 
            'register.select_schedule',
            array( 
                'doctor' => array(
                    'name'          => $doctor->name,
                    'photo'         => $doctor->photo,
                    'title'         => $doctor->title->name,
                    'department'    => $doctor->department->name,
                    'hospital'      => $doctor->department->hospital->name
                ),
                'schedules'         => $schedules_all,
                'schedules_map'     => $schedules_map
            )
        );
    }

    public function select_period(){

    }
}