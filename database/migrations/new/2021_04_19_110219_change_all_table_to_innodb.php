<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeAllTableToInnodb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      // DB::statement('REPAIR TABLE `ip_address`, `product_properties`, `properties`, `property_values`');

      $sql = "SELECT CONCAT('ALTER TABLE ',TABLE_NAME,' ENGINE=InnoDB;') as table_name
      FROM INFORMATION_SCHEMA.TABLES
      WHERE ENGINE='MyISAM'
      AND table_schema = '".env('DB_DATABASE')."';";

      $all_table = DB::select(DB::raw($sql));

      foreach ($all_table as  $tableSql) {
        DB::statement($tableSql->table_name);
      }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
