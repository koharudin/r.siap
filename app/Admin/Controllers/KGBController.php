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

class KGBController extends Controller
{
    public $title  = 'Kenaikan Gaji Berkala';
    public function index(Content $content)
    {
        Admin::js('plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js');
        Admin::js('plugins/bootstrap-datetimepicker/cs/bootstrap-datetimepicker.min.css');
        return $content
            ->title($this->title)
            ->body(view("v_kgb", ['url_cetak' => URL::to('/admin/kgb/cetak')]));
    }
    public function cetak()
    {
        $TBS = new OpenTBS();
        \Carbon\Carbon::setLocale('id');
        $file = storage_path('../templates/kandidat_kgb.xlsx');

        $TBS->LoadTemplate($file);

        $filter_nip = request()->input('nip');
        $filter_nama = request()->input('nama');
        $filter_periode = request()->input('periode_kgb');


        $employees = $this->dtable($filter_nip, $filter_nama, $filter_periode)->get();
        $data = [];
        $employees->each(function ($user, $i) use (&$data, $filter_periode) {
            $unit_kerja = 'Belum di tempatkan!';
            if ($user->obj_satker) {
                $unit_kerja =  $user->obj_satker->name;
            }
            $jabatan = '';
            $last = $user->obj_riwayat_jabatan->last();
            if ($last) $jabatan =  $last->nama_jabatan;

            $kgbt = '';
            $last = $user->obj_last_riwayat_kgb;
            if ($last) {
                $tmt_sk = '-';
                if ($last->tmt_sk) {
                    $tmt_sk = $last->tmt_sk->format('Y-m-d');
                }
                $tgl_sk = '-';
                if ($last->tgl_sk) {
                    $tgl_sk = $last->tgl_sk->format('Y-m-d');
                }
                $kgbt =   $last->no_sk . " \n TGL SK : " . $tgl_sk . "\n TMT SK : {$tmt_sk}";
            }
            $rw = '';

            $last = $user->obj_last_riwayat_kgb;
            if ($last) {
                if ($filter_periode) {
                    $dt_periode = Carbon::createFromFormat('Y/m/d', $filter_periode);
                    if ($last->tmt_sk) {
                        $rw =   $last->tmt_sk->diff($dt_periode)->format('%y tahun, %m bulan and %d hari');
                    } else  $rw = "Tidak diketahui TMT SK";
                } else $rw =  "Periode belum ditentukan";
            } else  $rw =  "Tidak ada riwayat KP";
            $data[] = [
                'nip' => $user->nip_baru,
                'unit_kerja' => $unit_kerja,
                'nama' => $user->first_name,
                'jabatan' => $jabatan,
                'kgbt' => $kgbt,
                'rw' => $rw
            ];
        });
        $TBS->MergeBlock('r', $data);
        $now = Carbon::now();
        $today = $now->isoFormat('dddd, D MMMM Y');
        $today_ymd = $now->isoFormat('YMMDD');
        $TBS->Show(OPENTBS_DOWNLOAD, "kandidat_kgb_{$today_ymd}.xlsx");
        return response()->json($data, 200);
    }
    public function dtable($filter_nip, $filter_nama, $filter_periode)
    {
        $query = Employee::whereIn('status_pegawai_id', [1, 2]) //only cpns & pns
            ->with(['obj_riwayat_jabatan', 'obj_riwayat_skcpns', 'obj_last_riwayat_kgb']);
        $query->orderBy('first_name', 'asc');
        $dt_periode = Carbon::createFromFormat('Y/m/d', $filter_periode);

        if ($filter_periode) {

            $query->whereHas('obj_last_riwayat_kgb', function ($query) use ($dt_periode) {
                // $query->whereRaw("DATE_PART('year', AGE('{$dt_periode->format('Y-m-d')}'::date,tmt_sk::date))>=2");
            });
        }
        if ($filter_nama) {
            $query->where('first_name', 'ilike', "%{$filter_nama}%");
        }
        if ($filter_nip) {
            $query->where('nip_baru', 'ilike', "%{$filter_nip}%");
        }

        return $query;
    }
    public function dt()
    {
        $params = request('extra_search');
        $filter_nama = null;
        $filter_nip = null;
        $filter_periode = null;
        $filter_pengecekan = null;
        if ($params) {
            foreach ($params as $param) {
                if (@$param['name'] == 'nama') {
                    $filter_nama = $param['value'];
                }
                if (@$param['name'] == 'nip') {
                    $filter_nip = $param['value'];
                }
                if (@$param['name'] == 'periode_kgb') {
                    $filter_periode = $param['value'];
                }
            }
        }
        $filter_pengecekan = false;
        $query = $this->dtable($filter_nip, $filter_nama, $filter_periode);
        return  DataTables::eloquent($query)
            ->only(['no', 'action', 'first_name', 'intro', 'nip_baru', 'jabatan', 'kgb_terakhir', 'rentang_waktu'])
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
            ->addColumn('kgb_terakhir', function (Employee $user) {
                $last = $user->obj_last_riwayat_kgb;
                if ($last) {
                    $tmt_sk = '-';
                    if ($last->tmt_sk) {
                        $tmt_sk = $last->tmt_sk->format('Y-m-d');
                    }
                    $tgl_sk = '-';
                    if ($last->tgl_sk) {
                        $tgl_sk = $last->tgl_sk->format('Y-m-d');
                    }
                    return  $last->no_sk . " <br>TGL SK : " . $tgl_sk . "<br>TMT SK : <b>{$tmt_sk}</b>";
                }
            })
            ->addColumn('rentang_waktu', function (Employee $user) use ($filter_periode) {

                $last = $user->obj_last_riwayat_kgb;
                if ($last) {
                    if ($filter_periode) {
                        $dt_periode = Carbon::createFromFormat('Y/m/d', $filter_periode);
                        if ($last->tmt_sk) {
                            return  $last->tmt_sk->diff($dt_periode)->format('%y tahun, %m bulan and %d hari');
                        } else return "Tidak diketahui TMT SK";
                    }
                    return "Periode belum ditentukan";
                }
                return "Tidak ada riwayat KP";
            })
            ->escapeColumns(['rentang_waktu'])
            ->make(true);
    }
}
