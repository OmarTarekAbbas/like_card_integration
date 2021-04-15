<?php

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
          'code'  => 1
        ]);

        $operator  = Operator::Create([
          'title' => 'Kuwait',
          'code'  => 1
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
