<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomizedRiwayatPengalamanKerjaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('riwayat_pengalaman_kerja')->delete();
        
        \DB::table('riwayat_pengalaman_kerja')->insert(array (
            0 => 
            array (
                'id' => 1,
                'employee_id' => 151,
                'simpeg_id' => '000000000696#1',
                'created_at' => '2023-07-13 05:37:13',
                'updated_at' => '2023-07-13 05:37:13',
                'instansi' => 'KEMENTERIAN PEKERJAAN UMUM DAN PERUMAHAN RAKYAT',
                'jabatan' => 'KONSULTAN INDIVIDUAL/TENAGA AHLI MUDA BIDANG HUKUM',
                'masa_kerja_tahun' => 3,
                'masa_kerja_bulan' => 5,
                'tgl_kerja' => '2017-02-01',
            ),
            1 => 
            array (
                'id' => 2,
                'employee_id' => 152,
                'simpeg_id' => '000000000697#1',
                'created_at' => '2023-07-13 05:37:13',
                'updated_at' => '2023-07-13 05:37:13',
                'instansi' => 'KEMENTERIAN PERENCANAAN PEMBANGUNAN NASIONAL/BAPPENAS',
                'jabatan' => 'STAF ADMININISTRASI PERSURATAN-KORESPONDENSI INTER',
                'masa_kerja_tahun' => 3,
                'masa_kerja_bulan' => 0,
                'tgl_kerja' => '2014-01-06',
            ),
            2 => 
            array (
                'id' => 3,
                'employee_id' => 152,
                'simpeg_id' => '000000000697#2',
                'created_at' => '2023-07-13 05:37:13',
                'updated_at' => '2023-07-13 05:37:13',
                'instansi' => 'BAPPENAS',
                'jabatan' => 'TENAGA ADMINISTRASI',
                'masa_kerja_tahun' => 1,
                'masa_kerja_bulan' => 0,
                'tgl_kerja' => '2018-01-02',
            ),
            3 => 
            array (
                'id' => 4,
                'employee_id' => 152,
                'simpeg_id' => '000000000697#3',
                'created_at' => '2023-07-13 05:37:13',
                'updated_at' => '2023-07-13 05:37:13',
                'instansi' => 'BAPPENAS',
                'jabatan' => 'TENAGA ADMINISTRASI',
                'masa_kerja_tahun' => 1,
                'masa_kerja_bulan' => 0,
                'tgl_kerja' => '2019-01-02',
            ),
            4 => 
            array (
                'id' => 5,
                'employee_id' => 153,
                'simpeg_id' => '000000000698#1',
                'created_at' => '2023-07-13 05:37:13',
                'updated_at' => '2023-07-13 05:37:13',
                'instansi' => 'KEMENTERIAN AGRARIA DAN TATA RUANG/BADAN PERTANAHAN NASIONAL',
                'jabatan' => 'OPERATOR KOMPUTER',
                'masa_kerja_tahun' => 4,
                'masa_kerja_bulan' => 9,
                'tgl_kerja' => '2021-03-01',
            ),
            5 => 
            array (
                'id' => 6,
                'employee_id' => 156,
                'simpeg_id' => '000000000701#1',
                'created_at' => '2023-07-13 05:37:13',
                'updated_at' => '2023-07-13 05:37:13',
                'instansi' => 'PT. JAPAN ASIA CONSULTANTS',
                'jabatan' => 'STAFF VISA',
                'masa_kerja_tahun' => 0,
                'masa_kerja_bulan' => 11,
                'tgl_kerja' => '2019-02-01',
            ),
            6 => 
            array (
                'id' => 7,
                'employee_id' => 158,
                'simpeg_id' => '000000000703#1',
                'created_at' => '2023-07-13 05:37:13',
                'updated_at' => '2023-07-13 05:37:13',
                'instansi' => 'PT BANK SINARMAS',
                'jabatan' => 'TELLER',
                'masa_kerja_tahun' => 1,
                'masa_kerja_bulan' => 5,
                'tgl_kerja' => '2017-07-06',
            ),
            7 => 
            array (
                'id' => 8,
                'employee_id' => 158,
                'simpeg_id' => '000000000703#2',
                'created_at' => '2023-07-13 05:37:13',
                'updated_at' => '2023-07-13 05:37:13',
                'instansi' => 'PT BANG SINARMAS TBK',
                'jabatan' => 'AML &amp; CTF ANALYST &amp; REPORTING JUNIOR OFFIC',
                'masa_kerja_tahun' => 2,
                'masa_kerja_bulan' => 0,
                'tgl_kerja' => '2018-12-01',
            ),
            8 => 
            array (
                'id' => 9,
                'employee_id' => 160,
                'simpeg_id' => '000000000705#1',
                'created_at' => '2023-07-13 05:37:13',
                'updated_at' => '2023-07-13 05:37:13',
                'instansi' => 'ARSIP NASIONAL REPUBLIK INDONESIA',
                'jabatan' => 'STAFF DATA ENTRY',
                'masa_kerja_tahun' => 2,
                'masa_kerja_bulan' => 0,
                'tgl_kerja' => '2018-01-01',
            ),
            9 => 
            array (
                'id' => 10,
                'employee_id' => 161,
                'simpeg_id' => '000000000706#1',
                'created_at' => '2023-07-13 05:37:13',
                'updated_at' => '2023-07-13 05:37:13',
                'instansi' => 'KONSIL KEDOKTERAN INDONESIA',
                'jabatan' => 'ARSIPARIS',
                'masa_kerja_tahun' => 0,
                'masa_kerja_bulan' => 9,
                'tgl_kerja' => '2017-03-01',
            ),
            10 => 
            array (
                'id' => 11,
                'employee_id' => 161,
                'simpeg_id' => '000000000706#2',
                'created_at' => '2023-07-13 05:37:13',
                'updated_at' => '2023-07-13 05:37:13',
                'instansi' => 'KONSIL KEDOKTERAN INDONESIA',
                'jabatan' => 'STAF HUBUNGAN MASYARAKAT',
                'masa_kerja_tahun' => 0,
                'masa_kerja_bulan' => 10,
                'tgl_kerja' => '2018-02-01',
            ),
            11 => 
            array (
                'id' => 12,
                'employee_id' => 161,
                'simpeg_id' => '000000000706#3',
                'created_at' => '2023-07-13 05:37:13',
                'updated_at' => '2023-07-13 05:37:13',
                'instansi' => 'KONSIL KEDOKTERAN INDONESIA',
                'jabatan' => 'STAF HUBUNGAN MASYARAKAT',
                'masa_kerja_tahun' => 1,
                'masa_kerja_bulan' => 0,
                'tgl_kerja' => '2021-01-02',
            ),
            12 => 
            array (
                'id' => 13,
                'employee_id' => 161,
                'simpeg_id' => '000000000706#4',
                'created_at' => '2023-07-13 05:37:13',
                'updated_at' => '2023-07-13 05:37:13',
                'instansi' => 'KONSIL KEDOKTERAN INDONESIA',
                'jabatan' => 'STAF HUBUNGAN MASYARAKAT',
                'masa_kerja_tahun' => 1,
                'masa_kerja_bulan' => 0,
                'tgl_kerja' => '2020-01-02',
            ),
            13 => 
            array (
                'id' => 14,
                'employee_id' => 164,
                'simpeg_id' => '000000000709#1',
                'created_at' => '2023-07-13 05:37:13',
                'updated_at' => '2023-07-13 05:37:13',
                'instansi' => 'PERUM PERIKANAN INDONESIA',
                'jabatan' => 'MANAGEMENT TRAINEE/PKWT',
                'masa_kerja_tahun' => 1,
                'masa_kerja_bulan' => 3,
                'tgl_kerja' => '2019-09-02',
            ),
            14 => 
            array (
                'id' => 15,
                'employee_id' => 165,
                'simpeg_id' => '000000000710#1',
                'created_at' => '2023-07-13 05:37:13',
                'updated_at' => '2023-07-13 05:37:13',
                'instansi' => 'PT VALUE STREEM INTERNATIONAL',
                'jabatan' => 'PROGRAMMER',
                'masa_kerja_tahun' => 1,
                'masa_kerja_bulan' => 4,
                'tgl_kerja' => '2017-08-08',
            ),
            15 => 
            array (
                'id' => 16,
                'employee_id' => 165,
                'simpeg_id' => '000000000710#2',
                'created_at' => '2023-07-13 05:37:13',
                'updated_at' => '2023-07-13 05:37:13',
                'instansi' => 'PT MADIA INVESTA PRATAMA',
                'jabatan' => 'WEB PROGRAMMER',
                'masa_kerja_tahun' => 1,
                'masa_kerja_bulan' => 5,
                'tgl_kerja' => '2019-03-12',
            ),
            16 => 
            array (
                'id' => 17,
                'employee_id' => 166,
                'simpeg_id' => '000000000711#1',
                'created_at' => '2023-07-13 05:37:13',
                'updated_at' => '2023-07-13 05:37:13',
                'instansi' => 'PT INFOMEDIA NUSANTARA',
                'jabatan' => 'ADMIN SEKRETARI',
                'masa_kerja_tahun' => 2,
                'masa_kerja_bulan' => 4,
                'tgl_kerja' => '2018-01-29',
            ),
            17 => 
            array (
                'id' => 19,
                'employee_id' => 170,
                'simpeg_id' => '000000000715#1',
                'created_at' => '2023-07-13 05:37:13',
                'updated_at' => '2023-07-13 05:37:13',
                'instansi' => 'PT RADIO SERAMBI INDONESIA PENYIARAN',
                'jabatan' => 'PENYIAR RADIO',
                'masa_kerja_tahun' => 2,
                'masa_kerja_bulan' => 2,
                'tgl_kerja' => '2018-08-01',
            ),
            18 => 
            array (
                'id' => 20,
                'employee_id' => 172,
                'simpeg_id' => '000000000717#1',
                'created_at' => '2023-07-13 05:37:13',
                'updated_at' => '2023-07-13 05:37:13',
                'instansi' => 'PT BINA MEDIA TENGGARA',
                'jabatan' => 'STAF',
                'masa_kerja_tahun' => 1,
                'masa_kerja_bulan' => 0,
                'tgl_kerja' => '2019-04-08',
            ),
            19 => 
            array (
                'id' => 21,
                'employee_id' => 179,
                'simpeg_id' => '000000000724#1',
                'created_at' => '2023-07-13 05:37:13',
                'updated_at' => '2023-07-13 05:37:13',
                'instansi' => 'DINAS PEMBERDAYAAN PEREMPUAN PERLINDUNGAN  ANAK PENGENDALIAN PENDUDUK DAN KELUARGA BERENCANA',
                'jabatan' => 'TENAGA HARIAN LEPAS',
                'masa_kerja_tahun' => 0,
                'masa_kerja_bulan' => 6,
                'tgl_kerja' => '2019-01-02',
            ),
            20 => 
            array (
                'id' => 22,
                'employee_id' => 179,
                'simpeg_id' => '000000000724#2',
                'created_at' => '2023-07-13 05:37:13',
                'updated_at' => '2023-07-13 05:37:13',
                'instansi' => 'PUSAT PENGEMBANGAN ASN',
                'jabatan' => 'PPNPN',
                'masa_kerja_tahun' => 0,
                'masa_kerja_bulan' => 4,
                'tgl_kerja' => '2019-08-01',
            ),
            21 => 
            array (
                'id' => 23,
                'employee_id' => 184,
                'simpeg_id' => '000000000729#1',
                'created_at' => '2023-07-13 05:37:13',
                'updated_at' => '2023-07-13 05:37:13',
                'instansi' => 'BADAN TENAGA NUKLIR NASIONAL',
                'jabatan' => 'TENAGA ADMINISTRASI NON PNS',
                'masa_kerja_tahun' => 4,
                'masa_kerja_bulan' => 10,
                'tgl_kerja' => '2018-03-01',
            ),
            22 => 
            array (
                'id' => 18,
                'employee_id' => 168,
                'simpeg_id' => '000000000713#1',
                'created_at' => '2023-07-13 05:37:13',
                'updated_at' => '2023-07-13 05:48:03',
                'instansi' => 'YAYASAN PRAYOGA PADANG',
                'jabatan' => 'TENAGA KEPENDIDIKAN',
                'masa_kerja_tahun' => 4,
                'masa_kerja_bulan' => 1,
                'tgl_kerja' => '2016-07-18',
            ),
        ));
        
        
    }
}