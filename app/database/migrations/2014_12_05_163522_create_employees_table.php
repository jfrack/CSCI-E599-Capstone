<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('employees', function($table) {
    		$table->increments('id');
    		$table->integer('user_id')->unique()->unsigned();
    		$table->foreign('user_id')->references('id')->on('users');
    		$table->tinyInteger('status')->unsigned();
    		$table->string('lastname', 25);
    		$table->string('firstname', 15);
    		$table->string('midlname', 15);
    		$table->string('nickname', 15);
    		$table->date('birthdate');
    		$table->enum('gender', array('M', 'F', 'U'));
    		$table->date('start_date');
    		$table->date('end_date');
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
		Schema::drop('employees');
	}

}
