<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomizedGolonganDarahTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('golongan_darah')->delete();
        
        \DB::table('golongan_darah')->insert(array (
            0 => 
            array (
                'id' => 'A',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 'B',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 'O',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 'AB',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}