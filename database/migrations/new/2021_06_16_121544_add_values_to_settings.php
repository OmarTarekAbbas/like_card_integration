<?php

use App\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddValuesToSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Setting::insert([
        ['key' => 'enable_dcb', 'value' => '0', 'type_id' => 7],
        ['key' => 'enable_delete', 'value' => '0', 'type_id' => 7],
        ['key' => 'balance_limit', 'value' => '40', 'type_id' => 2]
      ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            //
        });
    }
}
