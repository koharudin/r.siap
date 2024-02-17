<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomizedKemampuanBicaraTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('kemampuan_bicara')->delete();
        
        \DB::table('kemampuan_bicara')->insert(array (
            0 => 
            array (
                'id' => 'A',
                'name' => 'Aktif',
            ),
            1 => 
            array (
                'id' => 'P',
                'name' => 'Pasif',
            ),
        ));
        
        
    }
}