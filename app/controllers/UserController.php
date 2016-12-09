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

    # GET: http://localhost/user/help
    public function getHelp() {
        return View::make('user_help');
    }

    # POST: http://localhost/user/help
    public function postHelp() {
        return;
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
                    ->with('flash_message_error', 'Login failed.  Please try again.')
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
        try {
            $user->delete();
        }
        catch(exception $e) {
            return Redirect::action('IndexController@getIndex')
            ->with('flash_message_error', 'ERROR UC2: Could not delete employee.');
        }
    }

    /*
    * Display security manager page
    * GET: http://localhost/user/security_manager
    */
    public function getSecurityManager() {
    
        $roles = Role::get();    
                    
        return View::make('user_security_manager')
                ->with('roles', $roles);
    }

    /*
    * Display employee's security page
    * GET: http://localhost/user/security/$user_id
    */
    public function getSecurity($user_id) {

        $employee = Employee::where('id', '=', $user_id)->first();

        $roles = Role::get();

        $role_selection = array();
        foreach ($roles as $role) {
            $role_selection[] = $role->name;
        }

        # start array at index 1 instead of 0
        array_unshift($role_selection, 'phoney');
        unset($role_selection[0]);
    
        $role_user = DB::table('roles')
                    ->join('role_user', 'roles.id', '=', 'role_user.role_id')
                    ->where('user_id', '=', $user_id)
                    ->get();    
                    
        return View::make('user_security')
                ->with('employee', $employee)
                ->with('role_selection', $role_selection)
                ->with('role_user', $role_user);
    }

    # POST: http://localhost/user/add/$user_id/role/$role_id
    public function postAddRole() {

        $user_id = Input::get('employee_id');
        $role_selection = Input::get('role_selection');
        $role_id = $role_selection;

        try {
            # Insert item into role_user table
            $user_role = Role_User::create(array(
                        'user_id' => $user_id,
                        'role_id' => $role_id));
            $user_role->save();
        }
        catch (exception $e) {
            return Redirect::action('UserController@getSecurity', ['user_id' => $user_id])
            ->with('flash_message_error', 'ERROR UC3: Internal error adding role.');
        }

        # Return to user security view
        return Redirect::action('UserController@getSecurity', ['user_id' => $user_id])
                ->with('flash_message_success', 'User role has been added.');
    }

}