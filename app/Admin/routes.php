<?php

use Illuminate\Routing\Router;
use App\Admin\Controllers\AuthController;

Admin::routes();

Route::group(['middleware' => ['web']], function () {
    Route::post('/admin/auth-period', 'App\Admin\Controllers\AuthController@postPeriod')->name('auth.period');
});

Route::group([
    'prefix' => config('admin.route.prefix'),
    'namespace' => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
    'as' => config('admin.route.prefix') . '.',
], function (Router $router) {
    Route::group(['prefix' => 'api'], function (Router $router) {
        $router->get('employee', 'ApiController@list_employees');
    });
    Route::group(['prefix' => 'profile/{profile_id}', 'middleware' => ['checkProfile']], function (Router $router2) use ($router) {
        $router->get('data_personal/cetak-drh-singkat', 'ProfilePegawai\DataPersonalController@cetak_drh_singkat')->name('cetak-drh-singkat');
        $router->get('data_personal/cetak-drh-lengkap', 'ProfilePegawai\DataPersonalController@cetak_drh_lengkap')->name('cetak-drh-lengkap');

        $router->resource('/', ProfilePegawai\DataPersonalController::class)->parameter('data_personal', 'id');
        $router->resource('data_personal', ProfilePegawai\DataPersonalController::class)->parameter('data_personal', 'id');

        $router->resource('riwayat_orangtua', ProfilePegawai\RiwayatOrangTuaController::class)->parameter('riwayat_orangtua', 'id');
        $router->resource('riwayat_mertua', ProfilePegawai\RiwayatMertuaController::class)->parameter('riwayat_mertua', 'id');
        $router->resource('riwayat_nikah', ProfilePegawai\RiwayatNikahController::class)->parameter('riwayat_nikah', 'id');
        $router->resource('riwayat_sk_cpns', ProfilePegawai\SKCPNS_Controller::class)->parameter('riwayat_sk_pns', 'id');
        $router->resource('riwayat_sk_pns', ProfilePegawai\SKPNS_Controller::class)->parameter('riwayat_sk_pns', 'id');
        $router->resource('riwayat_sk_pensiun', ProfilePegawai\SKPensiun_Controller::class)->parameter('riwayat_sk_pensiun', 'id');
        $router->resource('riwayat_anak', ProfilePegawai\RiwayatAnakController::class)->parameter('riwayat_anak', 'id');
        $router->resource('riwayat_organisasi', ProfilePegawai\RiwayatOrganisasiController::class)->parameter('riwayat_organisasi', 'id');
        $router->resource('riwayat_rekam_medis', ProfilePegawai\RiwayatRekamMedisController::class)->parameter('riwayat_rekam_medis', 'id');
        $router->resource('riwayat_angkakredit', ProfilePegawai\RiwayatAngkaKreditController::class)->parameter('riwayat_angkakredit', 'id');
        $router->resource('riwayat_pangkat', ProfilePegawai\RiwayatPangkatController::class)->parameter('riwayat_pangkat', 'id');
        $router->resource('riwayat_jabatan', ProfilePegawai\RiwayatJabatanController::class)->parameter('riwayat_jabatan', 'id');
        $router->resource('riwayat_pendidikan', ProfilePegawai\RiwayatPendidikanController::class)->parameter('riwayat_pendidikan', 'id');
        $router->resource('riwayat_kursus', ProfilePegawai\RiwayatKursusController::class)->parameter('riwayat_kursus', 'id');
        $router->resource('riwayat_seminar', ProfilePegawai\RiwayatSeminarController::class)->parameter('riwayat_seminar', 'id');
        $router->resource('riwayat_dp3', ProfilePegawai\RiwayatDp3Controller::class)->parameter('riwayat_dp3', 'id');
        $router->resource('riwayat_prestasi_kerja', ProfilePegawai\RiwayatKinerjaController::class)->parameter('riwayat_prestasi_kerja', 'id');
        $router->resource('riwayat_potensi_diri', ProfilePegawai\RiwayatPotensiDiriController::class)->parameter('riwayat_potensi_diri', 'id');
        $router->resource('riwayat_uji_kompetensi', ProfilePegawai\RiwayatUjiKompetensiController::class)->parameter('riwayat_uji_kompetensi', 'id');
        $router->resource('riwayat_diklat_teknis', ProfilePegawai\RiwayatDiklatTeknisController::class)->parameter('riwayat_diklat_teknis', 'id');
        $router->resource('riwayat_diklat_fungsional', ProfilePegawai\RiwayatDiklatFungsionalController::class)->parameter('riwayat_diklat_fungsional', 'id');
        $router->resource('riwayat_diklat_struktural', ProfilePegawai\RiwayatDiklatStrukturalController::class)->parameter('riwayat_diklat_struktural', 'id');
        $router->resource('riwayat_penghargaan', ProfilePegawai\RiwayatPenghargaanController::class)->parameter('riwayat_penghargaan', 'id');
        $router->resource('riwayat_hukuman', ProfilePegawai\RiwayatHukumanController::class)->parameter('riwayat_hukuman', 'id');
        $router->resource('riwayat_sumpah', ProfilePegawai\RiwayatSumpahController::class)->parameter('riwayat_sumpah', 'id');
        $router->resource('riwayat_mutasi', ProfilePegawai\RiwayatMutasiController::class)->parameter('riwayat_mutasi', 'id');
        $router->resource('riwayat_gaji', ProfilePegawai\RiwayatGajiController::class)->parameter('riwayat_gaji', 'id');
        $router->resource('riwayat_penguasaan_bahasa', ProfilePegawai\RiwayatBahasaController::class)->parameter('riwayat_penguasaan_bahasa', 'id');
        $router->resource('riwayat_saudara', ProfilePegawai\RiwayatSaudaraController::class)->parameter('riwayat_saudara', 'id');
        $router->resource('riwayat_pengalaman_kerja', ProfilePegawai\RiwayatPengalamanKerjaController::class)->parameter('riwayat_pengalaman_kerja', 'id');
    });
    $router->get('/', 'HomeController@index')->name('home');
    $router->get('/download/dokumen/{f}', 'HomeController@download_dokumen')->name('download.dokumen');
    $router->get('/download/foto/{f}', 'HomeController@download_foto')->name('download.foto');
    $router->get('/download/dokumensiasn/{f}/{g}/{h}', 'SiasnController@download_dok')->name('download.dokumensiasn');
    $router->post('/download/datasiasn/{f}/{g}', 'SiasnController@download_data')->name('download.datasiasn');

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
    //$router->resource('manage_penempatan_pegawai', ManagePenempatanPegawai::class);
    $router->resource('manage_kategori_layanan', ManageTreeKategoriLayanan::class);

    $router->resource('manage_hari_libur', ManageHariLibur::class);
    $router->resource('manage_jenis_cuti', ManageJenisCuti::class);
    $router->resource('manage_riwayat_cuti', ManageRiwayatCuti::class);
    $router->any('manage_riwayat_izin/massal', 'ManageRiwayatIzin@massal')->name('manage_riwayat_izin.buat_massal');
    $router->any('manage_riwayat_pejaker/massal', 'ManageRiwayatPejaker@massal')->name('manage_riwayat_pejaker.buat_massal');
    $router->any('manage_riwayat_tubel/massal', 'ManageRiwayatTubel@massal')->name('manage_riwayat_tubel.buat_massal');
    $router->resource('manage_riwayat_izin', ManageRiwayatIzin::class);
    $router->resource('manage_riwayat_izin_lain', ManageRiwayatIzinLain::class);
    $router->resource('manage_riwayat_lupa_finger', ManageRiwayatLupaFinger::class);
    $router->resource('manage_riwayat_pejaker', ManageRiwayatPejaker::class);
    $router->resource('manage_riwayat_tubel', ManageRiwayatTubel::class);


    Route::group(['prefix' => 'layanan', 'middleware' => ['checkProfile']], function (Router $router2) use ($router) {
        $router->any('usulan/saya', 'UsulanController@me')->name("usulan.saya");
        $router->post('usulan/proses', 'UsulanController@process')->name("usulan.proses");
        $router->any('usulan/buat_baru', 'UsulanController@buat_baru')->name("usulan.buat_baru");
        $router->any('usulan/kategori/{id}', 'UsulanController@new_request')->name("usulan.kategori");
        $router->any('usulan/kategori/{id}/create', 'UsulanController@new_request_kategori')->name("usulan.ajukan_baru.kategori");
        $router->any('usulan/kategori/{kategori_id}/{record_ref_id}/edit', 'UsulanController@ubahFromRecord')->name("usulan.record.ubah");
        $router->any('usulan/kategori/{kategori_id}/{record_ref_id}/hapus', 'UsulanController@hapusFromRecord')->name("usulan.record.hapus");
        $router->get('usulan/{id}/detail', 'UsulanController@detail')->name("usulan.detail");
        $router->any('usulan/{id}/edit', 'UsulanController@edit')->name("usulan.edit");
        $router->post('verifikasi/usulan/{id}/do', 'VerifikasiUsulanController@do')->name("usulan.do_verifikasi");
        $router->get('verifikasi/usulan/{id}/form', 'VerifikasiUsulanController@form')->name("usulan.form_verifikasi");
        $router->any('verifikasi/usulan', 'VerifikasiUsulanController@grid')->name("usulan.grid_verifikasi");
        $router->any('verifikasi/usulan/{id}/detail', 'VerifikasiUsulanController@detail')->name("verifikasi.detail");
    });

    $router->any('absensi', 'HomeController@absensi');
    $router->get('daftar_pegawai', 'DaftarPegawaiController@Index');
    $router->any('duk', 'DukController@Index');
    $router->any('kgb', 'KGBController@Index');
    $router->any('kp', 'KGBController@Index');
    $router->any('pensiun', 'PensiunController@akan_pensiun');
    $router->any('pensiun-akan', 'PensiunController@akan_pensiun')->name('pensiun.akan-pensiun');
    $router->any('pensiun-mpp', 'PensiunController@mpp')->name('pensiun.mpp');
    $router->any('pensiun-tusk', 'PensiunController@tusk')->name('pensiun.tusk');
    $router->any('pensiun-akan2mpp-form/{e}', 'PensiunController@akan2mppForm')->name('pensiun.akan2mpp.form');
    $router->any('pensiun-tusk2album-form/{e}', 'PensiunController@tusk2AlbumForm')->name('pensiun.tusk2album.form');
    $router->any('pensiun-mpp2tusk-form/{e}', 'PensiunController@mpp2TuskForm')->name('pensiun.mpp2tusk.form');
    $router->any('pensiun-mpp2album-form/{e}', 'PensiunController@mpp2AlbumForm')->name('pensiun.mpp2album.form');

    $router->any('pensiun-album', 'PensiunController@album')->name('pensiun.album');
    $router->any('dt-akan-pensiun', 'PensiunController@dt_akan_pensiun')->name('pensiun.akan_pensiun.dt');
    $router->any('dt-mpp', 'PensiunController@dt_mpp')->name('pensiun.mpp.dt');
    $router->any('dt-tusk', 'PensiunController@dt_tusk')->name('pensiun.tusk.dt');
    $router->any('dt-album', 'PensiunController@dt_album')->name('pensiun.album.dt');

    $router->any('penghargaan', 'PenghargaanController@Index');
    $router->any('dt-penghargaan', 'PenghargaanController@dt')->name('penghargaan.dt');
    $router->any('penempatan_pegawai', 'PenempatanPegawaiController@Index');
    $router->any('dt-penempatan_pegawai', 'PenempatanPegawaiController@dt')->name('penempatan_pegawai.dt');
    $router->any('sinkrondata-penempatan_pegawai', 'PenempatanPegawaiController@sinkrondata')->name('penempatan_pegawai.sinkrondata');
    $router->any('total-penempatan_pegawai', 'PenempatanPegawaiController@getTotal')->name('penempatan_pegawai.getTotal');
    $router->any('existing_pegawai', 'ExistingPegawaiController@Index');
    $router->any('dt-existing_pegawai', 'ExistingPegawaiController@dt')->name('existing_pegawai.dt');
    $router->any('dokumen_digital', 'DokumenDigitalController@Index');
    $router->any('diagram_jabatan', 'DiagramJabatanController@Index');
    $router->any('statistik', 'StatistikController@Index');
    $router->any('riwayat_hukuman', 'RiwayatHukumanController@Index');
    $router->resource('nilaimasakerja', NilaiMasaKerjaPegawaiController::class);
    $router->resource('nilaijabatan', NilaiJabatanPegawaiController::class);
});