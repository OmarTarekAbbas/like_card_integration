<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToOperatorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('operators', function(Blueprint $table)
		{
			$table->foreign('country_id')->references('id')->on('countries')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('operators', function(Blueprint $table)
		{
			$table->dropForeign('operators_country_id_foreign');
		});
	}

}
