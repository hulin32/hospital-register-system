
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
        'record_id'
    );

    public function record(){
        return $this->belongsTo( 'RegisterRecord', 'record_id', 'id' );
    }

}
