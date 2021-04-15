<?php

use App\Country;
use App\Operator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertOperatorData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $country  = Country::Create([
          'title' => 'Kuwait',
        ]);

        $operator  = DB::table('operators')->insert([
          ['name' => 'Zain Kuwait', 'code'  => 41902, 'country_id' => 1],
          ['name' => 'Ooredoo Kuwait', 'code'  => 41903, 'country_id' => 1 ],
          ['name' => 'Stc Kuwait', 'code'  => 41904, 'country_id' => 1 ]
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
