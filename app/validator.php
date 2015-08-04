<?php

Validator::extend('telephone', function($attribute, $value, $parameters){

    return preg_match( Config::get( 'regex.telephone' ), $value );
});

Validator::extend('id_card', function($attribute, $value, $parameters){

    return preg_match( Config::get( 'regex.id_card' ), $value );
});