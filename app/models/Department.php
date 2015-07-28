
<?php

class Department extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'departments';

    protected $fillable = array(
        'name',
        'photo',
        'icon',
        'description',
        'hospital_id'
    );

    public function doctors(){
        return $this->hasMany( 'Doctor' );
    }

    public function hospital(){
        return $this->belongsTo( 'Hospital' );
    }
}
