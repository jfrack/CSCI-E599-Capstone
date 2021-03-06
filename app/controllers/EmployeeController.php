<?php

class EmployeeController extends BaseController {


    public function __construct() {

        # Make sure BaseController gets called
        parent::__construct();

        # Only logged in users should have access to this controller
        $this->beforeFilter('auth');
    }

    /*
    * Display employee add form
    * GET: http://localhost/employee/create
    */
    public function getCreate() {
        return View::make('employee_add');
    }

    /*
    * Process employee add form
    * POST: http://localhost/employee/create
    */
    public function postCreate() {

        try {
            # Insert into users table
            $user = User::create(array(
                        'username' => Input::get('username'),
                        'password' => Hash::make(Input::get('password')),
                        'status' => '1',
                        'last_login' => '0000-00-00'));
            $user->save();

        }
        catch (exception $e) {
            return Redirect::action('IndexController@getIndex')
            ->with('flash_message_error', 'ERROR EC1: Internal error adding employee.');
        }

        try {
            # Insert into employees table
            $employee = Employee::create(array(
                        'user_id' => $user->id,
                        'status' => '1',
                        'lastname' => Input::get('lastname'),
                        'firstname' => Input::get('firstname'),
                        'midlname' => Input::get('midlname'),
                        'nickname' => Input::get('nickname'),
                        'birthdate' => $this->convertDateDB(Input::get('birthdate')),
                        'gender' => Input::get('gender'),
                        'start_date' => $this->convertDateDB(Input::get('start_date'))));
            $employee->save();

        }
        catch (exception $e) {
            return Redirect::action('IndexController@getIndex')
            ->with('flash_message_error', 'ERROR EC2: Internal error adding employee.');
        }

        try {
            # Insert into contacts table
            $contact = Contact::create(array(
                        'employee_id' => $employee->id,
                        'type' => 'primary',
                        'address1' => Input::get('address1'),
                        'address2' => Input::get('address2'),
                        'address3' => Input::get('address3'),
                        'city' => Input::get('city'),
                        'state' => Input::get('state'),
                        'zipcode' => Input::get('zipcode'),
                        'phone1' => Input::get('phone1'),
                        'phone2' => Input::get('phone2')));
            $contact->save();

        }
        catch (exception $e) {
            return Redirect::action('IndexController@getIndex')
            ->with('flash_message_error', 'ERROR EC3: Internal error adding employee.');
        }

        # Return to dashboard with a user message
        return Redirect::action('IndexController@getIndex')
            ->with('flash_message_success', $employee->firstname.' '.$employee->lastname.' has been added.');
    }

    /*
    * View employee
    * GET: http://localhost/employee/view/$id
    */
    public function getView($id) {

        $employee = Employee::where('id', '=', $id)->first();
        $contact = Contact::where('employee_id', '=', $employee->id)->first();
        return View::make('employee_view')
                ->with('employee', $employee)
                ->with('contact', $contact);
    }

    /*
    * Edit employee
    * GET: http://localhost/employee/edit/$id
    */
    public function getEdit($id) {

        $employee = Employee::where('id', '=', $id)->first();
        $user = User::where('id', '=', $employee->user_id)->first();
        $contact = Contact::where('employee_id', '=', $employee->id)->first();
        return View::make('employee_edit')
                ->with('employee', $employee)
                ->with('user', $user)
                ->with('contact', $contact);
    }

