<?php

class HospitalController extends HospitalBasedController{

    public function __construct(){
    
        parent::__construct();

        $this->error_messages[1] = '不存在该医院信息';
    }
    
    public function introduction(){

        $hospital_info = $this->get_hospital_info();

        $data = array();

        if ( $hospital_info ){
            $data['name'] = $hospital_info->name;
            $data['photo'] = $hospital_info->photo;
            $data['description'] = html_entity_decode( $hospital_info->description );
        }else{
            $this->set_error_code( 1 );
        }

        // For html response
        $this->set_template( 'hospital.introduction' );
        
        // Post process function to remove html tags in value of key 'description'
        $this->set_postprocess_function( 'json', function( $result, $is_status_ok ){
            if ( $is_status_ok ){
                $result['description'] = strip_tags( $result['description'] );
            }
            return $result;
        });

        return $this->response( $data );
    }

    public function traffic_guide(){

        $hospital_info = $this->get_hospital_info();

        $data = array();

        if ( $hospital_info ){
            $data['phone'] = $hospital_info->phone;
            $data['longtitude'] = $hospital_info->longtitude;
            $data['latitude'] = $hospital_info->latitude;
            $data['traffic_intro'] = html_entity_decode( $hospital_info->traffic_intro );
            $data['traffic_guide'] = html_entity_decode( $hospital_info->traffic_guide );
        }else{
            $this->set_error_code( 1 );
        }

        // Post process function:
        //     Remove html tags in value of keys 'traffic_intro' and 'traffic_guide'
        $this->set_postprocess_function( 'json', function( $result, $is_status_ok ){
            if ( $is_status_ok ){
                $result['traffic_intro'] = strip_tags( $result['traffic_intro'] );
                $result['traffic_guide'] = strip_tags( $result['traffic_guide'] );
            }

            return $result;
        });

        // For html response
        $this->set_template( 'hospital.traffic_guide' );

        // Preprocess function:
        //     Get weixin access token and javascript api ticket
        $this->set_preprocess_function( 'html', function( $result, $is_status_ok ){
            if ( $is_status_ok ){
                require_once "WeixinSDK.php";
                require_once "DataStorageWrapper.php";

                $app_id = Config::get('weixin.app_id');
                $app_secret = Config::get('weixin.app_secret');

                $wx = new WeixinSDK( $app_id, $app_secret, new DataStorageWrapper() );
                $sign_package = $wx->getSignPackage();

                $result['app_id'] = $app_id;
                $result['sign_package'] = $sign_package;
            }
        });

        return $this->response( $data );
    }
}