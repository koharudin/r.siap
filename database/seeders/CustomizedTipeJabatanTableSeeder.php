<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomizedTipeJabatanTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tipe_jabatan')->delete();
        
        \DB::table('tipe_jabatan')->insert(array (
            0 => 
            array (
                'id' => 1,
            'name' => 'Struktural (Pejabat Pimpinan Tinggi)',
                'bup' => 60,
                'created_at' => '2023-07-14 09:42:31',
                'updated_at' => '2023-07-14 09:42:45',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Fungsional Umum',
                'bup' => 58,
                'created_at' => '2023-07-14 09:42:31',
                'updated_at' => '2023-07-14 09:42:45',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Fungsional Tertentu',
                'bup' => 58,
                'created_at' => '2023-07-14 09:42:31',
                'updated_at' => '2023-07-14 09:42:45',
            ),
            3 => 
            array (
                'id' => 4,
            'name' => 'Fungsional Tertentu (Madya)',
                'bup' => 60,
                'created_at' => '2023-07-14 09:42:31',
                'updated_at' => '2023-07-14 09:42:45',
            ),
            4 => 
            array (
                'id' => 5,
            'name' => 'Fungsional Tertentu (Utama)',
                'bup' => 65,
                'created_at' => '2023-07-14 09:42:31',
                'updated_at' => '2023-07-14 09:42:45',
            ),
            5 => 
            array (
                'id' => 6,
            'name' => 'Struktural (Pejabat Administrasi)',
                'bup' => 58,
                'created_at' => '2023-07-14 09:42:31',
                'updated_at' => '2023-07-14 09:42:45',
            ),
        ));
        
        
    }
}