<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('posts', function(Blueprint $table)
		{
			$table->foreign('content_id')->references('id')->on('contents')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('operator_id')->references('id')->on('operators')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('user_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('posts', function(Blueprint $table)
		{
			$table->dropForeign('posts_content_id_foreign');
			$table->dropForeign('posts_operator_id_foreign');
			$table->dropForeign('posts_user_id_foreign');
		});
	}

}
