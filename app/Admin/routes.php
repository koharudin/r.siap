<?php

use App\Admin\Controllers\DashboardPegawaiController;
use App\Admin\Controllers\ProfilePegawaiController;
use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {
    
    Route::group(['prefix'=>'profile/{profile_id}','middleware'=>['checkProfile']],function(Router $router2) use($router){
        $router->resource('data_personal', ProfilePegawai\DataPersonalController::class);
        $router->resource('riwayat_orangtua', ProfilePegawai\RiwayatOrangTuaController::class);
        $router->resource('riwayat_istrisuami', ProfilePegawai\RiwayatIstriSuamiController::class);
        $router->resource('riwayat_sk_pensiun', ProfilePegawai\SkPensiunController::class);
        $router->resource('riwayat_istrisuami', ProfilePegawai\RiwayatIstriSuamiController::class);
        $router->resource('riwayat_anak', ProfilePegawai\RiwayatAnakController::class);
        $router->resource('riwayat_organisasi', ProfilePegawai\RiwayatOrganisasiController::class);
        $router->resource('riwayat_rekammedis', ProfilePegawai\RiwayatRekamMedisController::class);
        $router->resource('riwayat_angkakredit', ProfilePegawai\RiwayatAngkaKreditController::class);
        $router->resource('riwayat_pangkat', ProfilePegawai\RiwayatPangkatController::class);
        $router->resource('riwayat_pendidikan', ProfilePegawai\RiwayatPendidikanController::class);
        $router->resource('riwayat_kursus', ProfilePegawai\RiwayatKursusController::class);
        $router->resource('riwayat_seminar', ProfilePegawai\RiwayatSeminarController::class);
        $router->resource('riwayat_dp3', ProfilePegawai\RiwayatDp3Controller::class);
        $router->resource('riwayat_prestasi_kerja', ProfilePegawai\RiwayatKinerjaController::class);
        $router->resource('riwayat_potensi_diri', ProfilePegawai\RiwayatPotensiDiriController::class);
        $router->resource('riwayat_uji_kompetensi', ProfilePegawai\RiwayatUjiKompetensiController::class);
        $router->resource('riwayat_diklat_teknis', ProfilePegawai\RiwayatDiklatTeknisController::class);
        $router->resource('riwayat_diklat_fungsional', ProfilePegawai\RiwayatDiklatFungsionalController::class);
        $router->resource('riwayat_diklat_struktural', ProfilePegawai\RiwayatDiklatStrukturalController::class);
        $router->resource('riwayat_penghargaan',  ProfilePegawai\RiwayatPenghargaanController::class);
        $router->resource('riwayat_hukuman',  ProfilePegawai\RiwayatHukumanController::class);
        $router->resource('riwayat_sumpah', ProfilePegawai\RiwayatSumpahController::class);
        $router->resource('riwayat_mutasi', ProfilePegawai\RiwayatMutasiController::class);
        $router->resource('riwayat_gaji', ProfilePegawai\RiwayatGajiController::class);
    });
    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('manage_agama', ManageAgama::class);
    $router->resource('manage_pendidikan', ManagePendidikanController::class);
    $router->resource('manage_unit_kerja', ManageTreeUnitKerja::class);
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
    $router->get('daftar_pegawai', 'DaftarPegawaiController@Index');
    $router->any('duk', 'DukController@Index');
    $router->any('kgb', 'KGBController@Index');
    $router->any('kp', 'KGBController@Index');    
    $router->any('pensiun', 'PensiunController@Index');    
    $router->any('penghargaan', 'PenghargaanController@Index');   
    $router->any('dokumen_digital', 'DokumenDigitalController@Index');    
    $router->any('diagram_jabatan', 'DiagramJabatanController@Index');
    $router->any('statistik', 'StatistikController@Index');
    $router->any('riwayat_hukuman', 'RiwayatHukumanController@Index');

    $router->middleware([])->get('profil-ku',[DashboardPegawaiController::class,'index']);
});
