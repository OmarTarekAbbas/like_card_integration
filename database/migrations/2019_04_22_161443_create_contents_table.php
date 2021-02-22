<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contents', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title', 191);
			$table->text('path', 65535);
			$table->string('image_preview', 191)->nullable();
			$table->integer('content_type_id')->unsigned()->index('contents_content_type_id_foreign');
			$table->integer('category_id')->unsigned()->index('contents_category_id_foreign');
			$table->string('patch_number', 191)->nullable();
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('contents');
	}

}
