
<?php

class Feedback extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'feedbacks';

    protected $fillable = array(
        'title',
        'content',
        'user_id'
    );

    public function user(){
        return $this->belongsTo( 'User' );
    }
}
