<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
      $table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('name', 191);
			$table->string('email', 191)->unique();
			$table->string('password', 60);
			$table->string('image', 60)->nullable();
			$table->string('phone', 11)->nullable()->unique();
			$table->string('remember_token', 100)->nullable();
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
		Schema::drop('users');
	}

}
