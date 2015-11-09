<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('info' , function(Blueprint $table)
		{
			$table->increments('ID');
			$table->string('notes');
			$table->string('ot_hours');
			$table->string('br_hours');
			$table->string('work_hours');
			$table->timestamp('created_at');
			$table->timestamp('updated_at');
		});
		
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('info');
	}

}
