<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('files', function($table) {
    		$table->increments('id');
    		$table->integer('employee_id')->unsigned();
    		$table->foreign('employee_id')->references('id')->on('employees');
    		$table->string('filename');
    		$table->enum('status', array('original', 'saved', 'submitted', 'other'));
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
		Schema::drop('files');
	}

}
