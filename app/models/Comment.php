
<?php

class Comment extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'comments';

    protected $fillable = array(
        'content',
        'user_id',
        'doctor_id'
    );

    public function user(){
        return $this->belongsTo( 'User' );
    }

    public function doctor(){
        return $this->belongsTo( 'Doctor' );
    }
}
