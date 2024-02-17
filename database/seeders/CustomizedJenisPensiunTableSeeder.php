<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomizedJenisPensiunTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('jenis_pensiun')->delete();
        
        \DB::table('jenis_pensiun')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Pensiun Dini',
                'created_at' => '2023-06-27 04:28:39',
                'updated_at' => '2023-06-27 04:28:39',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Karena Wafat',
                'created_at' => '2023-06-27 04:28:39',
                'updated_at' => '2023-06-27 04:28:39',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'MPP',
                'created_at' => '2023-06-27 04:28:39',
                'updated_at' => '2023-06-27 04:28:39',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'BUP',
                'created_at' => '2023-06-27 04:28:39',
                'updated_at' => '2023-06-27 04:28:39',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Tewas',
                'created_at' => '2023-06-27 04:28:39',
                'updated_at' => '2023-06-27 04:28:39',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Atas Permintaan Sendiri',
                'created_at' => '2023-06-27 04:28:39',
                'updated_at' => '2023-06-27 04:28:39',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Pemberhentian',
                'created_at' => '2023-06-27 04:28:39',
                'updated_at' => '2023-06-27 04:28:39',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Hilang',
                'created_at' => '2023-06-27 04:28:39',
                'updated_at' => '2023-06-27 04:28:39',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Karena Sakit',
                'created_at' => '2023-06-27 04:28:39',
                'updated_at' => '2023-06-27 04:28:39',
            ),
        ));
        
        
    }
}