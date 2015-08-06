
<?php

class Doctor extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'doctors';

    protected $fillable = array(
        'name',
        'photo',
        'title',
        'specialty',
        'description',
        'is_chief',
        'is_consultable',
        'department_id'
    );

    public function register_records(){
        return $this->hasMany( 'RegisterRecord' );
    }

    public function schedules(){
        return $this->hasMany( 'Schedule' );
    }

    public function department(){
        return $this->belongsTo( 'Department' );
    }

    public function title(){
        return $this->belongsTo( 'Title' );
    }
}
