<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomizedJenisKpTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('jenis_kp')->delete();
        
        \DB::table('jenis_kp')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Reguler',
                'sapk_jenis_kp_id' => '101',
                'created_at' => '2023-06-27 03:36:30',
                'updated_at' => '2023-06-27 03:36:30',
            ),
            1 => 
            array (
                'id' => 4,
                'name' => 'Anumerta',
                'sapk_jenis_kp_id' => NULL,
                'created_at' => '2023-06-27 03:36:30',
                'updated_at' => '2023-06-27 03:36:30',
            ),
            2 => 
            array (
                'id' => 5,
                'name' => 'Pengabdian',
                'sapk_jenis_kp_id' => NULL,
                'created_at' => '2023-06-27 03:36:30',
                'updated_at' => '2023-06-27 03:36:30',
            ),
            3 => 
            array (
                'id' => 7,
                'name' => 'TNI',
                'sapk_jenis_kp_id' => NULL,
                'created_at' => '2023-06-27 03:36:30',
                'updated_at' => '2023-06-27 03:36:30',
            ),
            4 => 
            array (
                'id' => 8,
                'name' => 'Istimewa',
                'sapk_jenis_kp_id' => NULL,
                'created_at' => '2023-06-27 03:36:30',
                'updated_at' => '2023-06-27 03:36:30',
            ),
            5 => 
            array (
                'id' => 2,
            'name' => 'Pilihan (Jabatan Struktural)',
                'sapk_jenis_kp_id' => '201',
                'created_at' => '2023-06-27 03:36:30',
                'updated_at' => '2023-06-27 03:36:30',
            ),
            6 => 
            array (
                'id' => 3,
            'name' => 'Pilihan (Jabatan Fungsional Tertentu)',
                'sapk_jenis_kp_id' => '202',
                'created_at' => '2023-06-27 03:36:30',
                'updated_at' => '2023-06-27 03:36:30',
            ),
            7 => 
            array (
                'id' => 6,
            'name' => 'Pilihan (Penyesuaian Ijazah)',
                'sapk_jenis_kp_id' => '203',
                'created_at' => '2023-06-27 03:36:30',
                'updated_at' => '2023-06-27 03:36:30',
            ),
            8 => 
            array (
                'id' => 10,
            'name' => 'Pilihan (Sedang Melaksanakan Tugas Belajar)',
                'sapk_jenis_kp_id' => '204',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 11,
            'name' => 'Pilihan (Setelah Selesai Tugas Belajar)',
                'sapk_jenis_kp_id' => '205',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 12,
            'name' => 'Pilihan (Diperbantukan/Diperkerjakan Instansi Lain)',
                'sapk_jenis_kp_id' => '206',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => 13,
            'name' => 'Pilihan (Penemuan Baru)',
                'sapk_jenis_kp_id' => '207',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id' => 9,
            'name' => 'Pilihan (Prestasi Luar Biasa)',
                'sapk_jenis_kp_id' => '208',
                'created_at' => '2023-06-27 03:36:30',
                'updated_at' => '2023-06-27 03:36:30',
            ),
            13 => 
            array (
                'id' => 14,
            'name' => 'Pilihan (Pejabat Negara)',
                'sapk_jenis_kp_id' => '209',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
            'name' => 'Pilihan (Selama DPK/DPB)',
                'sapk_jenis_kp_id' => '210',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'Gol. dari Pengadaan CPNS/PNS',
                'sapk_jenis_kp_id' => '211',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}