<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\Facades\DataTables;

class FlexiportController extends Controller
{
    //
    public function config()
    {
        $config = [
            "urlData" => URL::to('/') . "/api/flexiport?c=dt",
            "filters" => [
                [
                    "label" => "Status Pegawai",
                    "key" => "active_non_aktif",
                    "type" => "select",
                    "selected" => true,
                    "data" => [
                        [
                            "text" => "Pegawai Aktif",
                            "value" => "1",
                        ],
                        [
                            "text" => "Pegawai Non Aktif",
                            "value" => "2",
                        ],
                    ]
                ],
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
                        "url" => URL::to('/') . "/api/flexiport?c=agama",
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
        return response()->json($config, 200);
    }

    public function dt()
    {
        $list_filters = json_decode(request()->input('filters'));
        $query = Employee::orderBy('first_name', 'ASC');
        foreach ($list_filters as $filter) {
            if ($filter->key == 'active_non_aktif') {
                if ($filter->val == '1') { //pegawai aktif
                    $query->whereIn('status_pegawai_id', [1, 2]); //only cpns & pns
                } else if ($filter->val == '2') { //pegawai non aktif
                    $query->whereIn('status_pegawai_id', [10, 3, 8, 9]);
                }
            }
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
        $pageSize = 10;
        $page = request()->get('page', 1);
        $start = ($page - 1) * $pageSize;
        $total = $query->count();
        $query->skip($start)->take($pageSize);
        $dtb = DataTables::eloquent($query);
        $now = Carbon::now();
        foreach ($list_columns as $column) {
            if ($column == 'nip_baru') {
                $dtb->addColumn('nip_baru', function (Employee $employee) {
                    return $employee->nip_baru;
                });
            }
            if ($column == 'age') {
                $dtb->addColumn('age', function (Employee $employee) use ($now) {
                    if ($employee->birth_date) {
                        return $employee->birth_date->diff($now)->format('%y tahun, %m bulan and %d hari');
                    } else return '-';
                });
            }
            if ($column == 'first_name') {
                $dtb->addColumn('first_name', function (Employee $employee) {
                    return $employee->first_name;
                });
            }
            if ($column == 'jabatan_terakhir') {
                $dtb->addColumn('jabatan_terakhir', function (Employee $employee) {
                    $last_jabatan = $employee->obj_last_riwayat_jabatan;
                    if ($last_jabatan) {
                        return $last_jabatan->nama_jabatan;
                    } else return "Tidak ada jabatan";
                });
            }
        }
        return $dtb->with([
            'start' => $start,
            'page' => $page,
            'total' => $total
        ])->toJson();
    }
}
