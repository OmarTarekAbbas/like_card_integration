<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('countries')->delete();
        
        \DB::table('countries')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'Egypt',
                'created_at' => '2019-02-11 13:12:04',
                'updated_at' => '2019-02-11 13:12:04',
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'KSA',
                'created_at' => '2019-02-11 13:12:10',
                'updated_at' => '2019-02-11 13:12:10',
            ),
        ));
        
        
    }
}