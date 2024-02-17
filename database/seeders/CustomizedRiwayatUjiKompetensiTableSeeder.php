<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomizedRiwayatUjiKompetensiTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('riwayat_uji_kompetensi')->delete();
        
        \DB::table('riwayat_uji_kompetensi')->insert(array (
            0 => 
            array (
                'id' => 1,
                'employee_id' => 160,
                'simpeg_id' => '000000000705#1',
                'created_at' => '2023-06-30 02:30:01',
                'updated_at' => '2023-06-30 02:30:18',
                'jabatan' => 'Arsiparis Pelaksana',
                'satker' => 'Direktorat Layanan dan Pemanfaatan ',
                'keterangan' => 'Lulus dengan predikat cukup',
                'tanggal' => '2022-07-14',
            ),
            1 => 
            array (
                'id' => 2,
                'employee_id' => 162,
                'simpeg_id' => '000000000707#1',
                'created_at' => '2023-06-30 02:30:01',
                'updated_at' => '2023-06-30 02:30:18',
                'jabatan' => 'Arsiparis Pertama',
                'satker' => 'Direktorat Akuisisi   ',
                'keterangan' => 'Lulus dengan predikat cukup',
                'tanggal' => '2022-07-14',
            ),
            2 => 
            array (
                'id' => 3,
                'employee_id' => 164,
                'simpeg_id' => '000000000709#1',
                'created_at' => '2023-06-30 02:30:01',
                'updated_at' => '2023-06-30 02:30:18',
                'jabatan' => 'Arsiparis Pertama',
                'satker' => 'Biro Umum ',
                'keterangan' => 'Lulus dengan predikat cukup',
                'tanggal' => '2022-08-14',
            ),
            3 => 
            array (
                'id' => 4,
                'employee_id' => 709,
                'simpeg_id' => '000000502#1',
                'created_at' => '2023-06-30 02:30:01',
                'updated_at' => '2023-06-30 02:30:18',
                'jabatan' => 'Arsiparis Mahir',
                'satker' => 'Biro Umum ',
                'keterangan' => 'Lulus dengan predikat cukup',
                'tanggal' => '2022-07-14',
            ),
            4 => 
            array (
                'id' => 6,
                'employee_id' => 625,
                'simpeg_id' => NULL,
                'created_at' => '2023-11-15 06:41:09',
                'updated_at' => '2023-11-15 06:41:09',
                'jabatan' => 'Arsiparis Mahir/ Pelaksana Lanjutan',
                'satker' => NULL,
                'keterangan' => 'Uji Kopetensi jenjang jabatan Arsiparis Ahli Penyelia/Penyelia',
                'tanggal' => '2023-05-15',
            ),
            5 => 
            array (
                'id' => 7,
                'employee_id' => 366,
                'simpeg_id' => NULL,
                'created_at' => '2023-11-15 06:57:30',
                'updated_at' => '2023-11-15 06:57:30',
                'jabatan' => 'Arsiparis Ahli Muda',
                'satker' => 'ANRI',
                'keterangan' => 'Uji Kopetensi jenjang jabatan Arsiparis Ahli  Madya',
                'tanggal' => '2023-05-15',
            ),
            6 => 
            array (
                'id' => 8,
                'employee_id' => 640,
                'simpeg_id' => NULL,
                'created_at' => '2023-11-15 07:39:20',
                'updated_at' => '2023-11-15 07:39:20',
                'jabatan' => 'Arsiparis Penyelia',
                'satker' => 'ANRI',
                'keterangan' => 'Uji Kopetensi jenjang jabatan Arsiparis Ahli Muda',
                'tanggal' => '2023-05-15',
            ),
            7 => 
            array (
                'id' => 9,
                'employee_id' => 742,
                'simpeg_id' => NULL,
                'created_at' => '2023-11-15 07:57:48',
                'updated_at' => '2023-11-15 07:57:48',
                'jabatan' => 'Arsiparis Mahir / Pelaksana Lanjutan',
                'satker' => 'ANRI',
                'keterangan' => 'Uji Kopetensi jenjang jabatan Arsiparis Ahli Pertama',
                'tanggal' => '2023-05-15',
            ),
            8 => 
            array (
                'id' => 10,
                'employee_id' => 563,
                'simpeg_id' => NULL,
                'created_at' => '2023-11-15 08:35:02',
                'updated_at' => '2023-11-15 08:35:02',
                'jabatan' => 'Arsiparis Muda',
                'satker' => 'ANRI',
                'keterangan' => 'Uji Kopetensi jenjang jabatan Arsiparis Ahli Madya',
                'tanggal' => '2023-05-15',
            ),
            9 => 
            array (
                'id' => 11,
                'employee_id' => 434,
                'simpeg_id' => NULL,
                'created_at' => '2023-11-16 01:33:33',
                'updated_at' => '2023-11-16 01:33:33',
                'jabatan' => 'Arsiparis Ahli Muda',
                'satker' => 'ANRI',
                'keterangan' => 'Uji Kompetensi dalam jenjang jabatan Arsiparis Ahli Madya/Madya',
                'tanggal' => '2023-05-15',
            ),
            10 => 
            array (
                'id' => 12,
                'employee_id' => 409,
                'simpeg_id' => NULL,
                'created_at' => '2023-11-16 06:29:30',
                'updated_at' => '2023-11-16 06:29:30',
                'jabatan' => 'Arsiparis Ahli Muda',
                'satker' => 'ANRI',
                'keterangan' => 'Uji Kompetensi dalam jenjang jabatan Arsiparis Ahli Madya/Madya',
                'tanggal' => '2023-05-15',
            ),
            11 => 
            array (
                'id' => 13,
                'employee_id' => 407,
                'simpeg_id' => NULL,
                'created_at' => '2023-11-16 06:41:47',
                'updated_at' => '2023-11-16 06:41:47',
                'jabatan' => 'Arsiparis Ahli Muda',
                'satker' => 'ANRI',
                'keterangan' => 'Uji Kompetensi dalam jenjang jabatan Arsiparis Ahli Madya/Madya',
                'tanggal' => '2023-05-15',
            ),
            12 => 
            array (
                'id' => 14,
                'employee_id' => 529,
                'simpeg_id' => NULL,
                'created_at' => '2023-11-16 07:06:23',
                'updated_at' => '2023-11-16 07:06:23',
                'jabatan' => 'Arsiparis Ahli Muda',
                'satker' => 'ANRI',
                'keterangan' => 'Uji Kompetensi dalam jenjang jabatan Arsiparis Ahli Madya/Madya',
                'tanggal' => '2023-05-15',
            ),
            13 => 
            array (
                'id' => 15,
                'employee_id' => 417,
                'simpeg_id' => NULL,
                'created_at' => '2023-11-16 07:10:28',
                'updated_at' => '2023-11-16 07:10:28',
                'jabatan' => 'Arsiparis Ahli Muda',
                'satker' => 'ANRI',
                'keterangan' => 'Uji Kompetensi dalam jenjang jabatan Arsiparis Ahli Madya/Madya',
                'tanggal' => '2023-05-15',
            ),
            14 => 
            array (
                'id' => 16,
                'employee_id' => 435,
                'simpeg_id' => NULL,
                'created_at' => '2023-11-16 07:16:47',
                'updated_at' => '2023-11-16 07:16:47',
                'jabatan' => 'Arsiparis Ahli Muda',
                'satker' => 'ANRI',
                'keterangan' => 'Uji Kompetensi dalam jenjang jabatan Arsiparis Ahli Madya/Madya',
                'tanggal' => '2023-05-15',
            ),
            15 => 
            array (
                'id' => 17,
                'employee_id' => 535,
                'simpeg_id' => NULL,
                'created_at' => '2023-11-16 07:20:48',
                'updated_at' => '2023-11-16 07:20:48',
                'jabatan' => 'Arsiparis Ahli Muda',
                'satker' => 'ANRI',
                'keterangan' => 'Uji Kompetensi dalam jenjang jabatan Arsiparis Ahli Madya/Madya',
                'tanggal' => '2023-05-15',
            ),
            16 => 
            array (
                'id' => 18,
                'employee_id' => 447,
                'simpeg_id' => NULL,
                'created_at' => '2023-11-16 07:23:38',
                'updated_at' => '2023-11-16 07:23:38',
                'jabatan' => 'Arsiparis Ahli Muda',
                'satker' => 'ANRI',
                'keterangan' => 'Uji Kompetensi dalam jenjang jabatan Arsiparis Ahli Madya/Madya',
                'tanggal' => '2023-05-15',
            ),
            17 => 
            array (
                'id' => 19,
                'employee_id' => 349,
                'simpeg_id' => NULL,
                'created_at' => '2023-11-16 07:27:42',
                'updated_at' => '2023-11-16 07:27:42',
                'jabatan' => 'Arsiparis Ahli Muda',
                'satker' => 'ANRI',
                'keterangan' => 'Uji Kompetensi dalam jenjang jabatan Arsiparis Ahli Madya/Madya',
                'tanggal' => '2023-05-15',
            ),
            18 => 
            array (
                'id' => 20,
                'employee_id' => 454,
                'simpeg_id' => NULL,
                'created_at' => '2023-11-16 07:38:32',
                'updated_at' => '2023-11-16 07:38:32',
                'jabatan' => 'Arsiparis Ahli Muda',
                'satker' => 'ANRI',
                'keterangan' => 'Uji Kompetensi dalam jenjang jabatan Arsiparis Ahli Madya/Madya',
                'tanggal' => '2023-05-15',
            ),
            19 => 
            array (
                'id' => 21,
                'employee_id' => 396,
                'simpeg_id' => NULL,
                'created_at' => '2023-11-16 07:42:43',
                'updated_at' => '2023-11-16 07:42:43',
                'jabatan' => 'Arsiparis Ahli Muda',
                'satker' => 'ANRI',
                'keterangan' => 'Uji Kompetensi dalam jenjang jabatan Arsiparis Ahli Madya/Madya',
                'tanggal' => '2023-05-15',
            ),
            20 => 
            array (
                'id' => 22,
                'employee_id' => 448,
                'simpeg_id' => NULL,
                'created_at' => '2023-11-16 07:53:31',
                'updated_at' => '2023-11-16 07:53:31',
                'jabatan' => 'Arsiparis Ahli Muda',
                'satker' => 'ANRI',
                'keterangan' => 'Uji Kompetensi dalam jenjang jabatan Arsiparis Ahli Madya/Madya',
                'tanggal' => '2023-05-15',
            ),
            21 => 
            array (
                'id' => 23,
                'employee_id' => 340,
                'simpeg_id' => NULL,
                'created_at' => '2023-11-16 07:57:25',
                'updated_at' => '2023-11-16 07:57:25',
                'jabatan' => 'Arsiparis Ahli Muda',
                'satker' => 'ANRI',
                'keterangan' => 'Uji Kompetensi dalam jenjang jabatan Arsiparis Ahli Madya/Madya',
                'tanggal' => '2023-05-15',
            ),
            22 => 
            array (
                'id' => 24,
                'employee_id' => 548,
                'simpeg_id' => NULL,
                'created_at' => '2023-11-17 06:42:35',
                'updated_at' => '2023-11-17 06:42:35',
                'jabatan' => 'Arsiparis Ahli Muda',
                'satker' => 'ANRI',
                'keterangan' => 'Uji Kompetensi dalam jenjang jabatan Arsiparis Ahli Madya/Madya',
                'tanggal' => '2023-05-15',
            ),
            23 => 
            array (
                'id' => 25,
                'employee_id' => 586,
                'simpeg_id' => NULL,
                'created_at' => '2023-11-17 06:52:10',
                'updated_at' => '2023-11-17 06:52:10',
                'jabatan' => 'Arsiparis Ahli Muda',
                'satker' => 'ANRI',
                'keterangan' => 'Uji Kompetensi dalam jenjang jabatan Arsiparis Ahli Madya/Madya',
                'tanggal' => '2023-05-15',
            ),
            24 => 
            array (
                'id' => 26,
                'employee_id' => 451,
                'simpeg_id' => NULL,
                'created_at' => '2023-11-17 07:04:35',
                'updated_at' => '2023-11-17 07:04:35',
                'jabatan' => 'Arsiparis Ahli Muda',
                'satker' => 'ANRI',
                'keterangan' => 'Uji Kompetensi dalam jenjang jabatan Arsiparis Ahli Madya/Madya',
                'tanggal' => '2023-05-15',
            ),
            25 => 
            array (
                'id' => 27,
                'employee_id' => 429,
                'simpeg_id' => NULL,
                'created_at' => '2023-11-17 07:13:57',
                'updated_at' => '2023-11-17 07:13:57',
                'jabatan' => 'Arsiparis Ahli Muda',
                'satker' => 'ANRI',
                'keterangan' => 'Uji Kompetensi dalam jenjang jabatan Arsiparis Ahli Madya/Madya',
                'tanggal' => '2023-05-15',
            ),
            26 => 
            array (
                'id' => 28,
                'employee_id' => 401,
                'simpeg_id' => NULL,
                'created_at' => '2023-11-17 07:19:32',
                'updated_at' => '2023-11-17 07:19:32',
                'jabatan' => 'Arsiparis Ahli Muda',
                'satker' => 'ANRI',
                'keterangan' => 'Uji Kompetensi dalam jenjang jabatan Arsiparis Ahli Madya/Madya',
                'tanggal' => '2023-05-15',
            ),
            27 => 
            array (
                'id' => 29,
                'employee_id' => 660,
                'simpeg_id' => NULL,
                'created_at' => '2023-11-17 07:24:28',
                'updated_at' => '2023-11-17 07:24:28',
                'jabatan' => 'Arsiparis Ahli Pertama / Pertama',
                'satker' => 'ANRI',
                'keterangan' => 'Uji Kompetensi dalam jenjang jabatan Arsiparis Ahli  Muda',
                'tanggal' => '2023-05-15',
            ),
            28 => 
            array (
                'id' => 30,
                'employee_id' => 681,
                'simpeg_id' => NULL,
                'created_at' => '2023-11-17 07:30:15',
                'updated_at' => '2023-11-17 07:30:15',
                'jabatan' => 'Arsiparis Ahli Pertama / Pertama',
                'satker' => 'ANRI',
                'keterangan' => 'Uji Kompetensi dalam jenjang jabatan Arsiparis Ahli  Muda',
                'tanggal' => '2023-05-15',
            ),
            29 => 
            array (
                'id' => 31,
                'employee_id' => 518,
                'simpeg_id' => NULL,
                'created_at' => '2023-11-17 07:36:22',
                'updated_at' => '2023-11-17 07:36:22',
                'jabatan' => 'Arsiparis Penyelia',
                'satker' => 'ANRI',
                'keterangan' => 'Uji Kompetensi dalam jenjang jabatan Arsiparis Ahli  Muda',
                'tanggal' => '2023-05-15',
            ),
            30 => 
            array (
                'id' => 32,
                'employee_id' => 688,
                'simpeg_id' => NULL,
                'created_at' => '2023-11-17 07:45:16',
                'updated_at' => '2023-11-17 07:45:16',
                'jabatan' => 'Arsiparis Ahli Pertama',
                'satker' => 'ANRI',
                'keterangan' => 'Uji Kompetensi dalam jenjang jabatan Arsiparis Ahli  Muda',
                'tanggal' => '2023-05-15',
            ),
            31 => 
            array (
                'id' => 33,
                'employee_id' => 690,
                'simpeg_id' => NULL,
                'created_at' => '2023-11-17 07:55:59',
                'updated_at' => '2023-11-17 07:55:59',
                'jabatan' => 'Arsiparis Ahli Pertama',
                'satker' => 'ANRI',
                'keterangan' => 'Uji Kompetensi dalam jenjang jabatan Arsiparis Ahli  Muda',
                'tanggal' => '2023-05-15',
            ),
            32 => 
            array (
                'id' => 34,
                'employee_id' => 694,
                'simpeg_id' => NULL,
                'created_at' => '2023-11-17 07:59:57',
                'updated_at' => '2023-11-17 07:59:57',
                'jabatan' => 'Arsiparis Ahli Pertama',
                'satker' => 'ANRI',
                'keterangan' => 'Uji Kompetensi dalam jenjang jabatan Arsiparis Ahli  Muda',
                'tanggal' => '2023-05-15',
            ),
            33 => 
            array (
                'id' => 35,
                'employee_id' => 673,
                'simpeg_id' => NULL,
                'created_at' => '2023-11-17 08:04:24',
                'updated_at' => '2023-11-17 08:04:24',
                'jabatan' => 'Arsiparis Ahli Pertama',
                'satker' => 'ANRI',
                'keterangan' => 'Uji Kompetensi dalam jenjang jabatan Arsiparis Ahli  Muda',
                'tanggal' => '2023-05-15',
            ),
            34 => 
            array (
                'id' => 36,
                'employee_id' => 698,
                'simpeg_id' => NULL,
                'created_at' => '2023-11-20 07:08:35',
                'updated_at' => '2023-11-20 07:08:35',
                'jabatan' => 'Arsiparis Ahli Pertama / Pertama',
                'satker' => 'ANRI',
                'keterangan' => 'dinaikkan dalam jenjang jabatan Arsiparis Ahli Muda/Muda',
                'tanggal' => '2023-05-15',
            ),
            35 => 
            array (
                'id' => 37,
                'employee_id' => 676,
                'simpeg_id' => NULL,
                'created_at' => '2023-11-20 07:16:49',
                'updated_at' => '2023-11-20 07:16:49',
                'jabatan' => 'Arsiparis Ahli Pertama / Pertama',
                'satker' => 'ANRI',
                'keterangan' => 'dinaikkan dalam jenjang jabatan Arsiparis Ahli Muda/Muda',
                'tanggal' => '2023-05-15',
            ),
            36 => 
            array (
                'id' => 38,
                'employee_id' => 699,
                'simpeg_id' => NULL,
                'created_at' => '2023-11-20 07:19:12',
                'updated_at' => '2023-11-20 07:19:12',
                'jabatan' => 'Arsiparis Ahli Pertama',
                'satker' => 'ANRI',
                'keterangan' => 'dinaikkan dalam jenjang jabatan Arsiparis Ahli Muda/Muda',
                'tanggal' => '2023-05-15',
            ),
            37 => 
            array (
                'id' => 39,
                'employee_id' => 511,
                'simpeg_id' => NULL,
                'created_at' => '2023-11-20 07:21:58',
                'updated_at' => '2023-11-20 07:21:58',
                'jabatan' => 'Arsiparis Penyelia',
                'satker' => 'ANRI',
                'keterangan' => 'dinaikkan dalam jenjang jabatan Arsiparis Ahli Muda/Muda',
                'tanggal' => '2023-11-20',
            ),
            38 => 
            array (
                'id' => 40,
                'employee_id' => 659,
                'simpeg_id' => NULL,
                'created_at' => '2023-11-20 07:31:03',
                'updated_at' => '2023-11-20 07:31:03',
                'jabatan' => 'Arsiparis Penyelia',
                'satker' => 'ANRI',
                'keterangan' => 'dinaikkan dalam jenjang jabatan Arsiparis Ahli Muda/Muda',
                'tanggal' => '2023-05-15',
            ),
            39 => 
            array (
                'id' => 41,
                'employee_id' => 649,
                'simpeg_id' => NULL,
                'created_at' => '2023-11-20 07:35:39',
                'updated_at' => '2023-11-20 07:35:39',
                'jabatan' => 'Arsiparis Mahir/Palaksana Lanjutan',
                'satker' => 'ANRI',
                'keterangan' => 'Uji Kompetensi  untuk dinaikkan dalam jenjang jabatan Arsiparis Ahli Penyelia/Penyelia',
                'tanggal' => '2023-05-15',
            ),
            40 => 
            array (
                'id' => 42,
                'employee_id' => 641,
                'simpeg_id' => NULL,
                'created_at' => '2023-11-20 07:37:28',
                'updated_at' => '2023-11-20 07:37:28',
                'jabatan' => 'Arsiparis Mahir/Palaksana Lanjutan',
                'satker' => 'ANRI',
                'keterangan' => 'Uji Kompetensi  untuk dinaikkan dalam jenjang jabatan Arsiparis Ahli Penyelia/Penyelia',
                'tanggal' => '2023-05-15',
            ),
            41 => 
            array (
                'id' => 43,
                'employee_id' => 744,
                'simpeg_id' => NULL,
                'created_at' => '2023-11-20 07:39:34',
                'updated_at' => '2023-11-20 07:39:34',
                'jabatan' => 'Arsiparis Mahir/Palaksana Lanjutan',
                'satker' => 'ANRI',
                'keterangan' => 'Uji Kompetensi  untuk dapat dialihkan dalam jenjang jabatan Arsiparis Pertama / Pertama.',
                'tanggal' => '2023-05-15',
            ),
            42 => 
            array (
                'id' => 44,
                'employee_id' => 644,
                'simpeg_id' => NULL,
                'created_at' => '2023-11-20 07:41:51',
                'updated_at' => '2023-11-20 07:41:51',
                'jabatan' => 'Arsiparis Mahir/Palaksana Lanjutan',
                'satker' => 'ANRI',
                'keterangan' => 'Uji Kompetensi  untuk dapat dialihkan dalam jenjang jabatan Arsiparis Pertama / Pertama.',
                'tanggal' => '2023-05-15',
            ),
            43 => 
            array (
                'id' => 45,
                'employee_id' => 380,
                'simpeg_id' => NULL,
                'created_at' => '2023-11-27 06:24:10',
                'updated_at' => '2023-11-27 06:24:10',
                'jabatan' => 'Arsiparis Ahli Pertama',
                'satker' => 'ANRI',
                'keterangan' => 'Uji Kompetensi dalam jenjang jabatan Arsiparis Ahli  Muda',
                'tanggal' => '2016-08-29',
            ),
            44 => 
            array (
                'id' => 46,
                'employee_id' => 587,
                'simpeg_id' => NULL,
                'created_at' => '2023-12-01 09:11:45',
                'updated_at' => '2023-12-01 09:11:45',
                'jabatan' => 'Widyaiswara  Ahli Muda',
                'satker' => 'LAN RI',
                'keterangan' => 'Uji Kompetensi dalam jenjang  jabatan  Widyaiswara  Ahli  Madya',
                'tanggal' => '2016-10-27',
            ),
            45 => 
            array (
                'id' => 47,
                'employee_id' => 700,
                'simpeg_id' => NULL,
                'created_at' => '2023-12-01 09:22:02',
                'updated_at' => '2023-12-01 09:22:02',
                'jabatan' => 'Widyaiswara  Ahli  Pertama',
                'satker' => 'LAN RI',
                'keterangan' => 'Uji Kompetensi dalam jenjang  jabatan  Widyaiswara  Ahli  Muda',
                'tanggal' => '2016-10-27',
            ),
            46 => 
            array (
                'id' => 48,
                'employee_id' => 58,
                'simpeg_id' => NULL,
                'created_at' => '2023-12-01 09:23:31',
                'updated_at' => '2023-12-01 09:23:31',
                'jabatan' => 'Widyaiswara  Ahli  Pertama',
                'satker' => 'LAN RI',
                'keterangan' => 'Uji Kompetensi dalam jenjang  jabatan  Widyaiswara  Ahli  Muda',
                'tanggal' => '2016-10-27',
            ),
            47 => 
            array (
                'id' => 49,
                'employee_id' => 641,
                'simpeg_id' => NULL,
                'created_at' => '2023-12-06 03:21:52',
                'updated_at' => '2023-12-06 03:21:52',
                'jabatan' => 'Arsiparis Mahir/Pelaksana Lanjutan',
                'satker' => 'Pusdiklat',
                'keterangan' => 'Uji Kompetensi dalam Kenaikan Jenjang Jabatan Fungsional Arsiparis Ahli Pertama',
                'tanggal' => '2021-08-23',
            ),
        ));
        
        
    }
}