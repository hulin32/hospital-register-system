<?php

class HospitalBasedController extends BaseController {

    protected $hospital_id;

    protected static $default_hospital_id = 1;

    public function __construct(){
        parent::__construct();
        $this->hospital_id = (int)Input::get( 'hospital_id', self::$default_hospital_id );
    }

    public function get_hospital_info(){
        $hospital_info = Hospital::find( $this->hospital_id );

        return $hospital_info ? $hospital_info : Hospital::find( self::$default_hospital_id );
    }
}