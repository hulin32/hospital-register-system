<?php

class RegisterAccountController extends BaseController{

    public function get_accounts(){

        $accounts = RegisterAccount::select( 'id', 'name', 'phone' )
                                   ->where( 'user_id', Session::get( 'user.id' ) )
                                   ->get();

        if ( !isset( $accounts )){
            return Response::json(array( 'error_code' => 1, 'message' => 'Unkown Error' ));
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

    public function modify_account(){

        $inputs = Input::all();
        $account = RegisterAccount::find( $inputs['account_id'] )
                                  ->where( 'user_id', Session::get( 'user.id' ) )->first(); 

        if ( !isset( $account ) ){
            return Response::json(array( 'error_code' => 1, 'message' => '不存在该账户' ));
        }
        
        $rules = array(
            'name'              => '',
            'age'               => 'integer|min:0',
            'weight'            => 'numeric|min:0',
            'gender'            => 'in:0,1',
            'blood_type'        => '',
            'type'              => '',
            'phone'             => 'telephone',
            'emergency_name'    => '',
            'emergency_phone'   => 'telephone'
        );

        $messages = array(
            'min'               => ':attribute不能小于:min',
            'in'                => ':attribute错误',
            'telephone'         => ':attribute格式不正确',
            'numeric'           => ':attribute需为数字',
            'integer'           => ':attribute需为整数'
        );

        $custom_attribute = array(
            'name'              => '姓名',
            'age'               => '年龄',
            'weight'            => '体重',
            'gender'            => '性别',
            'blood_type'        => '血型',
            'phone'             => '手机号',
            'type'              => '患者类型',
            'emergency_name'    => '紧急联系名',
            'emergency_phone'   => '紧急联系电话'
        );

        $validator = Validator::make(
            $inputs,
            $rules,
            $messages,
            $custom_attribute
        );

        //return Response::json( Input::all() );

        if ( $validator->fails() ){
            return Response::json(array( 'error_code' => 2, 'messages' => $validator->messages()->all() ));
        }

        foreach ( $rules as $key => $value ){
            if ( array_key_exists( $key, $inputs ) ){
                $account[ $key ] = $inputs[ $key ];
            }
        }
        
        if ( !$account->save() ){
            return Response::json(array( 'error_code' => 1, 'message' => '修改失败' ));
        }

        return Response::json(array( 'error_code' => 0, 'message' => '修改成功' ));
    }

    public function add_account(){

        $inputs = Input::all();
        $rules = array(
            'name'              => 'required',
            'age'               => 'required|integer|min:0',
            'weight'            => 'required|numeric|min:0',
            'gender'            => 'required|in:0,1',
            'blood_type'        => 'required',
            'type'              => '',
            'phone'             => 'required|telephone',
            'id_card'           => 'required|id_card|unique:register_accounts,id_card',
            'emergency_name'    => '',
            'emergency_phone'   => 'telephone'
        );

        $messages = array(
            'required'          => ':attribute不能为空',
            'min'               => ':attribute不能小于:min',
            'in'                => ':attribute错误',
            'unique'            => '该:attribute已经被注册',
            'telephone'         => ':attribute格式不正确',
            'id_card'           => '身份证号格式不正确'
        );

        $custom_attribute = array(
            'name'              => '姓名',
            'age'               => '年龄',
            'weight'            => '体重',
            'gender'            => '性别',
            'blood_type'        => '血型',
            'phone'             => '手机号',
            'id_card'           => '身份证号',
            'type'              => '患者类型',
            'emergency_name'    => '紧急联系名',
            'emergency_phone'   => '紧急联系电话'
        );

        $validator = Validator::make(
            $inputs,
            $rules,
            $messages,
            $custom_attribute
        );

        // $validator->messages()->all() ?
        if ( $validator->fails() ){
            return Response::json(array( 'error_code' => 2, 'message' => $validator->messages()->all() ));
        }

        $account = new RegisterAccount();

        foreach ( $rules as $key => $value ){
            if ( array_key_exists( $key, $inputs ) ){
                $account[ $key ] = $inputs[ $key ];
            }
        }

        $account->user_id = Session::get( 'user.id' );

        if ( !$account->save() ){
            return Response::json(array( 'error_code' => 1, 'message' => '注册失败' ));
        }

        return Response::json(array( 'error_code' => 0, 'message' => '注册成功' ));
    }
}