<?php

class SaeDataStorageWrapper{
    private $kvdb;

    public function __construct(){
        $this->kvdb = new SaeKV();
        $this->kvdb->init();
        $this->init_kvdb();
    }

    private function init_kvdb(){

        if ( !$this->kvdb->get( "access_token" ) ){
            $this->kvdb->add( "access_token", "" );
        }

        if ( !$this->kvdb->get( "access_token_expire_time" ) ){
            $this->kvdb->add( "access_token_expire_time", 0 );
        }

        if ( !$this->kvdb->get( "jsapi_ticket" ) ){
            $this->kvdb->add( "jsapi", "" );
        }

        if ( !$this->kvdb->get( "jsapi_ticket_expire_time" ) ){
            $this->kvdb->add( "jsapi_ticket_expire_time", 0 );
        }
    }

    public function get( $key ){
        return $this->kvdb->get( $key ); 
    }

    public function set( $key, $value ){
        return $this->kvdb->set( $key, $value );
    }
}

?>