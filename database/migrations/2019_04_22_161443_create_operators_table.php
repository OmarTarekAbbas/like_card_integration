<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOperatorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('operators', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 191);
			$table->string('rbt_sms_code', 191)->nullable();
			$table->string('rbt_ussd_code', 191)->nullable();
			$table->string('image', 191)->nullable();
			$table->integer('country_id')->unsigned()->index('operators_country_id_foreign');
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
		Schema::drop('operators');
	}

}
