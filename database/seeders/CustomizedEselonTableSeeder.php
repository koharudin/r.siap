<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomizedEselonTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('eselon')->delete();
        
        
        
    }
}