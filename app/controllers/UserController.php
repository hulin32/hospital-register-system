<?php

class UserController extends BaseController{

    protected static $verification_code_expire = 60;

    protected static $verification_expire = 3600;

    protected static $possible_charactors = 'abcdefghijklmnopqrstuvwxyz0123456789';

    protected static $telephone_reg = "/^13[0-9]{1}[0-9]{8}$|15[0189]{1}[0-9]{8}$|189[0-9]{8}$|17[0-9]{1}[0-9]{8}/";

    protected function send_message( $user_telephone, $message ){
        
        $argv = array(
            'name' => '13580501456',
            'pwd' => '1AF3988258DE4FABDD7E1C5FDB36',
            'sign' => '紫睿科技',
            'type' => 'pt',
            'mobile' => $user_telephone,
            'content' => $message //'您的验证码为：'.$code
        );

        $url = 'http://web.cr6868.com/asmx/smsservice.aspx?'.http_build_query( $argv, '', '&' );
        
        $response = file_get_contents( $url );
        $return_code = substr( $response, 0, 1 );

        return $return_code == '0';
    }

    protected function generate_verification_code(){
        $code  =  '';   //验证码
        while( strlen( $code ) < 6 ){
             $code .= substr( self::$possible_charactors, 
                              rand( 0, strlen( self::$possible_charactors ) - 1 ),
                              1 );
        }

        return $code;
    }

    protected function is_verification_failed(){

        return empty( Session::get( 'verification.passed' ) );
    }

    protected function is_verification_expired(){

        if ( !Session::has( 'verification' ) ){
            return false;
        }

        if ( Session::get( 'verification.expire' ) > time() ){
            return false;
        }

        return true;
    }

    protected function is_verification_code_expired(){

        $expire = Session::get( 'verification.code.expire' );

        if ( !isset( $expire ) || $expire > time() ){

            return true;
        }

        return false;
    }

    public function check_phone(){
        $user_telephone = Input::get( 'verification.telephone' );

        if ( User::where( 'phone', $user_telephone )->first() ){
            return Response::json(array( 'error_code' => 1, 'message' => '该手机号已被注册' ));
        }

        return Response::json(array( 'error_code' => 0, 'message' => '该手机号可注册' ));
    }

    public function send_verification_code(){

        $code = $this->generate_verification_code();
        $user_telephone = Input::get( 'telephone' );

        if ( !preg_match( self::$telephone_reg, $user_telephone ) ){

            return Response::json(array( 'error_code' => 1, 'message' => '手机号码不正确' ));
        }

        $message = '您的验证码为：'.$code;

        // 发送验证码
        if ( !$this->send_message( $user_telephone, $message ) ){
            return Response::json(array( 'error_code' => 3, 'message' => '验证码发送失败' ));
        }

        // 设置验证通过标志
        Session::put( 'verification.passed', false );
        
        // 保存用户手机
        Session::put( 'verification.telephone', $user_telephone );
        
        // 保存验证码
        Session::put( 'verification.code.content', $code );
        
        // 设置验证码期限 - 60 seconds
        Session::put( 'verification.code.expire', time() + self::$verification_code_expire );
        
        // 设置该验证有效期 - 60 minutes
        Session::put( 'verification.expire', time() + self::$verification_expire );

        return Response::json(array( 'error_code' => 0, 'message' => '验证码已经发送' ));
    }

    public function check_verification_code(){

        /**
         * Check if call this method directly
         */
        if ( !$this->is_verification_expired() ){

            return Response::json(array( 'error_code' => 2, 'message' => '请先获取验证码' ));
        }

        if ( $this->is_verification_code_expired() ){

            Session::forget( 'verification' );

            return Response::json(array( 'error_code' => 3, 'message' => '请重新获取验证码' ));
        }

        if ( !$this->is_verification_failed() ){

            return Response::json(array( 'error_code' => 4, 'message' => '已验证' ));
        }

        $code_from_input = Input::get( 'verification_code' );
        $code_from_session = Session::get( 'verification.code.content' );

        if ( $code_from_input != $code_from_session ){

            return Response::json(array( 'error_code' => 1, 'message' => '验证码错误' ));
        }

        // 验证成功
        Session::put( 'verification.passed', true );

        return Response::json(array( 'error_code' => 0, 'message' => '验证码正确' ));
    }

    public function verify_and_reset_password(){

        if ( $this->is_verification_expired() ){
            return Response::json(array( 'error_code' => 2, 'message' => '请先验证手机号' ));
        }

        if ( $this->is_verification_failed() ){
            return Response::json(array( 'error_code' => 3, 'message' => '尚未验证通过' ));
        }

        $new_password = Input::get( 'new_password' );

        if ( !isset( $new_password ) ){
            return Response::json(array( 'error_code' => 4, 'message' => '请输入新密码' ));
        } 

        $user = User::where( 'phone', Session::get( 'verification.telephone' ) )->first();
        $user->password = $new_password;

        if ( !$user->save() ){
            return Response::json(array( 'error_code' => 1, 'message' => '修改失败' ));
        }

        return Response::json(array( 'error_code' => 0, 'message' => '修改成功' ));
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

        Session::put( 'user.id', Sentry::getUser()->id );

        return Response::json(array( 'error_code' => 0, 'message' => '登陆成功' ));
    }

    public function register_get(){

        return View::make( 'user.register.index' );
    }

    public function register_post(){

        if ( $this->is_verification_expired() ){
            return Response::json(array( 'error_code' => 2, 'message' => '请先验证手机号' ));
        }

        if ( $this->is_verification_failed() ){
            return Response::json(array( 'error_code' => 3, 'message' => '尚未验证通过' ));
        }

        if ( !Input::has( 'nickname' ) ){
            return Response::json(array( 'error_code' => 4, 'message' => '请输入昵称' ));
        }    

        if ( !Input::has( 'password' ) ){
            return Response::json(array( 'error_code' => 5, 'message' => '请输入密码'));
        }

        if ( !Input::has( 'real_name' ) ){
            return Response::json(array( 'error_code' => 6, 'message' => '请输入真实姓名' ));
        }

        $telephone = Session::get( 'verification.telephone' );
        $nickname   = Input::get( 'nickname' );
        $password  = Input::get( 'password' );
        $real_name = Input::get( 'real_name' );

        try{
            Sentry::create(array(
                'nickname' => $nickname,
                'password' => $password,
                'real_name' => $real_name,
                'phone' => $telephone,
                'activated' => true
            ));    
        }catch( Exception $e ){
            return Response::json(array( 'error_code' => 1, 'message' => '注册失败' ));
        }

        return Response::json(array( 'error_code' => 0, 'message' => '注册成功' ));
    }

    public function user_center(){

        $register_account = RegisterAccount::where( 'user_id', Session::get( 'user.id' ) )->first();

        return View::make( 'user.center', array( 'account' => $register_account ) );
    }

}