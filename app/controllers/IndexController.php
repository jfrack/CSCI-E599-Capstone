<?php
class IndexController extends BaseController {

	public function __construct() {

		# Make sure BaseController construct gets called
		parent::__construct();

		# Only logged in users should have access to this controller otherwise redirect to login
        $this->beforeFilter('auth');

	}

	public function getIndex() {

		$employees = Employee::orderBy('lastname')->orderBy('firstname')->get();

		return View::make('index')->with('employees', $employees);
	}

}