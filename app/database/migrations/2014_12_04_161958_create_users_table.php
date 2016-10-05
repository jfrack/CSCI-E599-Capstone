<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table) {
    		$table->increments('id');
    		$table->string('username', 25)->unique();
    		$table->string('password');
    		$table->tinyInteger('status')->unsigned();
    		$table->dateTime('last_login');
    		$table->string('remember_token', 100);
    		$table->timestamps();
    		$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
