<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomizedJenisPekerjaanTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('jenis_pekerjaan')->delete();
        
        \DB::table('jenis_pekerjaan')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'PNS Internal',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'PNS Eksternal',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Non PNS',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}