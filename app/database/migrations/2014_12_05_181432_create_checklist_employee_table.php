<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChecklistEmployeeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('checklist_employee', function($table) {
    		$table->integer('employee_id')->unsigned();
    		$table->foreign('employee_id')->references('id')->on('employees');
    		$table->integer('checklist_id')->unsigned();
    		$table->foreign('checklist_id')->references('id')->on('checklists');
    		$table->enum('status', array('todo', 'completed', 'na', 'other'));
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
		Schema::drop('checklist_employee');
	}

}
