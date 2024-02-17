<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomizedRiwayatOrganisasiTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('riwayat_organisasi')->delete();
        
        \DB::table('riwayat_organisasi')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nama' => 'KELOMPOK STUDI HUKUM FH UNPAD',
                'jabatan' => 'ANGGOTA',
                'awal' => '2010-05-01',
                'akhir' => '2011-05-01',
                'pimpinan' => 'MUHAMMAD SHABURYAN',
                'tempat' => 'BANDUNG',
                'simpeg_id' => '000000000696#1',
                'created_at' => '2023-06-28 07:15:59',
                'updated_at' => '2023-06-28 07:15:59',
                'employee_id' => 151,
            ),
            1 => 
            array (
                'id' => 2,
                'nama' => 'BADAN PERWAKILAN MAHASISWA KELUARGA ',
                'jabatan' => 'LAIN-LAIN',
                'awal' => '2011-12-12',
                'akhir' => '2012-12-12',
                'pimpinan' => 'GAMMA ABDUL JABAR',
                'tempat' => 'SUMEDANG',
                'simpeg_id' => '000000000696#2',
                'created_at' => '2023-06-28 07:15:59',
                'updated_at' => '2023-06-28 07:15:59',
                'employee_id' => 151,
            ),
            2 => 
            array (
                'id' => 3,
                'nama' => 'BEM FIB UI',
                'jabatan' => 'LAIN-LAIN',
                'awal' => '2016-03-08',
                'akhir' => '2016-12-27',
                'pimpinan' => 'MUHAMMAD AGUS FUAD',
                'tempat' => 'DEPOK',
                'simpeg_id' => '000000000707#1',
                'created_at' => '2023-06-28 07:15:59',
                'updated_at' => '2023-06-28 07:15:59',
                'employee_id' => 162,
            ),
            3 => 
            array (
                'id' => 4,
                'nama' => 'BEM FIB UI',
                'jabatan' => 'LAIN-LAIN',
                'awal' => '2017-02-07',
                'akhir' => '2017-12-29',
                'pimpinan' => 'AVEROUS IBRAHIM NOOR ESA',
                'tempat' => 'DEPOK',
                'simpeg_id' => '000000000707#2',
                'created_at' => '2023-06-28 07:15:59',
                'updated_at' => '2023-06-28 07:15:59',
                'employee_id' => 162,
            ),
            4 => 
            array (
                'id' => 5,
                'nama' => 'BEM FIB UI',
                'jabatan' => 'LAIN-LAIN',
                'awal' => '2018-01-09',
                'akhir' => '2018-12-21',
                'pimpinan' => 'NOVAL ADITYA INDRA NEGARA',
                'tempat' => 'DEPOK',
                'simpeg_id' => '000000000707#3',
                'created_at' => '2023-06-28 07:15:59',
                'updated_at' => '2023-06-28 07:15:59',
                'employee_id' => 162,
            ),
            5 => 
            array (
                'id' => 6,
                'nama' => 'MATAHARI KECIL INDONESIA FOUNDATION',
                'jabatan' => 'LAIN-LAIN',
                'awal' => '2019-07-13',
                'akhir' => '2019-12-06',
                'pimpinan' => 'YASSER MUHAMMAF SYAIFUL',
                'tempat' => 'JAKARTA',
                'simpeg_id' => '000000000707#4',
                'created_at' => '2023-06-28 07:15:59',
                'updated_at' => '2023-06-28 07:15:59',
                'employee_id' => 162,
            ),
            6 => 
            array (
                'id' => 7,
                'nama' => 'UKM BASKOM FAKULTAS HUKUM UNSYIAH',
                'jabatan' => 'KETUA',
                'awal' => '2009-09-15',
                'akhir' => '2010-10-15',
                'pimpinan' => 'EKA HUSNUL HIDAYATI',
                'tempat' => 'BANDA ACEH',
                'simpeg_id' => '000000000715#1',
                'created_at' => '2023-06-28 07:15:59',
                'updated_at' => '2023-06-28 07:15:59',
                'employee_id' => 170,
            ),
            7 => 
            array (
                'id' => 8,
                'nama' => 'DPM FAKULTAS HUKUM UNSYIAH',
                'jabatan' => 'BENDAHARA',
                'awal' => '2009-09-30',
                'akhir' => '2010-10-30',
                'pimpinan' => 'M. FAUZAN REZA',
                'tempat' => 'BANDA ACEH',
                'simpeg_id' => '000000000715#2',
                'created_at' => '2023-06-28 07:15:59',
                'updated_at' => '2023-06-28 07:15:59',
                'employee_id' => 170,
            ),
            8 => 
            array (
                'id' => 9,
                'nama' => 'REFERPAL COMMUNITY',
                'jabatan' => 'ANGGOTA',
                'awal' => '2018-10-01',
                'akhir' => '2020-11-02',
                'pimpinan' => 'DAVID ALEXANDER',
                'tempat' => 'JAKARTA',
                'simpeg_id' => '000000000722#1',
                'created_at' => '2023-06-28 07:15:59',
                'updated_at' => '2023-06-28 07:15:59',
                'employee_id' => 177,
            ),
            9 => 
            array (
                'id' => 10,
                'nama' => 'OSIS',
                'jabatan' => 'ANGGOTA BENDAHARA ',
                'awal' => '1984-01-01',
                'akhir' => '1984-12-31',
                'pimpinan' => NULL,
                'tempat' => NULL,
                'simpeg_id' => '000000030#1',
                'created_at' => '2023-06-28 07:15:59',
                'updated_at' => '2023-06-28 07:15:59',
                'employee_id' => 239,
            ),
            10 => 
            array (
                'id' => 11,
                'nama' => 'RESIMEN MAHASISWA',
                'jabatan' => 'ANGGOTA PROVOS',
                'awal' => '1990-01-01',
                'akhir' => '1992-12-31',
                'pimpinan' => NULL,
                'tempat' => NULL,
                'simpeg_id' => '000000030#2',
                'created_at' => '2023-06-28 07:15:59',
                'updated_at' => '2023-06-28 07:15:59',
                'employee_id' => 239,
            ),
            11 => 
            array (
                'id' => 12,
                'nama' => 'KMAPBS',
                'jabatan' => 'ANGGOTA',
                'awal' => '1990-01-01',
                'akhir' => '1992-12-31',
                'pimpinan' => NULL,
                'tempat' => NULL,
                'simpeg_id' => '000000030#3',
                'created_at' => '2023-06-28 07:15:59',
                'updated_at' => '2023-06-28 07:15:59',
                'employee_id' => 239,
            ),
            12 => 
            array (
                'id' => 13,
                'nama' => 'PENCAK SILAT SHT',
                'jabatan' => 'ANGGOTA',
                'awal' => '1990-01-01',
                'akhir' => '1992-12-31',
                'pimpinan' => NULL,
                'tempat' => NULL,
                'simpeg_id' => '000000030#4',
                'created_at' => '2023-06-28 07:15:59',
                'updated_at' => '2023-06-28 07:15:59',
                'employee_id' => 239,
            ),
        ));
        
        
    }
}