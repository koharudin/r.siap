<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomizedRiwayatUsulanTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('riwayat_usulan')->delete();
        
        \DB::table('riwayat_usulan')->insert(array (
            0 => 
            array (
                'id' => 2,
                'employee_id' => 578,
                'created_at' => '2023-08-10 03:57:13',
                'updated_at' => '2023-08-10 04:05:16',
                'old_data' => '{"id":129,"employee_id":578,"created_at":"2023-07-05T11:24:30.000000Z","updated_at":"2023-07-13T10:36:10.000000Z","name":"RAKA MUWAHID ALMAHDI","birth_place":"TANGERANG","birth_date":"2014-08-23T00:00:00.000000Z","jenis_kelamin":"L","status_keluarga":"K","status_tunjangan":"1","bln_dibayar":null,"bln_akhir_dibayar":null,"simpeg_id":"000000371#2","pekerjaan":""}',
                'new_data' => '{"employee_id":"578","name":"RAKA MUWAHID ALMAHDI.","birth_place":"TANGERANG","birth_date":"2014-08-23","jenis_kelamin":"L","pekerjaan":null,"status_keluarga":"K","status_tunjangan":"1","bln_dibayar":"2023-08-10","bln_akhir_dibayar":"2023-08-10"}',
                'status_id' => 5,
                'kategori_layanan_id' => 31,
                'ref_id' => 129,
                'requestor' => 377,
                'deleted_at' => NULL,
                'keterangan' => 'oke',
                'action' => 2,
                'dokumen_pendukung' => 'files/16e4d9fa028221ead6a2595afe672786.png',
            ),
        ));
        
        
    }
}