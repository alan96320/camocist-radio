<?php

use Illuminate\Database\Seeder;
use App\Models\LogoSetting;

class LogoSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $logo = new LogoSetting();
        $logo->key = 'header_logo';
        $logo->logo_image = 'logo_image_1561624766.png'; 
        $logo->status = 1;
        $logo->save();


        $logo = new LogoSetting();
        $logo->key = 'footer_logo';
        $logo->logo_image = 'logo_image_1561624788.png'; 
        $logo->status = 1;
        $logo->save();
    }
}
