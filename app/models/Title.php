
<?php

class Title extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'titles';

    protected $fillable = array(
        'name',
        'register_fee'
    );

    public function doctors(){
        return $this->hasMany( 'Doctor' );
    }
}
