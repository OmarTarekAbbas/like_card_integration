<?php

use Illuminate\Database\Seeder;

class ContentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('contents')->delete();
        
        \DB::table('contents')->insert(array (
            0 => 
            array (
                'id' => 23,
                'title' => 'video 1',
                'path' => '1552553197895.mp4',
                'image_preview' => '1552553196267.jpg',
                'content_type_id' => 5,
                'category_id' => 3,
                'patch_number' => '12354',
                'created_at' => '2019-03-14 08:46:37',
                'updated_at' => '2019-03-14 08:46:37',
            ),
            1 => 
            array (
                'id' => 24,
                'title' => 'audio 1',
                'path' => '155255330417.mp3',
                'image_preview' => NULL,
                'content_type_id' => 4,
                'category_id' => 12,
                'patch_number' => '1234',
                'created_at' => '2019-03-14 08:48:24',
                'updated_at' => '2019-03-14 08:48:24',
            ),
            2 => 
            array (
                'id' => 25,
                'title' => 'audio 2',
                'path' => '1552553335747.mp3',
                'image_preview' => NULL,
                'content_type_id' => 4,
                'category_id' => 9,
                'patch_number' => '12456',
                'created_at' => '2019-03-14 08:48:55',
                'updated_at' => '2019-03-14 08:48:55',
            ),
        ));
        
        
    }
}
