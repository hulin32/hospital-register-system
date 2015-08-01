<?php

class UserController extends BaseController{

    protected static $possible_charactors = 'abcdefghijklmnopqrstuvwxyz0123456789';

    protected static $telephone_reg = "/^13[0-9]{1}[0-9]{8}$|15[0189]{1}[0-9]{8}$|189[0-9]{8}$|17[0-9]{1}[0-9]{8}/";

    public function check_phone(){
        $user_telephone = Input::get( 'telephone' );

        if ( User::where( 'phone', $user_telephone )->first() ){
            return Response::json(array( 'error_code' => 1, 'message' => '该手机号已被注册' ));
        }

        return Response::json(array( 'error_code' => 0, 'message' => '该手机号可注册' ));
    }

    public function send_verification_code(){
        Session_start();

        $code  =  '';   //验证码
        while( strlen( $code ) < 6 ){
             $code .= substr( self::$possible_charactors, 
                              rand( 0, strlen( self::$possible_charactors ) - 1 ),
                              1 );
        }

        $user_telephone = Input::get( 'telephone' );

        if ( preg_match( self::$telephone_reg, $user_telephone ) ){

            $user = User::where( 'phone', $user_telephone )->first();

            if ( $user ){
                return Response::json(array( 'error_code' => 2, 'message' => '该手机号已被注册' ));
            }

            // 发送验证码
            if ( $this->send_message( $code, $user_telephone ) ){
                return Response::json(array( 'error_code' => 3, 'message' => '验证码发送失败' ));
            }

            $_SESSION['verification_code'] = $code;

            return Response::json(array( 'error_code' => 0, 'message' => '验证码已经发送' ));
        }

        return Response::json(array( 'error_code' => 1, 'message' => '手机号码不正确' ));
    }

    protected function send_message( $code, $user_telephone ){
        
        $argv = array(
            'name' => '13580501456',
            'pwd' => '1AF3988258DE4FABDD7E1C5FDB36',
            'sign' => '紫睿科技',
            'type' => 'pt',
            'mobile' => $user_telephone,
            'content' => '您的验证码为：'.$code
        );

        $url = 'http://web.cr6868.com/asmx/smsservice.aspx?'.http_build_query( $argv, '', '&' );
        
        $response = file_get_contents( $url );
        $return_code = substr( $response, 0, 1 );

        return $return_code == '0';
    }

    public function check_verification_code(){
        Session_start();

        $input_code = Input::get( 'verification_code' );
        $session_code = $_SESSION[ 'verification_code' ];

        $validator = Validator::make(
            array( 'code' => $input_code ),
            array( 'code' => 'required|alpha_num|size:6' )
        );

        if ( $validator->fails() ){
            return Response::json(array( 'error_code' => 2, 'message' => '验证码格式错误' ));
        }

        if ( $input_code != $session_code ){
            return Response::json(array( 'error_code' => 1, 'message' => '验证码错误' ));
        }

        return Response::json(array( 'error_code' => 0, 'message' => '验证码正确' ));
    }

    public function register_get(){

    }

    public function register_post(){

    }

    public function login_get(){
        
    }

    public function login_post(){

    }
}