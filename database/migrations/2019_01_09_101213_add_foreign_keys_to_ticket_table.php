<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTicketTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ticket', function(Blueprint $table)
		{
			$table->foreign('ticket_category', 'tk_ticket_category')->references('id')->on('ticket_category')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('ticket_status', 'tk_ticket_status')->references('id')->on('ticket_status')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ticket', function(Blueprint $table)
		{
			$table->dropForeign('tk_ticket_category');
			$table->dropForeign('tk_ticket_status');
		});
	}

}
