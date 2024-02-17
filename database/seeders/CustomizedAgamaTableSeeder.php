<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomizedAgamaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('agama')->delete();
        
        \DB::table('agama')->insert(array (
            0 => 
            array (
                'name' => 'Islam',
                'simpeg_id' => '1',
                'created_at' => '2023-06-26 05:14:34',
                'updated_at' => '2023-06-26 05:14:34',
                'id' => 1,
            ),
            1 => 
            array (
                'name' => 'Kristen',
                'simpeg_id' => '2',
                'created_at' => '2023-06-26 05:14:34',
                'updated_at' => '2023-06-26 05:14:34',
                'id' => 2,
            ),
            2 => 
            array (
                'name' => 'Katolik',
                'simpeg_id' => '3',
                'created_at' => '2023-06-26 05:14:34',
                'updated_at' => '2023-06-26 05:14:34',
                'id' => 3,
            ),
            3 => 
            array (
                'name' => 'Hindu',
                'simpeg_id' => '4',
                'created_at' => '2023-06-26 05:14:34',
                'updated_at' => '2023-06-26 05:14:34',
                'id' => 4,
            ),
            4 => 
            array (
                'name' => 'Budha',
                'simpeg_id' => '5',
                'created_at' => '2023-06-26 05:14:34',
                'updated_at' => '2023-06-26 05:14:34',
                'id' => 5,
            ),
            5 => 
            array (
                'name' => 'Shinto',
                'simpeg_id' => '6',
                'created_at' => '2023-06-26 05:14:34',
                'updated_at' => '2023-06-26 05:14:34',
                'id' => 6,
            ),
            6 => 
            array (
                'name' => 'Kong Hu Chu',
                'simpeg_id' => '7',
                'created_at' => '2023-06-26 05:14:34',
                'updated_at' => '2023-06-26 05:14:34',
                'id' => 7,
            ),
            7 => 
            array (
                'name' => 'Kong Hu Chu',
                'simpeg_id' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id' => 8,
            ),
        ));
        
        
    }
}