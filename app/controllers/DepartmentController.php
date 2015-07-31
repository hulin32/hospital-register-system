<?php

class DepartmentController extends HospitalBasedController {

    public function overview(){
        $departments = Department::select( 'id', 'name', 'icon' )
                                   ->where( 'hospital_id', $this->hospital_id )
                                   ->get();

        if ( $departments->count() ){
            return Response::json(array( 'error_code' => 1, 'departments' => $departments ));
        }

        return Response::json(array( 'error_code' => 1, 'message' => 'Not found' ));
    }

    public function detail(){
        
    }
}