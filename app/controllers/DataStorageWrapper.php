<?php

class DataStorageWrapper{

    protected static $expire_time = 60;

    public static $default_value = '';

    public function get( $key ){
        return Cache::get( $key, self::$default_value ); 
    }

    public function set( $key, $value ){
        return Cache::put( $key, $value, self::$expire_time );
    }

    public function has( $key ){
        return Cache::has( $key );
    }
}

?>