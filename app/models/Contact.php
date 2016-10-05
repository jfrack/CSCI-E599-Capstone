<?php

class Contact extends Eloquent {

	use SoftDeletingTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'contacts';

	# The guarded properties specifies which attributes should *not* be mass-assignable
	protected $guarded = array('id', 'created_at', 'updated_at');

	/**
	* Contact belongs to one Employee (one to one)
	*/
	public function employee() {
		return $this->belongsTo('Employee');
	}

}