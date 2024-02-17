<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomizedStatusAnakTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('status_anak')->delete();
        
        \DB::table('status_anak')->insert(array (
            0 => 
            array (
                'id' => 'K',
                'name' => 'Kandung',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 'T',
                'name' => 'Tiri',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 'A',
                'name' => 'Angkat',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}