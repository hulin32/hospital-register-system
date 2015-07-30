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
        
        // Callback function to remove html tags in value of key 'description'
        $this->set_postprocess_function( 'json', function( $result, $is_status_ok ){
            if ( $is_status_ok ){
                $result['description'] = strip_tags( $result['description'] );
            }
            return $result;
        });

        return $this->response( $data );
    }

    public function traffic_guide(){
    
        require_once "WeixinSDK.php";
        require_once "SaeDataStorageWrapper.php";

        $app_id = Config::get('weixin.app_id');
        $app_secret = Config::get('weixin.app_secret');

        $wx = new JSSDK( $appId, $appSecret, new SaeDataStorageWrapper() );
        $sign_package = $wx->getSignPackage();

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

        // For html response
        $this->set_template( 'hospital.traffic_guide' );

        // Callback function:
        //     Remove html tags in value of keys 'traffic_intro' and 'traffic_guide'
        $this->set_postprocess_function( 'json', function( $result, $is_status_ok ){
            if ( $is_status_ok ){
                $result['traffic_intro'] = strip_tags( $result['traffic_intro'] );
                $result['traffic_guide'] = strip_tags( $result['traffic_guide'] );
            }

            return $result;
        });

        return $this->response( $data );
    }
}