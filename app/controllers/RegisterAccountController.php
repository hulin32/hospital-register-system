<?php

class RegisterAccountController extends BaseController{

    public function get_accounts(){

        $accounts = RegisterAccount::select( 'id', 'name', 'phone' )
                                     ->where( 'user_id', Session::get( 'user.id' ) )
                                     ->get();

        if ( !isset( $accounts )){
            return Response::json(array( 'error_code' => 1, 'message' => '您还没有挂号账户' ));
        }

        return Response::json(array( 'error_code' => 0, 'accounts' => $accounts ));
    }

    public function detail(){

        $account = RegisterAccount::find( Input::get( 'account_id' ) )
                                    ->where( 'user_id', Session::get( 'user.id' ) )->first();

        if ( !isset( $account ) ){
            return Response::json(array( 'error_code' => 1, 'message' => '不存在该账户' ));
        }

        return Response::json(array( 'error_code' => 0, 'account' => $account ));
    }

    public function modify(){

        $account = RegisterAccount::find( Input::get( 'account_id' ) )
                                    ->where( 'user_id', Session::get( 'user.id' ) )->first(); 

        if ( !isset( $account ) ){
            return Response::json(array( 'error_code' => 1, 'message' => '不存在该账户' ));
        }

        if ( $id_card = Input::get( 'id_card' ) ){
            if ( !pre_match( Config::get('regular.id_card') ) ){
                return Response::json(array( 'error_code' => 2, 'message' => '身份证号格式不正确' ));
            }

            if ( $account = RegisterAccount::where( 'id_card', $id_card )->get() ){
                return Response::json(array( 'error_code' => 3, 'message' => '该身份证已被注册' ));
            }
            
            $account->id_card = $id_card;
        }

        /*

        if ( $name = Input::get( 'name' ) ){
            $account->name = $name;
        }

        if ( $age = Input::get( 'age' ) ){
            $account->age = (int)$age;
        }

        if ( $weight = Input::get( 'weight' ) ){
            $account->weight = (int)$weight;
        }

        if ( $blood_type = Input::get( 'blood_type' ) ){
            $account->blood_type = $blood_type;
        }

        if ( $type = Input::get( 'type' ) ){
            $account->type = $type;
        }

        if ( $phone = Input::get( 'phone' ) ){
            $account->phone = $phone;
        }

        if ( $emergency_name = Input::get( 'emergency_name' ) ){
            $account->emergency_name = $emergency_name;
        }

        if ( $emergency_phone = Input::get( 'emergency_phone' ) ){
            $account->emergency_phone = $emergency_phone;
        }

        */

        if ( !$account->save() ){
            return Response::json(array( 'error_code' => 4, 'message' => '修改失败' ));
        }

        return Response::json(array( 'error_code' => 0, 'message' => '修改成功' ));
    }

    public function add_account(){
        
    }
}