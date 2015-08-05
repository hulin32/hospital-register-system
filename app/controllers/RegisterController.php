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

    public function select_schedule(){

    }

    public function select_period(){

    }
}