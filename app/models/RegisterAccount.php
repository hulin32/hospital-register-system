
<?php

class RegisterAccount extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'register_accounts';

    protected $fillable = array(
        'name',
        'age',
        'weight',
        'gender',
        'type',
        'blood_type',
        'phone',
        'id_card',
        'emergency_name',
        'emergency_phone',
        'user_id'
    );

    public function user(){
        return $this->belongsTo( 'User' );
    }

    public function records(){
        return $this->hasMany( 'RegisterRecord', 'account_id', 'id' );
    }
}
