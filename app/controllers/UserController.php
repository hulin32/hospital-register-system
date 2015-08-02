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

            Session::put( 'telephone' );
            Session::put( 'verification_code', $code );
            Session::put( 'verification_code_expire', time() + 60 );

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

        /**
         * Check if call this method directly
         */
        if ( !Session::has( 'verification_code' ) ){

            return Response::json(array( 'error_code' => 3, 'message' => '请先获取验证码' ));
        }

        /**
         * Check expire time
         */
        else if ( Session::( 'verification_code_expire' ) < time() ){

            // clear session
            Session::forget( 'telephone' );
            Session::forget( 'verification_code' );
            Session::forget( 'verification_code_expire' );

            return Response::json(array( 'error_code' => 4, 'message' => '请重新获取验证码' ));
        }

        $input_code = Input::get( 'verification_code' );
        $session_code = Session::pull( 'verification_code' );

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

    public function login_get(){
        
        return View::make( 'user.login' );
    }

    public function login_post(){

        try{
            Sentry::authenticate(array(
                'phone' => Input::get( 'phone' ),
                'password' => Input::get( 'password' )
            ), false);

        }catch( Cartalyst\Sentry\Users\LoginRequiredException $e ){

            return Response::json(array( 'error_code' => 1, 'message' => '请输入手机号码' ));

        }catch( Cartalyst\Sentry\Users\PasswordRequiredException $e ){

            return Response::json(array( 'error_code' => 2, 'message' => '请输入密码' ));

        }catch( Cartalyst\Sentry\Users\UserNotFoundException $e ){

            return Response::json(array( 'error_code' => 3, 'message' => '不存在该用户' ));

        }catch( Cartalyst\Sentry\Users\WrongPasswordException $e ){

            return Response::json(array( 'error_code' => 4, 'message' => '密码错误' ));
        }

        return Response::json(array( 'error_code' => 0, 'message' => '登陆成功' ));
    }

    public function register_get(){

        return View::make( 'user.register.index' );
    }

    public function register_post(){

        if ( !Session::has( 'telephone' ) ){
            return Response::json(array( 'error_code' => 1, 'message' => '请先验证手机号' ));
        }

        if ( !Input::has( 'account' ) ){
            return Response::json(array( 'error_code' => 2, 'message' => '请输入用户名' ));
        }    

        if ( !Input::has( 'password' ) ){
            return Response::json(array( 'error_code' => 3, 'message' => '请输入密码'));
        }

        if ( !Input::has( 'real_name' ) ){
            return Response::json(array( 'error_code' => 4, 'message' => '请输入真实姓名' ));
        }

        $telephone = Session::get( 'telephone' );
        $account   = Input::get( 'account' );
        $password  = Input::get( 'password' );
        $real_name = Input::get( 'real_name' );
        
        if ( User::where( 'account', $account )->first() ){
            return Response::json(array( 'error_code' => 5, 'message' => '该用户名已存在' ));
        }

        Sentry::create(array(
            'account' => $account,
            'password' => $password,
            'real_name' => $real_name,
            'phone' => $telephone,
            'activated' => true
        ));

        return Response::json(array( 'error_code' => 0, 'message' => '注册成功' ));
    }

    public function user_center(){
        
    }

}