<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTicketTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ticket', function(Blueprint $table)
		{
			$table->integer('id')->autoIncrement();;
			$table->string('full_name');
			$table->string('email');
			$table->string('phone_num', 50);
			$table->text('description');
			$table->string('file_path')->nullable();
			$table->integer('ticket_category')->nullable();
			$table->integer('ticket_status')->nullable();
			$table->string('hash');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ticket');
	}

}
