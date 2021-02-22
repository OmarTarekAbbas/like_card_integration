<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::table('settings')->insert(
            array(
                array (
                    'key' => 'home_page_logo',
                    'value' => 'setting-image/settings_images/5e0b352e9f0e8.png',
                    'created_at' => '2019-12-31 10:50:04',
                    'updated_at' => '2019-12-31 08:54:06',
                    'type_id' => 3,
                ),
                array (
                    'key' => 'header_logo',
                    'value' => 'setting-image/settings_images/5e0b3547b4ecc.png',
                    'created_at' => '2019-12-31 10:50:04',
                    'updated_at' => '2019-12-31 08:54:06',
                    'type_id' => 3,
                ),
                array (
                    'key' => 'loading_image',
                    'value' => 'setting-image/settings_images/5e0b352e9f0e8.png',
                    'created_at' => '2019-12-31 10:50:04',
                    'updated_at' => '2019-12-31 08:54:06',
                    'type_id' => 3,
                ),
                array (
                    'key' => 'title',
                    'value' => 'Services General',
                    'created_at' => '2019-12-31 10:50:04',
                    'updated_at' => '2019-12-31 08:54:06',
                    'type_id' => 2,
                ),
                array (
                    'key' => 'fav_icon',
                    'value' => 'setting-image/settings_images/5e0b3547b4ecc.png',
                    'created_at' => '2019-12-31 10:50:04',
                    'updated_at' => '2019-12-31 08:54:06',
                    'type_id' => 3,
                ),
                array (
                    'key' => 'meta_description',
                    'value' => 'هذه الاية تسلية للنبى ﷺ
                    ومواساة ربانية لقلبك حين تشغل بالك بأقوال الآخرين وتنسى أن الله سبحانه وتعالى معك ويشعر بك
                    اللهم انك تعلم سرنا وعلانيتنا فأقـبل معـذرتنا وتعلم حاجتنا فاعطـنا سؤالنا وتعـلم ما في نفـوسنا فاغـفِـر لنا',
                    'created_at' => '2019-12-31 10:50:04',
                    'updated_at' => '2019-12-31 08:54:06',
                    'type_id' => 2,
                ),
                array (
                    'key' => 'copy_rights',
                    'value' => 'Copyright © 2019 Ooredoo Qatar Services',
                    'created_at' => '2019-12-31 10:50:04',
                    'updated_at' => '2019-12-31 08:54:06',
                    'type_id' => 2,
                ),
                array (
                    'key' => 'backgound_body',
                    'value' => 'setting-image/settings_images/5e0b353fd6b0a.jpg',
                    'created_at' => '2019-12-31 10:50:04',
                    'updated_at' => '2019-12-31 08:54:06',
                    'type_id' => 3,
                ),
                array (
                    'key' => 'default_image',
                    'value' => 'setting-image/settings_images/5e0b3547b4ecc.png',
                    'created_at' => '2019-12-31 10:50:04',
                    'updated_at' => '2019-12-31 08:54:06',
                    'type_id' => 3,
                ),
                array (
                    'key' => 'socail_enable',
                    'value' => '1',
                    'created_at' => '2019-12-31 10:50:04',
                    'updated_at' => '2019-12-31 08:54:06',
                    'type_id' => 7,
                ),
                array (
                    'key' => 'facebook',
                    'value' => 'https://www.facebook.com/',
                    'created_at' => '2019-12-31 10:50:04',
                    'updated_at' => '2019-12-31 08:54:06',
                    'type_id' => 2,
                ),
                array (
                    'key' => 'youtube',
                    'value' => 'https://www.youtube.com/watch?v=E555uAaczvo',
                    'created_at' => '2019-12-31 10:50:04',
                    'updated_at' => '2019-12-31 08:54:06',
                    'type_id' => 2,
                ),
                array (
                    'key' => 'home_page_video',
                    'value' => 'setting-image/settings_videos/5e0b355413d3a.mp4',
                    'created_at' => '2019-12-31 10:50:04',
                    'updated_at' => '2019-12-31 08:54:06',
                    'type_id' => 4,
                ),
                array (
                    'key' => 'navbar',
                    'value' => '#000000',
                    'created_at' => '2019-12-31 10:50:04',
                    'updated_at' => '2019-12-31 08:54:06',
                    'type_id' => 8,
                ),
                array (
                    'key' => 'footer',
                    'value' => '#000000',
                    'created_at' => '2019-12-31 10:50:04',
                    'updated_at' => '2019-12-31 08:54:06',
                    'type_id' => 8,
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