    /*
    * Edit employee
    * POST: http://localhost/employee/edit
    */
    public function postEdit() {

        try {
            $employee = Employee::findOrFail(Input::get('id'));
        }
        catch(exception $e) {
            return Redirect::action('IndexController@getIndex')
            ->with('flash_message_error', 'ERROR EC6: Could not update employee.');
        }

        $contact = Contact::where('employee_id', '=', $employee->id)->first();

        try {
            # Update employees table
            $employee->update(array(
                        'status' => Input::get('status'),
                        'lastname' => Input::get('lastname'),
                        'firstname' => Input::get('firstname'),
                        'midlname' => Input::get('midlname'),
                        'nickname' => Input::get('nickname'),
                        'birthdate' => $this->convertDateDB(Input::get('birthdate')),
                        'gender' => Input::get('gender'),
                        'start_date' => $this->convertDateDB(Input::get('start_date'))));
            $employee->save();
        }
        catch (exception $e) {
            return Redirect::action('IndexController@getIndex')
            ->with('flash_message_error', 'ERROR EC7: Internal error updating employee.');
        }

        try {
            # Update contacts table
            $contact->update(array(
                        'employee_id' => $employee->id,
                        'type' => 'primary',
                        'address1' => Input::get('address1'),
                        'address2' => Input::get('address2'),
                        'address3' => Input::get('address3'),
                        'city' => Input::get('city'),
                        'state' => Input::get('state'),
                        'zipcode' => Input::get('zipcode'),
                        'phone1' => Input::get('phone1'),
                        'phone2' => Input::get('phone2')));
            $contact->save();
        }
        catch (exception $e) {
            return Redirect::action('IndexController@getIndex')
            ->with('flash_message_error', 'ERROR EC8: Internal error updating employee.');
        }

        # Return to dashboard with a user message
        return Redirect::action('IndexController@getIndex')
            ->with('flash_message_success', $employee->firstname.' '.$employee->lastname.' has been updated.');
    }

    /*
    * Reset employee password
    * GET: http://localhost/employee/reset/$id
    */
    public function getReset($id) {

        $employee = Employee::where('id', '=', $id)->first();
        $user = User::where('id', '=', $employee->user_id)->first();
        return View::make('employee_reset')
                ->with('employee', $employee)
                ->with('user', $user);
    }

    /*
    * Reset employee password
    * POST: http://localhost/employee/reset
    */
    public function postReset() {

        # form validation
        $rules = array(
            'password' => 'required|min:6|same:password_confirm'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('employee/reset/'.Input::get('id'))
                    # Already get specific errors from validator
                    # ->with('flash_message_error', 'Password reset failed.  Please try again.')
                    ->withErrors($validator);
        }

        try {
            $employee = Employee::findOrFail(Input::get('id'));
        }
        catch(exception $e) {
            return Redirect::action('IndexController@getIndex')
                ->with('flash_message_error', 'ERROR EC9: Could not reset employee password.');
        }

        $user = User::where('id', '=', $employee->user_id)->first();

        # Save new password to DB
        try {
            $user->update(array(
                            'password' => Hash::make(Input::get('password'))));
            $user->save();
        }
        catch(exception $e) {
            return Redirect::action('IndexController@getIndex')
                ->with('flash_message_error', 'ERROR EC10: Could not reset employee password.');
        }

        # Return to dashboard with a user message
        return Redirect::action('IndexController@getIndex')
               ->with('flash_message_success', 'Password reset for '.$employee->firstname.' '.$employee->lastname.'.');
    }

    /*
    * Display delete employee confirmation page
    * GET: http://localhost/employee/delete/$id
    */
    public function getDelete($id) {

        $employee = Employee::where('id', '=', $id)->first();
        $contact = Contact::where('employee_id', '=', $employee->id)->first();
        return View::make('employee_delete')
                ->with('employee', $employee)
                ->with('contact', $contact);
    }

    /*
    * Soft delete employee
    * POST: http://localhost/employee/delete/$id
    */
    public function postDelete() {

        try {
            $employee = Employee::findOrFail(Input::get('id'));
        }
        catch(exception $e) {
            return Redirect::action('IndexController@getIndex')
            ->with('flash_message_error', 'ERROR EC4: Could not delete employee.');
        }

        # inactivate and soft delete user account via UserController
        App::make('UserController')->postDelete($employee->user_id);

        # soft delete employee's contacts via ContactController
        App::make('ContactController')->postDelete($employee->id);

        # flag employee status as terminated
        $employee->update(array('status' => 0));
        

        # soft delete employee
        try {
            $employee->delete();
        }
        catch(exception $e) {
            return Redirect::action('IndexController@getIndex')
            ->with('flash_message_error', 'ERROR EC22: Could not delete employee.');
        }

        # Return to dashboard with a user message
        return Redirect::action('IndexController@getIndex')
            ->with('flash_message_success', $employee->firstname.' '.$employee->lastname.' has been deleted.');
    }

