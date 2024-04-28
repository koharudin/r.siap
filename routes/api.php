<?php

use App\Http\Controllers\FlexiportController;
use App\Http\Controllers\RequestCategoryController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\RiwayatAnakController;
use App\Http\Controllers\RiwayatAngkaKreditController;
use App\Http\Controllers\RiwayatDiklatFungsionalController;
use App\Http\Controllers\RiwayatDiklatStrukturalController;
use App\Http\Controllers\RiwayatDiklatTeknisController;
use App\Http\Controllers\RiwayatDp3Controller;
use App\Http\Controllers\RiwayatGajiController;
use App\Http\Controllers\RiwayatHukumanController;
use App\Http\Controllers\RiwayatJabatanController;
use App\Http\Controllers\RiwayatKinerjaController;
use App\Http\Controllers\RiwayatKursusController;
use App\Http\Controllers\RiwayatMutasiController;
use App\Http\Controllers\RiwayatNikahController;
use App\Http\Controllers\RiwayatOrangTuaController;
use App\Http\Controllers\RiwayatPangkatController;
use App\Http\Controllers\RiwayatPendidikanController;
use App\Http\Controllers\RiwayatPengalamanKerjaController;
use App\Http\Controllers\RiwayatPenghargaanController;
use App\Http\Controllers\RiwayatPenguasaanBahasaController;
use App\Http\Controllers\RiwayatPensiunController;
use App\Http\Controllers\RiwayatPotensiDiriController;
use App\Http\Controllers\RiwayatRekamMedisController;
use App\Http\Controllers\RiwayatSaudaraController;
use App\Http\Controllers\RiwayatSeminarController;
use App\Http\Controllers\RiwayatSKCPNSController;
use App\Http\Controllers\RiwayatSumpahController;
use App\Http\Controllers\RiwayatUjiKompetensiController;
use App\Http\Controllers\VerifikasiController;
use App\Models\Administrator;
use App\Models\Agama;
use App\Models\Employee;
use App\Models\LineApproval;
use App\Models\Pangkat;
use App\Models\RequestCategory;
use App\Models\RiwayatAngkaKredit;
use App\Models\RiwayatDiklatFungsional;
use Carbon\Carbon;
use Encore\Admin\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\UrlHelper;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/kedudukan_pernikahan', function (Request $request) {
    $ls = config('app.sistem.kedudukan_pernikahan');
    $l = [];
    foreach ($ls  as $k => $v) {
        $l[] = [
            'id' => $k,
            'text' => $v
        ];
    }
    return ['data' => $l];
});
Route::get('/list_pangkat', function (Request $request) {
    $ls = Pangkat::all();
    $l = [];
    foreach ($ls  as $r) {
        $l[] = [
            'id' => $r->id,
            'text' => $r->text
        ];
    }
    return ['data' => $l];
});

Route::get('/token', function () {
    $user = Administrator::find(377);
    $token = $user->createToken('authToken')->accessToken;

    return response()->json([
        "token" => $token,
        "user" => $user
    ], 200);
});

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/me', function () {
        $user = Auth::user();
        return response()->json($user, 200);
    });
});

Route::get('cek-login', function () {
    return response()->json(1, 200);
});


Route::post('flexiport', function () {
    $c = request()->input("c");
    if ($c == 'config') {
        return app(FlexiportController::class)->config();
    } else if ($c == 'dt') {
        return app(FlexiportController::class)->dt();
    }
    if ($c == 'agama') {
        $l = Agama::all();
        return response()->json($l, 200);
    }
    return response()->json([], 200);
});


Route::group([],function(){
    Route::resource('riwayat-anak', RiwayatAnakController::class);
    Route::resource('riwayat-angka-kredit', RiwayatAngkaKreditController::class);
    Route::resource('riwayat-diklat-fungsional', RiwayatDiklatFungsionalController::class);
    Route::resource('riwayat-diklat-struktural', RiwayatDiklatStrukturalController::class);
    Route::resource('riwayat-diklat-teknis', RiwayatDiklatTeknisController::class);
    Route::resource('riwayat-dp3', RiwayatDp3Controller::class);
    Route::resource('riwayat-gaji', RiwayatGajiController::class);
    Route::resource('riwayat-hukuman', RiwayatHukumanController::class);
    Route::resource('riwayat-jabatan', RiwayatJabatanController::class);
    Route::resource('riwayat-kinerja', RiwayatKinerjaController::class);
    Route::resource('riwayat-kursus', RiwayatKursusController::class);
    Route::resource('riwayat-mutasi', RiwayatMutasiController::class);
    Route::resource('riwayat-nikah', RiwayatNikahController::class);
    Route::resource('riwayat-orangtua', RiwayatOrangTuaController::class);
    Route::resource('riwayat-pangkat', RiwayatPangkatController::class);
    Route::resource('riwayat-pendidikan', RiwayatPendidikanController::class);
    Route::resource('riwayat-pengalamankerja', RiwayatPengalamanKerjaController::class);
    Route::resource('riwayat-penghargaan', RiwayatPenghargaanController::class);
    Route::resource('riwayat-penguasaanbahasa', RiwayatPenguasaanBahasaController::class);
    Route::resource('riwayat-pensiun', RiwayatPensiunController::class);
    Route::resource('riwayat-potensidiri', RiwayatPotensiDiriController::class);
    Route::resource('riwayat-rekammedis', RiwayatRekamMedisController::class);
    Route::resource('riwayat-saudara', RiwayatSaudaraController::class);
    Route::resource('riwayat-seminar', RiwayatSeminarController::class);
    Route::resource('riwayat-skcpns', RiwayatSKCPNSController::class);
    Route::resource('riwayat-skpns', RiwayatSKCPNSController::class);
    Route::resource('riwayat-sumpah', RiwayatSumpahController::class);
    Route::resource('riwayat-ujikompetensi', RiwayatUjiKompetensiController::class);

});
Route::group(["prefix" => "pelayanan"], function () {
    Route::group(["prefix" => "public"], function () {
        Route::get('request-categories', function () {
            $l = RequestCategory::all();
            return request()->json($l, 200);
        });
    });
    Route::group(['middleware' => 'auth:api'], function () {
        Route::resource('request-category', RequestCategoryController::class);

        Route::group(['middleware' => 'role:verifikator'], function () {
            Route::post('/verifikasi-request/{uuid_request}/terima', [VerifikasiController::class, "terima"]);
            Route::post('/verifikasi-request/{uuid_request}/tolak', [VerifikasiController::class, "tolak"]);
        });
        //verifikator

        Route::resource('requests', RequestController::class);
        Route::resource('line-approval', LineApproval::class);
    });
});
