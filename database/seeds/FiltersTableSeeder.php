<?php

use Illuminate\Database\Seeder;
use App\Models\Filters;

class FiltersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Filters::query()->truncate();
        
        $logo = new Filters();
        $logo->name = 'CATEGORY';
        $logo->active = 1; 
        $logo->save();


        $logo = new Filters();
        $logo->name = 'LATEST';
        $logo->active = 1; 
        $logo->save();
    }
}
