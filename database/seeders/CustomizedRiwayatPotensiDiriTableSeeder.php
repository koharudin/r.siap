<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomizedRiwayatPotensiDiriTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('riwayat_potensi_diri')->delete();
        
        \DB::table('riwayat_potensi_diri')->insert(array (
            0 => 
            array (
                'id' => 1,
                'employee_id' => 384,
                'simpeg_id' => '000000177#5',
                'tahun' => '1',
                'tanggung_jawab' => '2',
                'motivasi' => '3',
                'minat' => '4',
                'created_at' => '2023-06-30 01:50:53',
                'updated_at' => '2023-06-30 01:51:47',
            ),
        ));
        
        
    }
}