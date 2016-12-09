<?php

class Role_User extends Eloquent {

	use SoftDeletingTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'role_user';

	# The guarded properties specifies which attributes should *not* be mass-assignable
	protected $guarded = array('created_at', 'updated_at');

	# Enable fillable so we can use the Model shortcut Create
	protected $fillable = array('user_id', 'role_id');

	/**
	* Execute raw SQL query
	*/
	public function execQuery($query) {

		# Escape SQL
		$sql = DB::raw($query);

		# Run the SQL query
		$results = DB::select($sql);

		return $results;
	}

}