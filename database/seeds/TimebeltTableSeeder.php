<?php

use Illuminate\Database\Seeder;
use App\Models\Timebelt;
class TimebeltTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	 // 883Jia   1
        $timebelt = new Timebelt();
        $timebelt->start_time = '06:00';
        $timebelt->end_time = '09:00';
        $timebelt->days = 'Wednesday,Friday';
        $timebelt->player_name = '883JIA';
        $timebelt->banner_image = 'banner_image_1561639111.png';
        $timebelt->is_active = '1';
        $timebelt->is_default = '0';
        $timebelt->save();


         // 883Jia    2
        $timebelt = new Timebelt();
        $timebelt->start_time = '09:00';
        $timebelt->end_time = '11:59';
        $timebelt->days = 'Wednesday,Friday';
        $timebelt->player_name = '883JIA';
        $timebelt->banner_image = 'banner_image_1561639346.png';
        $timebelt->is_active = '1';
        $timebelt->is_default = '0';
        $timebelt->save();


         // 883Jia    3
        $timebelt = new Timebelt();
        $timebelt->start_time = '12:00';
        $timebelt->end_time = '03:00';
        $timebelt->days = 'Wednesday,Monday';
        $timebelt->player_name = '883JIA';
        $timebelt->banner_image = 'banner_image_1561639397.png';
        $timebelt->is_active = '1';
        $timebelt->is_default = '0';
        $timebelt->save();


        // 883Jia    4
        $timebelt = new Timebelt();
        $timebelt->start_time = '17:00';
        $timebelt->end_time = '20:00';
        $timebelt->days = 'Wednesday,Monday';
        $timebelt->player_name = '883JIA';
        $timebelt->banner_image = 'banner_image_1561639447.png';
        $timebelt->is_active = '1';
        $timebelt->is_default = '0';
        $timebelt->save();


        // 883Jia    5
        $timebelt = new Timebelt();
        $timebelt->start_time = '21:00';
        $timebelt->end_time = '23:59';
        $timebelt->days = 'Wednesday,Monday';
        $timebelt->player_name = '883JIA';
        $timebelt->banner_image = 'banner_image_1561639484.png';
        $timebelt->is_active = '1';
        $timebelt->is_default = '0';
        $timebelt->save();


        // power98    6
        $timebelt = new Timebelt();
        $timebelt->start_time = '06:00';
        $timebelt->end_time = '08:59';
        $timebelt->days = 'Wednesday,Monday';
        $timebelt->player_name = 'POWER98 RAW';
        $timebelt->banner_image = 'banner_image_1561639703.png';
        $timebelt->is_active = '1';
        $timebelt->is_default = '0';
        $timebelt->save();


         // power98    7
        $timebelt = new Timebelt();
        $timebelt->start_time = '09:00';
        $timebelt->end_time = '11:59';
        $timebelt->days = 'Wednesday,Monday';
        $timebelt->player_name = 'POWER98 RAW';
        $timebelt->banner_image = 'banner_image_1561639737.png';
        $timebelt->is_active = '1';
        $timebelt->is_default = '0';
        $timebelt->save();

        // power98    8
        $timebelt = new Timebelt();
        $timebelt->start_time = '12:00';
        $timebelt->end_time = '15:00';
        $timebelt->days = 'Wednesday,Monday';
        $timebelt->player_name = 'POWER98 RAW';
        $timebelt->banner_image = 'banner_image_1561639758.png';
        $timebelt->is_active = '1';
        $timebelt->is_default = '0';
        $timebelt->save();


        // power98    9
        $timebelt = new Timebelt();
        $timebelt->start_time = '17:00';
        $timebelt->end_time = '20:00';
        $timebelt->days = 'Wednesday,Monday';
        $timebelt->player_name = 'POWER98 RAW';
        $timebelt->banner_image = 'banner_image_1561639775.png';
        $timebelt->is_active = '1';
        $timebelt->is_default = '0';
        $timebelt->save();


        // power98    10
        $timebelt = new Timebelt();
        $timebelt->start_time = '21:00';
        $timebelt->end_time = '23:59';
        $timebelt->days = 'Wednesday,Monday';
        $timebelt->player_name = 'POWER98 RAW';
        $timebelt->banner_image = 'banner_image_1561639670.png';
        $timebelt->is_active = '1';
        $timebelt->is_default = '0';
        $timebelt->save();


         // 883Jia    1 default
        $timebelt = new Timebelt();
        $timebelt->start_time = '00:00';
        $timebelt->end_time = '00:00';
        $timebelt->days = 'Monday';
        $timebelt->player_name = '883JIA';
        $timebelt->banner_image = 'banner_image_1561639897.png';
        $timebelt->is_active = '1';
        $timebelt->is_default = '1';
        $timebelt->save();

         // 883Jia webhits    2 default
        $timebelt = new Timebelt();
        $timebelt->start_time = '00:00';
        $timebelt->end_time = '00:00';
        $timebelt->days = 'Monday';
        $timebelt->player_name = '883JIA WEBHITS';
        $timebelt->banner_image = 'banner_image_1561639931.png';
        $timebelt->is_active = '1';
        $timebelt->is_default = '1';
        $timebelt->save();

        // 883Jia kpop    3 default
        $timebelt = new Timebelt();
        $timebelt->start_time = '00:00';
        $timebelt->end_time = '00:00';
        $timebelt->days = 'Monday';
        $timebelt->player_name = '883JIA KPOP';
        $timebelt->banner_image = 'banner_image_1561639956.png';
        $timebelt->is_active = '1';
        $timebelt->is_default = '1';
        $timebelt->save();

        // power98    4 default
        $timebelt = new Timebelt();
        $timebelt->start_time = '00:00';
        $timebelt->end_time = '00:00';
        $timebelt->days = 'Monday';
        $timebelt->player_name = 'POWER98 RAW';
        $timebelt->banner_image = 'banner_image_1561639984.png';
        $timebelt->is_active = '1';
        $timebelt->is_default = '1';
        $timebelt->save();

        // power98 hits    5 default
        $timebelt = new Timebelt();
        $timebelt->start_time = '00:00';
        $timebelt->end_time = '00:00';
        $timebelt->days = 'Monday';
        $timebelt->player_name = 'POWER98 HITS';
        $timebelt->banner_image = 'banner_image_1561640013.png';
        $timebelt->is_active = '1';
        $timebelt->is_default = '1';
        $timebelt->save();

        // power98 love song    6 default
        $timebelt = new Timebelt();
        $timebelt->start_time = '00:00';
        $timebelt->end_time = '00:00';
        $timebelt->days = 'Monday';
        $timebelt->player_name = 'POWER98 LOVE SONGS';
        $timebelt->banner_image = 'banner_image_1561640032.png';
        $timebelt->is_active = '1';
        $timebelt->is_default = '1';
        $timebelt->save();
    }
}
