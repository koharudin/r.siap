<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomizedMigrationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('migrations')->delete();
        
        \DB::table('migrations')->insert(array (
            0 => 
            array (
                'id' => 1,
                'migration' => '2014_10_12_000000_create_users_table',
                'batch' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'migration' => '2014_10_12_100000_create_password_resets_table',
                'batch' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'migration' => '2016_01_04_173148_create_admin_tables',
                'batch' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'migration' => '2019_08_19_000000_create_failed_jobs_table',
                'batch' => 1,
            ),
            4 => 
            array (
                'id' => 6,
                'migration' => '2019_12_14_000001_create_personal_access_tokens_table',
                'batch' => 2,
            ),
            5 => 
            array (
                'id' => 7,
                'migration' => '2024_02_17_062421_create_admin_menu_table',
                'batch' => 0,
            ),
            6 => 
            array (
                'id' => 8,
                'migration' => '2024_02_17_062421_create_admin_operation_log_table',
                'batch' => 0,
            ),
            7 => 
            array (
                'id' => 9,
                'migration' => '2024_02_17_062421_create_admin_permissions_table',
                'batch' => 0,
            ),
            8 => 
            array (
                'id' => 10,
                'migration' => '2024_02_17_062421_create_admin_role_menu_table',
                'batch' => 0,
            ),
            9 => 
            array (
                'id' => 11,
                'migration' => '2024_02_17_062421_create_admin_role_permissions_table',
                'batch' => 0,
            ),
            10 => 
            array (
                'id' => 12,
                'migration' => '2024_02_17_062421_create_admin_role_users_table',
                'batch' => 0,
            ),
            11 => 
            array (
                'id' => 13,
                'migration' => '2024_02_17_062421_create_admin_roles_table',
                'batch' => 0,
            ),
            12 => 
            array (
                'id' => 14,
                'migration' => '2024_02_17_062421_create_admin_user_permissions_table',
                'batch' => 0,
            ),
            13 => 
            array (
                'id' => 15,
                'migration' => '2024_02_17_062421_create_admin_users_table',
                'batch' => 0,
            ),
            14 => 
            array (
                'id' => 16,
                'migration' => '2024_02_17_062421_create_agama_table',
                'batch' => 0,
            ),
            15 => 
            array (
                'id' => 17,
                'migration' => '2024_02_17_062421_create_alasan_hukuman_table',
                'batch' => 0,
            ),
            16 => 
            array (
                'id' => 18,
                'migration' => '2024_02_17_062421_create_bank_table',
                'batch' => 0,
            ),
            17 => 
            array (
                'id' => 19,
                'migration' => '2024_02_17_062421_create_country_table',
                'batch' => 0,
            ),
            18 => 
            array (
                'id' => 20,
                'migration' => '2024_02_17_062421_create_diklat_table',
                'batch' => 0,
            ),
            19 => 
            array (
                'id' => 21,
                'migration' => '2024_02_17_062421_create_diklat_siasn_table',
                'batch' => 0,
            ),
            20 => 
            array (
                'id' => 22,
                'migration' => '2024_02_17_062421_create_diklat_siasn_struktural_table',
                'batch' => 0,
            ),
            21 => 
            array (
                'id' => 23,
                'migration' => '2024_02_17_062421_create_dokumen_pegawai_table',
                'batch' => 0,
            ),
            22 => 
            array (
                'id' => 24,
                'migration' => '2024_02_17_062421_create_employee_table',
                'batch' => 0,
            ),
            23 => 
            array (
                'id' => 25,
                'migration' => '2024_02_17_062421_create_eselon_table',
                'batch' => 0,
            ),
            24 => 
            array (
                'id' => 26,
                'migration' => '2024_02_17_062421_create_failed_jobs_table',
                'batch' => 0,
            ),
            25 => 
            array (
                'id' => 27,
                'migration' => '2024_02_17_062421_create_gaji_pokok_table',
                'batch' => 0,
            ),
            26 => 
            array (
                'id' => 28,
                'migration' => '2024_02_17_062421_create_golongan_darah_table',
                'batch' => 0,
            ),
            27 => 
            array (
                'id' => 29,
                'migration' => '2024_02_17_062421_create_hukuman_table',
                'batch' => 0,
            ),
            28 => 
            array (
                'id' => 30,
                'migration' => '2024_02_17_062421_create_jabatan_table',
                'batch' => 0,
            ),
            29 => 
            array (
                'id' => 31,
                'migration' => '2024_02_17_062421_create_jenis_bahasa_table',
                'batch' => 0,
            ),
            30 => 
            array (
                'id' => 32,
                'migration' => '2024_02_17_062421_create_jenis_kelamin_table',
                'batch' => 0,
            ),
            31 => 
            array (
                'id' => 33,
                'migration' => '2024_02_17_062421_create_jenis_kenaikan_gaji_table',
                'batch' => 0,
            ),
            32 => 
            array (
                'id' => 34,
                'migration' => '2024_02_17_062421_create_jenis_kp_table',
                'batch' => 0,
            ),
            33 => 
            array (
                'id' => 35,
                'migration' => '2024_02_17_062421_create_jenis_pekerjaan_table',
                'batch' => 0,
            ),
            34 => 
            array (
                'id' => 36,
                'migration' => '2024_02_17_062421_create_jenis_pensiun_table',
                'batch' => 0,
            ),
            35 => 
            array (
                'id' => 37,
                'migration' => '2024_02_17_062421_create_jenjang_fungsional_table',
                'batch' => 0,
            ),
            36 => 
            array (
                'id' => 38,
                'migration' => '2024_02_17_062421_create_kategori_layanan_table',
                'batch' => 0,
            ),
            37 => 
            array (
                'id' => 39,
                'migration' => '2024_02_17_062421_create_kemampuan_bicara_table',
                'batch' => 0,
            ),
            38 => 
            array (
                'id' => 40,
                'migration' => '2024_02_17_062421_create_klasifikasi_dokumen_table',
                'batch' => 0,
            ),
            39 => 
            array (
                'id' => 41,
                'migration' => '2024_02_17_062421_create_pangkat_table',
                'batch' => 0,
            ),
            40 => 
            array (
                'id' => 42,
                'migration' => '2024_02_17_062421_create_password_resets_table',
                'batch' => 0,
            ),
            41 => 
            array (
                'id' => 43,
                'migration' => '2024_02_17_062421_create_pejabat_penetap_table',
                'batch' => 0,
            ),
            42 => 
            array (
                'id' => 44,
                'migration' => '2024_02_17_062421_create_pendidikan_table',
                'batch' => 0,
            ),
            43 => 
            array (
                'id' => 45,
                'migration' => '2024_02_17_062421_create_penempatan_pegawai_table',
                'batch' => 0,
            ),
            44 => 
            array (
                'id' => 46,
                'migration' => '2024_02_17_062421_create_penghargaan_table',
                'batch' => 0,
            ),
            45 => 
            array (
                'id' => 47,
                'migration' => '2024_02_17_062421_create_personal_access_tokens_table',
                'batch' => 0,
            ),
            46 => 
            array (
                'id' => 48,
                'migration' => '2024_02_17_062421_create_request_log_table',
                'batch' => 0,
            ),
            47 => 
            array (
                'id' => 49,
                'migration' => '2024_02_17_062421_create_riwayat_anak_table',
                'batch' => 0,
            ),
            48 => 
            array (
                'id' => 50,
                'migration' => '2024_02_17_062421_create_riwayat_angkakredit_table',
                'batch' => 0,
            ),
            49 => 
            array (
                'id' => 51,
                'migration' => '2024_02_17_062421_create_riwayat_diklat_struktural_table',
                'batch' => 0,
            ),
            50 => 
            array (
                'id' => 52,
                'migration' => '2024_02_17_062421_create_riwayat_diklat_teknis_table',
                'batch' => 0,
            ),
            51 => 
            array (
                'id' => 53,
                'migration' => '2024_02_17_062421_create_riwayat_dp3_table',
                'batch' => 0,
            ),
            52 => 
            array (
                'id' => 54,
                'migration' => '2024_02_17_062421_create_riwayat_gaji_table',
                'batch' => 0,
            ),
            53 => 
            array (
                'id' => 55,
                'migration' => '2024_02_17_062421_create_riwayat_hukuman_table',
                'batch' => 0,
            ),
            54 => 
            array (
                'id' => 56,
                'migration' => '2024_02_17_062421_create_riwayat_jabatan_table',
                'batch' => 0,
            ),
            55 => 
            array (
                'id' => 57,
                'migration' => '2024_02_17_062421_create_riwayat_kinerja_table',
                'batch' => 0,
            ),
            56 => 
            array (
                'id' => 58,
                'migration' => '2024_02_17_062421_create_riwayat_kursus_table',
                'batch' => 0,
            ),
            57 => 
            array (
                'id' => 59,
                'migration' => '2024_02_17_062421_create_riwayat_mutasi_table',
                'batch' => 0,
            ),
            58 => 
            array (
                'id' => 60,
                'migration' => '2024_02_17_062421_create_riwayat_nikah_table',
                'batch' => 0,
            ),
            59 => 
            array (
                'id' => 61,
                'migration' => '2024_02_17_062421_create_riwayat_orangtua_table',
                'batch' => 0,
            ),
            60 => 
            array (
                'id' => 62,
                'migration' => '2024_02_17_062421_create_riwayat_organisasi_table',
                'batch' => 0,
            ),
            61 => 
            array (
                'id' => 63,
                'migration' => '2024_02_17_062421_create_riwayat_pangkat_table',
                'batch' => 0,
            ),
            62 => 
            array (
                'id' => 64,
                'migration' => '2024_02_17_062421_create_riwayat_pendidikan_table',
                'batch' => 0,
            ),
            63 => 
            array (
                'id' => 65,
                'migration' => '2024_02_17_062421_create_riwayat_pengalaman_kerja_table',
                'batch' => 0,
            ),
            64 => 
            array (
                'id' => 66,
                'migration' => '2024_02_17_062421_create_riwayat_penghargaan_table',
                'batch' => 0,
            ),
            65 => 
            array (
                'id' => 67,
                'migration' => '2024_02_17_062421_create_riwayat_penguasaan_bahasa_table',
                'batch' => 0,
            ),
            66 => 
            array (
                'id' => 68,
                'migration' => '2024_02_17_062421_create_riwayat_pensiun_table',
                'batch' => 0,
            ),
            67 => 
            array (
                'id' => 69,
                'migration' => '2024_02_17_062421_create_riwayat_potensi_diri_table',
                'batch' => 0,
            ),
            68 => 
            array (
                'id' => 70,
                'migration' => '2024_02_17_062421_create_riwayat_rekammedis_table',
                'batch' => 0,
            ),
            69 => 
            array (
                'id' => 71,
                'migration' => '2024_02_17_062421_create_riwayat_saudara_table',
                'batch' => 0,
            ),
            70 => 
            array (
                'id' => 72,
                'migration' => '2024_02_17_062421_create_riwayat_seminar_table',
                'batch' => 0,
            ),
            71 => 
            array (
                'id' => 73,
                'migration' => '2024_02_17_062421_create_riwayat_skcpns_table',
                'batch' => 0,
            ),
            72 => 
            array (
                'id' => 74,
                'migration' => '2024_02_17_062421_create_riwayat_skpns_table',
                'batch' => 0,
            ),
            73 => 
            array (
                'id' => 75,
                'migration' => '2024_02_17_062421_create_riwayat_sumpah_table',
                'batch' => 0,
            ),
            74 => 
            array (
                'id' => 76,
                'migration' => '2024_02_17_062421_create_riwayat_uji_kompetensi_table',
                'batch' => 0,
            ),
            75 => 
            array (
                'id' => 77,
                'migration' => '2024_02_17_062421_create_riwayat_usulan_table',
                'batch' => 0,
            ),
            76 => 
            array (
                'id' => 78,
                'migration' => '2024_02_17_062421_create_status_anak_table',
                'batch' => 0,
            ),
            77 => 
            array (
                'id' => 79,
                'migration' => '2024_02_17_062421_create_status_jabatan_table',
                'batch' => 0,
            ),
            78 => 
            array (
                'id' => 80,
                'migration' => '2024_02_17_062421_create_status_menikah_table',
                'batch' => 0,
            ),
            79 => 
            array (
                'id' => 81,
                'migration' => '2024_02_17_062421_create_status_pegawai_table',
                'batch' => 0,
            ),
            80 => 
            array (
                'id' => 82,
                'migration' => '2024_02_17_062421_create_status_pernikahan_table',
                'batch' => 0,
            ),
            81 => 
            array (
                'id' => 83,
                'migration' => '2024_02_17_062421_create_status_usulan_table',
                'batch' => 0,
            ),
            82 => 
            array (
                'id' => 84,
                'migration' => '2024_02_17_062421_create_tingkat_hukuman_table',
                'batch' => 0,
            ),
            83 => 
            array (
                'id' => 85,
                'migration' => '2024_02_17_062421_create_tipe_jabatan_table',
                'batch' => 0,
            ),
            84 => 
            array (
                'id' => 86,
                'migration' => '2024_02_17_062421_create_unit_kerja_table',
                'batch' => 0,
            ),
            85 => 
            array (
                'id' => 87,
                'migration' => '2024_02_17_062421_create_users_table',
                'batch' => 0,
            ),
            86 => 
            array (
                'id' => 88,
                'migration' => '2024_02_17_062422_create_employee_statistics_view',
                'batch' => 0,
            ),
            87 => 
            array (
                'id' => 89,
                'migration' => '2016_06_01_000001_create_oauth_auth_codes_table',
                'batch' => 3,
            ),
            88 => 
            array (
                'id' => 90,
                'migration' => '2016_06_01_000002_create_oauth_access_tokens_table',
                'batch' => 3,
            ),
            89 => 
            array (
                'id' => 91,
                'migration' => '2016_06_01_000003_create_oauth_refresh_tokens_table',
                'batch' => 3,
            ),
            90 => 
            array (
                'id' => 92,
                'migration' => '2016_06_01_000004_create_oauth_clients_table',
                'batch' => 3,
            ),
            91 => 
            array (
                'id' => 93,
                'migration' => '2016_06_01_000005_create_oauth_personal_access_clients_table',
                'batch' => 3,
            ),
            92 => 
            array (
                'id' => 94,
                'migration' => '2024_02_17_063144_create_admin_menu_table',
                'batch' => 0,
            ),
            93 => 
            array (
                'id' => 95,
                'migration' => '2024_02_17_063144_create_admin_operation_log_table',
                'batch' => 0,
            ),
            94 => 
            array (
                'id' => 96,
                'migration' => '2024_02_17_063144_create_admin_permissions_table',
                'batch' => 0,
            ),
            95 => 
            array (
                'id' => 97,
                'migration' => '2024_02_17_063144_create_admin_role_menu_table',
                'batch' => 0,
            ),
            96 => 
            array (
                'id' => 98,
                'migration' => '2024_02_17_063144_create_admin_role_permissions_table',
                'batch' => 0,
            ),
            97 => 
            array (
                'id' => 99,
                'migration' => '2024_02_17_063144_create_admin_role_users_table',
                'batch' => 0,
            ),
            98 => 
            array (
                'id' => 100,
                'migration' => '2024_02_17_063144_create_admin_roles_table',
                'batch' => 0,
            ),
            99 => 
            array (
                'id' => 101,
                'migration' => '2024_02_17_063144_create_admin_user_permissions_table',
                'batch' => 0,
            ),
            100 => 
            array (
                'id' => 102,
                'migration' => '2024_02_17_063144_create_admin_users_table',
                'batch' => 0,
            ),
            101 => 
            array (
                'id' => 103,
                'migration' => '2024_02_17_063144_create_agama_table',
                'batch' => 0,
            ),
            102 => 
            array (
                'id' => 104,
                'migration' => '2024_02_17_063144_create_alasan_hukuman_table',
                'batch' => 0,
            ),
            103 => 
            array (
                'id' => 105,
                'migration' => '2024_02_17_063144_create_bank_table',
                'batch' => 0,
            ),
            104 => 
            array (
                'id' => 106,
                'migration' => '2024_02_17_063144_create_country_table',
                'batch' => 0,
            ),
            105 => 
            array (
                'id' => 107,
                'migration' => '2024_02_17_063144_create_diklat_table',
                'batch' => 0,
            ),
            106 => 
            array (
                'id' => 108,
                'migration' => '2024_02_17_063144_create_diklat_siasn_table',
                'batch' => 0,
            ),
            107 => 
            array (
                'id' => 109,
                'migration' => '2024_02_17_063144_create_diklat_siasn_struktural_table',
                'batch' => 0,
            ),
            108 => 
            array (
                'id' => 110,
                'migration' => '2024_02_17_063144_create_dokumen_pegawai_table',
                'batch' => 0,
            ),
            109 => 
            array (
                'id' => 111,
                'migration' => '2024_02_17_063144_create_employee_table',
                'batch' => 0,
            ),
            110 => 
            array (
                'id' => 112,
                'migration' => '2024_02_17_063144_create_eselon_table',
                'batch' => 0,
            ),
            111 => 
            array (
                'id' => 113,
                'migration' => '2024_02_17_063144_create_failed_jobs_table',
                'batch' => 0,
            ),
            112 => 
            array (
                'id' => 114,
                'migration' => '2024_02_17_063144_create_gaji_pokok_table',
                'batch' => 0,
            ),
            113 => 
            array (
                'id' => 115,
                'migration' => '2024_02_17_063144_create_golongan_darah_table',
                'batch' => 0,
            ),
            114 => 
            array (
                'id' => 116,
                'migration' => '2024_02_17_063144_create_hukuman_table',
                'batch' => 0,
            ),
            115 => 
            array (
                'id' => 117,
                'migration' => '2024_02_17_063144_create_jabatan_table',
                'batch' => 0,
            ),
            116 => 
            array (
                'id' => 118,
                'migration' => '2024_02_17_063144_create_jenis_bahasa_table',
                'batch' => 0,
            ),
            117 => 
            array (
                'id' => 119,
                'migration' => '2024_02_17_063144_create_jenis_kelamin_table',
                'batch' => 0,
            ),
            118 => 
            array (
                'id' => 120,
                'migration' => '2024_02_17_063144_create_jenis_kenaikan_gaji_table',
                'batch' => 0,
            ),
            119 => 
            array (
                'id' => 121,
                'migration' => '2024_02_17_063144_create_jenis_kp_table',
                'batch' => 0,
            ),
            120 => 
            array (
                'id' => 122,
                'migration' => '2024_02_17_063144_create_jenis_pekerjaan_table',
                'batch' => 0,
            ),
            121 => 
            array (
                'id' => 123,
                'migration' => '2024_02_17_063144_create_jenis_pensiun_table',
                'batch' => 0,
            ),
            122 => 
            array (
                'id' => 124,
                'migration' => '2024_02_17_063144_create_jenjang_fungsional_table',
                'batch' => 0,
            ),
            123 => 
            array (
                'id' => 125,
                'migration' => '2024_02_17_063144_create_kategori_layanan_table',
                'batch' => 0,
            ),
            124 => 
            array (
                'id' => 126,
                'migration' => '2024_02_17_063144_create_kemampuan_bicara_table',
                'batch' => 0,
            ),
            125 => 
            array (
                'id' => 127,
                'migration' => '2024_02_17_063144_create_klasifikasi_dokumen_table',
                'batch' => 0,
            ),
            126 => 
            array (
                'id' => 128,
                'migration' => '2024_02_17_063144_create_oauth_access_tokens_table',
                'batch' => 0,
            ),
            127 => 
            array (
                'id' => 129,
                'migration' => '2024_02_17_063144_create_oauth_auth_codes_table',
                'batch' => 0,
            ),
            128 => 
            array (
                'id' => 130,
                'migration' => '2024_02_17_063144_create_oauth_clients_table',
                'batch' => 0,
            ),
            129 => 
            array (
                'id' => 131,
                'migration' => '2024_02_17_063144_create_oauth_personal_access_clients_table',
                'batch' => 0,
            ),
            130 => 
            array (
                'id' => 132,
                'migration' => '2024_02_17_063144_create_oauth_refresh_tokens_table',
                'batch' => 0,
            ),
            131 => 
            array (
                'id' => 133,
                'migration' => '2024_02_17_063144_create_pangkat_table',
                'batch' => 0,
            ),
            132 => 
            array (
                'id' => 134,
                'migration' => '2024_02_17_063144_create_password_resets_table',
                'batch' => 0,
            ),
            133 => 
            array (
                'id' => 135,
                'migration' => '2024_02_17_063144_create_pejabat_penetap_table',
                'batch' => 0,
            ),
            134 => 
            array (
                'id' => 136,
                'migration' => '2024_02_17_063144_create_pendidikan_table',
                'batch' => 0,
            ),
            135 => 
            array (
                'id' => 137,
                'migration' => '2024_02_17_063144_create_penempatan_pegawai_table',
                'batch' => 0,
            ),
            136 => 
            array (
                'id' => 138,
                'migration' => '2024_02_17_063144_create_penghargaan_table',
                'batch' => 0,
            ),
            137 => 
            array (
                'id' => 139,
                'migration' => '2024_02_17_063144_create_request_log_table',
                'batch' => 0,
            ),
            138 => 
            array (
                'id' => 140,
                'migration' => '2024_02_17_063144_create_riwayat_anak_table',
                'batch' => 0,
            ),
            139 => 
            array (
                'id' => 141,
                'migration' => '2024_02_17_063144_create_riwayat_angkakredit_table',
                'batch' => 0,
            ),
            140 => 
            array (
                'id' => 142,
                'migration' => '2024_02_17_063144_create_riwayat_diklat_struktural_table',
                'batch' => 0,
            ),
            141 => 
            array (
                'id' => 143,
                'migration' => '2024_02_17_063144_create_riwayat_diklat_teknis_table',
                'batch' => 0,
            ),
            142 => 
            array (
                'id' => 144,
                'migration' => '2024_02_17_063144_create_riwayat_dp3_table',
                'batch' => 0,
            ),
            143 => 
            array (
                'id' => 145,
                'migration' => '2024_02_17_063144_create_riwayat_gaji_table',
                'batch' => 0,
            ),
            144 => 
            array (
                'id' => 146,
                'migration' => '2024_02_17_063144_create_riwayat_hukuman_table',
                'batch' => 0,
            ),
            145 => 
            array (
                'id' => 147,
                'migration' => '2024_02_17_063144_create_riwayat_jabatan_table',
                'batch' => 0,
            ),
            146 => 
            array (
                'id' => 148,
                'migration' => '2024_02_17_063144_create_riwayat_kinerja_table',
                'batch' => 0,
            ),
            147 => 
            array (
                'id' => 149,
                'migration' => '2024_02_17_063144_create_riwayat_kursus_table',
                'batch' => 0,
            ),
            148 => 
            array (
                'id' => 150,
                'migration' => '2024_02_17_063144_create_riwayat_mutasi_table',
                'batch' => 0,
            ),
            149 => 
            array (
                'id' => 151,
                'migration' => '2024_02_17_063144_create_riwayat_nikah_table',
                'batch' => 0,
            ),
            150 => 
            array (
                'id' => 152,
                'migration' => '2024_02_17_063144_create_riwayat_orangtua_table',
                'batch' => 0,
            ),
            151 => 
            array (
                'id' => 153,
                'migration' => '2024_02_17_063144_create_riwayat_organisasi_table',
                'batch' => 0,
            ),
            152 => 
            array (
                'id' => 154,
                'migration' => '2024_02_17_063144_create_riwayat_pangkat_table',
                'batch' => 0,
            ),
            153 => 
            array (
                'id' => 155,
                'migration' => '2024_02_17_063144_create_riwayat_pendidikan_table',
                'batch' => 0,
            ),
            154 => 
            array (
                'id' => 156,
                'migration' => '2024_02_17_063144_create_riwayat_pengalaman_kerja_table',
                'batch' => 0,
            ),
            155 => 
            array (
                'id' => 157,
                'migration' => '2024_02_17_063144_create_riwayat_penghargaan_table',
                'batch' => 0,
            ),
            156 => 
            array (
                'id' => 158,
                'migration' => '2024_02_17_063144_create_riwayat_penguasaan_bahasa_table',
                'batch' => 0,
            ),
            157 => 
            array (
                'id' => 159,
                'migration' => '2024_02_17_063144_create_riwayat_pensiun_table',
                'batch' => 0,
            ),
            158 => 
            array (
                'id' => 160,
                'migration' => '2024_02_17_063144_create_riwayat_potensi_diri_table',
                'batch' => 0,
            ),
            159 => 
            array (
                'id' => 161,
                'migration' => '2024_02_17_063144_create_riwayat_rekammedis_table',
                'batch' => 0,
            ),
            160 => 
            array (
                'id' => 162,
                'migration' => '2024_02_17_063144_create_riwayat_saudara_table',
                'batch' => 0,
            ),
            161 => 
            array (
                'id' => 163,
                'migration' => '2024_02_17_063144_create_riwayat_seminar_table',
                'batch' => 0,
            ),
            162 => 
            array (
                'id' => 164,
                'migration' => '2024_02_17_063144_create_riwayat_skcpns_table',
                'batch' => 0,
            ),
            163 => 
            array (
                'id' => 165,
                'migration' => '2024_02_17_063144_create_riwayat_skpns_table',
                'batch' => 0,
            ),
            164 => 
            array (
                'id' => 166,
                'migration' => '2024_02_17_063144_create_riwayat_sumpah_table',
                'batch' => 0,
            ),
            165 => 
            array (
                'id' => 167,
                'migration' => '2024_02_17_063144_create_riwayat_uji_kompetensi_table',
                'batch' => 0,
            ),
            166 => 
            array (
                'id' => 168,
                'migration' => '2024_02_17_063144_create_riwayat_usulan_table',
                'batch' => 0,
            ),
            167 => 
            array (
                'id' => 169,
                'migration' => '2024_02_17_063144_create_status_anak_table',
                'batch' => 0,
            ),
            168 => 
            array (
                'id' => 170,
                'migration' => '2024_02_17_063144_create_status_jabatan_table',
                'batch' => 0,
            ),
            169 => 
            array (
                'id' => 171,
                'migration' => '2024_02_17_063144_create_status_menikah_table',
                'batch' => 0,
            ),
            170 => 
            array (
                'id' => 172,
                'migration' => '2024_02_17_063144_create_status_pegawai_table',
                'batch' => 0,
            ),
            171 => 
            array (
                'id' => 173,
                'migration' => '2024_02_17_063144_create_status_pernikahan_table',
                'batch' => 0,
            ),
            172 => 
            array (
                'id' => 174,
                'migration' => '2024_02_17_063144_create_status_usulan_table',
                'batch' => 0,
            ),
            173 => 
            array (
                'id' => 175,
                'migration' => '2024_02_17_063144_create_tingkat_hukuman_table',
                'batch' => 0,
            ),
            174 => 
            array (
                'id' => 176,
                'migration' => '2024_02_17_063144_create_tipe_jabatan_table',
                'batch' => 0,
            ),
            175 => 
            array (
                'id' => 177,
                'migration' => '2024_02_17_063144_create_unit_kerja_table',
                'batch' => 0,
            ),
            176 => 
            array (
                'id' => 178,
                'migration' => '2024_02_17_063144_create_users_table',
                'batch' => 0,
            ),
            177 => 
            array (
                'id' => 179,
                'migration' => '2024_02_17_063145_create_employee_statistics_view',
                'batch' => 0,
            ),
        ));
        
        
    }
}