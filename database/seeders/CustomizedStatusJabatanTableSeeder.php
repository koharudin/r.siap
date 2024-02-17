<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomizedStatusJabatanTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('status_jabatan')->delete();
        
        \DB::table('status_jabatan')->insert(array (
            0 => 
            array (
                'id' => 0,
                'name' => 'Jabatan Terbaru',
                'created_at' => '2023-07-26 04:42:55',
                'updated_at' => '2023-07-26 04:42:55',
                'simpeg_id' => '0',
            ),
            1 => 
            array (
                'id' => 1,
                'name' => 'PLT',
                'created_at' => '2023-07-26 04:42:55',
                'updated_at' => '2023-07-26 04:42:55',
                'simpeg_id' => '1',
            ),
            2 => 
            array (
                'id' => 2,
                'name' => 'PLH',
                'created_at' => '2023-07-26 04:42:55',
                'updated_at' => '2023-07-26 04:42:55',
                'simpeg_id' => '2',
            ),
            3 => 
            array (
                'id' => 3,
                'name' => 'PJ',
                'created_at' => '2023-07-26 04:42:55',
                'updated_at' => '2023-07-26 04:42:55',
                'simpeg_id' => '3',
            ),
            4 => 
            array (
                'id' => 4,
                'name' => 'PJS',
                'created_at' => '2023-07-26 04:42:55',
                'updated_at' => '2023-07-26 04:42:55',
                'simpeg_id' => '4',
            ),
            5 => 
            array (
                'id' => 99,
                'name' => '-',
                'created_at' => '2023-07-26 04:42:55',
                'updated_at' => '2023-07-26 04:42:55',
                'simpeg_id' => '99',
            ),
        ));
        
        
    }
}