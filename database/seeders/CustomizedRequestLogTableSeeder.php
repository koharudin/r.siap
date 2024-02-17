<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomizedRequestLogTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('request_log')->delete();
        
        \DB::table('request_log')->insert(array (
            0 => 
            array (
                'id' => 1,
                'request_id' => 2,
                'log' => 'Membuat usulan #2 kategori 31 status 2',
                'created_at' => '2023-08-10 03:57:13',
                'updated_at' => '2023-08-10 03:57:13',
                'user_id' => 377,
                'dirty_data' => '{"employee_id":"578","name":"RAKA MUWAHID ALMAHDI.","birth_place":"TANGERANG","birth_date":"2014-08-23","jenis_kelamin":"L","pekerjaan":null,"status_keluarga":"K","status_tunjangan":"1","bln_dibayar":"2023-08-10","bln_akhir_dibayar":"2023-08-10"}',
            ),
            1 => 
            array (
                'id' => 2,
                'request_id' => 2,
                'log' => 'USULAN DITERIMA',
                'created_at' => '2023-08-10 04:05:16',
                'updated_at' => '2023-08-10 04:05:16',
                'user_id' => 377,
                'dirty_data' => NULL,
            ),
        ));
        
        
    }
}