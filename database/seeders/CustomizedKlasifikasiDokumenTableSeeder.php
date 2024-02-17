<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomizedKlasifikasiDokumenTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('klasifikasi_dokumen')->delete();
        
        \DB::table('klasifikasi_dokumen')->insert(array (
            0 => 
            array (
                'id' => 3,
                'parent_id' => 1,
                'name' => 'KTP',
                'order' => 2,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            1 => 
            array (
                'id' => 4,
                'parent_id' => 0,
                'name' => 'SK CPNS',
                'order' => 4,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            2 => 
            array (
                'id' => 5,
                'parent_id' => 0,
                'name' => 'SK PNS',
                'order' => 5,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            3 => 
            array (
                'id' => 7,
                'parent_id' => 6,
                'name' => 'SPMJ',
                'order' => 1,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            4 => 
            array (
                'id' => 8,
                'parent_id' => 6,
                'name' => 'SPMT',
                'order' => 2,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            5 => 
            array (
                'id' => 9,
                'parent_id' => 6,
                'name' => 'SK Jabatan',
                'order' => 3,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            6 => 
            array (
                'id' => 10,
                'parent_id' => 6,
                'name' => 'SK Pelantikan',
                'order' => 4,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            7 => 
            array (
                'id' => 12,
                'parent_id' => 11,
                'name' => 'SK KP',
                'order' => 1,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            8 => 
            array (
                'id' => 13,
                'parent_id' => 0,
                'name' => 'Riwayat Gaji',
                'order' => 8,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            9 => 
            array (
                'id' => 14,
                'parent_id' => 0,
                'name' => 'Pendidikan Umum',
                'order' => 9,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            10 => 
            array (
                'id' => 15,
                'parent_id' => 0,
                'name' => 'Diklat Struktural',
                'order' => 10,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            11 => 
            array (
                'id' => 16,
                'parent_id' => 0,
                'name' => 'Pengalaman Kerja',
                'order' => 3,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            12 => 
            array (
                'id' => 18,
                'parent_id' => 0,
                'name' => 'Penghargaan',
                'order' => 14,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            13 => 
            array (
                'id' => 19,
                'parent_id' => 0,
                'name' => 'Prestasi Kerja',
                'order' => 17,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            14 => 
            array (
                'id' => 20,
                'parent_id' => 0,
                'name' => 'Kursus',
                'order' => 11,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            15 => 
            array (
                'id' => 22,
                'parent_id' => 15,
                'name' => 'Surat Penugasan Diklat',
                'order' => 1,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            16 => 
            array (
                'id' => 23,
                'parent_id' => 15,
                'name' => 'Sertifikat',
                'order' => 2,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            17 => 
            array (
                'id' => 24,
                'parent_id' => 15,
                'name' => 'STTPL',
                'order' => 3,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            18 => 
            array (
                'id' => 27,
                'parent_id' => 25,
                'name' => 'Anak',
                'order' => 2,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            19 => 
            array (
                'id' => 30,
                'parent_id' => 27,
                'name' => 'Foto',
                'order' => 1,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            20 => 
            array (
                'id' => 31,
                'parent_id' => 27,
                'name' => 'KTP',
                'order' => 2,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            21 => 
            array (
                'id' => 34,
                'parent_id' => 20,
                'name' => 'Kursus',
                'order' => 1,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            22 => 
            array (
                'id' => 35,
                'parent_id' => 0,
                'name' => 'SK Pensiun',
                'order' => 25,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            23 => 
            array (
                'id' => 36,
                'parent_id' => 0,
                'name' => 'Riwayat Mutasi',
                'order' => 17,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            24 => 
            array (
                'id' => 39,
                'parent_id' => 1,
                'name' => 'SIM',
                'order' => 3,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            25 => 
            array (
                'id' => 40,
                'parent_id' => 25,
                'name' => 'Orang Tua',
                'order' => 3,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            26 => 
            array (
                'id' => 41,
                'parent_id' => 25,
                'name' => 'Saudara',
                'order' => 3,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            27 => 
            array (
                'id' => 42,
                'parent_id' => 25,
                'name' => 'Mertua',
                'order' => 3,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            28 => 
            array (
                'id' => 43,
                'parent_id' => 0,
                'name' => 'Organisasi',
                'order' => 13,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            29 => 
            array (
                'id' => 44,
                'parent_id' => 0,
                'name' => 'Nilai DP3',
                'order' => 15,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            30 => 
            array (
                'id' => 47,
                'parent_id' => 0,
                'name' => 'Cuti',
                'order' => 19,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            31 => 
            array (
                'id' => 48,
                'parent_id' => 0,
                'name' => 'Penguasaan Bahasa',
                'order' => 21,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            32 => 
            array (
                'id' => 49,
                'parent_id' => 0,
                'name' => 'Riwayat Sumpah',
                'order' => 24,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            33 => 
            array (
                'id' => 50,
                'parent_id' => 0,
                'name' => 'Riwayat Nikah',
                'order' => 22,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            34 => 
            array (
                'id' => 51,
                'parent_id' => 204,
                'name' => 'Foto',
                'order' => 1,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            35 => 
            array (
                'id' => 52,
                'parent_id' => 204,
                'name' => 'KTP',
                'order' => 2,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            36 => 
            array (
                'id' => 54,
                'parent_id' => 206,
                'name' => 'KTP',
                'order' => 1,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            37 => 
            array (
                'id' => 55,
                'parent_id' => 0,
                'name' => 'Lokasi Kerja',
                'order' => 1,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            38 => 
            array (
                'id' => 63,
                'parent_id' => 0,
                'name' => 'Nilai SKP',
                'order' => 17,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            39 => 
            array (
                'id' => 64,
                'parent_id' => 15,
                'name' => 'Laporan',
                'order' => 4,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            40 => 
            array (
                'id' => 57,
                'parent_id' => 4,
                'name' => 'SK CPNS',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:37',
            ),
            41 => 
            array (
                'id' => 58,
                'parent_id' => 5,
                'name' => 'SK PNS',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:37',
            ),
            42 => 
            array (
                'id' => 60,
                'parent_id' => 14,
                'name' => 'Ijazah',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:37',
            ),
            43 => 
            array (
                'id' => 61,
                'parent_id' => 16,
                'name' => 'Surat Keterangan Kerja',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:37',
            ),
            44 => 
            array (
                'id' => 62,
                'parent_id' => 21,
                'name' => 'SK Hukuman',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:37',
            ),
            45 => 
            array (
                'id' => 128,
                'parent_id' => 0,
                'name' => 'Riwayat Sertifikat',
                'order' => 67,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            46 => 
            array (
                'id' => 131,
                'parent_id' => 1,
                'name' => 'CV',
                'order' => 4,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            47 => 
            array (
                'id' => 132,
                'parent_id' => 1,
                'name' => 'Kartu Pegawai',
                'order' => 5,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            48 => 
            array (
                'id' => 133,
                'parent_id' => 1,
                'name' => 'Askes',
                'order' => 6,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            49 => 
            array (
                'id' => 135,
                'parent_id' => 1,
                'name' => 'Bapertarum',
                'order' => 8,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            50 => 
            array (
                'id' => 139,
                'parent_id' => 11,
                'name' => 'STLUD',
                'order' => 2,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            51 => 
            array (
                'id' => 144,
                'parent_id' => 0,
                'name' => 'Diklat Fungsional',
                'order' => 68,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            52 => 
            array (
                'id' => 149,
                'parent_id' => 0,
                'name' => 'Diklat Teknis',
                'order' => 69,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            53 => 
            array (
                'id' => 136,
                'parent_id' => 4,
                'name' => 'Nota Persetujuan',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:37',
            ),
            54 => 
            array (
                'id' => 137,
                'parent_id' => 5,
                'name' => 'Hasil Uji Kesehatan',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:37',
            ),
            55 => 
            array (
                'id' => 138,
                'parent_id' => 5,
                'name' => 'Nota Persetujuan',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:37',
            ),
            56 => 
            array (
                'id' => 154,
                'parent_id' => 0,
                'name' => 'Seminar',
                'order' => 70,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            57 => 
            array (
                'id' => 141,
                'parent_id' => 36,
                'name' => 'SK Mutasi',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:37',
            ),
            58 => 
            array (
                'id' => 142,
                'parent_id' => 36,
                'name' => 'Petikan SK',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:37',
            ),
            59 => 
            array (
                'id' => 143,
                'parent_id' => 49,
                'name' => 'Sumpah',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:37',
            ),
            60 => 
            array (
                'id' => 163,
                'parent_id' => 27,
                'name' => 'Akte Kelahiran',
                'order' => 3,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            61 => 
            array (
                'id' => 145,
                'parent_id' => 144,
                'name' => 'Surat Penugasan Diklat',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:37',
            ),
            62 => 
            array (
                'id' => 147,
                'parent_id' => 144,
                'name' => 'STTPL',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            63 => 
            array (
                'id' => 148,
                'parent_id' => 144,
                'name' => 'Laporan',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            64 => 
            array (
                'id' => 164,
                'parent_id' => 27,
                'name' => 'Surat Adopsi',
                'order' => 4,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            65 => 
            array (
                'id' => 150,
                'parent_id' => 149,
                'name' => 'Surat Penugasan Diklat',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            66 => 
            array (
                'id' => 151,
                'parent_id' => 149,
                'name' => 'Sertifikat',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            67 => 
            array (
                'id' => 152,
                'parent_id' => 149,
                'name' => 'STTPL',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            68 => 
            array (
                'id' => 155,
                'parent_id' => 154,
                'name' => 'Seminar',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            69 => 
            array (
                'id' => 156,
                'parent_id' => 44,
                'name' => 'DP3',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            70 => 
            array (
                'id' => 157,
                'parent_id' => 63,
                'name' => 'SKP',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            71 => 
            array (
                'id' => 159,
                'parent_id' => 45,
                'name' => 'Potensi Diri',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            72 => 
            array (
                'id' => 160,
                'parent_id' => 19,
                'name' => 'Prestasi Kerja',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            73 => 
            array (
                'id' => 161,
                'parent_id' => 21,
                'name' => 'SK Pencabutan',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            74 => 
            array (
                'id' => 162,
                'parent_id' => 21,
                'name' => 'SK Pemberhentian',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            75 => 
            array (
                'id' => 166,
                'parent_id' => 41,
                'name' => 'KTP',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            76 => 
            array (
                'id' => 167,
                'parent_id' => 193,
                'name' => 'Foto',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            77 => 
            array (
                'id' => 168,
                'parent_id' => 193,
                'name' => 'KTP',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            78 => 
            array (
                'id' => 169,
                'parent_id' => 193,
                'name' => 'Surat Nikah',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            79 => 
            array (
                'id' => 171,
                'parent_id' => 193,
                'name' => 'Karis',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            80 => 
            array (
                'id' => 173,
                'parent_id' => 35,
                'name' => 'SK Pensiun',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            81 => 
            array (
                'id' => 174,
                'parent_id' => 35,
                'name' => 'Surat Keterangan Meninggal',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            82 => 
            array (
                'id' => 175,
                'parent_id' => 47,
                'name' => 'Surat Cuti',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            83 => 
            array (
                'id' => 176,
                'parent_id' => 47,
                'name' => 'Nota Persetujuan',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            84 => 
            array (
                'id' => 177,
                'parent_id' => 200,
                'name' => 'SPT',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            85 => 
            array (
                'id' => 178,
                'parent_id' => 200,
                'name' => 'Laporan',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            86 => 
            array (
                'id' => 180,
                'parent_id' => 201,
                'name' => 'Surat Perjanjian',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            87 => 
            array (
                'id' => 181,
                'parent_id' => 201,
                'name' => 'Surat Perpanjangan',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            88 => 
            array (
                'id' => 182,
                'parent_id' => 201,
                'name' => 'Laporan Perkembangan',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            89 => 
            array (
                'id' => 183,
                'parent_id' => 201,
                'name' => 'Laporan Akhir',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            90 => 
            array (
                'id' => 184,
                'parent_id' => 202,
                'name' => 'SK Dipekerjakan',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            91 => 
            array (
                'id' => 186,
                'parent_id' => 48,
                'name' => 'Penguasaan Bahasa',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            92 => 
            array (
                'id' => 187,
                'parent_id' => 48,
                'name' => 'Sertifikat',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            93 => 
            array (
                'id' => 188,
                'parent_id' => 43,
                'name' => 'Organisasi',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            94 => 
            array (
                'id' => 189,
                'parent_id' => 127,
                'name' => 'SPMK',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            95 => 
            array (
                'id' => 190,
                'parent_id' => 127,
                'name' => 'SK PAK',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            96 => 
            array (
                'id' => 191,
                'parent_id' => 127,
                'name' => 'Nota Peringatan',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            97 => 
            array (
                'id' => 193,
                'parent_id' => 50,
                'name' => 'Laki-Laki',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            98 => 
            array (
                'id' => 194,
                'parent_id' => 50,
                'name' => 'Perempuan',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            99 => 
            array (
                'id' => 2,
                'parent_id' => 1,
                'name' => 'Foto',
                'order' => 1,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            100 => 
            array (
                'id' => 59,
                'parent_id' => 13,
                'name' => 'SK KGB',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:37',
            ),
            101 => 
            array (
                'id' => 90,
                'parent_id' => 55,
                'name' => 'Lokasi Kerja',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:37',
            ),
            102 => 
            array (
                'id' => 146,
                'parent_id' => 144,
                'name' => 'Sertifikat',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:37',
            ),
            103 => 
            array (
                'id' => 153,
                'parent_id' => 149,
                'name' => 'Laporan',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            104 => 
            array (
                'id' => 158,
                'parent_id' => 18,
                'name' => 'Penghargaan',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            105 => 
            array (
                'id' => 165,
                'parent_id' => 41,
                'name' => 'Foto',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            106 => 
            array (
                'id' => 170,
                'parent_id' => 193,
                'name' => 'Surat Perceraian',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            107 => 
            array (
                'id' => 179,
                'parent_id' => 201,
                'name' => 'Surat Tugas Belajar',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            108 => 
            array (
                'id' => 185,
                'parent_id' => 203,
                'name' => 'SK Diperbantukan',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            109 => 
            array (
                'id' => 192,
                'parent_id' => 128,
                'name' => 'Sertifikat',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            110 => 
            array (
                'id' => 195,
                'parent_id' => 194,
                'name' => 'Foto',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            111 => 
            array (
                'id' => 196,
                'parent_id' => 194,
                'name' => 'KTP',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            112 => 
            array (
                'id' => 197,
                'parent_id' => 194,
                'name' => 'Surat Nikah',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            113 => 
            array (
                'id' => 198,
                'parent_id' => 194,
                'name' => 'Surat Perceraian',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            114 => 
            array (
                'id' => 199,
                'parent_id' => 194,
                'name' => 'Karsu',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            115 => 
            array (
                'id' => 200,
                'parent_id' => 17,
                'name' => 'Dinas',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            116 => 
            array (
                'id' => 201,
                'parent_id' => 17,
                'name' => 'Tugas Belajar',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            117 => 
            array (
                'id' => 202,
                'parent_id' => 17,
                'name' => 'Dipekerjakan',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            118 => 
            array (
                'id' => 203,
                'parent_id' => 17,
                'name' => 'Diperbantukan',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            119 => 
            array (
                'id' => 208,
                'parent_id' => 205,
                'name' => 'Foto',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            120 => 
            array (
                'id' => 209,
                'parent_id' => 205,
                'name' => 'KTP',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            121 => 
            array (
                'id' => 210,
                'parent_id' => 207,
                'name' => 'Foto',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            122 => 
            array (
                'id' => 211,
                'parent_id' => 207,
                'name' => 'KTP',
                'order' => NULL,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:26:38',
            ),
            123 => 
            array (
                'id' => 1,
                'parent_id' => 0,
                'name' => 'Identitas',
                'order' => 2,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            124 => 
            array (
                'id' => 6,
                'parent_id' => 0,
                'name' => 'Riwayat Jabatan',
                'order' => 7,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            125 => 
            array (
                'id' => 11,
                'parent_id' => 0,
                'name' => 'Riwayat Pangkat',
                'order' => 6,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            126 => 
            array (
                'id' => 17,
                'parent_id' => 0,
                'name' => 'Riwayat Penugasan',
                'order' => 20,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            127 => 
            array (
                'id' => 21,
                'parent_id' => 0,
                'name' => 'Hukuman',
                'order' => 18,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            128 => 
            array (
                'id' => 25,
                'parent_id' => 0,
                'name' => 'Riwayat Keluarga',
                'order' => 12,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            129 => 
            array (
                'id' => 37,
                'parent_id' => 0,
                'name' => 'Tambahan Masa Kerja',
                'order' => 23,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            130 => 
            array (
                'id' => 45,
                'parent_id' => 0,
                'name' => 'Potensi Diri',
                'order' => 16,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            131 => 
            array (
                'id' => 53,
                'parent_id' => 206,
                'name' => 'Foto',
                'order' => 1,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            132 => 
            array (
                'id' => 127,
                'parent_id' => 0,
                'name' => 'Riwayat Angka Kredit',
                'order' => 66,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            133 => 
            array (
                'id' => 134,
                'parent_id' => 1,
                'name' => 'Taspen',
                'order' => 7,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            134 => 
            array (
                'id' => 140,
                'parent_id' => 11,
                'name' => 'Nota Persetujuan',
                'order' => 3,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            135 => 
            array (
                'id' => 204,
                'parent_id' => 40,
                'name' => 'Ayah',
                'order' => 3,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            136 => 
            array (
                'id' => 205,
                'parent_id' => 40,
                'name' => 'Ibu',
                'order' => 4,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            137 => 
            array (
                'id' => 206,
                'parent_id' => 42,
                'name' => 'Ayah Mertua',
                'order' => 2,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            138 => 
            array (
                'id' => 207,
                'parent_id' => 42,
                'name' => 'Ibu Mertua',
                'order' => 3,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
            139 => 
            array (
                'id' => 212,
                'parent_id' => 1,
                'name' => 'SK Gelar',
                'order' => 9,
                'created_at' => '2023-07-09 01:25:53',
                'updated_at' => '2023-07-09 01:27:11',
            ),
        ));
        
        
    }
}