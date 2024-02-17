<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomizedStatusMenikahTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('status_menikah')->delete();
        
        \DB::table('status_menikah')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Menikah',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Cerai',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Meninggal',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}