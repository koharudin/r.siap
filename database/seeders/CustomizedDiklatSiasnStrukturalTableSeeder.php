<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomizedDiklatSiasnStrukturalTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('diklat_siasn_struktural')->delete();
        
        \DB::table('diklat_siasn_struktural')->insert(array (
            0 => 
            array (
                'id_siasn' => 1,
                'jenis_diklat' => 'SEPADA',
            ),
            1 => 
            array (
                'id_siasn' => 2,
                'jenis_diklat' => 'SEPALA/ADUM/DIKLAT PIM TK. IV',
            ),
            2 => 
            array (
                'id_siasn' => 3,
                'jenis_diklat' => 'SEPADYA/SPAMA/DIKLAT PIM TK. III',
            ),
            3 => 
            array (
                'id_siasn' => 4,
                'jenis_diklat' => 'SPAMEN/SESPA/SESPANAS/DIKLAT PIM TK. II',
            ),
            4 => 
            array (
                'id_siasn' => 5,
                'jenis_diklat' => 'SEPATI/DIKLAT PIM TK. I',
            ),
            5 => 
            array (
                'id_siasn' => 6,
                'jenis_diklat' => 'SESPIM',
            ),
            6 => 
            array (
                'id_siasn' => 7,
                'jenis_diklat' => 'SESPATI',
            ),
            7 => 
            array (
                'id_siasn' => 8,
                'jenis_diklat' => 'Diklat Struktural Lainnya',
            ),
        ));
        
        
    }
}