
<?php

class Schedule extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'schedules';

    protected $fillable = array(
        'date',
        'period',
        'doctor_id'
    );

    public function doctor(){
        return $this->belongsTo( 'Doctor' );
    }
}
