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
			$table->integer('id')->primary('ticket_pkey');
			$table->string('fio');
			$table->string('email');
			$table->string('phone_num', 50);
			$table->string('file_path')->nullable();
			$table->integer('ticket_category')->nullable();
			$table->integer('ticket_status')->nullable();
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
