<?php

class File extends Eloquent {

	use SoftDeletingTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'files';

	# The guarded properties specifies which attributes should *not* be mass-assignable
	protected $guarded = array('id', 'created_at', 'updated_at');

	/**
	* File belongs to one Employee (one to one)
	*/
	public function employee() {
	return $this->belongsTo('Employee');
	}

}