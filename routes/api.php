<?php

use App\Models\Administrator;
use App\Models\Agama;
use App\Models\Employee;
use App\Models\Pangkat;
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

function getFlexiportConfig()
{
    $config = [
        "urlData" => URL::to('/') . "/api/flexiport?c=dt",
        "filters" => [
            [
                "label" => "NIP",
                "key" => "nip_baru",
                "type" => "text",
            ],
            [
                "label" => "Nama",
                "key" => "first_name",
                "type" => "text",
            ],
            [
                "label" => "Tempat Lahir",
                "key" => "birth_place",
                "type" => "text",
            ],
            [
                "label" => "Email",
                "key" => "email",
                "type" => "text",
            ],
            [
                "label" => "Nama Suami/Istri",
                "key" => "nama_suami_istri",
                "type" => "text",
            ],
            [
                "label" => "Agama",
                "key" => "agama",
                "type" => "select",
                "data" =>  [
                    "url" => URL::to('/') ."/api/flexiport?c=agama",
                    "root" => "",
                    "keyField" => "id",
                    "labelField" => "name",
                ],
            ],
            [
                "label" => "Umur",
                "key" => "age",
                "type" => "number",
                "customOptions" => [
                    [
                        "text" => "<=25",
                        "value" => "under25"
                    ],
                    [
                        "text" => ">25 & <=40",
                        "value" => "between 25-40"
                    ],
                    [
                        "text" => ">40",
                        "value" => "over>40"
                    ],
                ],

            ],
            [
                "label" => "Tipe Jabatan",
                "key" => "tipe_jabatan",
                "type" => "select",
                "data" => [
                    [
                        "text" => "Struktural",
                        "value" => "1",
                    ],
                    [
                        "text" => "Fungsional",
                        "value" => "3",
                    ],
                    [
                        "text" => "Pelaksana",
                        "value" => "2",
                    ],
                ],
            ],
        ],
        "cols" => [
            [
                "key" => "nip_baru",
                "label" => "NIP",
                "selected" => true,
            ],
            [
                "key" => "first_name",
                "label" => "Nama",
                "selected" => true,
            ],
            [
                "key" => "age",
                "label" => "Umur",
            ],
            [
                "key" => "jabatan_terakhir",
                "label" => "Jabatan Terakhir",
            ],
        ],

    ];

    return $config;
}
Route::post('flexiport', function () {
    $c = request()->input("c");
    if ($c == 'config') {
        return response()->json(getFlexiportConfig(), 200);
    } else if ($c == 'dt') {
        $list_filters = json_decode(request()->input('filters'));
        $query = Employee::orderBy('first_name', 'ASC');
        foreach ($list_filters as $filter) {
            if ($filter->key == 'first_name') {
                if ($filter->val == 'in') {
                    $query->where('first_name', "ilike", "%{$filter->parameter}%");
                }
                if ($filter->val == 'not') {
                    $query->notWhere('first_name', "ilike", "%{$filter->parameter}%");
                }
                if ($filter->val == '=') {
                    $query->where('first_name', $filter->val);
                }
            }
            if ($filter->key == 'birth_place') {
                if ($filter->val == 'in') {
                    $query->where('birth_place', "ilike", "%{$filter->parameter}%");
                }
                if ($filter->val == 'not') {
                    $query->notWhere('birth_place', "ilike", "%{$filter->parameter}%");
                }
                if ($filter->val == '=') {
                    $query->where('birth_place', $filter->val);
                }
            }
            if ($filter->key == 'agama') {
                $query->where('agama_id', $filter->val);
            }
            if ($filter->key == 'tipe_jabatan') {
                $query->whereHas('obj_last_riwayat_jabatan', function ($query) use ($filter) {
                    $query->where("tipe_jabatan_id", $filter->val);
                });
            }
            if ($filter->key == 'age') {
                if ($filter->val == '=') {
                    $query->whereRaw("EXTRACT('YEAR' FROM AGE(CURRENT_DATE, birth_date)) = ?", [$filter->parameter]);
                }
                if ($filter->val == '<=') {
                    $query->whereRaw("EXTRACT('YEAR' FROM AGE(CURRENT_DATE, birth_date)) <= ?", [$filter->parameter]);
                }
                if ($filter->val == '<') {
                    $query->whereRaw("EXTRACT('YEAR' FROM AGE(CURRENT_DATE, birth_date)) < ?", [$filter->parameter]);
                }
                if ($filter->val == '>=') {
                    $query->whereRaw("EXTRACT('YEAR' FROM AGE(CURRENT_DATE, birth_date)) >= ?", [$filter->parameter]);
                }
                if ($filter->val == '>') {
                    $query->whereRaw("EXTRACT('YEAR' FROM AGE(CURRENT_DATE, birth_date)) > ?", [$filter->parameter]);
                }
                if ($filter->val == 'under25') {
                    $query->whereRaw("EXTRACT('YEAR' FROM AGE(CURRENT_DATE, birth_date)) < ?", [25]);
                }
                if ($filter->val == 'betwen25-40') {
                    $query->whereRaw("? >= EXTRACT('YEAR' FROM AGE(CURRENT_DATE, birth_date)) <= ?", [25, 40]);
                }
            }
        }

        $list_columns = json_decode(request()->input('cols'));
        //memastikan relasi tersedia
        foreach ($list_columns as $column) {
            if ($column == 'jabatan_terakhir') {
                $query->with(['obj_last_riwayat_jabatan']);
            }
        }

        $l = $query->take(200)->get();
        $result = [];
        $now = Carbon::now();
        $l->each(function ($employee, $i) use (&$result, $list_columns, $now) {
            $record = [];
            foreach ($list_columns as $column) {
                if ($column == 'nip_baru') {
                    $record['nip_baru'] = $employee->nip_baru;
                }
                if ($column == 'age') {
                    if ($employee->birth_date) {
                        $record['age'] = $employee->birth_date->diff($now)->format('%y tahun, %m bulan and %d hari');
                    } else $record['age'] = '-';
                }
                if ($column == 'first_name') {
                    $record['first_name'] = $employee->first_name;
                }
                if ($column == 'jabatan_terakhir') {
                    $last_jabatan = $employee->obj_last_riwayat_jabatan;
                    if ($last_jabatan) {
                        $record['jabatan_terakhir'] = $last_jabatan->nama_jabatan;
                    } else $record['jabatan_terakhir'] = "Tidak ada jabatan";
                }
            }
            $result[] = $record;
        });
        return response()->json([
            "total" => sizeof($result),
            'data' => $result
        ], 200);
    }
    if ($c == 'agama') {
        $l = Agama::all();
        return response()->json($l, 200);
    }
    return response()->json([], 200);
});
