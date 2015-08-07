<?php

class DepartmentController extends HospitalBasedController {

    protected $not_found_error_code;

    public function __construct(){
        parent::__construct();

        $this->not_found_error_code = 1;
        $this->set_error_message( $this->not_found_error_code, 'Not found' );
    }

    public function overview(){
        $departments = Department::select( 'id', 'name', 'icon' )
                                   ->where( 'hospital_id', $this->hospital_id )
                                   ->get();

        if ( $departments ){
            $this->set_template( 'hospital.department.overview' );
            $this->set_data(array( 'departments' => $departments ));
        }else{
            $this->set_error_code( $this->not_found_error_code );
        }

        return $this->response();
    }

    public function detail(){
        $department = Department::find( Input::get( 'department_id' ) );

        if ( $department ){
            $this->set_template( 'hospital.department.detail' );
            $this->set_data(array( 
                'name' => $department->name,
                'photo' => $department->photo,
                'content' => $department->description
            ));

            // Json response:
            //     Remove html tags 
            $this->set_postprocess_function( 'json', function( $result, $status ){
                if ( $status ){
                    $result['content'] = strip_tags( $result['content'] );
                }

                return $result;
            });

            // Html response:
            //     add some information
            $this->set_postprocess_function( 
                'html', 
                function( $result, $status ) use ( $department ){
                    if ( $status ){
                        $chief_doctor = $department->doctors()
                                                   ->where( 'is_chief', true )->first();
                        $hospital_name = $department->hospital()->first()->name;

                        $result['photo'] = $department->photo;
                        $result['hospital_name'] = $hospital_name;

                        if ( $chief_doctor ){
                            $result['doctor'] = array(
                                'photo' => $chief_doctor->photo,
                                'description' => $chief_doctor->description,
                                'specialty'   => $chief_doctor->specialty
                            );    
                        }
                    }

                    return $result;
                }
            );

        }else{
            $this->set_error_code( $this->not_found_error_code );
        }

        return $this->response();
    }
}