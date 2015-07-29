<?php

class HospitalBasedController extends BaseController {

    protected $hospital_id;

    protected static $default_hospital_id = 1;

    public function __construct(){
        parent::__construct();
        $this->hospital_id = Input::get( 'hospital_id', self::$default_hospital_id );
    }
}