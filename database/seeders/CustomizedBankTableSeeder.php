<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomizedBankTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('bank')->delete();
        
        \DB::table('bank')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'BJB new',
                'created_at' => '2023-06-27 02:51:40',
                'updated_at' => '2023-06-27 02:51:40',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Bank Rakyat Indonesia',
                'created_at' => '2023-06-27 02:51:40',
                'updated_at' => '2023-06-27 02:51:40',
            ),
            2 => 
            array (
                'id' => 6,
                'name' => 'Bank Mandiri',
                'created_at' => '2023-06-27 02:51:40',
                'updated_at' => '2023-06-27 02:51:40',
            ),
            3 => 
            array (
                'id' => 7,
                'name' => 'Bank Negara Indonesia',
                'created_at' => '2023-06-27 02:51:40',
                'updated_at' => '2023-06-27 02:51:40',
            ),
            4 => 
            array (
                'id' => 8,
                'name' => 'Bank Syariah Mandiri',
                'created_at' => '2023-06-27 02:51:40',
                'updated_at' => '2023-06-27 02:51:40',
            ),
            5 => 
            array (
                'id' => 19,
                'name' => 'BPD Aceh Cabang Lhokseumawe',
                'created_at' => '2023-06-27 02:51:40',
                'updated_at' => '2023-06-27 02:51:40',
            ),
            6 => 
            array (
                'id' => 20,
                'name' => 'Bank Jateng',
                'created_at' => '2023-06-27 02:51:40',
                'updated_at' => '2023-06-27 02:51:40',
            ),
            7 => 
            array (
                'id' => 22,
                'name' => 'BPD ACEH CABANG JANTHO',
                'created_at' => '2023-06-27 02:51:40',
                'updated_at' => '2023-06-27 02:51:40',
            ),
            8 => 
            array (
                'id' => 23,
                'name' => 'BPD ACEH CABANG CUNDA',
                'created_at' => '2023-06-27 02:51:40',
                'updated_at' => '2023-06-27 02:51:40',
            ),
            9 => 
            array (
                'id' => 24,
                'name' => 'BPD ACEH CABANG CALANG',
                'created_at' => '2023-06-27 02:51:40',
                'updated_at' => '2023-06-27 02:51:40',
            ),
            10 => 
            array (
                'id' => 25,
                'name' => 'Bank Nagari',
                'created_at' => '2023-06-27 02:51:40',
                'updated_at' => '2023-06-27 02:51:40',
            ),
            11 => 
            array (
                'id' => 26,
                'name' => 'Bank Sumut',
                'created_at' => '2023-06-27 02:51:40',
                'updated_at' => '2023-06-27 02:51:40',
            ),
            12 => 
            array (
                'id' => 27,
                'name' => 'BPD D.I.YOGYAKARTA',
                'created_at' => '2023-06-27 02:51:40',
                'updated_at' => '2023-06-27 02:51:40',
            ),
            13 => 
            array (
                'id' => 28,
                'name' => 'BANK BPD JATIM CAB. MOJOKERTO',
                'created_at' => '2023-06-27 02:51:40',
                'updated_at' => '2023-06-27 02:51:40',
            ),
            14 => 
            array (
                'id' => 31,
                'name' => 'Bank DKI',
                'created_at' => '2023-06-27 02:51:40',
                'updated_at' => '2023-06-27 02:51:40',
            ),
            15 => 
            array (
                'id' => 81,
                'name' => 'BPD SUMATERA SELATAN',
                'created_at' => '2023-06-27 02:51:40',
                'updated_at' => '2023-06-27 02:51:40',
            ),
            16 => 
            array (
                'id' => 82,
                'name' => 'BPD BANGKA BELITUNG',
                'created_at' => '2023-06-27 02:51:40',
                'updated_at' => '2023-06-27 02:51:40',
            ),
            17 => 
            array (
                'id' => 101,
                'name' => 'Bank Aceh',
                'created_at' => '2023-06-27 02:51:40',
                'updated_at' => '2023-06-27 02:51:40',
            ),
            18 => 
            array (
                'id' => 121,
                'name' => 'Bank BTN Cabang Kendari ',
                'created_at' => '2023-06-27 02:51:40',
                'updated_at' => '2023-06-27 02:51:40',
            ),
        ));
        
        
    }
}