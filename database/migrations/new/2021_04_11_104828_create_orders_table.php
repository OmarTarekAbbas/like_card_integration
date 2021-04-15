<?php

use App\Constants\DcbStatus;
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
            $table->string('product_name');
            $table->string('product_image');
            $table->string('valid_to')->nullable();
            $table->string('serial_id')->nullable();
            $table->string('hash_serial_code')->nullable();
            $table->string('serial_code')->nullable();
            $table->string('currency');
            $table->decimal('original_price', 10, 2);
            $table->decimal('sell_price', 10, 2);
            $table->integer('quantity');
            $table->decimal('total_price', 10, 2);
            $table->string('phone_code');
            $table->string('phone');
            $table->unsignedBigInteger('operator_id');
            $table->unsignedBigInteger('transaction_id')->nullable()->comment("like card order id");
            $table->unsignedBigInteger('pincode_request_id')->nullable();
            $table->unsignedBigInteger('pincode_verify_id')->nullable();
            $table->integer('status')->default(OrderStatus::PENDING)->comment("0-pending | 1-finish | 2-fail");
            $table->integer('payment')->default(PaymentType::NO_PAYMENT)->comment("0-no payment yet | 1-DCB");
            $table->integer('dcb_status')->default(DcbStatus::Pending)->comment("you'll found all status in DcbStatus class in constant class");
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
