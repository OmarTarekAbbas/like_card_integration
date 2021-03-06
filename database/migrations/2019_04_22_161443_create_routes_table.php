<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRoutesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('routes', function(Blueprint $table)
		{
      $table->engine = 'InnoDB';
			$table->integer('id', true);
			$table->string('method', 20);
			$table->string('route', 100);
			$table->string('controller_name', 100);
			$table->timestamps();
			$table->string('function_name', 191)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('routes');
	}

}
