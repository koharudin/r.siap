<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomizedStatusPegawaiTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('status_pegawai')->delete();
        
        \DB::table('status_pegawai')->insert(array (
            0 => 
            array (
                'id' => 0,
                'name' => 'Usulan CPNS',
                'created_at' => '2023-07-28 00:16:33',
                'updated_at' => '2023-07-28 00:16:33',
            ),
            1 => 
            array (
                'id' => 1,
                'name' => 'CPNS',
                'created_at' => '2023-07-28 00:16:33',
                'updated_at' => '2023-07-28 00:16:33',
            ),
            2 => 
            array (
                'id' => 10,
                'name' => 'Tewas',
                'created_at' => '2023-07-28 00:16:33',
                'updated_at' => '2023-07-28 00:16:33',
            ),
            3 => 
            array (
                'id' => 2,
                'name' => 'PNS',
                'created_at' => '2023-07-28 00:16:33',
                'updated_at' => '2023-07-28 00:16:33',
            ),
            4 => 
            array (
                'id' => 23,
                'name' => 'PPPK',
                'created_at' => '2023-07-28 00:16:33',
                'updated_at' => '2023-07-28 00:16:33',
            ),
            5 => 
            array (
                'id' => 3,
                'name' => 'Pensiun',
                'created_at' => '2023-07-28 00:16:33',
                'updated_at' => '2023-07-28 00:16:33',
            ),
            6 => 
            array (
                'id' => 8,
                'name' => 'Pemberhentian',
                'created_at' => '2023-07-28 00:16:33',
                'updated_at' => '2023-07-28 00:16:33',
            ),
            7 => 
            array (
                'id' => 9,
                'name' => 'Meninggal',
                'created_at' => '2023-07-28 00:16:33',
                'updated_at' => '2023-07-28 00:16:33',
            ),
        ));
        
        
    }
}