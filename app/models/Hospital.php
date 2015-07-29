
<?php

class Hospital extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hospitals';

    protected $fillable = array(
        'name',
        'address',
        'phone',
        'logo',
        'photo',
        'register_start',
        'register_stop',
        'specialty',
        'description',
        'traffic_intro',
        'traffic_guide',
        'longtitude',
        'latitude'
    );

    public function information(){
        return $this->hasMany( 'HospitalInformation' );
    }

    public function departments(){
        return $this->hasMany( 'Department' );
    }
}