    /*
    * Display employee forms page
    * GET: http://localhost/employee/forms/$id
    */
    public function getForms($id) {

        $employee = Employee::where('id', '=', $id)->first();
        $contact = Contact::where('employee_id', '=', $employee->id)->first();
        return View::make('employee_forms')
                ->with('employee', $employee)
                ->with('contact', $contact);
    }

    /*
    * Save employee forms
    * POST: http://localhost/employee/forms
    */
    public function postForms() {

        try {
            $employee = Employee::findOrFail(Input::get('id'));
        }
        catch(exception $e) {
            return Redirect::action('IndexController@getIndex')
            ->with('flash_message_error', 'ERROR EC12: Could not save forms.');
        }

        # Return to dashboard with a user message
        return Redirect::action('IndexController@getIndex')
            ->with('flash_message_success', $employee->firstname.' '.$employee->lastname.' forms have been saved.');
    }

    /*
    * Display forms manager page
    * GET: http://localhost/employee/forms_manager
    */
    public function getFormsManager() {   
                    
        return View::make('employee_forms_manager');
    }

    /*
    * Display checklists manager page
    * GET: http://localhost/employee/checklists_manager
    */
    public function getChecklistsManager() {
    
        $checklists = Checklist::get();    
                    
        return View::make('employee_checklists_manager')
                ->with('checklists', $checklists);
    }

    /*
    * Display edit checklists item page
    * GET: http://localhost/employee/checklists_manager/edit/$checklist_id
    */
    public function getChecklistsManagerEdit($checklist_id) {
    
        $checklist_item = Checklist::where('id', '=', $checklist_id)->first();
                    
        return View::make('employee_checklists_manager_edit')
                ->with('checklist_item', $checklist_item);
    }

    /*
    * Edit a checklists item in manager
    * POST: http://localhost/employee/checklists_manager/edit/$checklist_id
    */
    public function postChecklistsManagerEdit() {

        $checklist_id = Input::get('checklist_id');
        $name = Input::get('item');
        $description = Input::get('description');
    
        try {
            $checklist_item = Checklist::findOrFail($checklist_id);
        }
        catch(exception $e) {
            return Redirect::action('EmployeeController@getChecklistsManager')
                    ->with('flash_message_error', 'ERROR EC20: Could not edit checklist item.');
        }

        try {
            # Update checklists table
            $checklist_item->update(array(
                        'name' => $name,
                        'description' => $description));
            $checklist_item->save();
        }
        catch (exception $e) {
            return Redirect::action('IndexController@getIndex')
                    ->with('flash_message_error', 'ERROR EC21: Internal error editing checklist item.');
        }
        
        # return to checklists manager view            
        return Redirect::action('EmployeeController@getChecklistsManager')
                ->with('flash_message_success', 'Checklist item has been saved.');
    }

    /*
    * Display add checklists item page
    * GET: http://localhost/employee/checklists_manager/add
    */
    public function getChecklistsManagerAdd() {
                    
        return View::make('employee_checklists_manager_add');
    }

    /*
    * Display delete checklists item confirmation page
    * GET: http://localhost/employee/checklists_manager/delete/$checklist_id
    */
    public function getChecklistsManagerDelete($checklist_id) {
    
        $checklist_item = Checklist::where('id', '=', $checklist_id)->first();
                    
        return View::make('employee_checklists_manager_delete')
                ->with('checklist_item', $checklist_item);
    }

