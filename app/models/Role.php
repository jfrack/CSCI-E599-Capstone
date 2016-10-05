<?php

class Role extends Eloquent {

	use SoftDeletingTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'roles';

	# The guarded properties specifies which attributes should *not* be mass-assignable
	protected $guarded = array('id', 'created_at', 'updated_at');

	# Enable fillable on the 'name' column so we can use the Model shortcut Create
	protected $fillable = array('name');

	/**
	* Roles belong to many Users (many to many)
	*/
	public function users() {
		return $this->belongsToMany('User');
	}

	public static function boot() {
		parent::boot();
		static::deleting(function($role) {
			DB::statement('DELETE FROM role_user WHERE role_id = ?', array($role->id));
		});
	}

}