<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomizedJenisBahasaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('jenis_bahasa')->delete();
        
        \DB::table('jenis_bahasa')->insert(array (
            0 => 
            array (
                'name' => 'Asing',
                'created_at' => NULL,
                'updated_at' => NULL,
                'id' => 1,
            ),
            1 => 
            array (
                'name' => 'Daerah',
                'created_at' => NULL,
                'updated_at' => NULL,
                'id' => 2,
            ),
        ));
        
        
    }
}