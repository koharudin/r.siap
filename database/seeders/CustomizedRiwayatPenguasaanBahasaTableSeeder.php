<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomizedRiwayatPenguasaanBahasaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('riwayat_penguasaan_bahasa')->delete();
        
        \DB::table('riwayat_penguasaan_bahasa')->insert(array (
            0 => 
            array (
                'id' => 1,
                'employee_id' => 287,
                'created_at' => '2023-07-12 09:56:47',
                'updated_at' => '2023-07-12 09:57:00',
                'jenis_bahasa' => 2,
                'nama_bahasa' => 'BAHASA JAWA SUNDA',
                'kemampuan_bicara' => 'A',
                'jenis_sertifikasi' => '',
                'lembaga_sertifikasi' => '',
                'skor' => '0.0',
                'tgl_expired' => NULL,
                'simpeg_id' => '000000079#1',
            ),
            1 => 
            array (
                'id' => 2,
                'employee_id' => 389,
                'created_at' => '2023-07-12 09:56:47',
                'updated_at' => '2023-07-12 09:57:00',
                'jenis_bahasa' => 2,
                'nama_bahasa' => 'JAWA',
                'kemampuan_bicara' => 'P',
                'jenis_sertifikasi' => '',
                'lembaga_sertifikasi' => '',
                'skor' => '0.0',
                'tgl_expired' => NULL,
                'simpeg_id' => '000000182#1',
            ),
            2 => 
            array (
                'id' => 3,
                'employee_id' => 578,
                'created_at' => '2023-07-12 09:56:47',
                'updated_at' => '2023-07-12 11:37:18',
                'jenis_bahasa' => 2,
                'nama_bahasa' => 'INGGRIS',
                'kemampuan_bicara' => 'P',
                'jenis_sertifikasi' => 'tet',
                'lembaga_sertifikasi' => '-aa',
                'skor' => '1.0',
                'tgl_expired' => '2022-02-26',
                'simpeg_id' => '000000371#',
            ),
            3 => 
            array (
                'id' => 4,
                'employee_id' => NULL,
                'created_at' => '2023-07-12 12:08:44',
                'updated_at' => '2023-07-12 12:08:44',
                'jenis_bahasa' => NULL,
                'nama_bahasa' => NULL,
                'kemampuan_bicara' => NULL,
                'jenis_sertifikasi' => NULL,
                'lembaga_sertifikasi' => NULL,
                'skor' => NULL,
                'tgl_expired' => NULL,
                'simpeg_id' => '371#',
            ),
        ));
        
        
    }
}