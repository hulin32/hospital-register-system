<?php

class DoctorController extends BaseController {

    public function get_doctors(){
        
        $department = Department::find( Input::get( 'department_id' ) );

        if ( !isset( $department ) ){
            return Response::json(array( 'error_code' => 1, 'message' => '不存在该诊室' ));
        }

        $doctors = $department->doctors()->with('title')->get();

        if ( !isset( $doctors ) ){
            return Response::json(array( 'error_code' => 2, 'message' => '该诊室无医生...' ));
        }

        $result = array();
        foreach ( $doctors as $doctor ){
            $result[] = array(
                'id'                => $doctor->id,
                'name'              => $doctor->name,
                'title'             => $doctor->title->name,
                'photo'             => $doctor->photo,
                'specialty'         => strip_tags( $doctor->specialty ),
                'can_be_registered' => $this->can_be_registered( $doctor->id ),
                'is_consultable'    => $doctor->is_consultable
            );
        }

        return Response::json(array( 'error_code' => 0, 'doctors' => $result ));
    }

    protected function can_be_registered( $doctor_id ){
        $periods = Doctor::find( $doctor_id )->schedules()->with('periods')->get();

        foreach ( $periods as $period ) {
            if ( $period->current < $period->total ){
                return true;
            }
        }

        return false;
    }

    public function add_doctor(){

    }

    public function modify_doctor(){

    }

    public function delete_doctor(){
    
    }
}