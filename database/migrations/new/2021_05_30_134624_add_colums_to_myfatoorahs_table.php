<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumsToMyfatoorahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('myfatoorahs', function (Blueprint $table) {
          $table->string("invoice_id")->nullable()->after("type");
          $table->text("payment_url")->nullable()->after("invoice_id");
          $table->string("payment_method")->nullable()->after("payment_url");
          $table->string("invoice_status")->nullable()->after("payment_method");
          $table->string("transaction_status")->nullable()->after("invoice_status");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('myfatoorahs', function (Blueprint $table) {
          $table->dropColumn("invoiceId");
          $table->dropColumn("paymentUrl");
          $table->dropColumn("paymentMethod");
          $table->dropColumn("invoiceStatus");
          $table->dropColumn("TransactionStatus");
        });
    }
}
