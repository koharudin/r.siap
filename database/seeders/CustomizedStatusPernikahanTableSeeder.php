<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomizedStatusPernikahanTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('status_pernikahan')->delete();
        
        \DB::table('status_pernikahan')->insert(array (
            0 => 
            array (
                'id' => 'D',
                'name' => NULL,
            ),
            1 => 
            array (
                'id' => 'B',
                'name' => 'Belum',
            ),
            2 => 
            array (
                'id' => 'K',
                'name' => 'Kawin',
            ),
            3 => 
            array (
                'id' => 'J',
                'name' => 'Janda',
            ),
        ));
        
        
    }
}