<?php

use Illuminate\Database\Seeder;

class ContentTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('content_types')->delete();
        
        \DB::table('content_types')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'Advanced Text',
                'created_at' => '2019-02-14 13:05:42',
                'updated_at' => '2019-02-14 13:05:42',
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'Normal Text',
                'created_at' => '2019-02-14 13:06:12',
                'updated_at' => '2019-02-14 13:06:12',
            ),
            2 => 
            array (
                'id' => 3,
                'title' => 'Image',
                'created_at' => '2019-02-14 13:06:27',
                'updated_at' => '2019-02-14 13:06:27',
            ),
            3 => 
            array (
                'id' => 4,
                'title' => 'Audio',
                'created_at' => '2019-02-14 13:06:34',
                'updated_at' => '2019-02-14 13:06:34',
            ),
            4 => 
            array (
                'id' => 5,
                'title' => 'Video',
                'created_at' => '2019-02-14 13:06:38',
                'updated_at' => '2019-02-14 13:06:38',
            ),
            5 => 
            array (
                'id' => 6,
                'title' => 'external video link',
                'created_at' => '2019-03-06 08:02:01',
                'updated_at' => '2019-03-06 08:02:01',
            ),
        ));
        
        
    }
}