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

class KPController extends Controller
{
    public $title  = 'Kenaikan Pangkat';
    public function index(Content $content)
    {
        Admin::js('plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js');
        Admin::js('plugins/bootstrap-datetimepicker/cs/bootstrap-datetimepicker.min.css');
        return $content
            ->title($this->title)
            ->body(view("v_kp", ['url_cetak' => URL::to('/admin/kp/cetak')]));
    }
    public function cetak()
    {
        $TBS = new OpenTBS();
        \Carbon\Carbon::setLocale('id');
        $file = storage_path('../templates/cetak_kp.xlsx');

        $TBS->LoadTemplate($file);

        $filter_jenis = request()->input('jenis');
        $query = Employee::whereHas('obj_riwayat_pangkat', function ($query) use ($filter_jenis) {
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
        $filter_nama = null;
        $filter_nip = null;
        $filter_periode = null;
        if ($params) {
            foreach ($params as $param) {
                if (@$param['name'] == 'nama') {
                    $filter_nama = $param['value'];
                }
                if (@$param['name'] == 'nip') {
                    $filter_nip = $param['value'];
                }
                if (@$param['name'] == 'periode_kp') {
                    $filter_periode = $param['value'];
                }
            }
        }
        $query = Employee::whereIn('status_pegawai_id', [1, 2]) //only cpns & pns
            ->with(['obj_riwayat_jabatan', 'obj_last_riwayat_pangkat']);
        $query->orderBy('first_name', 'asc');
        if ($filter_periode) {
            $dt_periode = Carbon::createFromFormat('Y/m/d', $filter_periode);
            $query->whereHas('obj_last_riwayat_pangkat', function ($query) use ($dt_periode) {
                $query->whereRaw("DATE_PART('year', AGE('{$dt_periode->format('Y-m-d')}'::date,tmt_pangkat::date))>4");
            });
        }
        if ($filter_nama) {
            $query->where('first_name', 'ilike', "%{$filter_nama}%");
        }
        if ($filter_nip) {
            $query->where('nip_baru', 'ilike', "%{$filter_nip}%");
        }

        // diluar fungsional
        $query->whereHas('obj_last_riwayat_jabatan', function ($query) use ($dt_periode) {
            $query->whereNotIn('tipe_jabatan_id', [3, 4, 5]);
        });
        return  DataTables::eloquent($query)
            ->only(['no', 'action', 'first_name', 'intro', 'nip_baru', 'jabatan', 'pangkat_terakhir', 'rentang_waktu'])
            ->addIndexColumn()

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
                if ($last) return $last->nama_jabatan;
                else return "Jabatan tidaka ada";
            })
            ->addColumn('pangkat_terakhir', function (Employee $user) {
                $last = $user->obj_last_riwayat_pangkat;
                if ($last) {
                    return  $last->obj_pangkat->name . " - " . $last->obj_pangkat->kode . "<br><b>{$last->tmt_pangkat->format('Y-m-d')}</b>";
                }
            })
            ->addColumn('rentang_waktu', function (Employee $user) use ($filter_periode) {

                $last = $user->obj_last_riwayat_pangkat;
                if ($last) {
                    if ($filter_periode) {
                        $dt_periode = Carbon::createFromFormat('Y/m/d', $filter_periode);
                        return $last->tmt_pangkat->diff($dt_periode)->format('%y tahun, %m bulan and %d hari');
                    }
                    return "Periode belum ditentukan";
                }
                return "Tidak ada riwayat KP";
            })
            ->escapeColumns(['rentang_waktu'])
            ->make(true);
    }
}
