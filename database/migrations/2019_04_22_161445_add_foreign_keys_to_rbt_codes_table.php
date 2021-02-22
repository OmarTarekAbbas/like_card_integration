<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRbtCodesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('rbt_codes', function(Blueprint $table)
		{
			$table->foreign('content_id')->references('id')->on('contents')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('operator_id')->references('id')->on('operators')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('rbt_codes', function(Blueprint $table)
		{
			$table->dropForeign('rbt_codes_content_id_foreign');
			$table->dropForeign('rbt_codes_operator_id_foreign');
		});
	}

}
