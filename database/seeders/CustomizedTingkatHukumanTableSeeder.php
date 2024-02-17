<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomizedTingkatHukumanTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tingkat_hukuman')->delete();
        
        \DB::table('tingkat_hukuman')->insert(array (
            0 => 
            array (
                'id' => 0,
                'name' => 'Hukuman Disiplin Ringan Berdasarkan PP 53 Thn 2010',
                'created_at' => '2023-06-27 04:03:27',
                'updated_at' => '2023-06-27 04:03:27',
            ),
            1 => 
            array (
                'id' => 1,
                'name' => 'Hukuman Disiplin Sedang Berdasarkan PP 53 Thn 2010',
                'created_at' => '2023-06-27 04:03:27',
                'updated_at' => '2023-06-27 04:03:27',
            ),
            2 => 
            array (
                'id' => 2,
                'name' => 'Hukuman Disiplin Berat Berdasarkan PP 53 Thn 2010',
                'created_at' => '2023-06-27 04:03:27',
                'updated_at' => '2023-06-27 04:03:27',
            ),
            3 => 
            array (
                'id' => 3,
                'name' => 'Berdasarkan PP 32 Tahun 1979',
                'created_at' => '2023-06-27 04:03:27',
                'updated_at' => '2023-06-27 04:03:27',
            ),
            4 => 
            array (
                'id' => 4,
                'name' => 'Berdasarkan PP 11 Tahun 2002',
                'created_at' => '2023-06-27 04:03:27',
                'updated_at' => '2023-06-27 04:03:27',
            ),
            5 => 
            array (
                'id' => 5,
                'name' => 'Berdasarkan PP 4 Tahun 1966',
                'created_at' => '2023-06-27 04:03:27',
                'updated_at' => '2023-06-27 04:03:27',
            ),
            6 => 
            array (
                'id' => 6,
                'name' => 'Hukuman Berdasarkan PP 30 Tahun 1980',
                'created_at' => '2023-06-27 04:03:27',
                'updated_at' => '2023-06-27 04:03:27',
            ),
            7 => 
            array (
                'id' => 7,
                'name' => 'Hukuman Sedang Berdasarkan PP 30 Tahun 1980',
                'created_at' => '2023-06-27 04:03:27',
                'updated_at' => '2023-06-27 04:03:27',
            ),
            8 => 
            array (
                'id' => 8,
                'name' => 'Hukuman Berat Berdasarkan PP 30 Tahun 1980',
                'created_at' => '2023-06-27 04:03:27',
                'updated_at' => '2023-06-27 04:03:27',
            ),
        ));
        
        
    }
}