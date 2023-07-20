<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    Route::group(['prefix'=>'profile/{profile_id}','middleware'=>['checkProfile']],function(Router $router2) use($router){
        $router->resource('data_personal', ProfilePegawai\DataPersonalController::class)->parameter('data_personal','id');
        $router->resource('riwayat_orangtua', ProfilePegawai\RiwayatOrangTuaController::class)->parameter('riwayat_orangtua','id');
        $router->resource('riwayat_mertua', ProfilePegawai\RiwayatMertuaController::class)->parameter('riwayat_mertua','id');
        $router->resource('riwayat_nikah', ProfilePegawai\RiwayatNikahController::class)->parameter('riwayat_nikah','id');
        $router->resource('riwayat_sk_cpns', ProfilePegawai\SKCPNS_Controller::class)->parameter('riwayat_sk_pns','id');
        $router->resource('riwayat_sk_pns', ProfilePegawai\SKPNS_Controller::class)->parameter('riwayat_sk_pns','id');
        $router->resource('riwayat_sk_pensiun', ProfilePegawai\SKPensiun_Controller::class)->parameter('riwayat_sk_pensiun','id');
        $router->resource('riwayat_anak', ProfilePegawai\RiwayatAnakController::class)->parameter('riwayat_anak','id');
        $router->resource('riwayat_organisasi', ProfilePegawai\RiwayatOrganisasiController::class)->parameter('riwayat_organisasi','id');
        $router->resource('riwayat_rekam_medis', ProfilePegawai\RiwayatRekamMedisController::class)->parameter('riwayat_rekam_medis','id');
        $router->resource('riwayat_angkakredit', ProfilePegawai\RiwayatAngkaKreditController::class)->parameter('riwayat_angkakredit','id');
        $router->resource('riwayat_pangkat', ProfilePegawai\RiwayatPangkatController::class)->parameter('riwayat_pangkat','id');
        $router->resource('riwayat_jabatan', ProfilePegawai\RiwayatJabatanController::class)->parameter('riwayat_jabatan','id');
        $router->resource('riwayat_pendidikan', ProfilePegawai\RiwayatPendidikanController::class)->parameter('riwayat_pendidikan','id');
        $router->resource('riwayat_kursus', ProfilePegawai\RiwayatKursusController::class)->parameter('riwayat_kursus','id');
        $router->resource('riwayat_seminar', ProfilePegawai\RiwayatSeminarController::class)->parameter('riwayat_seminar','id');
        $router->resource('riwayat_dp3', ProfilePegawai\RiwayatDp3Controller::class)->parameter('riwayat_dp3','id');
        $router->resource('riwayat_prestasi_kerja', ProfilePegawai\RiwayatKinerjaController::class)->parameter('riwayat_prestasi_kerja','id');
        $router->resource('riwayat_potensi_diri', ProfilePegawai\RiwayatPotensiDiriController::class)->parameter('riwayat_potensi_diri','id');
        $router->resource('riwayat_uji_kompetensi', ProfilePegawai\RiwayatUjiKompetensiController::class)->parameter('riwayat_uji_kompetensi','id');
        $router->resource('riwayat_diklat_teknis', ProfilePegawai\RiwayatDiklatTeknisController::class)->parameter('riwayat_diklat_teknis','id');
        $router->resource('riwayat_diklat_fungsional', ProfilePegawai\RiwayatDiklatFungsionalController::class)->parameter('riwayat_diklat_fungsional','id');
        $router->resource('riwayat_diklat_struktural', ProfilePegawai\RiwayatDiklatStrukturalController::class)->parameter('riwayat_diklat_struktural','id');
        $router->resource('riwayat_penghargaan',  ProfilePegawai\RiwayatPenghargaanController::class)->parameter('riwayat_penghargaan','id');
        $router->resource('riwayat_hukuman',  ProfilePegawai\RiwayatHukumanController::class)->parameter('riwayat_hukuman','id');
        $router->resource('riwayat_sumpah', ProfilePegawai\RiwayatSumpahController::class)->parameter('riwayat_sumpah','id');
        $router->resource('riwayat_mutasi', ProfilePegawai\RiwayatMutasiController::class)->parameter('riwayat_mutasi','id');
        $router->resource('riwayat_gaji', ProfilePegawai\RiwayatGajiController::class)->parameter('riwayat_gaji','id');
        $router->resource('riwayat_penguasaan_bahasa', ProfilePegawai\RiwayatBahasaController::class)->parameter('riwayat_penguasaan_bahasa','id');
        $router->resource('riwayat_saudara', ProfilePegawai\RiwayatSaudaraController::class)->parameter('riwayat_saudara','id');
        $router->resource('riwayat_pengalaman_kerja', ProfilePegawai\RiwayatPengalamanKerjaController::class)->parameter('riwayat_pengalaman_kerja','id');
    
    });
    $router->get('/', 'HomeController@index')->name('home');
    $router->get('/download/dokumen/{f}', 'HomeController@download_dokumen')->name('download.dokumen');
    $router->resource('test', TestController::class);
    $router->resource('manage_agama', ManageAgama::class);
    $router->resource('manage_pendidikan', ManagePendidikanController::class);
    $router->resource('manage_unit_kerja', ManageTreeUnitKerja::class);
    $router->resource('manage_tree_jabatan', ManageTreeJabatan::class);
    $router->resource('manage_klasifikasi_dokumen', ManageTreeKlasifikasiDokumenController::class);
    $router->resource('manage_country', ManageCountry::class);
    $router->resource('manage_bank', ManageBank::class);
    $router->resource('manage_pangkat', ManagePangkat::class);
    $router->resource('manage_jeniskp', ManageJenisKP::class);
    $router->resource('manage_tingkat_hukuman', ManageTingkatHukuman::class);
    $router->resource('manage_hukuman', ManageHukumanController::class);
    $router->resource('manage_jenis_pensiun', ManageJenisPensiun::class);
    $router->resource('manage_employee', ManageEmployee::class);
    $router->resource('manage_jenjang_fungsional', ManageJenjangFungsional::class);
    $router->resource('manage_pejabat_penetap', ManagePejabatPenetapController::class);
    $router->resource('manage_golongan_darah', ManageGolonganDarahController::class);   
    $router->resource('manage_user', UserController::class);   
    $router->resource('manage_diklat', DiklatController::class);
    $router->resource('manage_dokumen_pegawai', DokumenPegawaiController::class);
    $router->resource('manage_penghargaan', ManagePenghargaan::class);

    $router->get('daftar_pegawai', 'DaftarPegawaiController@Index');
    $router->any('duk', 'DukController@Index');
    $router->any('kgb', 'KGBController@Index');
    $router->any('kp', 'KGBController@Index');    
    $router->any('pensiun', 'PensiunController@Index');    
    $router->any('penghargaan', 'PenghargaanController@Index');
    $router->any('dt-penghargaan', 'PenghargaanController@dt')->name('penghargaan.dt');   
    $router->any('dokumen_digital', 'DokumenDigitalController@Index');    
    $router->any('diagram_jabatan', 'DiagramJabatanController@Index');
    $router->any('statistik', 'StatistikController@Index');
    $router->any('riwayat_hukuman', 'RiwayatHukumanController@Index');

});
