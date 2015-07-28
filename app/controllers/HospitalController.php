<?php

class HospitalController extends BaseController{
    
    public function introduction(){
        return View::make( 'hospital.introduction' );
    }
}