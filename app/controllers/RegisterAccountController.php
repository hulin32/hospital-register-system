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
                                    ->where( 'user_id', Session::get( 'user.id' ) );

        if ( !isset( $account ) ){
            return Response::json(array( 'error_code' => 1, 'message' => '不存在该账户' ));
        }

        return Response::json(array( 'error_code' => 0, 'account' => $account ));
    }

    public function modify(){

    }

    public function add_account(){
        
    }
}