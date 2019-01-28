<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCommentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comment', function(Blueprint $table)
		{
			$table->integer('id')->autoIncrement();
			$table->text('content');
			$table->integer('ticket_id');
			$table->integer('user_id')->unsigned()->nullable();
			$table->boolean('admin_only');
			$table->timestamps();
		});

		Schema::table('comment', function(Blueprint $table)
		{
			$table->foreign('user_id')->references('id')->on('users');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('comment');
	}

}
