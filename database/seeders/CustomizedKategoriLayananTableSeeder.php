<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomizedKategoriLayananTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('kategori_layanan')->delete();
        
        \DB::table('kategori_layanan')->insert(array (
            0 => 
            array (
                'id' => 4,
                'parent_id' => 1,
                'name' => 'Riwayat Pendidikan',
                'created_at' => '2023-07-28 06:58:46',
                'updated_at' => '2023-07-28 06:58:46',
                'order' => 1,
                'form_request_class' => 'App\\Admin\\Forms\\Requests\\FormRiwayatPendidikan',
                'enabled' => 1,
                'form_request_model' => 'App\\Models\\RiwayatPendidikan',
            ),
            1 => 
            array (
                'id' => 25,
                'parent_id' => 1,
                'name' => 'Riwayat Pengalaman Kerja',
                'created_at' => NULL,
                'updated_at' => NULL,
                'order' => 1,
                'form_request_class' => 'App\\Admin\\Forms\\Requests\\FormRiwayatPengalamanKerja',
                'enabled' => 1,
                'form_request_model' => 'App\\Models\\RiwayatPengalamanKerja',
            ),
            2 => 
            array (
                'id' => 2,
                'parent_id' => 1,
                'name' => 'Foto Pegawai',
                'created_at' => '2023-07-28 06:57:01',
                'updated_at' => '2023-07-28 06:57:01',
                'order' => 1,
                'form_request_class' => 'App\\Admin\\Forms\\Requests\\FormFoto',
                'enabled' => 1,
                'form_request_model' => 'App\\Models\\Employee',
            ),
            3 => 
            array (
                'id' => 3,
                'parent_id' => 1,
                'name' => 'Identitas Pegawai',
                'created_at' => '2023-07-28 06:58:15',
                'updated_at' => '2023-07-28 06:58:15',
                'order' => 1,
                'form_request_class' => NULL,
                'enabled' => 0,
                'form_request_model' => 'App\\Models\\Employee',
            ),
            4 => 
            array (
                'id' => 1,
                'parent_id' => NULL,
                'name' => 'Profile Pegawai',
                'created_at' => NULL,
                'updated_at' => '2023-07-28 06:56:14',
                'order' => 1,
                'form_request_class' => NULL,
                'enabled' => 0,
                'form_request_model' => 'App\\Models\\',
            ),
            5 => 
            array (
                'id' => 31,
                'parent_id' => 1,
                'name' => 'Riwayat Anak',
                'created_at' => NULL,
                'updated_at' => NULL,
                'order' => 1,
                'form_request_class' => 'App\\Admin\\Forms\\Requests\\FormRiwayatAnak',
                'enabled' => 1,
                'form_request_model' => 'App\\Models\\RiwayatAnak',
            ),
            6 => 
            array (
                'id' => 6,
                'parent_id' => 1,
                'name' => 'Riwayat Angka Kredit',
                'created_at' => NULL,
                'updated_at' => NULL,
                'order' => 1,
                'form_request_class' => 'App\\Admin\\Forms\\Requests\\FormRiwayatAngkaKredit',
                'enabled' => 1,
                'form_request_model' => 'App\\Models\\RiwayatAngkaKredit',
            ),
            7 => 
            array (
                'id' => 16,
                'parent_id' => 1,
                'name' => 'Riwayat Diklat Fungsional',
                'created_at' => NULL,
                'updated_at' => NULL,
                'order' => 1,
                'form_request_class' => 'App\\Admin\\Forms\\Requests\\FormRiwayatDiklatFungsional',
                'enabled' => 1,
                'form_request_model' => 'App\\Models\\RiwayatDiklatFungsional',
            ),
            8 => 
            array (
                'id' => 18,
                'parent_id' => 1,
                'name' => 'Riwayat Diklat Kursus',
                'created_at' => NULL,
                'updated_at' => NULL,
                'order' => 1,
                'form_request_class' => 'App\\Admin\\Forms\\Requests\\FormRiwayatKursus',
                'enabled' => 1,
                'form_request_model' => 'App\\Models\\RiwayatKursus',
            ),
            9 => 
            array (
                'id' => 19,
                'parent_id' => 1,
                'name' => 'Riwayat Diklat Seminar',
                'created_at' => NULL,
                'updated_at' => NULL,
                'order' => 1,
                'form_request_class' => 'App\\Admin\\Forms\\Requests\\FormRiwayatSeminar',
                'enabled' => 1,
                'form_request_model' => 'App\\Models\\RiwayatSeminar',
            ),
            10 => 
            array (
                'id' => 15,
                'parent_id' => 1,
                'name' => 'Riwayat Diklat Struktural',
                'created_at' => NULL,
                'updated_at' => NULL,
                'order' => 1,
                'form_request_class' => 'App\\Admin\\Forms\\Requests\\FormRiwayatDiklatStruktural',
                'enabled' => 1,
                'form_request_model' => 'App\\Models\\RiwayatDiklatStruktural',
            ),
            11 => 
            array (
                'id' => 17,
                'parent_id' => 1,
                'name' => 'Riwayat Diklat Teknis',
                'created_at' => NULL,
                'updated_at' => NULL,
                'order' => 1,
                'form_request_class' => 'App\\Admin\\Forms\\Requests\\FormRiwayatDiklatTeknis',
                'enabled' => 1,
                'form_request_model' => 'App\\Models\\RiwayatDiklatTeknis',
            ),
            12 => 
            array (
                'id' => 20,
                'parent_id' => 1,
                'name' => 'Riwayat DP3',
                'created_at' => NULL,
                'updated_at' => NULL,
                'order' => 1,
                'form_request_class' => 'App\\Admin\\Forms\\Requests\\FormRiwayatDP3',
                'enabled' => 1,
                'form_request_model' => 'App\\Models\\RiwayatDp3',
            ),
            13 => 
            array (
                'id' => 13,
                'parent_id' => 1,
                'name' => 'Riwayat Gaji',
                'created_at' => NULL,
                'updated_at' => NULL,
                'order' => 1,
                'form_request_class' => 'App\\Admin\\Forms\\Requests\\FormRiwayatGaji',
                'enabled' => 1,
                'form_request_model' => 'App\\Models\\RiwayatGaji',
            ),
            14 => 
            array (
                'id' => 35,
                'parent_id' => 1,
                'name' => 'Riwayat Hukuman',
                'created_at' => NULL,
                'updated_at' => NULL,
                'order' => 1,
                'form_request_class' => 'App\\Admin\\Forms\\Requests\\FormRiwayatHukuman',
                'enabled' => 1,
                'form_request_model' => 'App\\Models\\RiwayatHukuman',
            ),
            15 => 
            array (
                'id' => 10,
                'parent_id' => 1,
                'name' => 'Riwayat Jabatan',
                'created_at' => NULL,
                'updated_at' => NULL,
                'order' => 1,
                'form_request_class' => 'App\\Admin\\Forms\\Requests\\FormRiwayatJabatan',
                'enabled' => 1,
                'form_request_model' => 'App\\Models\\RiwayatJabatan',
            ),
            16 => 
            array (
                'id' => 28,
                'parent_id' => 1,
                'name' => 'Riwayat Mertua',
                'created_at' => NULL,
                'updated_at' => NULL,
                'order' => 1,
                'form_request_class' => 'App\\Admin\\Forms\\Requests\\FormRiwayatMertua',
                'enabled' => 1,
                'form_request_model' => 'App\\Models\\RiwayatOrangTua',
            ),
            17 => 
            array (
                'id' => 11,
                'parent_id' => 1,
                'name' => 'Riwayat Mutasi',
                'created_at' => NULL,
                'updated_at' => NULL,
                'order' => 1,
                'form_request_class' => 'App\\Admin\\Forms\\Requests\\FormRiwayatMutasi',
                'enabled' => 1,
                'form_request_model' => 'App\\Models\\RiwayatMutasi',
            ),
            18 => 
            array (
                'id' => 30,
                'parent_id' => 1,
                'name' => 'Riwayat Nikah',
                'created_at' => NULL,
                'updated_at' => NULL,
                'order' => 1,
                'form_request_class' => 'App\\Admin\\Forms\\Requests\\FormRiwayatNikah',
                'enabled' => 1,
                'form_request_model' => 'App\\Models\\RiwayatNikah',
            ),
            19 => 
            array (
                'id' => 27,
                'parent_id' => 1,
                'name' => 'Riwayat Orang Tua',
                'created_at' => NULL,
                'updated_at' => NULL,
                'order' => 1,
                'form_request_class' => 'App\\Admin\\Forms\\Requests\\FormRiwayatOrangTua',
                'enabled' => 1,
                'form_request_model' => 'App\\Models\\RiwayatOrangTua',
            ),
            20 => 
            array (
                'id' => 33,
                'parent_id' => 1,
                'name' => 'Riwayat Organisasi',
                'created_at' => NULL,
                'updated_at' => NULL,
                'order' => 1,
                'form_request_class' => 'App\\Admin\\Forms\\Requests\\FormRiwayatOrganisasi',
                'enabled' => 1,
                'form_request_model' => 'App\\Models\\RiwayatOrganisasi',
            ),
            21 => 
            array (
                'id' => 9,
                'parent_id' => 1,
                'name' => 'Riwayat Pangkat',
                'created_at' => NULL,
                'updated_at' => NULL,
                'order' => 1,
                'form_request_class' => 'App\\Admin\\Forms\\Requests\\FormRiwayatPangkat',
                'enabled' => 1,
                'form_request_model' => 'App\\Models\\RiwayatPangkat',
            ),
            22 => 
            array (
                'id' => 22,
                'parent_id' => 1,
                'name' => 'Riwayat Penghargaan',
                'created_at' => NULL,
                'updated_at' => NULL,
                'order' => 1,
                'form_request_class' => 'App\\Admin\\Forms\\Requests\\FormRiwayatPenghargaan',
                'enabled' => 1,
                'form_request_model' => 'App\\Models\\RiwayatPenghargaan',
            ),
            23 => 
            array (
                'id' => 34,
                'parent_id' => 1,
                'name' => 'Riwayat Penguasaan Bahasa',
                'created_at' => NULL,
                'updated_at' => NULL,
                'order' => 1,
                'form_request_class' => 'App\\Admin\\Forms\\Requests\\FormRiwayatPenguasaanBahasa',
                'enabled' => 1,
                'form_request_model' => 'App\\Models\\RiwayatPenguasaanBahasa',
            ),
            24 => 
            array (
                'id' => 23,
                'parent_id' => 1,
                'name' => 'Riwayat Potensi Diri',
                'created_at' => NULL,
                'updated_at' => NULL,
                'order' => 1,
                'form_request_class' => 'App\\Admin\\Forms\\Requests\\FormRiwayatPotensiDiri',
                'enabled' => 1,
                'form_request_model' => 'App\\Models\\RiwayatPotensiDiri',
            ),
            25 => 
            array (
                'id' => 24,
                'parent_id' => 1,
                'name' => 'Riwayat Prestasi Kerja',
                'created_at' => NULL,
                'updated_at' => NULL,
                'order' => 1,
                'form_request_class' => 'App\\Admin\\Forms\\Requests\\FormRiwayatPrestasiKerja',
                'enabled' => 1,
                'form_request_model' => 'App\\Models\\RiwayatKinerja',
            ),
            26 => 
            array (
                'id' => 26,
                'parent_id' => 1,
                'name' => 'Riwayat Rekam Medis',
                'created_at' => NULL,
                'updated_at' => NULL,
                'order' => 1,
                'form_request_class' => 'App\\Admin\\Forms\\Requests\\FormRiwayatRekamMedis',
                'enabled' => 1,
                'form_request_model' => 'App\\Models\\RiwayatRekamMedis',
            ),
            27 => 
            array (
                'id' => 32,
                'parent_id' => 1,
                'name' => 'Riwayat Saudara',
                'created_at' => NULL,
                'updated_at' => NULL,
                'order' => 1,
                'form_request_class' => 'App\\Admin\\Forms\\Requests\\FormRiwayatSaudara',
                'enabled' => 1,
                'form_request_model' => 'App\\Models\\RiwayatSaudara',
            ),
            28 => 
            array (
                'id' => 12,
                'parent_id' => 1,
                'name' => 'Riwayat Sumpah',
                'created_at' => NULL,
                'updated_at' => NULL,
                'order' => 1,
                'form_request_class' => 'App\\Admin\\Forms\\Requests\\FormRiwayatSumpah',
                'enabled' => 1,
                'form_request_model' => 'App\\Models\\RiwayatSumpah',
            ),
            29 => 
            array (
                'id' => 21,
                'parent_id' => 1,
                'name' => 'Riwayat Uji Kompetensi',
                'created_at' => NULL,
                'updated_at' => NULL,
                'order' => 1,
                'form_request_class' => 'App\\Admin\\Forms\\Requests\\FormRiwayatUjiKompetensi',
                'enabled' => 1,
                'form_request_model' => 'App\\Models\\RiwayatUjiKompetensi',
            ),
            30 => 
            array (
                'id' => 7,
                'parent_id' => 1,
                'name' => 'SK CPNS',
                'created_at' => NULL,
                'updated_at' => NULL,
                'order' => 1,
                'form_request_class' => 'App\\Admin\\Forms\\Requests\\FormSKCPNS',
                'enabled' => 1,
                'form_request_model' => 'App\\Models\\RiwayatSKCPNS',
            ),
            31 => 
            array (
                'id' => 14,
                'parent_id' => 1,
                'name' => 'SK Pensiun',
                'created_at' => NULL,
                'updated_at' => NULL,
                'order' => 1,
                'form_request_class' => 'App\\Admin\\Forms\\Requests\\FormSKPensiun',
                'enabled' => 1,
                'form_request_model' => 'App\\Models\\RiwayatPensiun',
            ),
            32 => 
            array (
                'id' => 8,
                'parent_id' => 1,
                'name' => 'SK PNS',
                'created_at' => NULL,
                'updated_at' => NULL,
                'order' => 1,
                'form_request_class' => 'App\\Admin\\Forms\\Requests\\FormSKPNS',
                'enabled' => 1,
                'form_request_model' => 'App\\Models\\RiwayatSKPNS',
            ),
        ));
        
        
    }
}