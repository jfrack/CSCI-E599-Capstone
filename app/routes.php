<?php

use Paste\Pre;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

# Index controller
Route::get('/', 'IndexController@getIndex');

# Employee controller
Route::get('/employee/create', 'EmployeeController@getCreate');
Route::post('/employee/create', 'EmployeeController@postCreate');
Route::get('/employee/view/{id}', 'EmployeeController@getView');
Route::get('/employee/edit/{id}', 'EmployeeController@getEdit');
Route::post('/employee/edit', 'EmployeeController@postEdit');
Route::get('/employee/reset/{id}', 'EmployeeController@getReset');
Route::post('/employee/reset', 'EmployeeController@postReset');
Route::get('/employee/delete/{id}', 'EmployeeController@getDelete');
Route::post('/employee/delete/{id}', 'EmployeeController@postDelete');
Route::get('/employee/forms/{id}', 'EmployeeController@getForms');
Route::post('/employee/forms', 'EmployeeController@postForms');
Route::get('/employee/checklists/manager', 'EmployeeController@getChecklistsManager');
Route::post('/employee/checklists/manager', 'EmployeeController@postChecklistsManager');
Route::get('/employee/checklists/{id}', 'EmployeeController@getChecklists');
Route::post('/employee/checklists', 'EmployeeController@postChecklists');
Route::get('/employee/checklists/{employee_id}/add/{checklist_id}', 'EmployeeController@getChecklistsAdd');
Route::post('/employee/checklists/{employee_id}/add/{checklist_id}', 'EmployeeController@postChecklistsAdd');
Route::get('/employee/checklists/{employee_id}/edit/{checklist_id}', 'EmployeeController@getChecklistsEdit');
Route::post('/employee/checklists/{employee_id}/edit/{checklist_id}', 'EmployeeController@postChecklistsEdit');
Route::get('/employee/checklists/{employee_id}/delete/{checklist_id}', 'EmployeeController@getChecklistsDelete');
Route::post('/employee/checklists/{employee_id}/delete/{checklist_id}', 'EmployeeController@postChecklistsDelete');
Route::get('/employee/checklists/{employee_id}/comments/{checklist_id}', 'EmployeeController@getChecklistsComments');
Route::post('/employee/checklists/{employee_id}/comments/{checklist_id}', 'EmployeeController@postChecklistsComments');

# User controller
Route::get('/user/login', 'UserController@getLogin');
Route::post('/user/login', 'UserController@postLogin');
Route::get('/user/logout', 'UserController@getLogout');


Route::get('/get-environment',function() {

    echo "Environment: " . App::environment();
});

Route::get('/trigger-error',function() {

    # Class Foobar should not exist, so this should create an error
    $foo = new Foobar;
});

Route::get('mysql-test', function() {

    # Print environment
    echo 'Environment: '.App::environment().'<br>';

    # Use the DB component to select all the databases
    $results = DB::select('SHOW DATABASES;');

    # If the "Pre" package is not installed, you should output using print_r instead
    echo Pre::render($results);

});

# /app/routes.php
Route::get('/debug', function() {

    echo '<pre>';

    echo '<h1>environment.php</h1>';
    $path   = base_path().'/environment.php';

    try {
        $contents = 'Contents: '.File::getRequire($path);
        $exists = 'Yes';
    }
    catch (Exception $e) {
        $exists = 'No. Defaulting to `production`';
        $contents = '';
    }

    echo "Checking for: ".$path.'<br>';
    echo 'Exists: '.$exists.'<br>';
    echo $contents;
    echo '<br>';

    echo '<h1>Environment</h1>';
    echo App::environment().'</h1>';

    echo '<h1>Debugging?</h1>';
    if(Config::get('app.debug')) echo "Yes"; else echo "No";

    echo '<h1>Database Config</h1>';
    print_r(Config::get('database.connections.mysql'));

    echo '<h1>Test Database Connection</h1>';
    try {
        $results = DB::select('SHOW DATABASES;');
        echo '<strong style="background-color:green; padding:5px;">Connection confirmed</strong>';
        echo "<br><br>Your Databases:<br><br>";
        print_r($results);
    }
    catch (Exception $e) {
        echo '<strong style="background-color:crimson; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
    }

    echo '</pre>';
});

Route::get('/unpacking-sessions-and-cookies', function() {
    # Log in check
    if(Auth::check())
    echo "You are logged in: ".Auth::user();
    else
    echo "You are not logged in.";
    echo "<br><br>";
    # Cookies
    echo "<h1>Your Raw, encrypted Cookies</h1>";
    echo Paste\Pre::render($_COOKIE,'');
    # Decrypted cookies
    echo "<h1>Your Decrypted Cookies</h1>";
    echo Paste\Pre::render(Cookie::get(),'');
    echo "<br><br>";
    # All Session files
    echo "<h1>All Session Files</h1>";
    $files = File::files(app_path().'/storage/sessions');
    foreach($files as $file) {
    if(strstr($file,Cookie::get('laravel_session'))) {
    echo "<div style='background-color:yellow'><strong>YOUR SESSION FILE:</strong><br>";
    }
    else {
    echo "<div>";
    }
    echo "<strong>".$file."</strong>:<br>".File::get($file)."<br>";
    echo "</div><br>";
    }
    echo "<br><br>";
    # Your Session Data
    $data = Session::all();
    echo "<h1>Your Session Data</h1>";
    echo Paste\Pre::render($data,'Session data');
    echo "<br><br>";
    # Token
    echo "<h1>Your CSRF Token</h1>";
    echo Form::token();
    echo "<script>document.querySelector('[name=_token]').type='text'</script>";
    echo "<br><br>";
});