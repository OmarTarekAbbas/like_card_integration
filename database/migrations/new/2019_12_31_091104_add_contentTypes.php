<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddContentTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::table('content_types')->insert(
            array(
                array (
                    'id' => 7,
                    'title' => 'external link',
                    'created_at' => '2019-12-30 13:06:12',
                    'updated_at' => '2019-12-30 13:06:12',
                ),
        ));
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
