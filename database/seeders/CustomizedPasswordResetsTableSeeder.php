<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomizedPasswordResetsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('password_resets')->delete();
        
        
        
    }
}