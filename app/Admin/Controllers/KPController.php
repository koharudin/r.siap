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
    public function getCatatan($user)
    {
        if ($user->obj_last_riwayat_jabatan) {
            if ($user->obj_last_riwayat_jabatan->tipe_jabatan_id == 1 || $user->obj_last_riwayat_jabatan->tipe_jabatan_id == 6) { //1/6 struktural
                $unit_kerja = $user->obj_last_riwayat_jabatan->obj_unit_kerja;

                if ($unit_kerja) {
                    if ($unit_kerja->obj_eselon) {
                        $obj_pangkat = $user->obj_last_riwayat_pangkat->obj_pangkat;
                        if ($obj_pangkat->id == $unit_kerja->obj_eselon->pangkat_max) {
                            return "MENTOK : struktural, PANGKAT MAX";
                        }
                    } else {
                        return "ERR : struktural, tidak ada obj_eselon";
                    }
                } else {
                    return "ERR : struktural , tidak ada obj_unit";
                }
                return "struktural ";
            } else  if ($user->obj_last_riwayat_jabatan->tipe_jabatan_id == 2) { //JFU
                $last_pendidikan = $user->obj_last_riwayat_pendidikan;
                if (!$last_pendidikan) {
                    return "MENTOK : Pelaksana, PANGKAT MAX, Tidak ada Riwayat";
                }
                $obj_parent  = $last_pendidikan->obj_pendidikan->obj_parent;
                if (!$obj_parent) {
                    return "ERR pelaksana, obj PARENT Last Pendidikan NULL ";
                }
                $obj_pangkat = $user->obj_last_riwayat_pangkat->obj_pangkat;
                if ($obj_parent->id == 237) { // s1
                    if ($obj_pangkat->id >= 34) {
                        return "MENTOK : Pelaksana, PANGKAT MAX";
                    }
                } else if ($obj_parent->id == 531) { // S2

                } else if ($obj_parent->id == 660) { // S3

                } else if ($obj_parent->id == 225) { // D4
                    if ($obj_pangkat->id >= 34) {
                        return "MENTOK : Pelaksana, PANGKAT MAX";
                    }
                } else if ($obj_parent->id == 115) { // D3
                    if ($obj_pangkat->id >= 33) {
                        return "MENTOK : Pelaksana, PANGKAT MAX";
                    }
                } else { //D2 ke bawah
                    return "MENTOK : Pelaksana, PANGKAT MAX";
                }
                //Jika pelaksana maka jika pendidikan terakhir D3 maka IIIc, jika S1 maka IIId, jika DII ke bawah maka IIIb
                return "pelaksana, LASTPEND ";
            } else  if ($user->obj_last_riwayat_jabatan->tipe_jabatan_id == 3) { //JFT
                return "fungsional";
            }
        } else return "Tidak ada data jabatan terakhir";
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
        })->with(['obj_last_riwayat_pendidikan.obj_pendidikan.obj_parent', 'obj_last_riwayat_jabatan.obj_unit_kerja.obj_eselon', 'obj_riwayat_jabatan', 'obj_last_riwayat_pangkat.obj_pangkat']);
        // diluar fungsional
        $query->whereHas('obj_last_riwayat_jabatan', function ($query) {
            $query->whereNotIn('tipe_jabatan_id', [3, 4, 5]);
        });
        $query->orderBy('first_name', 'asc');
        $employees = $query->get();
        $data = [];
        $employees->each(function ($user, $i) use (&$data) {
            $unit_kerja = '';
            if ($user->obj_satker) {
                $unit_kerja =  $user->obj_satker->name;
            } else $unit_kerja = "Belum di tempatkan!";

            $pangkat_text = '';
            $last = $user->obj_riwayat_pangkat->last();
            if ($last) {
                if ($last->obj_pangkat) {
                    $pangkat_text =  $last->obj_pangkat->name . " - " . $last->obj_pangkat->kode;
                } else   $pangkat_text = 'Tidak ditemukan obj_pangkat pada riwayat pada pegawai  $user->nip_baru';
            } else $pangkat_text = 'Tidak ditemukan riwayat pada pegawai  $user->nip_baru';

            $jabatan = '';
            $last = $user->obj_riwayat_jabatan->last();
            if ($last) {
                $jabatan =  $last->nama_jabatan;
            } else $jabatan = 'Tidak ditemukan riwayat  pada pegawai  $user->nip_baru';


            $nama = $user->first_name;


            $catatan = $this->getCatatan($user);

            $filter_periode = request()->input('periode_kp');
            if (!$filter_periode) {
                return response()->json("Tidak ada filter periode_kp", 500);
            }
            $last = $user->obj_last_riwayat_pangkat;

            $rentang_waktu = '';
            if ($last) {
                if (!$last->tmt_pangkat) {
                    return response()->json("Tidak ada TMT Pangkat pada pegawai  $user->nip_baru", 500);
                }
                if ($filter_periode) {
                    $dt_periode = Carbon::createFromFormat('Y/m/d', $filter_periode);
                    $rentang_waktu = $last->tmt_pangkat->diff($dt_periode)->format('%y tahun, %m bulan and %d hari');
                }
            } else $rentang_waktu = "Tidak ada riwayat KP pada pegawai  $user->nip_baru";

            $data[] = [
                'nip' => $user->nip_baru,
                'unit_kerja' => $unit_kerja,
                'pangkat_text' => $pangkat_text,
                'jabatan' => $jabatan,
                'nama' => $nama,
                'catatan' => $catatan,
                'rentang_waktu' => $rentang_waktu
            ];
        });
        $TBS->MergeBlock('r', $data);
        $now = Carbon::now();
        $today = $now->isoFormat('dddd, D MMMM Y');
        $today_ymd = $now->isoFormat('YMMDD');
        $TBS->Show(OPENTBS_DOWNLOAD, "cetak_kandidat_usulan_kp_reguler_{$today_ymd}.xlsx");
        return response()->json($data, 200);
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
                if (@$param['name'] == 'periode_kp') {
                    $filter_periode = $param['value'];
                }
            }
        }
        $filter_pengecekan = false;
        $query = Employee::whereIn('status_pegawai_id', [1, 2]) //only cpns & pns
            ->with(['obj_last_riwayat_pendidikan.obj_pendidikan.obj_parent', 'obj_last_riwayat_jabatan.obj_unit_kerja.obj_eselon', 'obj_riwayat_jabatan', 'obj_last_riwayat_pangkat.obj_pangkat']);
        $query->orderBy('first_name', 'asc');
        $dt_periode = Carbon::createFromFormat('Y/m/d', $filter_periode);

        if ($filter_periode && !$filter_pengecekan) {

            $query->whereHas('obj_last_riwayat_pangkat', function ($query) use ($dt_periode) {
                $query->whereRaw("DATE_PART('year', AGE('{$dt_periode->format('Y-m-d')}'::date,tmt_pangkat::date))>=4");
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
            ->only(['no', 'action', 'catatan', 'first_name', 'intro', 'nip_baru', 'jabatan', 'pangkat_terakhir', 'rentang_waktu'])
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
            ->addColumn('catatan', function (Employee $user) {
                return $this->getCatatan($user);
            })
            ->addColumn('rentang_waktu', function (Employee $user) use ($filter_periode) {

                $last = $user->obj_last_riwayat_pangkat;
                if ($last) {
                    if ($filter_periode) {
                        $dt_periode = Carbon::createFromFormat('Y/m/d', $filter_periode);
                        return  $last->tmt_pangkat->diff($dt_periode)->format('%y tahun, %m bulan and %d hari');
                    }
                    return "Periode belum ditentukan";
                }
                return "Tidak ada riwayat KP";
            })
            ->escapeColumns(['rentang_waktu'])
            ->make(true);
    }
}
