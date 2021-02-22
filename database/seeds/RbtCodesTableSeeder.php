<?php

use Illuminate\Database\Seeder;

class RbtCodesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('rbt_codes')->delete();
        
        \DB::table('rbt_codes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'rbt_code' => 12345,
                'content_id' => 24,
                'operator_id' => 1,
                'created_at' => '2019-03-14 08:51:28',
                'updated_at' => '2019-03-14 08:51:28',
            ),
            1 => 
            array (
                'id' => 3,
                'rbt_code' => 133,
                'content_id' => 24,
                'operator_id' => 4,
                'created_at' => '2019-03-14 08:52:51',
                'updated_at' => '2019-03-14 08:52:51',
            ),
            2 => 
            array (
                'id' => 4,
                'rbt_code' => 1235,
                'content_id' => 24,
                'operator_id' => 5,
                'created_at' => '2019-03-14 08:52:51',
                'updated_at' => '2019-03-14 08:52:51',
            ),
        ));
        
        
    }
}
