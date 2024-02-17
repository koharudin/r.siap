<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomizedDiklatSiasnTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('diklat_siasn')->delete();
        
        \DB::table('diklat_siasn')->insert(array (
            0 => 
            array (
                'id_siasn' => 2,
                'jenis_diklat' => 'Diklat Fungsional',
                'jenis_sertifikat' => 'F',
            ),
            1 => 
            array (
                'id_siasn' => 3,
                'jenis_diklat' => 'Diklat Teknis',
                'jenis_sertifikat' => 'T',
            ),
            2 => 
            array (
                'id_siasn' => 5,
                'jenis_diklat' => 'Pelatihan Manajerial',
                'jenis_sertifikat' => '-',
            ),
            3 => 
            array (
                'id_siasn' => 6,
                'jenis_diklat' => 'Pelatihan Sosial Kultural',
                'jenis_sertifikat' => '-',
            ),
            4 => 
            array (
                'id_siasn' => 7,
                'jenis_diklat' => 'Sosialisasi',
                'jenis_sertifikat' => 'P',
            ),
            5 => 
            array (
                'id_siasn' => 8,
                'jenis_diklat' => 'Bimbingan Teknis',
                'jenis_sertifikat' => 'P',
            ),
            6 => 
            array (
                'id_siasn' => 9,
                'jenis_diklat' => 'Seminar',
                'jenis_sertifikat' => 'P',
            ),
            7 => 
            array (
                'id_siasn' => 10,
                'jenis_diklat' => 'Magang',
                'jenis_sertifikat' => 'P',
            ),
            8 => 
            array (
                'id_siasn' => 1,
                'jenis_diklat' => 'Diklat Struktural',
                'jenis_sertifikat' => '-',
            ),
            9 => 
            array (
                'id_siasn' => 4,
                'jenis_diklat' => 'Workshop',
                'jenis_sertifikat' => 'P',
            ),
        ));
        
        
    }
}