<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use SoftDeletingTrait, UserTrait, RemindableTrait;

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
	protected $hidden = array('password', 'remember_token');

	# The guarded properties specifies which attributes should *not* be mass-assignable
	protected $guarded = array('id', 'created_at', 'updated_at');

	# Enable fillable on the 'name' column so we can use the Model shortcut Create
	protected $fillable = array('username', 'password', 'status', 'last_login');

	/**
	* User has one Employee
	*/
	public function employee() {
	return $this->hasOne('Employee');
	}

	/**
	* Users belong to many Roles (many to many)
	*/
	public function roles() {
		return $this->belongsToMany('Role');
	}

}
