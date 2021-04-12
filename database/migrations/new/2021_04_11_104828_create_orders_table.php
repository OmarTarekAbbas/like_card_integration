<?php

use App\Constants\OrderStatus;
use App\Constants\PaymentStatus;
use App\Constants\PaymentType;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('client_id');
            $table->integer('status')->default(OrderStatus::PENDING)->comment("0-pending | 1-finish | 2-fail ");
            $table->decimal('total_price',2);
            $table->string('currency');
            $table->integer('payment')->default(PaymentType::NO_PAYMENT)->comment("0-no payment yet | 1-DCB");
            $table->integer('payment_status')->default(PaymentStatus::Pending)->comment("0-pending | 1-success | 2-cancel | 3-fail");
            $table->unsignedBigInteger('transaction_id')->nullable()->comment("like card order id");
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
        Schema::dropIfExists('orders');
    }
}
