<?php

class NHPSeeder extends Seeder {

  const USERS_CNT = 10;
  const ROLES_CNT = 4;
  const EMPLOYEES_CNT = 10;
  const CONTACTS_CNT = 10;
  const CHECKLISTS_CNT = 7;
  const FILES_CNT = 0;

  public function run()
  {
  	$tables = [
  		'checklists',
  		'checklist_employee',
  		'contacts',
  		'employees',
  		'files',
  		'roles',
  		'role_user',
  		'users'
  	];

  	# Disable FK constraints so that all rows can be deleted
	DB::statement('SET FOREIGN_KEY_CHECKS=0');

	# Reset tables	
	foreach ($tables as $table) {
		DB::table($table)->truncate();
	}

 	# Seed users
 	$user = User::create(array(
		'username' => 'admin',
		'password' => Hash::make('foobar123'),
		'status' => '1',
		'last_login' => date("Y-m-d H:i:s")
	));
	# Create users array to later seed role_user pivot table
	$users[$user->id] = $user;

	$user = User::create(array(
		'username' => 'hrmanager',
		'password' => Hash::make('foobar123'),
		'status' => '1',
		'last_login' => date("Y-m-d H:i:s")
	));
	$users[$user->id] = $user;

	$user = User::create(array(
		'username' => 'hrspecialist',
		'password' => Hash::make('foobar123'),
		'status' => '1',
		'last_login' => date("Y-m-d H:i:s")
	));
	$users[$user->id] = $user;

	$user = User::create(array(
		'username' => 'user',
		'password' => Hash::make('foobar123'),
		'status' => '1',
		'last_login' => date("Y-m-d H:i:s")
	));
	$users[$user->id] = $user;

	$faker = Faker\Factory::create();
	for ($i = 0; $i < self::USERS_CNT-4; $i++)
	{
	  $user = User::create(array(
	    'username' => $faker->userName,
	    'password' => Hash::make($faker->word),
	    'status' => '1',
	    'last_login' => $faker->dateTimeThisYear($max = 'now')
	  ));
	  $users[$user->id] = $user;
	}

	# Seed employees
	# POWERUSER
	$employee = Employee::create(array(
		'user_id' => '1',
		'status' => '1',
		'lastname' => 'Admin',
		'firstname' => 'System',
		'gender' => 'U'
	));
	# Create employees array to later seed checklist_employee pivot table
	$employees[$employee->id] = $employee;

	# HR_MANAGER
	$employee = Employee::create(array(
		'user_id' => '2',
		'status' => '1',
		'lastname' => 'Turner',
		'firstname' => 'Amy',
		'midlname' => '',
		'nickname' => '',
		'birthdate' => date('Y-m-d H:i:s', strtotime("1975-01-01")),
		'gender' => 'F',
		'start_date' => date('Y-m-d H:i:s', strtotime("2007-11-05"))
	));
	$employees[$employee->id] = $employee;

	# HR_SPECIALIST
	$employee = Employee::create(array(
		'user_id' => '3',
		'status' => '1',
		'lastname' => 'Whitfield',
		'firstname' => 'Pamela',
		'midlname' => '',
		'nickname' => '',
		'birthdate' => date('Y-m-d H:i:s', strtotime("1975-01-01")),
		'gender' => 'F',
		'start_date' => date('Y-m-d H:i:s', strtotime("2009-12-13"))
	));
	$employees[$employee->id] = $employee;

	# USER
	$employee = Employee::create(array(
		'user_id' => '4',
		'status' => '1',
		'lastname' => 'Hicks',
		'firstname' => 'Scott',
		'midlname' => '',
		'nickname' => '',
		'birthdate' => date('Y-m-d H:i:s', strtotime("1975-01-01")),
		'gender' => 'M',
		'start_date' => date('Y-m-d H:i:s', strtotime("2011-07-09"))
	));
	$employees[$employee->id] = $employee;

	# Other USERS
	# Females
	$faker = Faker\Factory::create();
	for ($i = 0; $i < 3; $i++)
	{
	  $employee = Employee::create(array(
		'user_id' => $i + 5,
		'status' => '1', # active
		'lastname' => $faker->lastName,
		'firstname' => $faker->firstName('female'),
		'midlname' => $faker->firstName('female'),
		'nickname' => $faker->firstName('female'),
		'birthdate' => $faker->date($format = 'Y-m-d', $max = 'now'),
		'gender' => 'F',
		'start_date' => $faker->date($format = 'Y-m-d', $max = 'now')
	  ));
	  $employees[$employee->id] = $employee;
	}

	# Males
	for ($i = 0; $i < 3; $i++)
	{
	 	$employee = Employee::create(array(
			'user_id' => $i + 8,
			'status' => '0', # terminated
			'lastname' => $faker->lastName,
			'firstname' => $faker->firstName('male'),
			'midlname' => $faker->firstName('male'),
			'nickname' => $faker->firstName('male'),
			'birthdate' => $faker->date($format = 'Y-m-d', $max = 'now'),
			'gender' => 'M',
			'start_date' => $faker->date($format = 'Y-m-d', $max = 'now')
		));
		$employees[$employee->id] = $employee;
	}

	# Seed contacts
	for ($i = 0; $i < self::CONTACTS_CNT; $i++)
	{
		$contact = Contact::create(array(
			'employee_id' => $i + 1,
			'type' => 'primary',
			'address1' => $faker->streetAddress,
			'city' => $faker->city,
			'state' => $faker->state,
			'zipcode' => $faker->postcode,
			'phone1' => $faker->phoneNumber,
			'phone2' => $faker->phoneNumber
		));
		$employees[$employee->id] = $employee;
	}

	# Seed checklists
	$checklist = Checklist::create(array(
		'name' => 'Employee Profile',
		'description' => 'Employee profile has been updated.',
		'group' => '1'
	));
	$checklist = Checklist::create(array(
		'name' => 'New Hire Forms',
		'description' => 'Employee submitted all new hire forms.',
		'group' => '1'
	));
	$checklist = Checklist::create(array(
		'name' => 'Orientation',
		'description' => 'Employee has completed new hire orientation.',
		'group' => '2'
	));
	$checklist = Checklist::create(array(
		'name' => 'ID Badge',
		'description' => 'Employee badge has been assigned and delivered.',
		'group' => '2'
	));
	$checklist = Checklist::create(array(
		'name' => 'Parking Permit',
		'description' => 'Vehicle permit has been assigned and delivered.',
		'group' => '2'
	));
	$checklist = Checklist::create(array(
		'name' => 'Phone System',
		'description' => 'Phone number has been assigned and phone configured.',
		'group' => '2'
	));
	$checklist = Checklist::create(array(
		'name' => 'IT Services',
		'description' => 'Employee has been assigned a domain login and email.',
		'group' => '2'
	));

 	# Seed roles
	$role = Role::create(array(
		'name' => 'POWERUSER',
		'description' => 'Admin access to entire system.'
	));
	$role = Role::create(array(
		'name' => 'HR_MANAGER',
		'description' => 'Manager of the HR department with access to setup and view information.'
	));
	$role = Role::create(array(
		'name' => 'HR_SPECIALIST',
		'description' => 'Performs common Human Resources tasks.'
	));
	$role = Role::create(array(
		'name' => 'USER',
		'description' => 'Employee level access to view and update personal information.'
	));

	# Seed role_user pivot table
	$users[1]->roles()->attach(1); #POWERUSER
	$users[2]->roles()->attach(2); #HR_MANAGER
	$users[3]->roles()->attach(3); #HR_SPECIALIST
	$users[4]->roles()->attach(4); #USER
	$users[5]->roles()->attach(4); #USER
	$users[6]->roles()->attach(4); #USER
	$users[7]->roles()->attach(4); #USER
	$users[8]->roles()->attach(4); #USER
	$users[9]->roles()->attach(4); #USER
	$users[10]->roles()->attach(4); #USER

	# Seed checklist_employee pivot table
	# Add all checklists to all employees
	for ($i = 0; $i < self::EMPLOYEES_CNT; $i++)
	{
		for ($j = 0; $j < self::CHECKLISTS_CNT; $j++)
		{
			$employees[$i+1]->checklists()->attach($j+1);
		}
	}

	DB::statement('SET FOREIGN_KEY_CHECKS=1');

  } 
}