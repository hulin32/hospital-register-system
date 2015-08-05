<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array(
		'password',
		'permissions',
		'activated',
		'activation_code',
		'activated_at',
		'last_login',
		'persist_code',
		'reset_password_code',
		'updated_at',
		'created_at'
	);

	protected $fillable = array(
		'account',
		'password',
		'gender',
		'phone',
		'activated',
		'activated_at'
	);

	public function comments(){
		return $this->hasMany( 'Comment' );
	}

	public function register_accounts(){
		return $this->hasMany( 'RegisterAccount' );
	}

	public function register_records(){
		return $this->hasMany( 'RegisterRecord' );
	}

	public function feedbacks(){
		return $this->hasMany( 'Feedback' );
	}
}
