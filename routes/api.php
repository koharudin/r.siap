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
use App\Http\Controllers\VerifikasiUsulanController;
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
use App\Models\Presensi\RiwayatIzin;
use Carbon\Carbon;
use Encore\Admin\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

Route::get('cekpresensi', function () {
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

Route::post('/login-token', function () {
    $username = request()->input("username");
    $password = request()->input("password");
    $user = Administrator::where("username", $username)->get()->first();
    if (!$user) {
        return response()->json("User tidak ditemukan", 404);
    }
    if (md5($password) == $user->password_x) {

        $token = $user->createToken('authToken')->accessToken;
        return response()->json([
            "token" => $token,
            "user" => $user
        ], 200);
    } else return response()->json("Kombinasi user dan password tidak cocok", 404);
});
Route::group(["middleware" => "auth:api"], function () {
    Route::post("menus", function () {
        $user = Auth::user();
        $user->load('roles');
        $isVerifikator = false;
        $isPegawai = false;
        $user->roles->each(function ($v, $i) use (&$isVerifikator, &$isPegawai) {
            if ($v->id == 5) $isVerifikator = true;
            if ($v->id == 2) $isPegawai = true;
        });
        $items = [];
        $child = new stdClass;
        $child->id = "ui-element";
        $child->title = "Usulan";
        $child->type =  "group";
        $child->icon = "icon-ui";
        $child->children = [];
        $items[] = $child;

        $item = new stdClass;
        $item->id = "dashboard";
        $item->title = "Dashboard";
        $item->type =  "item";
        $item->icon = "feather icon-server";
        $item->url = '/dashboard';
        $child->children[] = $item;

        if ($isPegawai) {
            $item = new stdClass;
            $item->id = "menu-daftar-usulan";
            $item->title = "Daftar Usulan";
            $item->type =  "item";
            $item->icon = "feather icon-server";
            $item->url = '/usulan-ku/daftar-usulan';
            $child->children[] = $item;
        }
        if ($isVerifikator) {
            $item = new stdClass;
            $item->id = "verifikasi-usulan";
            $item->title = "Verifikasi Usulan";
            $item->type =  "item";
            $item->icon = "feather icon-server";
            $item->url = '/verifikasi-usulan';
            $child->children[] = $item;
        }
        return response()->json([
            "items" => $items
        ]);
    });
    Route::get("usulan-saya", [DaftarUsulanController::class, "list"]);
    Route::get("verifikasi-usulan", [VerifikasiUsulanController::class, "list"]);
    Route::get("usulan/{uuid}/detail", [DaftarUsulanController::class, "detail"]);
    Route::post("usulan/{uuid}/hapus", [DaftarUsulanController::class, "hapus"]);
    Route::post("usulan", [DaftarUsulanController::class, "store"]);
    Route::post("on-verify", [VerifikasiController::class, "doVerify"]);
    Route::get('me', [AdminEmployeeController::class, 'dataSaya']);
    Route::get('me/informasi-pegawai', [AdminEmployeeController::class, 'informasiPegawai']);
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
    $query = Jabatan::query();
    $tipe_jabatan = request()->input("tipe_jabatan");
    
    if($tipe_jabatan ==1 ){
        $query = UnitKerja::query();
    }
    else if ($tipe_jabatan ==2){
        $query->fungsional();
    }
    else if ($tipe_jabatan ==3){
        $query->pelaksana();
    }   
    $q = request()->input("q");
    $query->where("name","ilike","%{$q}%");
    return response()->json($query->paginate(), 200);
});
Route::get("/master-jabatan/detail", function () {
    $query = Jabatan::query();
    $tipe_jabatan = request()->input("tipe_jabatan");
    
    if($tipe_jabatan ==1 ){
        $query = UnitKerja::query();
    }
    else if ($tipe_jabatan ==2){
        $query->fungsional();
    }
    else if ($tipe_jabatan ==3){
        $query->pelaksana();
    }   
    $id = request()->input("id");
    $query->where("id",$id);
    $data = $query->get()->first();
    if ($data) {
        return response()->json($data, 200);
    } else return response()->json("data tidak ditemukan", 404);
});
Route::post("/master-pangkat", function () {
    return response()->json(Pangkat::paginate(), 200);
});
Route::get("/master-pangkat/{id}/detail", function ($id) {
    $query = Pangkat::query();
    $query->where("id", $id);
    $data = $query->get()->first();
    if ($data) {
        return response()->json($data, 200);
    } else return response()->json("data tidak ditemukan", 404);
});

Route::post("/master-unitkerja", function () {
    $query = UnitKerja::query();
    $q = request()->input("q");
    $query->where("name", "ilike", "%{$q}%");
    $query->orderBy("name", "asc");
    return response()->json($query->paginate(), 200);
});
Route::get("/master-jenis-diklat-siasn/{id}/detail", function ($id) {
    $query = DiklatSiasn::query();
    $query->where("id_siasn", $id);
    $data = $query->get()->first();
    if ($data) {
        return response()->json($data, 200);
    } else return response()->json("data tidak ditemukan", 404);
});
Route::get("/master-jenis-diklat-struktural/{id}/detail", function ($id) {

    $query = Diklat::query();
    $query->where("id", $id);
    $data = $query->get()->first();
    if ($data) {
        return response()->json($data, 200);
    } else return response()->json("data tidak ditemukan", 404);
});
Route::get("/master-jenis-diklat-fungsional/{id}/detail", function ($id) {

    $query = Diklat::query();
    $query->where("id", $id);
    $data = $query->get()->first();
    if ($data) {
        return response()->json($data, 200);
    } else return response()->json("data tidak ditemukan", 404);
});
Route::get("/master-jenis-diklat-teknis/{id}/detail", function ($id) {

    $query = Diklat::query();
    $query->where("id", $id);
    $data = $query->get()->first();
    if ($data) {
        return response()->json($data, 200);
    } else return response()->json("data tidak ditemukan", 404);
});
Route::get("/master-unitkerja/{id}/detail", function ($id) {
    $query = UnitKerja::query();
    $query->where("id", $id);
    $data = $query->get()->first();
    if ($data) {
        return response()->json($data, 200);
    } else return response()->json("data tidak ditemukan", 404);
});

Route::post("/master-jenis-kenaikan-gaji", function () {
    return response()->json(JenisKenaikanGaji::paginate(), 200);
});
Route::get("/master-jenis-kenaikan-gaji/{id}/detail", function ($id) {

    $query = JenisKenaikanGaji::query();
    $query->where("id", $id);
    $data = $query->get()->first();
    if ($data) {
        return response()->json($data, 200);
    } else return response()->json("data tidak ditemukan", 404);
});
Route::post("/master-jenis-bahasa", function () {
    return response()->json(JenisBahasa::paginate(), 200);
});
Route::post("/master-jenis-layanan", function () {
    if (request()->input('pagination') == "false") {
        return response()->json(RequestCategory::whereNotNull('parent_id')->orderBy('name', 'asc')->get(), 200);
    }
    return response()->json(RequestCategory::orderBy('name', 'asc')->paginate(), 200);
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
Route::get("/master-pejabat-penetap/{id}/detail", function ($id) {
    $query = PejabatPenetap::query();
    $query->where("id", $id);
    $data = $query->get()->first();
    if ($data) {
        return response()->json($data, 200);
    } else return response()->json("data tidak ditemukan", 404);
});
Route::get("/master-kemampuan-bicara/{id}/detail", function ($id) {
    $query = KemampuanBicara::query();
    $query->where("id", $id);
    $data = $query->get()->first();
    if ($data) {
        return response()->json($data, 200);
    } else return response()->json("data tidak ditemukan", 404);
});
Route::get("/master-jenis-bahasa/{id}/detail", function ($id) {
    $query = JenisBahasa::query();
    $query->where("id", $id);
    $data = $query->get()->first();
    if ($data) {
        return response()->json($data, 200);
    } else return response()->json("data tidak ditemukan", 404);
});
Route::get("/master-status-pernikahan/{id}/detail", function ($id) {
    $query = StatusMenikah::query();
    $query->where("id", $id);
    $data = $query->get()->first();
    if ($data) {
        return response()->json($data, 200);
    } else return response()->json("data tidak ditemukan", 404);
});
Route::get("/master-jenis-penghargaan/{id}/detail", function ($id) {
    $query = JenisPenghargaan::query();
    $query->where("id", $id);
    $data = $query->get()->first();
    if ($data) {
        return response()->json($data, 200);
    } else return response()->json("data tidak ditemukan", 404);
});
Route::get("/master-jenis-pekerjaan/{id}/detail", function ($id) {
    $query = JenisPekerjaan::query();
    $query->where("id", $id);
    $data = $query->get()->first();
    if ($data) {
        return response()->json($data, 200);
    } else return response()->json("data tidak ditemukan", 404);
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
Route::get("/master-tingkat-hukuman/{id}/detail", function ($id) {
    $array = [
        ["id" => "R", "name" => "Hukuman Ringan"],
        ["id" => "S", "name" => "Hukuman Sedang"],
        ["id" => "B", "name" => "Hukuman Berat"],
        ["id" => "K", "name" => "Hukuman Kode Etik"]
    ];
    foreach ($array as $arr) {
        if ($arr["id"] == $id) {
            return response()->json($arr, 200);
        }
    }
    return response()->json("data tidak ditemukan", 404);
});
Route::post("/master-jenis-hukuman", function () {
    $list = Hukuman::select("id", "hukuman as name")->whereNotNull('siasn_id')->orderBy('id', 'asc')->get();
    return response()->json(["data" => $list], 200);
});
Route::get("/master-jenis-hukuman/{id}/detail", function ($id) {
    $query = Hukuman::query();
    $query->select("id","hukuman as name");
    $query->where("id", $id);
    $data = $query->get()->first();
    if ($data) {
        return response()->json($data, 200);
    } else return response()->json("data tidak ditemukan", 404);
});
Route::post("/master-pendidikan", function () {
    $query = Pendidikan::query();
    $q = request()->input("q");
    $query->where("name", "ilike", "%{$q}%");
    $query->orderBy("name", "asc");
    return response()->json($query->paginate(), 200);
});
Route::post("/master-pelanggaran", function () {
    $list = AlasanHukuman::select("id_hukuman as id", "nama_hukuman as name")->get();
    return response()->json(["data" => $list], 200);
});
Route::get("/master-pelanggaran/{id}/detail", function ($id) {
    $query = AlasanHukuman::query();
    $query->select("id_hukuman as id", "nama_hukuman as name");
    $query->where("id_hukuman", $id);
    $data = $query->get()->first();
    if ($data) {
        return response()->json($data, 200);
    } else return response()->json("data tidak ditemukan", 404);
});
Route::get("/master-pendidikan/{id}/detail", function ($id) {
    $query = Pendidikan::query();
    $query->where("id", $id);
    $data = $query->get()->first();
    if ($data) {
        return response()->json($data, 200);
    } else return response()->json("data tidak ditemukan", 404);
});
Route::post("/master-peraturan-hukuman", function () {
    $array = [
        ["id" => "07", "name" => "PP 94 TAHUN 2021"],
        ["id" => "03", "name" => "PP 53 TAHUN 2010"],
    ];
    return response()->json(["data" => $array], 200);
});
Route::get("/master-peraturan-hukuman/{id}/detail", function ($id) {
    $array = [
        ["id" => "07", "name" => "PP 94 TAHUN 2021"],
        ["id" => "03", "name" => "PP 53 TAHUN 2010"],
    ];
    foreach ($array as $arr) {
        if ($arr["id"] == $id) {
            return response()->json($arr, 200);
        }
    }
    return response()->json("data tidak ditemukan", 404);
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


        Route::resource('requests', RequestController::class);
        Route::resource('line-approval', LineApproval::class);
    });
});
