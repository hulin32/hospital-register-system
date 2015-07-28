
<?php

class Period extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'periods';

    protected $fillable = array(
        'start',
        'end',
        'total',
        'current',
        'schedule_id'
    );

    public function schedule(){
        return $this->belongsTo( 'Schedule' );
    }
}
