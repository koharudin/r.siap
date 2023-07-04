<?php

use App\Admin\Controllers\ProfilePegawaiController;
use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('manage_agama', ManageAgama::class);
    //$router->resource('manage_unit_kerja', ManageUnitKerja::class);
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

    $router->get('daftar_pegawai', 'DaftarPegawaiController@Index');
    $router->resource('profile.data_personal', ProfilePegawai\DataPersonalController::class)->parameters([
        'profile' => 'profile_id',
        'data_personal' => 'id'
    ]);
    $router->resource('profile.riwayat_sk_pensiun', ProfilePegawai\SkPensiunController::class)->parameters([
        'profile' => 'profile_id',
        'riwayat_sk_pensiun' => 'id'
    ]);
    
    $router->resource('profile.riwayat_orangtua', ProfilePegawai\RiwayatOrangTuaController::class)->parameters([
        'profile' => 'profile_id',
        'riwayat_orangtua' => 'id'
    ]);
    $router->resource('profile.riwayat_istrisuami', ProfilePegawai\RiwayatIstriSuamiController::class)->parameters([
        'profile' => 'profile_id',
        'riwayat_istrisuami' => 'id'
    ]);
    $router->resource('profile.riwayat_organisasi', ProfilePegawai\RiwayatOrganisasiController::class)->parameters([
        'profile' => 'profile_id',
        'riwayat_organisasi' => 'id'
    ]);
    $router->resource('profile.riwayat_rekammedis', ProfilePegawai\RiwayatRekamMedisController::class)->parameters([
        'profile' => 'profile_id',
        'riwayat_rekammedis' => 'id'
    ]);
    $router->resource('profile.riwayat_angkakredit', ProfilePegawai\RiwayatAngkaKreditController::class)->parameters([
        'profile' => 'profile_id',
        'riwayat_angkakredit' => 'id'
    ]);
    $router->resource('profile.riwayat_pangkat', ProfilePegawai\RiwayatPangkatController::class)->parameters([
        'profile' => 'profile_id',
        'riwayat_pangkat' => 'id'
    ]);
    $router->resource('profile.riwayat_pendidikan', ProfilePegawai\RiwayatPendidikanController::class)->parameters([
        'profile' => 'profile_id',
        'riwayat_pendidikan' => 'id'
    ]);
    $router->resource('profile.riwayat_kursus', ProfilePegawai\RiwayatKursusController::class)->parameters([
        'profile' => 'profile_id',
        'riwayat_kursus' => 'id'
    ]);
    $router->resource('profile.riwayat_seminar', ProfilePegawai\RiwayatSeminarController::class)->parameters([
        'profile' => 'profile_id',
        'riwayat_seminar' => 'id'
    ]);
    $router->resource('profile.riwayat_dp3', ProfilePegawai\RiwayatDp3Controller::class)->parameters([
        'profile' => 'profile_id',
        'riwayat_dp3' => 'id'
    ]);
    $router->resource('profile.riwayat_prestasi_kerja', ProfilePegawai\RiwayatKinerjaController::class)->parameters([
        'profile' => 'profile_id',
        'riwayat_prestasi_kerja' => 'id'
    ]);
    $router->resource('profile.riwayat_potensi_diri', ProfilePegawai\RiwayatPotensiDiriController::class)->parameters([
        'profile' => 'profile_id',
        'riwayat_prestasi_kerja' => 'id'
    ]);
    $router->resource('profile.riwayat_uji_kompetensi', ProfilePegawai\RiwayatUjiKompetensiController::class)->parameters([
        'profile' => 'profile_id',
        'riwayat_uji_kompetensi' => 'id'
    ]);
    $router->resource('profile.riwayat_diklat_teknis', ProfilePegawai\RiwayatDiklatTeknisController::class)->parameters([
        'profile' => 'profile_id',
        'riwayat_diklat_teknis' => 'id'
    ]);
    $router->resource('profile.riwayat_diklat_fungsional', ProfilePegawai\RiwayatDiklatFungsionalController::class)->parameters([
        'profile' => 'profile_id',
        'riwayat_diklat_fungsional' => 'id'
    ]);
    $router->resource('profile.riwayat_diklat_struktural', ProfilePegawai\RiwayatDiklatStrukturalController::class)->parameters([
        'profile' => 'profile_id',
        'riwayat_diklat_struktural' => 'id'
    ]);
    $router->resource('profile.riwayat_penghargaan',  ProfilePegawai\RiwayatPenghargaanController::class)->parameters([
        'profile' => 'profile_id',
        'riwayat_penghargaan' => 'id'
    ]);
    $router->resource('profile.riwayat_hukuman',  ProfilePegawai\RiwayatHukumanController::class)->parameters([
        'profile' => 'profile_id',
        'riwayat_hukuman' => 'id'
    ]);
    $router->resource('profile.riwayat_sumpah', ProfilePegawai\RiwayatSumpahController::class)->parameters([
        'profile' => 'profile_id',
        'riwayat_sumpah' => 'id'
    ]);
    $router->resource('profile.riwayat_mutasi', ProfilePegawai\RiwayatMutasiController::class)->parameters([
        'profile' => 'profile_id',
        'riwayat_mutasi' => 'id'
    ]);
    $router->resource('profile.riwayat_gaji', ProfilePegawai\RiwayatGajiController::class)->parameters([
        'profile' => 'profile_id',
        'riwayat_gaji' => 'id'
    ]);
});
