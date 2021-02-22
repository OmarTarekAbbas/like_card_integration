<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'super admin',
                'email' => 'super_admin@ivas.com',
                'password' => '$2y$10$u2evAW530miwgUb2jcXkTuqIGswxnSQ3DSmX1Ji5rtO3Tx.MtVcX2',
                'image' => '',
                'phone' => '01234567890',
                'remember_token' => 'rZuEmD6bPlK8lMdaoIC1jRvzlLs17XOy5r6MTsGWA1ggFfMGCVaw7bYG3hBQ',
                'created_at' => '2017-11-09 06:13:14',
                'updated_at' => '2018-11-26 08:11:50',
            ),
        ));
        
        
    }
}