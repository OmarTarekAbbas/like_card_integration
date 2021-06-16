<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeRelationBetweenOrderAndOrderReplaies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('order_replays', function (Blueprint $table) {
        $table->foreign('order_id')->references('id')->on('orders')->onUpdate('RESTRICT')->onDelete('CASCADE');
        $table->foreign('client_id')->references('id')->on('clients')->onUpdate('RESTRICT')->onDelete('CASCADE');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
