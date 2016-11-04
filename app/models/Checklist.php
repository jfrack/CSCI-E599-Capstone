<?php

class Checklist extends Eloquent {

	use SoftDeletingTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'checklists';

	# The guarded properties specifies which attributes should *not* be mass-assignable
	protected $guarded = array('id', 'created_at', 'updated_at');

	/**
	* Checklists belong to many Employees (many to many)
	*/
	public function employees() {
		return $this->belongsToMany('Employee');
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