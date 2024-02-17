<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomizedAdminPermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admin_permissions')->delete();
        
        \DB::table('admin_permissions')->insert(array (
            0 => 
            array (
                'id' => 2,
                'name' => 'Dashboard',
                'slug' => 'dashboard',
                'http_method' => 'GET',
                'http_path' => '/',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 3,
                'name' => 'Login',
                'slug' => 'auth.login',
                'http_method' => '',
                'http_path' => '/auth/login
/auth/logout',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 4,
                'name' => 'User setting',
                'slug' => 'auth.setting',
                'http_method' => 'GET,PUT',
                'http_path' => '/auth/setting',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 5,
                'name' => 'Auth management',
                'slug' => 'auth.management',
                'http_method' => '',
                'http_path' => '/auth/roles
/auth/permissions
/auth/menu
/auth/logs',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 1,
                'name' => 'All permission',
                'slug' => '*',
                'http_method' => '',
                'http_path' => '**',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'profilku',
                'slug' => 'profilku',
                'http_method' => '',
                'http_path' => '/profile/me/**',
                'created_at' => '2023-07-06 11:04:24',
                'updated_at' => '2023-07-07 10:09:01',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'save-data_personal',
                'slug' => 'save-data_personal',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 00:30:18',
                'updated_at' => '2023-07-08 00:32:18',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'create-riwayat_angkakredit',
                'slug' => 'create-riwayat_angkakredit',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 01:01:15',
                'updated_at' => '2023-07-08 01:01:15',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'edit-riwayat_angkakredit',
                'slug' => 'edit-riwayat_angkakredit',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 01:03:07',
                'updated_at' => '2023-07-08 01:03:07',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'delete-riwayat_angkakredit',
                'slug' => 'delete-riwayat_angkakredit',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 01:03:21',
                'updated_at' => '2023-07-08 01:03:21',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'create-riwayat_pangkat',
                'slug' => 'create-riwayat_pangkat',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 02:33:42',
                'updated_at' => '2023-07-08 02:33:42',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'edit-riwayat_pangkat',
                'slug' => 'edit-riwayat_pangkat',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 02:33:53',
                'updated_at' => '2023-07-08 02:33:53',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'delete-riwayat_pangkat',
                'slug' => 'delete-riwayat_pangkat',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 02:34:07',
                'updated_at' => '2023-07-08 02:34:07',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'create-riwayat_mutasi',
                'slug' => 'create-riwayat_mutasi',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 03:24:41',
                'updated_at' => '2023-07-08 03:24:41',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'edit-riwayat_mutasi',
                'slug' => 'edit-riwayat_mutasi',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 03:24:51',
                'updated_at' => '2023-07-08 03:24:51',
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'delete-riwayat_mutasi',
                'slug' => 'delete-riwayat_mutasi',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 03:25:01',
                'updated_at' => '2023-07-08 03:25:01',
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'create-riwayat_sumpah',
                'slug' => 'create-riwayat_sumpah',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 04:39:08',
                'updated_at' => '2023-07-08 04:39:08',
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'edit-riwayat_sumpah',
                'slug' => 'edit-riwayat_sumpah',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 04:39:17',
                'updated_at' => '2023-07-08 04:39:17',
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'delete-riwayat_sumpah',
                'slug' => 'delete-riwayat_sumpah',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 04:39:33',
                'updated_at' => '2023-07-08 04:39:33',
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'create-riwayat_gaji',
                'slug' => 'create-riwayat_gaji',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 04:42:06',
                'updated_at' => '2023-07-08 04:42:06',
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'edit-riwayat_gaji',
                'slug' => 'edit-riwayat_gaji',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 04:42:18',
                'updated_at' => '2023-07-08 04:42:18',
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'delete-riwayat_gaji',
                'slug' => 'delete-riwayat_gaji',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 04:42:28',
                'updated_at' => '2023-07-08 04:42:28',
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'save-skpensiun',
                'slug' => 'save-skpensiun',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 04:46:10',
                'updated_at' => '2023-07-08 04:46:10',
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'create-riwayat_pendidikan',
                'slug' => 'create-riwayat_pendidikan',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 04:48:38',
                'updated_at' => '2023-07-08 04:48:38',
            ),
            24 => 
            array (
                'id' => 25,
                'name' => 'edit-riwayat_pendidikan',
                'slug' => 'edit-riwayat_pendidikan',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 04:48:48',
                'updated_at' => '2023-07-08 04:48:48',
            ),
            25 => 
            array (
                'id' => 26,
                'name' => 'delete-riwayat_pendidikan',
                'slug' => 'delete-riwayat_pendidikan',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 04:48:59',
                'updated_at' => '2023-07-08 04:48:59',
            ),
            26 => 
            array (
                'id' => 27,
                'name' => 'create-riwayat_diklat_struktural',
                'slug' => 'create-riwayat_diklat_struktural',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 04:54:15',
                'updated_at' => '2023-07-08 04:54:15',
            ),
            27 => 
            array (
                'id' => 28,
                'name' => 'edit-riwayat_diklat_struktural',
                'slug' => 'edit-riwayat_diklat_struktural',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 04:54:24',
                'updated_at' => '2023-07-08 04:54:24',
            ),
            28 => 
            array (
                'id' => 29,
                'name' => 'delete-riwayat_diklat_struktural',
                'slug' => 'delete-riwayat_diklat_struktural',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 04:54:35',
                'updated_at' => '2023-07-08 04:54:35',
            ),
            29 => 
            array (
                'id' => 30,
                'name' => 'create-riwayat_diklat_fungsional',
                'slug' => 'create-riwayat_diklat_fungsional',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 05:48:00',
                'updated_at' => '2023-07-08 05:48:00',
            ),
            30 => 
            array (
                'id' => 31,
                'name' => 'edit-riwayat_diklat_fungsional',
                'slug' => 'edit-riwayat_diklat_fungsional',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 05:48:10',
                'updated_at' => '2023-07-08 05:48:10',
            ),
            31 => 
            array (
                'id' => 32,
                'name' => 'delete-riwayat_diklat_fungsional',
                'slug' => 'delete-riwayat_diklat_fungsional',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 05:48:18',
                'updated_at' => '2023-07-08 05:48:18',
            ),
            32 => 
            array (
                'id' => 33,
                'name' => 'create-riwayat_diklat_teknis',
                'slug' => 'create-riwayat_diklat_teknis',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 05:48:45',
                'updated_at' => '2023-07-08 05:48:45',
            ),
            33 => 
            array (
                'id' => 34,
                'name' => 'edit-riwayat_diklat_teknis',
                'slug' => 'edit-riwayat_diklat_teknis',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 05:48:53',
                'updated_at' => '2023-07-08 05:48:53',
            ),
            34 => 
            array (
                'id' => 35,
                'name' => 'delete-riwayat_diklat_teknis',
                'slug' => 'delete-riwayat_diklat_teknis',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 05:49:05',
                'updated_at' => '2023-07-08 05:49:05',
            ),
            35 => 
            array (
                'id' => 36,
                'name' => 'create-riwayat_kursus',
                'slug' => 'create-riwayat_kursus',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 05:51:18',
                'updated_at' => '2023-07-08 05:51:18',
            ),
            36 => 
            array (
                'id' => 37,
                'name' => 'edit-riwayat_kursus',
                'slug' => 'edit-riwayat_kursus',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 05:51:25',
                'updated_at' => '2023-07-08 05:51:25',
            ),
            37 => 
            array (
                'id' => 38,
                'name' => 'delete-riwayat_kursus',
                'slug' => 'delete-riwayat_kursus',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 05:51:35',
                'updated_at' => '2023-07-08 05:51:35',
            ),
            38 => 
            array (
                'id' => 39,
                'name' => 'create-riwayat_seminar',
                'slug' => 'create-riwayat_seminar',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 05:53:10',
                'updated_at' => '2023-07-08 05:53:10',
            ),
            39 => 
            array (
                'id' => 40,
                'name' => 'edit-riwayat_seminar',
                'slug' => 'edit-riwayat_seminar',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 05:53:19',
                'updated_at' => '2023-07-08 05:53:19',
            ),
            40 => 
            array (
                'id' => 41,
                'name' => 'delete-riwayat_seminar',
                'slug' => 'delete-riwayat_seminar',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 05:53:27',
                'updated_at' => '2023-07-08 05:53:27',
            ),
            41 => 
            array (
                'id' => 42,
                'name' => 'create-riwayat_dp3',
                'slug' => 'create-riwayat_dp3',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 05:53:54',
                'updated_at' => '2023-07-08 05:53:54',
            ),
            42 => 
            array (
                'id' => 43,
                'name' => 'edit-riwayat_dp3',
                'slug' => 'edit-riwayat_dp3',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 05:54:04',
                'updated_at' => '2023-07-08 05:54:04',
            ),
            43 => 
            array (
                'id' => 44,
                'name' => 'delete-riwayat_dp3',
                'slug' => 'delete-riwayat_dp3',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 05:54:39',
                'updated_at' => '2023-07-08 05:54:39',
            ),
            44 => 
            array (
                'id' => 45,
                'name' => 'create-riwayat_uji_kompetensi',
                'slug' => 'create-riwayat_uji_kompetensi',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 05:55:15',
                'updated_at' => '2023-07-08 05:55:15',
            ),
            45 => 
            array (
                'id' => 46,
                'name' => 'edit-riwayat_uji_kompetensi',
                'slug' => 'edit-riwayat_uji_kompetensi',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 05:55:22',
                'updated_at' => '2023-07-08 05:55:22',
            ),
            46 => 
            array (
                'id' => 47,
                'name' => 'delete-riwayat_uji_kompetensi',
                'slug' => 'delete-riwayat_uji_kompetensi',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 05:55:30',
                'updated_at' => '2023-07-08 05:55:30',
            ),
            47 => 
            array (
                'id' => 48,
                'name' => 'create-riwayat_penghargaan',
                'slug' => 'create-riwayat_penghargaan',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 05:55:51',
                'updated_at' => '2023-07-08 05:55:51',
            ),
            48 => 
            array (
                'id' => 49,
                'name' => 'edit-riwayat_penghargaan',
                'slug' => 'edit-riwayat_penghargaan',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 05:55:59',
                'updated_at' => '2023-07-08 05:55:59',
            ),
            49 => 
            array (
                'id' => 50,
                'name' => 'delete-riwayat_penghargaan',
                'slug' => 'delete-riwayat_penghargaan',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 05:56:09',
                'updated_at' => '2023-07-08 05:56:09',
            ),
            50 => 
            array (
                'id' => 51,
                'name' => 'create-riwayat_potensi_diri',
                'slug' => 'create-riwayat_potensi_diri',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 05:56:28',
                'updated_at' => '2023-07-08 05:56:28',
            ),
            51 => 
            array (
                'id' => 52,
                'name' => 'edit-riwayat_potensi_diri',
                'slug' => 'edit-riwayat_potensi_diri',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 05:56:37',
                'updated_at' => '2023-07-08 05:56:37',
            ),
            52 => 
            array (
                'id' => 53,
                'name' => 'delete-riwayat_potensi_diri',
                'slug' => 'delete-riwayat_potensi_diri',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 05:56:46',
                'updated_at' => '2023-07-08 05:56:46',
            ),
            53 => 
            array (
                'id' => 54,
                'name' => 'create-riwayat_prestasi_kerja',
                'slug' => 'create-riwayat_prestasi_kerja',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 05:57:08',
                'updated_at' => '2023-07-08 05:57:08',
            ),
            54 => 
            array (
                'id' => 55,
                'name' => 'edit-riwayat_prestasi_kerja',
                'slug' => 'edit-riwayat_prestasi_kerja',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 05:57:16',
                'updated_at' => '2023-07-08 05:57:16',
            ),
            55 => 
            array (
                'id' => 56,
                'name' => 'delete-riwayat_prestasi_kerja',
                'slug' => 'delete-riwayat_prestasi_kerja',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 05:59:43',
                'updated_at' => '2023-07-08 05:59:43',
            ),
            56 => 
            array (
                'id' => 57,
                'name' => 'create-riwayat_orangtua',
                'slug' => 'create-riwayat_orangtua',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 06:00:07',
                'updated_at' => '2023-07-08 06:00:07',
            ),
            57 => 
            array (
                'id' => 58,
                'name' => 'edit-riwayat_orangtua',
                'slug' => 'edit-riwayat_orangtua',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 06:00:17',
                'updated_at' => '2023-07-08 06:00:17',
            ),
            58 => 
            array (
                'id' => 59,
                'name' => 'delete-riwayat_orangtua',
                'slug' => 'delete-riwayat_orangtua',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 06:00:26',
                'updated_at' => '2023-07-08 06:00:26',
            ),
            59 => 
            array (
                'id' => 60,
                'name' => 'create-riwayat_istrisuami',
                'slug' => 'create-riwayat_istrisuami',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 06:04:24',
                'updated_at' => '2023-07-08 06:04:24',
            ),
            60 => 
            array (
                'id' => 61,
                'name' => 'edit-riwayat_istrisuami',
                'slug' => 'edit-riwayat_istrisuami',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 06:04:33',
                'updated_at' => '2023-07-08 06:04:33',
            ),
            61 => 
            array (
                'id' => 62,
                'name' => 'delete-riwayat_istrisuami',
                'slug' => 'delete-riwayat_istrisuami',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 06:04:43',
                'updated_at' => '2023-07-08 06:04:43',
            ),
            62 => 
            array (
                'id' => 63,
                'name' => 'create-riwayat_anak',
                'slug' => 'create-riwayat_anak',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 06:05:10',
                'updated_at' => '2023-07-08 06:05:10',
            ),
            63 => 
            array (
                'id' => 64,
                'name' => 'edit-riwayat_anak',
                'slug' => 'edit-riwayat_anak',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 06:05:19',
                'updated_at' => '2023-07-08 06:05:19',
            ),
            64 => 
            array (
                'id' => 65,
                'name' => 'delete-riwayat_anak',
                'slug' => 'delete-riwayat_anak',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 06:05:30',
                'updated_at' => '2023-07-08 06:05:30',
            ),
            65 => 
            array (
                'id' => 66,
                'name' => 'create-riwayat_organisasi',
                'slug' => 'create-riwayat_organisasi',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 06:05:49',
                'updated_at' => '2023-07-08 06:05:49',
            ),
            66 => 
            array (
                'id' => 67,
                'name' => 'edit-riwayat_organisasi',
                'slug' => 'edit-riwayat_organisasi',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 06:05:58',
                'updated_at' => '2023-07-08 06:05:58',
            ),
            67 => 
            array (
                'id' => 68,
                'name' => 'delete-riwayat_organisasi',
                'slug' => 'delete-riwayat_organisasi',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 06:06:10',
                'updated_at' => '2023-07-08 06:06:10',
            ),
            68 => 
            array (
                'id' => 69,
                'name' => 'create-riwayat_hukuman',
                'slug' => 'create-riwayat_hukuman',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 06:06:41',
                'updated_at' => '2023-07-08 06:06:41',
            ),
            69 => 
            array (
                'id' => 70,
                'name' => 'edit-riwayat_hukuman',
                'slug' => 'edit-riwayat_hukuman',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 06:06:51',
                'updated_at' => '2023-07-08 06:06:51',
            ),
            70 => 
            array (
                'id' => 71,
                'name' => 'delete-riwayat_hukuman',
                'slug' => 'delete-riwayat_hukuman',
                'http_method' => '',
                'http_path' => NULL,
                'created_at' => '2023-07-08 06:07:00',
                'updated_at' => '2023-07-08 06:07:00',
            ),
            71 => 
            array (
                'id' => 72,
                'name' => 'Usulan Ku',
                'slug' => 'usulanku',
                'http_method' => '',
                'http_path' => '/usulan/**',
                'created_at' => '2023-07-30 10:20:03',
                'updated_at' => '2023-07-30 10:20:03',
            ),
            72 => 
            array (
                'id' => 73,
                'name' => 'download-dokumen',
                'slug' => 'download-dokumen',
                'http_method' => NULL,
                'http_path' => '/download/dokumen/**',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            73 => 
            array (
                'id' => 74,
                'name' => 'download-foto',
                'slug' => 'download-foto',
                'http_method' => NULL,
                'http_path' => '/download/foto/**',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            74 => 
            array (
                'id' => 77,
                'name' => 'Verifikator Usulan',
                'slug' => 'verifikator-usulan',
                'http_method' => '',
                'http_path' => '/layanan/verifikasi/**',
                'created_at' => '2023-08-03 10:30:09',
                'updated_at' => '2023-08-09 21:52:09',
            ),
            75 => 
            array (
                'id' => 78,
                'name' => 'Pengusul',
                'slug' => 'pengusul',
                'http_method' => '',
                'http_path' => '/layanan/usulan/**',
                'created_at' => '2023-08-03 10:32:09',
                'updated_at' => '2023-08-03 10:32:09',
            ),
        ));
        
        
    }
}