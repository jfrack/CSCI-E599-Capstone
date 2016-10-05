<?php

class Employee extends Eloquent {

	use SoftDeletingTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'employees';

	# The guarded properties specifies which attributes should *not* be mass-assignable
	protected $guarded = array('id', 'created_at', 'updated_at');

	/**
	* Employee belongs to one User (one to one)
	*/
	public function user() {
	return $this->belongsTo('User');
	}

	/**
	* Employee has many Contacts (one to many)
	*/
	public function contacts() {
		return $this->hasMany('Contact');
	}

	/**
	* Employees belong to many Checklists (many to many)
	*/
	public function checklists() {
		return $this->belongsToMany('Checklist');
	}

	/**
	* Employees have many Files (one to many)
	*/
	public function files() {
		return $this->hasMany('File');
	}

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