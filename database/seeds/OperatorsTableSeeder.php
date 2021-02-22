<?php

use Illuminate\Database\Seeder;

class OperatorsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('operators')->delete();
        
        \DB::table('operators')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'etisalat',
                'rbt_sms_code' => '123',
                'rbt_ussd_code' => '1234',
                'image' => '1552552540477.png',
                'country_id' => 1,
                'created_at' => '2019-02-11 13:12:35',
                'updated_at' => '2019-03-14 08:35:40',
            ),
            1 => 
            array (
                'id' => 4,
                'name' => 'Vodafone',
                'rbt_sms_code' => '123',
                'rbt_ussd_code' => '',
                'image' => '1552552433218.png',
                'country_id' => 1,
                'created_at' => '2019-02-11 15:23:49',
                'updated_at' => '2019-03-14 08:33:53',
            ),
            2 => 
            array (
                'id' => 5,
                'name' => 'Orange',
                'rbt_sms_code' => '123456789',
                'rbt_ussd_code' => '123',
                'image' => '1552552570122.png',
                'country_id' => 1,
                'created_at' => '2019-03-14 08:36:10',
                'updated_at' => '2019-03-14 08:36:10',
            ),
        ));
        
        
    }
}
