<?php

class HospitalController extends HospitalBasedController{

    public function __construct(){
    
        parent::__construct();

        $this->error_messages[1] = '不存在该医院信息';
    }
    
    public function introduction(){

        $hospital_info = $this->get_hospital_info();

        if ( $hospital_info ){
            // For html response
            $this->set_template( 'hospital.introduction' );

            $this->set_data(array(
                'name' => $hospital_info->name,
                'photo' => $hospital_info->photo,
                'description' => $hospital_info->description
            ));

            // Post process function to remove html tags in value of key 'description'
            $this->set_postprocess_function( 'json', function( $result, $status ){
                if ( $status ){
                    $result['description'] = strip_tags( $result['description'] );
                }
                return $result;
            });
        }else{
            $this->set_error_code( 1 );
        }

        return $this->response();
    }

    public function traffic_guide(){

        $hospital_info = $this->get_hospital_info();

        if ( $hospital_info ){
            // For html response
            $this->set_template( 'hospital.traffic_guide' );

            $this->set_data(array(
                'phone' => $hospital_info->phone,
                'latitude' => $hospital_info->latitude,
                'longtitude' => $hospital_info->longtitude,
                'traffic_guide' => $hospital_info->traffic_guide,
                'traffic_intro' => $hospital_info->traffic_intro
            ));

            // Post process function:
            //     Remove html tags in value of keys 'traffic_intro' and 'traffic_guide'
            $this->set_postprocess_function( 'json', function( $result, $status ){
                if ( $status ){
                    $result['traffic_intro'] = strip_tags( $result['traffic_intro'] );
                    $result['traffic_guide'] = strip_tags( $result['traffic_guide'] );
                }

                return $result;
            });

            // Post function:
            //     Get weixin access token and javascript api ticket
            $this->set_postprocess_function( 'html', function( $result, $status ){
                if ( $status ){
                    $app_id = Config::get('weixin.app_id');
                    $app_secret = Config::get('weixin.app_secret');

                    $wx = new WeixinSDK( $app_id, $app_secret, new DataStorageWrapper() );
                    $sign_package = $wx->getSignPackage();

                    $result['app_id'] = $app_id;
                    $result['sign_package'] = $sign_package;
                }

                return $result;
            });
        }else{
            $this->set_error_code( 1 );
        }

        return $this->response();
    }

    public function usage(){

        return View::make( 'hospital.usage' );
    }
    
}