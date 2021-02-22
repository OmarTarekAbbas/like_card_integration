<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToContentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('contents', function(Blueprint $table)
		{
			$table->foreign('category_id')->references('id')->on('categories')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('content_type_id')->references('id')->on('content_types')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('contents', function(Blueprint $table)
		{
			$table->dropForeign('contents_category_id_foreign');
			$table->dropForeign('contents_content_type_id_foreign');
		});
	}

}
