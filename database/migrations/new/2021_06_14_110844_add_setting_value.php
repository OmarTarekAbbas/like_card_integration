<?php

use App\Setting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSettingValue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Setting::insert([
          ['key' => 'admin_mail', 'value' => 'emad@ivas.com.eg', 'type_id' => 2],
          ['key' => 'order_mail', 'value' => 'emad@ivas.com.eg', 'type_id' => 2]
        ]);
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
