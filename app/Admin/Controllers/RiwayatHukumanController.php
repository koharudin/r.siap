<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\DetailPegawaiAction;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\RiwayatHukuman;
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

class RiwayatHukumanController extends Controller
{
    public $title  = 'Riwayat Hukuman Disiplin';
    public function index(Content $content)
    {
        return $content
            ->title($this->title)
            ->body(view("v_riwayat_hukuman", ['url_cetak' => URL::to('/admin/riwayat_hukuman/cetak')]));
    }
    public function cetak()
    {
        $TBS = new OpenTBS();
        \Carbon\Carbon::setLocale('id');
        $file = storage_path('../templates/cetak_riwayat_hukuman.xlsx');

        $TBS->LoadTemplate($file);

        $filter_nama = request()->input('nama');
        $filter_nip = request()->input('nip');
        $query = RiwayatHukuman::whereHas('obj_employee', function ($q) use ($filter_nama, $filter_nip) {
            if ($filter_nip) {
                $q->where('nip_baru', 'ilike', "%{$filter_nip}%");
            }
            if ($filter_nama) {
                $q->where('first_name', 'ilike', "%{$filter_nama}%");
            }
        });
        $query->orderBy('tmt_sk', 'DESC');

        $records = $query->get();
        $data = [];
        $records->each(function ($record, $i) use (&$data) {
            $tmt_sk  = '-';
            if ($record->tmt_sk) {
                $tmt_sk = $record->tmt_sk->format('Y-m-d');
            }
            $data[] = [
                'first_name' => $record->obj_employee->first_name,
                'nip' => $record->obj_employee->nip_baru,
                'pelanggaran' => $record->pelanggaran,
                'pejabat_penetap' => $record->pejabat_penetap_jabatan,
                'tmt_sk' => $tmt_sk
            ];
        });
        $TBS->MergeBlock('r', $data);
        $now = Carbon::now();
        $today = $now->isoFormat('dddd, D MMMM Y');
        $today_ymd = $now->isoFormat('YMMDD');
        $TBS->Show(OPENTBS_DOWNLOAD, "cetak_riwayat_hukuman_{$today_ymd}.xlsx");
        return response()->json($data, 200);
    }
    public function dt()
    {
        $params = request('extra_search');
        $filter_nip = null;
        $filter_nama = null;
        $filter_tahun = null;
        if($params) {
            foreach($params as $param) {
                if(@$param['name'] == 'nip') {
                    $filter_nip = $param['value'];
                }
                if(@$param['name'] == 'nama') {
                    $filter_nama = $param['value'];
                }
                if(@$param['name'] == 'tahun') {
                    $filter_tahun = $param['value'];
                }
            }
        }

        $query = RiwayatHukuman::whereHas('obj_employee', function($q) use($filter_nama, $filter_nip, $filter_tahun) {
            if($filter_nip) {
                $q->where('nip_baru', 'ilike', "%{$filter_nip}%");
            }
            if($filter_nama) {
                $q->where('first_name', 'ilike', "%{$filter_nama}%");
            }
            if($filter_tahun) {
                $q->where('tgl_sk', 'like', "%{$filter_tahun}%");
            }
        });
        $query->orderBy('tgl_sk', 'DESC');
        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->addColumn('first_name', function(RiwayatHukuman $rw) {
                return $rw->obj_employee->first_name;
            })
            ->addColumn('nip_baru', function(RiwayatHukuman $rw) {
                return $rw->obj_employee->nip_baru;
            })
            ->addColumn('nama_hukuman', function(RiwayatHukuman $rw) {
                $val = "-";
                if($rw->tingkat_hukuman == "R") {
                    $val = "Hukdis Ringan";
                } else if($rw->tingkat_hukuman == "S") {
                    $val = "Hukdis Sedang";
                } else if($rw->tingkat_hukuman == "B") {
                    $val = "Hukdis Berat";
                } else if($rw->tingkat_hukuman == "K") {
                    $val = "Hukuman Kode Etik";
                }
                if(!empty($rw->obj_hukuman->hukuman)) {
                    if($val == "-") {
                        $val = $rw->obj_hukuman->hukuman;
                    } else {
                        $val .= " - ".$rw->obj_hukuman->hukuman;
                    }
                }
                return $val;
            })
            ->addColumn('pelanggaran', function(RiwayatHukuman $rw) {
                if(!empty($rw->obj_alasan->nama_hukuman)) {
                    return $rw->obj_alasan->nama_hukuman;
                } else {
                    return '-';
                }
                })
            ->addColumn('pejabat_penetap', function(RiwayatHukuman $rw) {
                return $rw->pejabat_penetap_jabatan;
            })
            ->addColumn('tgl_sk', function(RiwayatHukuman $rw) {
                if($rw->tgl_sk) {
                    return $rw->tgl_sk->format('Y-m-d');
                }
                return '-';
            })
            ->make(true);
    }
}
