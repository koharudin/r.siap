<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomizedJenisKenaikanGajiTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('jenis_kenaikan_gaji')->delete();
        
        \DB::table('jenis_kenaikan_gaji')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Kenaikan Pangkat',
                'created_at' => '2023-07-02 06:05:06',
                'updated_at' => '2023-07-02 06:05:06',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Gaji Berkala',
                'created_at' => '2023-07-02 06:05:06',
                'updated_at' => '2023-07-02 06:05:06',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Penyesuaian Tabel Gaji Pokok',
                'created_at' => '2023-07-02 06:05:06',
                'updated_at' => '2023-07-02 06:05:06',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'SK Lain-lain',
                'created_at' => '2023-07-02 06:05:06',
                'updated_at' => '2023-07-02 06:05:06',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Penurunan Pangkat',
                'created_at' => '2023-07-02 06:05:06',
                'updated_at' => '2023-07-02 06:05:06',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Pencabutan Hukuman',
                'created_at' => '2023-07-02 06:05:06',
                'updated_at' => '2023-07-02 06:05:06',
            ),
        ));
        
        
    }
}