    /*
    * Delete checklists item from manager
    * POST: http://localhost/employee/checklists_manager/delete/$checklist_id
    */
    public function postChecklistsManagerDelete() {

        $checklist_id = Input::get('checklist_id');
    
        try {
            $checklist_item = Checklist::where('id', '=', $checklist_id);
        }
        catch(exception $e) {
            return Redirect::action('EmployeeController@getChecklistsManager')
                    ->with('flash_message_error', 'ERROR EC18: Could not delete checklist item.');
        }

        // soft delete checklist item
        try {
            $checklist_item->delete();   
        }
        catch(exception $e) {
            return Redirect::action('EmployeeController@getChecklistsManager')
                    ->with('flash_message_error', 'ERROR EC19: Could not delete checklist item.');
        }
        
        # return to checklists manager view            
        return Redirect::action('EmployeeController@getChecklistsManager')
                ->with('flash_message_success', 'Checklist item has been deleted.');
    }

    /*
    * Display employee checklists page
    * GET: http://localhost/employee/checklists/$id
    */
    public function getChecklists($employee_id) {

        $employee = Employee::where('id', '=', $employee_id)->first();
    
        /*
        $checklist_employee = DB::table('checklists')
                    ->join('checklist_employee', 'checklists.id', '=', 'checklist_employee.checklist_id')
                    ->where('employee_id', '=', $employee->id)
                    ->orderBy('checklist_employee.updated_at', 'desc')
                    ->get();
        */

        $checklist_employee = Checklist::join('checklist_employee', 'checklists.id', '=', 'checklist_employee.checklist_id')
            ->where('employee_id', '=', $employee->id)
            ->where('checklist_employee.deleted_at', '=', NULL)
            ->orderBy('checklist_employee.updated_at', 'desc')
            ->get();

        $checklist = Checklist::get();

        $checklist_selection = array();
        foreach ($checklist as $item) {
            $checklist_selection[] = $item->name;
        }

        # start array at index 1 instead of 0
        /*
        array_unshift($checklist_selection, 'phoney');
        unset($checklist_selection[0]);    
        */  

        return View::make('employee_checklists')
                ->with('employee', $employee)
                ->with('checklist_employee', $checklist_employee)
                ->with('checklist_selection', $checklist_selection);
    }

    /*
    * Save checklists
    * POST: http://localhost/employee/checklists
    */
    public function postChecklists() {

        $employee_id = Input::get('employee_id');

        try {
            $employee = Employee::findOrFail(Input::get('employee_id'));
        }
        catch(exception $e) {
            return Redirect::action('IndexController@getIndex')
            ->with('flash_message_error', 'ERROR EC13: Could not save checklist.');
        }

        # Return to employee checklist view
        return Redirect::action('EmployeeController@getChecklists', ['employee_id' => $employee_id])
        ->with('flash_message_success', 'Checklist has been saved.');
    }

    /*
    * Add employee's checklist item
    * POST: http://localhost/employee/checklists/$employee_id/add/$checklist_id
    */
    public function postChecklistsAdd() {

        $employee_id = Input::get('employee_id');
        $checklist_selection = Input::get('checklist_selection');
        // get first checklist id that has not been deleted and add the drop down selection offset
        $checklist_id = Checklist::first()->pluck('id') + $checklist_selection;
        $already_exists = Checklist_Employee::where('employee_id', '=', $employee_id)
                                            ->where('checklist_id', '=', $checklist_id)
                                            ->first();

        try {
            # First check if employee already has that item assigned
            if ($already_exists) {
                return Redirect::action('EmployeeController@getChecklists', ['employee_id' => $employee_id])
                    ->with('flash_message_error', 'Selected checklist item already assigned to employee.');
            }
            else {
                # Insert item into checklist_employee table
                $checklist_item = Checklist_Employee::create(array(
                            'employee_id' => $employee_id,
                            'checklist_id' => $checklist_id,
                            'status' => 'todo',
                            'comments' => ''));
                $checklist_item->save();
            }
        }
        catch (exception $e) {
            return Redirect::action('EmployeeController@getChecklists', ['employee_id' => $employee_id])
            ->with('flash_message_error', 'ERROR EC15: Internal error adding checklist item.'
                .' checklist_id='.$checklist_id.' employee_id='.$employee_id);
        }

        # Return to employee checklist view
        return Redirect::action('EmployeeController@getChecklists', ['employee_id' => $employee_id])
                ->with('flash_message_success', 'Checklist item has been added.');
    }

