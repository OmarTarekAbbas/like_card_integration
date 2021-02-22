<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'Aflam',
                'image' => '1550152145324.jpg',
                'created_at' => '2019-02-14 13:49:05',
                'updated_at' => '2019-02-14 13:49:05',
                'parent_id' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'Music',
                'image' => '1552552611379.jpg',
                'created_at' => '2019-02-14 14:35:00',
                'updated_at' => '2019-03-14 08:36:51',
                'parent_id' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'title' => 'Arabic',
                'image' => '1552552637642.jpg',
                'created_at' => '2019-03-06 09:01:44',
                'updated_at' => '2019-03-14 08:37:17',
                'parent_id' => 1,
            ),
            3 => 
            array (
                'id' => 5,
                'title' => 'English',
                'image' => '1552552649795.jpg',
                'created_at' => '2019-03-14 08:37:29',
                'updated_at' => '2019-03-14 08:37:29',
                'parent_id' => 1,
            ),
            4 => 
            array (
                'id' => 6,
                'title' => 'Arabic Music',
                'image' => '1552552673699.jpg',
                'created_at' => '2019-03-14 08:37:53',
                'updated_at' => '2019-03-14 08:47:32',
                'parent_id' => 2,
            ),
            5 => 
            array (
                'id' => 7,
                'title' => 'English Music',
                'image' => '1552552689643.jpg',
                'created_at' => '2019-03-14 08:38:09',
                'updated_at' => '2019-03-14 08:47:47',
                'parent_id' => 2,
            ),
            6 => 
            array (
                'id' => 8,
                'title' => 'Amr Diab',
                'image' => '1552552713880.jpg',
                'created_at' => '2019-03-14 08:38:33',
                'updated_at' => '2019-03-14 08:38:33',
                'parent_id' => 6,
            ),
            7 => 
            array (
                'id' => 9,
                'title' => 'Tamer Ashour',
                'image' => '155255273259.jpg',
                'created_at' => '2019-03-14 08:38:52',
                'updated_at' => '2019-03-14 08:38:52',
                'parent_id' => 6,
            ),
            8 => 
            array (
                'id' => 10,
                'title' => 'Action',
                'image' => '1552552922566.jpg',
                'created_at' => '2019-03-14 08:42:02',
                'updated_at' => '2019-03-14 08:42:02',
                'parent_id' => 3,
            ),
            9 => 
            array (
                'id' => 11,
                'title' => 'Romantic',
                'image' => '1552552933190.jpg',
                'created_at' => '2019-03-14 08:42:13',
                'updated_at' => '2019-03-14 08:42:13',
                'parent_id' => 3,
            ),
            10 => 
            array (
                'id' => 12,
                'title' => 'selena gomez',
                'image' => '155255298255.jpg',
                'created_at' => '2019-03-14 08:43:02',
                'updated_at' => '2019-03-14 08:43:02',
                'parent_id' => 7,
            ),
            11 => 
            array (
                'id' => 14,
                'title' => 'Adele Lyrics',
                'image' => '1552553075139.jpg',
                'created_at' => '2019-03-14 08:44:35',
                'updated_at' => '2019-03-14 08:44:35',
                'parent_id' => 7,
            ),
            12 => 
            array (
                'id' => 15,
                'title' => 'Horror',
                'image' => '1552553097809.jpg',
                'created_at' => '2019-03-14 08:44:57',
                'updated_at' => '2019-03-14 08:44:57',
                'parent_id' => 5,
            ),
            13 => 
            array (
                'id' => 16,
                'title' => 'Scientific',
                'image' => '1552553141894.jpg',
                'created_at' => '2019-03-14 08:45:41',
                'updated_at' => '2019-03-14 08:45:41',
                'parent_id' => 5,
            ),
        ));
        
        
    }
}
