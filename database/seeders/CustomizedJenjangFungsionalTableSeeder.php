<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomizedJenjangFungsionalTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('jenjang_fungsional')->delete();
        
        \DB::table('jenjang_fungsional')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Pelaksana',
                'min' => 22,
                'max' => 24,
                'created_at' => '2023-06-27 06:31:11',
                'updated_at' => '2023-06-27 06:31:11',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Pelaksana Lanjutan',
                'min' => 31,
                'max' => 32,
                'created_at' => '2023-06-27 06:31:11',
                'updated_at' => '2023-06-27 06:31:11',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Penyelia',
                'min' => 33,
                'max' => 34,
                'created_at' => '2023-06-27 06:31:11',
                'updated_at' => '2023-06-27 06:31:11',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Pertama',
                'min' => 31,
                'max' => 32,
                'created_at' => '2023-06-27 06:31:11',
                'updated_at' => '2023-06-27 06:31:11',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Muda',
                'min' => 33,
                'max' => 34,
                'created_at' => '2023-06-27 06:31:11',
                'updated_at' => '2023-06-27 06:31:11',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Madya',
                'min' => 41,
                'max' => 43,
                'created_at' => '2023-06-27 06:31:11',
                'updated_at' => '2023-06-27 06:31:11',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Utama',
                'min' => 44,
                'max' => 45,
                'created_at' => '2023-06-27 06:31:11',
                'updated_at' => '2023-06-27 06:31:11',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Pemula',
                'min' => NULL,
                'max' => NULL,
                'created_at' => '2023-06-27 06:31:11',
                'updated_at' => '2023-06-27 06:31:11',
            ),
        ));
        
        
    }
}