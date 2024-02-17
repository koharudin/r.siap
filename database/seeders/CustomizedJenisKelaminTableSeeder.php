<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomizedJenisKelaminTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('jenis_kelamin')->delete();
        
        \DB::table('jenis_kelamin')->insert(array (
            0 => 
            array (
                'id' => 'L',
                'name' => 'Laki-Laki',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 'P',
                'name' => 'Perempuan',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}