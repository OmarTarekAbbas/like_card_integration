<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCategoriesprovidersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('categories', function(Blueprint $table)
		{
            $table->integer('provider_id')->unsigned()->nullable();
			$table->foreign('provider_id')->references('id')->on('providers')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('categories', function(Blueprint $table)
		{
			$table->dropForeign('categories_provider_id_foreign');
		});
	}

}
