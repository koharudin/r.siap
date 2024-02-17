<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomizedStatusUsulanTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('status_usulan')->delete();
        
        \DB::table('status_usulan')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Draft',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 3,
                'name' => 'Verifikasi',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 4,
                'name' => 'Ditolak',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 5,
                'name' => 'Diterima',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 2,
                'name' => 'Terkirim',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}