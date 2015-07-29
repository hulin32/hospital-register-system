<?php

class HospitalController extends HospitalBasedController{
    
    public function introduction(){

        //$hospital_id = Input::get( 'hospital_id', 1 );
        $hospital_info = Hospital::find( $this->hospital_id );

        if ( $hospital_info ){
            $data = array(
                'photo' => $hospital_info->photo,
                'name' => $hospital_info->name,
                'description' => html_entity_decode( $hospital_info->description )
            );
        }

        // For json response
        if ( $this->return_type == 'json' ){

            if ( isset( $data ) ){
                $data['error_code'] = 0;
                $data['description'] = strip_tags( $data['description'] );

                return Response::json( $data );
            }

            // Hospital does not exists
            else{
                return Response::json([ 
                    'error_code' => 1, 
                    'message' => '不存在该医院信息'
                ]);
            }
        }

        // For html response
        else{
            if ( isset( $data ) ){
                return View::make( 'hospital.introduction', $data );
            }else{
                die( 'Error!' );
            }
        }
    }

    public function traffic_guide(){
        $hospital_id = Input::get( 'hospital_id', 1 );
        $hospital_info = Hospital::find( $hospital_id );
        
        if ( $hospital_info ){
            $data = array();
        }
    }
}