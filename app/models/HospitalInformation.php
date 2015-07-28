
<?php

class HospitalInformation extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hospital_information';

    protected $fillable = array(
        'title',
        'image',
        'time',
        'content',
        'is_new',
        'hospital_id'
    );

    public function hospital(){
        return $this->belongsTo( 'Hospital' );
    }
}
