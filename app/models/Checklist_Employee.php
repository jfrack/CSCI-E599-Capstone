<?php

class Checklist_Employee extends Eloquent {

	use SoftDeletingTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'checklist_emplooyee';

	# The guarded properties specifies which attributes should *not* be mass-assignable
	protected $guarded = array('created_at', 'updated_at');

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