    /*
    * Display edit employee's checklist item page
    * GET: http://localhost/employee/checklists/$employee_id/edit/$checklist_id
    */
    public function getChecklistsEdit($employee_id, $checklist_id) {

        $employee = Employee::where('id', '=', $employee_id)->first();
        $checklist_item = Checklist_Employee::where('employee_id', '=', $employee_id)
                                            ->where('checklist_id', '=', $checklist_id)
                                            ->first();
        $checklist_item_info = Checklist::where('id', '=', $checklist_id)->first();

        return View::make('employee_checklists_edit')
                ->with('employee', $employee)
                ->with('checklist_item', $checklist_item)
                ->with('checklist_item_info', $checklist_item_info);
    }

    /*
    * Save employee's checklist item
    * POST: http://localhost/employee/checklists/$employee_id/edit/$checklist_id
    */
    public function postChecklistsEdit() {

        $employee_id = Input::get('employee_id');
        $checklist_id = Input::get('checklist_id');
        
        try {
            $checklist_item = Checklist_Employee::where('employee_id', '=', $employee_id)
                ->where('checklist_id', '=', $checklist_id);
                #>first();
        }
        catch(exception $e) {
            return Redirect::action('EmployeeController@getChecklists', ['employee_id' => $employee_id])
            ->with('flash_message_error', 'ERROR EC20: Could not save checklist item.');
        }

        try {
            # Update checklist_employee table
            $checklist_item->update(array(
                        'status' => Input::get('status'),
                        'comments' => Input::get('comments')));
            #checklist_item->save();
        }
        catch (exception $e) {
            return Redirect::action('EmployeeController@getChecklists', ['employee_id' => $employee_id])
            ->with('flash_message_error', 'ERROR EC23: Internal error updating checklist item.');
        }


        # Return to employee checklist view
        return Redirect::action('EmployeeController@getChecklists', ['employee_id' => $employee_id])
                ->with('flash_message_success', 'Checklist item has been updated.');
    }

    /*
    * Display delete employee's checklist item confirmation page
    * GET: http://localhost/employee/checklists/$employee_id/delete/$checklist_id
    */
    public function getChecklistsDelete($employee_id, $checklist_id) {

        $employee = Employee::where('id', '=', $employee_id)->first();
        $checklist_item = Checklist_Employee::where('employee_id', '=', $employee_id)
                                            ->where('checklist_id', '=', $checklist_id)
                                            ->first();
        $checklist_item_info = Checklist::where('id', '=', $checklist_id)->first();

        return View::make('employee_checklists_delete')
                ->with('employee', $employee)
                ->with('checklist_item', $checklist_item)
                ->with('checklist_item_info', $checklist_item_info);
    }

    /*
    * Soft delete employee's checklist item
    * POST: http://localhost/employee/checklists/$employee_id/delete/$checklist_id
    */
    public function postChecklistsDelete() {

        $employee_id = Input::get('employee_id');
        $checklist_id = Input::get('checklist_id');
        $checklist_created_at = Input::get('checklist_created_at');
        
        try {
            $checklist_item = Checklist_Employee::where('employee_id', '=', $employee_id)
                                                ->where('checklist_id', '=', $checklist_id);
        }
        catch(exception $e) {
            return Redirect::action('EmployeeController@getChecklists', ['employee_id' => $employee_id])
            ->with('flash_message_error', 'ERROR EC16: Could not delete checklist item.');
        }

        // soft delete checklist item
        try {
            $checklist_item->delete();
        }
        catch(exception $e) {
            return Redirect::action('EmployeeController@getChecklists', ['employee_id' => $employee_id])
            ->with('flash_message_error', 'ERROR EC17: Could not delete checklist item.');
        }


        # Return to employee checklist view
        return Redirect::action('EmployeeController@getChecklists', ['employee_id' => $employee_id])
                ->with('flash_message_success', 'Checklist item has been deleted.');
    }

}