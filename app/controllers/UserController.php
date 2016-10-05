<?php

use Faker\Provider\pt_PT\username;

class UserController extends BaseController {


    public function __construct() {

        # Make sure BaseController gets called
        parent::__construct();

        # Only logged in users should have access to this controller
        #$this->beforeFilter('auth');

        # Guests should only be allowed login access
         $this->beforeFilter('guest', array('only' => array('getLogin')));
    }

    # GET: http://localhost/user
    public function getIndex() {

    }

    # GET: http://localhost/user/login
    public function getLogin() {
        return View::make('user_login');
    }

    # POST: http://localhost/user/login
    public function postLogin() {

/*
        # form validation
        $rules = array(
            #'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:6'
        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()) {
            return Redirect::to('user/login')
                    ->with('flash_message', 'Login failed; please try again.')
                    ->withInput()
                    ->withErrors($validator);
        }
*/

        $credentials = Input::only('username', 'password');

        # Note we don't have to hash the password before attempting to auth - Auth::attempt will take care of that for us
        if (Auth::attempt($credentials, $remember = false)) {
            return Redirect::intended('/');
        }
        else {
            return Redirect::to('/user/login')
                    ->with('flash_message_error', 'Log in failed.  Please try again.')
                    ->withInput();
        }
    }

    # GET: http://localhost/user/logout
    public function getLogout() {
        # Log out
        Auth::logout();

        # Send them to login page
        return Redirect::to('/user/login');
    }

    # POST: http://localhost/user/delete/$id
    # called by EmployeeController@postDelete
    public function postDelete($id) {

        try {
            $user = User::findOrFail($id);
        }
        catch(exception $e) {
            return Redirect::action('IndexController@getIndex')
            ->with('flash_message_error', 'ERROR UC1: Could not delete employee.');
        }

        # inactivate user account
        $user->update(array('status' => 0));

        # soft delete user account
        $user->delete();
    }

}