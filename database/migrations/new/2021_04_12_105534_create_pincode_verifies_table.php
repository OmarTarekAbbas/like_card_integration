<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePincodeVerifiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pincode_verifies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('msisdn', 100);
            $table->string('operator_id', 100);
            $table->string('price', 100);
            $table->string('request_id', 100);
            $table->string('pin', 100);
            $table->text('request');
            $table->text('response');
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
        Schema::dropIfExists('pincode_verifies');
    }
}
