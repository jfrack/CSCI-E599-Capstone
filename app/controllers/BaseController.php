<?php

class BaseController extends Controller {

	public function __construct() {

		# all routes submitted via POST to have the csrf before filter
    	$this->beforeFilter('csrf', array('on' => 'post'));
    }

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	/**
	* Convert mm/dd/yyyy from datepicker to yyyy-mm-dd to store in DB
	*
	* @return $new_date
	*/
	public static function convertDateDB($date) {
		try {
			$new_date = substr($date, 6, 4).'-'.substr($date, 0, 2).'-'.substr($date, 3, 2);
			$new_date = date_create($new_date);
			return $new_date;
		}
		catch(exception $e) {
			throw Redirect::action('IndexController@getIndex')
            ->with('flash_message_error', 'ERROR BC1: Could not convert date.');
		}
	}

	/**
	* Convert yyyy-mm-dd from DB to mm/dd/yyyy to display
	*
	* @return $new_date
	*/
	public static function convertDateView($date) {

		try {
			//$new_date = substr($date, 5, 2).'/'.substr($date, 8, 2).'/'.substr($date, 0, 4);
			$new_date = date("m-d-Y", strtotime($date));
			return $new_date;
		}
		catch(exception $e) {
			throw Redirect::action('IndexController@getIndex')
            ->with('flash_message_error', 'ERROR BC2: Could not convert date.');
		}
	}

	/**
	* Convert yyyy-mm-dd from DB to mm/dd/yyyy to display
	*
	* @return $new_date
	*/
	public static function convertDateTimeView($date) {

		try {
			//$new_date = substr($date, 5, 2).'/'.substr($date, 8, 2).'/'.substr($date, 0, 4);
			$new_date = date("m-d-Y h:i a", strtotime($date));
			return $new_date;
		}
		catch(exception $e) {
			throw Redirect::action('IndexController@getIndex')
            ->with('flash_message_error', 'ERROR BC2: Could not convert date.');
		}
	}

}
