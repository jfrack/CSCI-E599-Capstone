<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contacts', function($table) {
    		$table->increments('id');
    		$table->integer('employee_id')->unsigned();
    		$table->foreign('employee_id')->references('id')->on('employees');
    		$table->enum('type', array('primary', 'mailing', 'other'));
    		$table->string('address1', 50);
    		$table->string('address2', 50);
    		$table->string('address3', 50);
    		$table->string('city', 25);
    		$table->char('state', 2);
    		$table->string('zipcode', 10);
    		$table->string('phone1', 15);
    		$table->string('phone2', 15);
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
		Schema::drop('contacts');
	}

}
