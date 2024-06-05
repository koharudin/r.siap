<?php

use App\Http\Controllers\AdminEmployeeController;
use App\Http\Controllers\DaftarUsulanController;
use App\Http\Controllers\FlexiportController;
use App\Http\Controllers\PresensiCutiController;
use App\Http\Controllers\PresensiIzinController;
use App\Http\Controllers\PresensiIzinLainController;
use App\Http\Controllers\PresensiKehadiranController;
use App\Http\Controllers\PresensiSesiKerjaController;
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
use App\Http\Controllers\RiwayatMertuaController;
use App\Http\Controllers\RiwayatMutasiController;
use App\Http\Controllers\RiwayatNikahController;
use App\Http\Controllers\RiwayatOrangTuaController;
use App\Http\Controllers\RiwayatOrganisasiController;
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
use App\Http\Controllers\RiwayatSKPNSController;
use App\Http\Controllers\RiwayatSumpahController;
use App\Http\Controllers\RiwayatUjiKompetensiController;
use App\Http\Controllers\VerifikasiController;
use App\Models\Administrator;
use App\Models\Agama;
use App\Models\AlasanHukuman;
use App\Models\Diklat;
use App\Models\DiklatSiasn;
use App\Models\Employee;
use App\Models\Hukuman;
use App\Models\Jabatan;
use App\Models\JenisBahasa;
use App\Models\JenisKenaikanGaji;
use App\Models\JenisPekerjaan;
use App\Models\JenisPenghargaan;
use App\Models\KemampuanBicara;
use App\Models\LineApproval;
use App\Models\Pangkat;
use App\Models\PejabatPenetap;
use App\Models\Pendidikan;
use App\Models\RequestCategory;
use App\Models\RiwayatAngkaKredit;
use App\Models\RiwayatDiklatFungsional;
use App\Models\StatusMenikah;
use App\Models\StatusPernikahan;
use App\Models\TingkatHukuman;
use App\Models\UnitKerja;
use App\Models\User;
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


Route::group(["middleware" => "auth:api"], function () {
    Route::get("usulan-saya", [DaftarUsulanController::class, "list"]);
    Route::get("usulan/{uuid}/detail", [DaftarUsulanController::class, "detail"]);
    Route::post("usulan/{uuid}/hapus", [DaftarUsulanController::class, "hapus"]);
    Route::post("usulan", [DaftarUsulanController::class, "store"]);
    Route::get('me', [AdminEmployeeController::class, 'dataSaya']);
    Route::resource('riwayat-kehadiran', PresensiKehadiranController::class);
    Route::resource('riwayat-sesikerja', PresensiSesiKerjaController::class);
    Route::resource('riwayat-izin', PresensiIzinController::class);
    Route::resource('riwayat-cuti', PresensiCutiController::class);
    Route::resource('riwayat-izin-lain', PresensiIzinLainController::class);

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
    Route::resource('riwayat-mertua', RiwayatMertuaController::class);
    Route::resource('riwayat-organisasi', RiwayatOrganisasiController::class);
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
    Route::resource('riwayat-skpns', RiwayatSKPNSController::class);
    Route::resource('riwayat-sumpah', RiwayatSumpahController::class);
    Route::resource('riwayat-ujikompetensi', RiwayatUjiKompetensiController::class);
});

Route::post("/master-jabatan", function () {
    return response()->json(Jabatan::paginate(), 200);
});
Route::post("/master-pangkat", function () {
    return response()->json(Pangkat::paginate(), 200);
});
Route::get("/master-pangkat/{id}/detail", function ($id) {
    $query = Pangkat::query();
    $query->where("id",$id);
    $data = $query->get()->first();
    if($data) {
        return response()->json($data,200);
    }
    else return response()->json("data tidak ditemukan",404);
});

Route::post("/master-unitkerja", function () {
    $query = UnitKerja::query();
    $q = request()->input("q");
    $query->where("name","ilike","%{$q}%");
    $query->orderBy("name","asc");
    return response()->json($query->paginate(), 200);
});
Route::get("/master-unitkerja/{id}/detail", function ($id) {
    $query = UnitKerja::query();
    $query->where("id",$id);
    $data = $query->get()->first();
    if($data) {
        return response()->json($data,200);
    }
    else return response()->json("data tidak ditemukan",404);
});

Route::post("/master-jenis-kenaikan-gaji", function () {
    return response()->json(JenisKenaikanGaji::paginate(), 200);
});
Route::post("/master-jenis-bahasa", function () {
    return response()->json(JenisBahasa::paginate(), 200);
});
Route::post("/master-jenis-layanan", function () {
    if(request()->input('pagination')=="false"){
        return response()->json(RequestCategory::whereNotNull('parent_id')->orderBy('name','asc')->get(), 200); 
    }
    return response()->json(RequestCategory::orderBy('name','asc')->paginate(), 200);
});
Route::post("/master-kemampuan-bicara", function () {
    return response()->json(KemampuanBicara::paginate(), 200);
});
Route::post("/master-status-pernikahan", function () {
    return response()->json(StatusMenikah::orderBy('name', 'ASC')->paginate(), 200);
});
Route::post("/master-jenis-pekerjaan", function () {
    return response()->json(JenisPekerjaan::orderBy('name', 'ASC')->paginate(), 200);
});
Route::post("/master-jenis-penghargaan", function () {
    return response()->json(JenisPenghargaan::orderBy('order', 'DESC')->orderBy('name', 'ASC')->paginate(), 200);
});
Route::post("/master-jenis-diklat-siasn", function () {
    return response()->json(DiklatSiasn::where('jenis_sertifikat', 'P')->where('id_siasn', '!=', 9)->paginate(), 200);
});
Route::post("/master-jenis-diklat-struktural", function () {
    return response()->json(Diklat::where('parent_id', 1)->paginate(), 200);
});
Route::post("/master-jenis-diklat-fungsional", function () {
    return response()->json(Diklat::where('parent_id', 12)->paginate(), 200);
});
Route::post("/master-jenis-diklat-teknis", function () {
    return response()->json(Diklat::where('parent_id', 70)->paginate(), 200);
});
Route::post("/master-pejabat-penetap", function () {
    return response()->json(PejabatPenetap::paginate(), 200);
});
Route::post("/master-tingkat-hukuman", function () {
    $array = [
        ["id" => "R", "name" => "Hukuman Ringan"],
        ["id" => "S", "name" => "Hukuman Sedang"],
        ["id" => "B", "name" => "Hukuman Berat"],
        ["id" => "K", "name" => "Hukuman Kode Etik"]
    ];
    return response()->json(["data" => $array], 200);
});
Route::post("/master-jenis-hukuman", function () {
    $list = Hukuman::select("id", "hukuman as name")->whereNotNull('siasn_id')->orderBy('id', 'asc')->get();
    return response()->json(["data" => $list], 200);
});
Route::post("/master-pendidikan", function () {
    $list = Pendidikan::select("id as id", "name as name")->get();
    return response()->json(["data" => $list], 200);
});
Route::post("/master-pelanggaran", function () {
    $list = AlasanHukuman::select("id_hukuman as id", "nama_hukuman as name")->get();
    return response()->json(["data" => $list], 200);
});
Route::post("/master-peraturan-hukuman", function () {
    $array = [
        ["id" => "07", "name" => "PP 94 TAHUN 2021"],
        ["id" => "03", "name" => "PP 53 TAHUN 2010"],
    ];
    return response()->json(["data" => $array], 200);
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
