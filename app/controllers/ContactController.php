<?php

class ContactController extends BaseController {


    public function __construct() {

        # Make sure BaseController gets called
        parent::__construct();

        # Only logged in users should have access to this controller
        $this->beforeFilter('auth');

    }

    # GET: http://localhost/contact
    public function getIndex() {

    }

    # POST: http://localhost/contact/delete/$id
    # called by EmployeeController@postDelete
    public function postDelete($id) {

        try {
            # try to soft delete every employee contact record
            Contact::where('employee_id', '=', $id)->delete();
        }
        catch(exception $e) {
            return Redirect::action('IndexController@getIndex')
            ->with('flash_message_error', 'ERROR CC1: Could not delete contacts.');
        }
    }

}