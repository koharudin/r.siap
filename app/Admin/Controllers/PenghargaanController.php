<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\DetailPegawaiAction;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\RiwayatPenghargaan;
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
        $query = RiwayatPenghargaan::with(['obj_jenis_penghargaan', 'obj_employee', 'obj_employee.obj_satker', 'obj_employee.obj_riwayat_jabatan']);
        if ($filter_jenis) {
            $query->where('jenis_penghargaan_id', $filter_jenis);
        }

        $rps = $query->get();
        $data = [];
        $rps->each(function ($rp, $i) use (&$data) {
            $unit_kerja = '';
            if ($rp->obj_employee->obj_satker) {
                $unit_kerja =  $rp->obj_employee->obj_satker->name;
            } else $unit_kerja = "Belum di tempatkan!";

            $golongan = '';
            $last = $rp->obj_employee->obj_riwayat_pangkat->last();
            $golongan =  $last->obj_pangkat->name . " - " . $last->obj_pangkat->kode;

            $jabatan = '';
            $last = $rp->obj_employee->obj_riwayat_jabatan->last();
            $jabatan =  $last->nama_jabatan;

            $nama = $rp->obj_employee->first_name;

            $list = [];
            $penghargaan = $rp->obj_jenis_penghargaan->name;

            $data[] = [
                'nip' => $rp->obj_employee->nip_baru,
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
        $query = RiwayatPenghargaan::with(['obj_jenis_penghargaan', 'obj_employee', 'obj_employee.obj_satker', 'obj_employee.obj_riwayat_jabatan']);
        if ($filter_jenis) {
            $query->where('jenis_penghargaan_id', $filter_jenis);
        }
        $query->orderBy('tgl_sk', 'asc');
        return  DataTables::eloquent($query)
            ->addIndexColumn()
            ->addColumn('penghargaan', function (RiwayatPenghargaan $rp) {
                if ($rp->obj_jenis_penghargaan) {
                    return $rp->obj_jenis_penghargaan->name;
                }
            })
            ->addColumn('nip_baru', function (RiwayatPenghargaan $rp) {
                if ($rp->obj_employee->nip_baru) {
                    return $rp->obj_employee->nip_baru;
                }
            })
            ->addColumn('first_name', function (RiwayatPenghargaan $rp) {
                if ($rp->obj_employee->first_name) {
                    return $rp->obj_employee->first_name;
                }
            })
            ->addColumn('unit_kerja', function (RiwayatPenghargaan $rp) {
                if ($rp->obj_employee->obj_satker) {
                    return $rp->obj_employee->obj_satker->name;
                }
                return "Belum di tempatkan!";
            })

            ->addColumn('jabatan', function (RiwayatPenghargaan $rp) {
                $last = $rp->obj_employee->obj_riwayat_jabatan->last();
                return  $last->nama_jabatan;
            })
            ->addColumn('pangkat', function (RiwayatPenghargaan $rp) {
                $last = $rp->obj_employee->obj_riwayat_pangkat->last();
                return  $last->obj_pangkat->name . " - " . $last->obj_pangkat->kode;
            })
            ->make(true);
    }
}
