<?php

use App\Http\Controllers\FlexiportController;
use App\Http\Controllers\RequestCategoryController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\VerifikasiController;
use App\Models\Administrator;
use App\Models\Agama;
use App\Models\Employee;
use App\Models\LineApproval;
use App\Models\Pangkat;
use App\Models\Presensi\RiwayatIzin;
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

Route::get('cekpresensi',function(){
	$rs = RiwayatIzin::take(7)->get();
	return response()->json($rs, 200);
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


Route::group(["prefix" => "pelayanan"], function () {
    Route::group(["prefix" => "public"], function () {
        Route::get('request-categories', function () {
            return 123;
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
