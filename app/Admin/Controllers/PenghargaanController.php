<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\DetailPegawaiAction;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use Carbon\Carbon;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use DataTables;
use Illuminate\Support\Facades\URL;
use Log;
use MBence\OpenTBSBundle\Services\OpenTBS;

class PenghargaanController extends Controller
{
    public $title  = 'Penghargaan';
    public function index(Content $content)
    {
        Admin::js('js/v_penghargaan.js');

        return $content
            ->title($this->title)
            ->body(view("v_penghargaan", ['url_cetak' => URL::to('/admin/penghargaan/cetak')]));
    }
    public function cetak()
    {
        $TBS = new OpenTBS();
        \Carbon\Carbon::setLocale('id');
        $file = storage_path('../templates/cetak_penghargaan.xlsx');

        $TBS->LoadTemplate($file);

        $filter_jenis = request()->input('jenis');
        $query = Employee::whereHas('obj_riwayat_penghargaan', function ($query) use ($filter_jenis) {
            if ($filter_jenis) {
                $query->where('jenis_penghargaan_id', $filter_jenis);
            }
        })->with(['obj_riwayat_jabatan', 'obj_satker', 'obj_riwayat_pangkat.obj_pangkat', 'obj_riwayat_penghargaan']);

        $employees = $query->get();
        $data = [];
        $employees->each(function ($user, $i) use (&$data) {
            $unit_kerja = '';
            if ($user->obj_satker) {
                $unit_kerja =  $user->obj_satker->name;
            } else $unit_kerja = "Belum di tempatkan!";

            $golongan = '';
            $last = $user->obj_riwayat_pangkat->last();
            $golongan =  $last->obj_pangkat->name . " - " . $last->obj_pangkat->kode;

            $jabatan = '';
            $last = $user->obj_riwayat_jabatan->last();
            $jabatan =  $last->nama_jabatan;

            $nama = $user->first_name;

            $list = [];
            $user->obj_riwayat_penghargaan->each(function ($o, $i) use (&$list) {
                $list[] = $o->nama_penghargaan;
            });
            $penghargaan = implode(",", $list);

            $data[] = [
                'nip' => $user->nip_baru,
                'unit_kerja' => $unit_kerja,
                'gol' => $golongan,
                'jabatan' => $jabatan,
                'nama' => $nama,
                'penghargaan' => $penghargaan
            ];
        });
        $TBS->MergeBlock('r', $data);
        $now = Carbon::now();
        $today = $now->isoFormat('dddd, D MMMM Y');
        $today_ymd = $now->isoFormat('YMMDD');
        $TBS->Show(OPENTBS_DOWNLOAD, "cetak_penghargaan_{$today_ymd}.xlsx");
        return response()->json($data, 200);
    }
    public function dt()
    {
        $params = request('extra_search');
        $filter_jenis = null;
        if ($params) {
            foreach ($params as $param) {
                if (@$param['name'] == 'kriteria') {
                    //$param['value']    
                }
                if (@$param['name'] == 'jenis') {
                    $filter_jenis = $param['value'];
                }
            }
        }

        $query = Employee::whereHas('obj_riwayat_penghargaan', function ($query) use ($filter_jenis) {
            if ($filter_jenis) {
                $query->where('jenis_penghargaan_id', $filter_jenis);
            }
        })->with(['obj_riwayat_jabatan', 'obj_satker', 'obj_riwayat_pangkat.obj_pangkat', 'obj_riwayat_penghargaan']);
        $query->orderBy('first_name', 'asc');
        return  DataTables::eloquent($query)
            ->only(['no', 'action', 'first_name', 'intro', 'nip_baru', 'jabatan', 'pangkat', 'unit_kerja', 'jenis_penghargaan'])
            ->addIndexColumn()
            ->addColumn('no', function (Employee $user) {
                return 'Hi ' . $user->name . '!';
            })
            ->addColumn('unit_kerja', function (Employee $user) {
                if ($user->obj_satker) {
                    return $user->obj_satker->name;
                }
                return "Belum di tempatkan!";
            })
            ->addColumn('jenis_penghargaan', function (Employee $user) {
                $list = [];
                $user->obj_riwayat_penghargaan->each(function ($o, $i) use (&$list) {
                    $list[] = $o->nama_penghargaan;
                });
                return implode(",", $list);
            })
            ->addColumn('jabatan', function (Employee $user) {
                $last = $user->obj_riwayat_jabatan->last();
                return  $last->nama_jabatan;
            })
            ->addColumn('pangkat', function (Employee $user) {
                $last = $user->obj_riwayat_pangkat->last();
                return  $last->obj_pangkat->name . " - " . $last->obj_pangkat->kode;
            })
            /* ->addColumn('action', function ($row) {
                $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            */
            ->make(true);
    }
}
