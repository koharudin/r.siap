<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomizedAdminMenuTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admin_menu')->delete();
        
        \DB::table('admin_menu')->insert(array (
            0 => 
            array (
                'id' => 17,
                'parent_id' => 9,
                'order' => 28,
                'title' => 'Jenis KP',
                'icon' => 'fa-bars',
                'uri' => '/manage_jeniskp',
                'permission' => NULL,
                'created_at' => '2023-06-27 03:40:13',
                'updated_at' => '2024-01-20 04:47:30',
            ),
            1 => 
            array (
                'id' => 1,
                'parent_id' => 0,
                'order' => 1,
                'title' => 'Dashboard',
                'icon' => 'fa-bar-chart',
                'uri' => '/',
                'permission' => NULL,
                'created_at' => NULL,
                'updated_at' => '2024-01-20 04:47:30',
            ),
            2 => 
            array (
                'id' => 35,
                'parent_id' => 0,
                'order' => 2,
                'title' => 'Profil Ku',
                'icon' => 'fa-user-md',
                'uri' => '/profile/me/data_personal',
                'permission' => NULL,
                'created_at' => '2023-07-06 10:43:32',
                'updated_at' => '2024-01-20 04:47:30',
            ),
            3 => 
            array (
                'id' => 42,
                'parent_id' => 0,
                'order' => 3,
                'title' => 'Layanan',
                'icon' => 'fa-bars',
                'uri' => NULL,
                'permission' => NULL,
                'created_at' => '2023-07-28 06:45:07',
                'updated_at' => '2024-01-20 04:47:30',
            ),
            4 => 
            array (
                'id' => 44,
                'parent_id' => 42,
                'order' => 4,
                'title' => 'Layanan Ku',
                'icon' => 'fa-bars',
                'uri' => '/layanan/usulan/saya',
                'permission' => NULL,
                'created_at' => '2023-07-28 06:45:48',
                'updated_at' => '2024-01-20 04:47:30',
            ),
            5 => 
            array (
                'id' => 45,
                'parent_id' => 42,
                'order' => 5,
                'title' => 'Verifikasi Layanan',
                'icon' => 'fa-bars',
                'uri' => '/layanan/verifikasi/usulan',
                'permission' => NULL,
                'created_at' => '2023-07-28 06:46:13',
                'updated_at' => '2024-01-20 04:47:30',
            ),
            6 => 
            array (
                'id' => 26,
                'parent_id' => 0,
                'order' => 6,
                'title' => 'DUK',
                'icon' => 'fa-cubes',
                'uri' => '/duk',
                'permission' => NULL,
                'created_at' => '2023-07-05 23:57:24',
                'updated_at' => '2024-01-20 04:47:30',
            ),
            7 => 
            array (
                'id' => 27,
                'parent_id' => 0,
                'order' => 7,
                'title' => 'KGB',
                'icon' => 'fa-diamond',
                'uri' => '/kgb',
                'permission' => NULL,
                'created_at' => '2023-07-05 23:57:47',
                'updated_at' => '2024-01-20 04:47:30',
            ),
            8 => 
            array (
                'id' => 36,
                'parent_id' => 0,
                'order' => 8,
                'title' => 'KP',
                'icon' => 'fa-university',
                'uri' => '/kp',
                'permission' => NULL,
                'created_at' => '2023-07-06 23:46:48',
                'updated_at' => '2024-01-20 04:47:30',
            ),
            9 => 
            array (
                'id' => 28,
                'parent_id' => 0,
                'order' => 9,
                'title' => 'Pensiun',
                'icon' => 'fa-money',
                'uri' => '/pensiun',
                'permission' => NULL,
                'created_at' => '2023-07-05 23:58:07',
                'updated_at' => '2024-01-20 04:47:30',
            ),
            10 => 
            array (
                'id' => 29,
                'parent_id' => 0,
                'order' => 10,
                'title' => 'Penghargaan',
                'icon' => 'fa-trophy',
                'uri' => '/penghargaan',
                'permission' => NULL,
                'created_at' => '2023-07-05 23:58:31',
                'updated_at' => '2024-01-20 04:47:30',
            ),
            11 => 
            array (
                'id' => 30,
                'parent_id' => 0,
                'order' => 11,
                'title' => 'Dokumen Digital',
                'icon' => 'fa-folder-open',
                'uri' => '/dokumen_digital',
                'permission' => NULL,
                'created_at' => '2023-07-05 23:58:46',
                'updated_at' => '2024-01-20 04:47:30',
            ),
            12 => 
            array (
                'id' => 31,
                'parent_id' => 0,
                'order' => 12,
                'title' => 'Diagram Jabatan',
                'icon' => 'fa-bar-chart',
                'uri' => '/diagram_jabatan',
                'permission' => NULL,
                'created_at' => '2023-07-05 23:59:21',
                'updated_at' => '2024-01-20 04:47:30',
            ),
            13 => 
            array (
                'id' => 32,
                'parent_id' => 0,
                'order' => 13,
                'title' => 'Statistik',
                'icon' => 'fa-area-chart',
                'uri' => '/statistik',
                'permission' => NULL,
                'created_at' => '2023-07-05 23:59:40',
                'updated_at' => '2024-01-20 04:47:30',
            ),
            14 => 
            array (
                'id' => 33,
                'parent_id' => 0,
                'order' => 14,
                'title' => 'Riwayat Hukuman',
                'icon' => 'fa-balance-scale',
                'uri' => '/riwayat_hukuman',
                'permission' => NULL,
                'created_at' => '2023-07-05 23:59:53',
                'updated_at' => '2024-01-20 04:47:30',
            ),
            15 => 
            array (
                'id' => 21,
                'parent_id' => 0,
                'order' => 15,
                'title' => 'Daftar Pegawai',
                'icon' => 'fa-users',
                'uri' => '/daftar_pegawai',
                'permission' => NULL,
                'created_at' => '2023-06-27 13:23:05',
                'updated_at' => '2024-01-20 04:47:30',
            ),
            16 => 
            array (
                'id' => 2,
                'parent_id' => 0,
                'order' => 16,
                'title' => 'Penempatan Pegawai',
                'icon' => 'fa-sitemap',
                'uri' => '/penempatan_pegawai',
                'permission' => NULL,
                'created_at' => '2024-01-20 04:44:21',
                'updated_at' => '2024-01-20 04:47:30',
            ),
            17 => 
            array (
                'id' => 9,
                'parent_id' => 0,
                'order' => 17,
                'title' => 'Admin',
                'icon' => 'fa-cog',
                'uri' => '/',
                'permission' => NULL,
                'created_at' => NULL,
                'updated_at' => '2024-01-20 04:47:30',
            ),
            18 => 
            array (
                'id' => 15,
                'parent_id' => 9,
                'order' => 18,
                'title' => 'User',
                'icon' => 'fa-bars',
                'uri' => '/manage_user',
                'permission' => NULL,
                'created_at' => '2023-06-26 13:24:20',
                'updated_at' => '2024-01-20 04:47:30',
            ),
            19 => 
            array (
                'id' => 4,
                'parent_id' => 9,
                'order' => 19,
                'title' => 'Roles',
                'icon' => 'fa-bars',
                'uri' => 'auth/roles',
                'permission' => NULL,
                'created_at' => NULL,
                'updated_at' => '2024-01-20 04:47:30',
            ),
            20 => 
            array (
                'id' => 5,
                'parent_id' => 9,
                'order' => 20,
                'title' => 'Permission',
                'icon' => 'fa-bars',
                'uri' => 'auth/permissions',
                'permission' => NULL,
                'created_at' => NULL,
                'updated_at' => '2024-01-20 04:47:30',
            ),
            21 => 
            array (
                'id' => 6,
                'parent_id' => 9,
                'order' => 21,
                'title' => 'Menu',
                'icon' => 'fa-bars',
                'uri' => 'auth/menu',
                'permission' => NULL,
                'created_at' => NULL,
                'updated_at' => '2024-01-20 04:47:30',
            ),
            22 => 
            array (
                'id' => 46,
                'parent_id' => 9,
                'order' => 22,
                'title' => 'Kategori Layanan',
                'icon' => 'fa-bars',
                'uri' => '/manage_kategori_layanan',
                'permission' => NULL,
                'created_at' => '2023-07-28 06:50:35',
                'updated_at' => '2024-01-20 04:47:30',
            ),
            23 => 
            array (
                'id' => 40,
                'parent_id' => 9,
                'order' => 23,
                'title' => 'Diklat',
                'icon' => 'fa-bars',
                'uri' => '/manage_diklat',
                'permission' => NULL,
                'created_at' => '2023-07-17 04:40:40',
                'updated_at' => '2024-01-20 04:47:30',
            ),
            24 => 
            array (
                'id' => 37,
                'parent_id' => 9,
                'order' => 24,
                'title' => 'Klasifikasi Dokumen',
                'icon' => 'fa-bars',
                'uri' => '/manage_klasifikasi_dokumen',
                'permission' => NULL,
                'created_at' => '2023-07-09 04:07:52',
                'updated_at' => '2024-01-20 04:47:30',
            ),
            25 => 
            array (
                'id' => 38,
                'parent_id' => 9,
                'order' => 25,
                'title' => 'Dokumen Pegawai',
                'icon' => 'fa-bars',
                'uri' => '/manage_dokumen_pegawai',
                'permission' => NULL,
                'created_at' => '2023-07-10 00:31:02',
                'updated_at' => '2024-01-20 04:47:30',
            ),
            26 => 
            array (
                'id' => 41,
                'parent_id' => 9,
                'order' => 26,
                'title' => 'Penghargaan',
                'icon' => 'fa-bars',
                'uri' => '/manage_penghargaan',
                'permission' => NULL,
                'created_at' => '2023-07-18 01:48:44',
                'updated_at' => '2024-01-20 04:47:30',
            ),
            27 => 
            array (
                'id' => 34,
                'parent_id' => 9,
                'order' => 27,
                'title' => 'Pendidikan',
                'icon' => 'fa-bars',
                'uri' => '/manage_pendidikan',
                'permission' => NULL,
                'created_at' => '2023-07-06 10:30:42',
                'updated_at' => '2024-01-20 04:47:30',
            ),
            28 => 
            array (
                'id' => 16,
                'parent_id' => 9,
                'order' => 29,
                'title' => 'Pangkat',
                'icon' => 'fa-bars',
                'uri' => '/manage_pangkat',
                'permission' => NULL,
                'created_at' => '2023-06-27 03:25:12',
                'updated_at' => '2024-01-20 04:47:30',
            ),
            29 => 
            array (
                'id' => 13,
                'parent_id' => 9,
                'order' => 30,
                'title' => 'Unit Kerja',
                'icon' => 'fa-bars',
                'uri' => '/manage_unit_kerja',
                'permission' => NULL,
                'created_at' => '2023-06-26 13:19:42',
                'updated_at' => '2024-01-20 04:47:30',
            ),
            30 => 
            array (
                'id' => 39,
                'parent_id' => 9,
                'order' => 31,
                'title' => 'Jabatan',
                'icon' => 'fa-bars',
                'uri' => '/manage_tree_jabatan',
                'permission' => NULL,
                'created_at' => '2023-07-14 23:33:26',
                'updated_at' => '2024-01-20 04:47:30',
            ),
            31 => 
            array (
                'id' => 12,
                'parent_id' => 9,
                'order' => 32,
                'title' => 'Employee',
                'icon' => 'fa-bars',
                'uri' => '/manage_employee',
                'permission' => NULL,
                'created_at' => '2023-06-26 13:05:56',
                'updated_at' => '2024-01-20 04:47:30',
            ),
            32 => 
            array (
                'id' => 14,
                'parent_id' => 9,
                'order' => 33,
                'title' => 'Pendidikan',
                'icon' => 'fa-bars',
                'uri' => '/manage_pendidikan',
                'permission' => NULL,
                'created_at' => '2023-06-26 13:21:51',
                'updated_at' => '2024-01-20 04:47:30',
            ),
            33 => 
            array (
                'id' => 11,
                'parent_id' => 9,
                'order' => 34,
                'title' => 'Negara',
                'icon' => 'fa-bars',
                'uri' => '/manage_country',
                'permission' => NULL,
                'created_at' => '2023-06-26 13:05:23',
                'updated_at' => '2024-01-20 04:47:30',
            ),
            34 => 
            array (
                'id' => 8,
                'parent_id' => 9,
                'order' => 35,
                'title' => 'Agama',
                'icon' => 'fa-bars',
                'uri' => '/manage_agama',
                'permission' => NULL,
                'created_at' => '2023-06-26 07:01:32',
                'updated_at' => '2024-01-20 04:47:30',
            ),
            35 => 
            array (
                'id' => 10,
                'parent_id' => 9,
                'order' => 36,
                'title' => 'Bank',
                'icon' => 'fa-bars',
                'uri' => '/manage_bank',
                'permission' => NULL,
                'created_at' => '2023-06-26 13:04:24',
                'updated_at' => '2024-01-20 04:47:30',
            ),
            36 => 
            array (
                'id' => 19,
                'parent_id' => 9,
                'order' => 37,
                'title' => 'Jenis Pensiun',
                'icon' => 'fa-bars',
                'uri' => '/manage_jenis_pensiun',
                'permission' => NULL,
                'created_at' => '2023-06-27 04:29:53',
                'updated_at' => '2024-01-20 04:47:30',
            ),
            37 => 
            array (
                'id' => 22,
                'parent_id' => 9,
                'order' => 38,
                'title' => 'Hukuman',
                'icon' => 'fa-bars',
                'uri' => '/manage_hukuman',
                'permission' => NULL,
                'created_at' => '2023-07-01 05:12:38',
                'updated_at' => '2024-01-20 04:47:30',
            ),
            38 => 
            array (
                'id' => 18,
                'parent_id' => 9,
                'order' => 39,
                'title' => 'Tingkat Hukuman',
                'icon' => 'fa-bars',
                'uri' => '/manage_tingkat_hukuman',
                'permission' => NULL,
                'created_at' => '2023-06-27 04:06:27',
                'updated_at' => '2024-01-20 04:47:30',
            ),
            39 => 
            array (
                'id' => 20,
                'parent_id' => 9,
                'order' => 40,
                'title' => 'Jenjang Fungsional',
                'icon' => 'fa-bars',
                'uri' => '/manage_jenjang_fungsional',
                'permission' => NULL,
                'created_at' => '2023-06-27 06:32:56',
                'updated_at' => '2024-01-20 04:47:30',
            ),
            40 => 
            array (
                'id' => 25,
                'parent_id' => 9,
                'order' => 41,
                'title' => 'Golongan Darah',
                'icon' => 'fa-bars',
                'uri' => '/manage_golongan_darah',
                'permission' => NULL,
                'created_at' => '2023-07-05 04:13:54',
                'updated_at' => '2024-01-20 04:47:30',
            ),
            41 => 
            array (
                'id' => 23,
                'parent_id' => 9,
                'order' => 42,
                'title' => 'Pejabat Penetap',
                'icon' => 'fa-bars',
                'uri' => '/manage_pejabat_penetap',
                'permission' => NULL,
                'created_at' => '2023-07-01 07:52:00',
                'updated_at' => '2024-01-20 04:47:30',
            ),
            42 => 
            array (
                'id' => 7,
                'parent_id' => 9,
                'order' => 43,
                'title' => 'Operation log',
                'icon' => 'fa-bars',
                'uri' => 'auth/logs',
                'permission' => NULL,
                'created_at' => NULL,
                'updated_at' => '2024-01-20 04:47:30',
            ),
        ));
        
        
    }
}