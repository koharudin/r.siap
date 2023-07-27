<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\DetailPegawaiAction;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\RiwayatPensiun;
use Carbon\Carbon;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Widgets\Tab as WidgetsTab;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class PensiunController extends Controller
{
    public $title  = 'Pensiun';
    public $activeTab = 'akan_pensiun';
    public function generateTab(){
        $tab = new WidgetsTab();
        $links = [
            'AKAN PENSIUN' => route('admin.pensiun.akan-pensiun'),
            'MPP' =>  route('admin.pensiun.mpp'),
            'TUSK' =>  route('admin.pensiun.tusk'),
            'ALBUM' =>  route('admin.pensiun.album'),
        ];
        foreach ($links as $k => $v) {
            if ($v === $this->activeTab) {
                $tab->addLink($k, $v, true);
            } else $tab->addLink($k, $v, false);
        }
        return $tab;
    }
    public function akan_pensiun(Content $content)
    {
        Admin::js('js/v_penghargaan.js');
        $this->activeTab = route('admin.pensiun.akan-pensiun');
        $tab = $this->generateTab();
        return $content
            ->title($this->title)
            ->body($tab)
            ->body(view("pensiun.akan_pensiun"));
    }
    public function mpp(Content $content){
        $this->activeTab = route('admin.pensiun.mpp');
        $tab = $this->generateTab();
        return $content
            ->title($this->title)
            ->body($tab)
            ->body(view("pensiun.mpp"));
    }
    public function tusk(Content $content){
        $this->activeTab = route('admin.pensiun.tusk');
        $tab = $this->generateTab();
        return $content
            ->title($this->title)
            ->body($tab)
            ->body(view("pensiun.tusk"));
    }
    public function album(Content $content){
        $this->activeTab = route('admin.pensiun.album');
        $tab = $this->generateTab();
        return $content
            ->title($this->title)
            ->body($tab)
            ->body(view("pensiun.album"));
    }
    public function dt_akan_pensiun()
    {
        $query = RiwayatPensiun::akanPensiun()->whereHas('obj_employee',function($query){
            $query->aktif();
        })->with(['obj_employee.obj_riwayat_jabatan', 'obj_employee.obj_satker', 'obj_employee.obj_riwayat_pangkat.obj_pangkat']);
        return  DataTables::eloquent($query)
            ->only(['no', 'sex', 'usia', 'action', 'first_name', 'intro', 'nip_baru', 'jabatan', 'pangkat', 'unit_kerja', 'tgl_pensiun', 'tmt_jabatan', 'sisa_masa_kerja'])
            ->addIndexColumn()
            ->addColumn('nip_baru', function (RiwayatPensiun $r) {
                return $r->obj_employee->nip_baru;
            })
            ->addColumn('sex', function (RiwayatPensiun $r) {
                return $r->obj_employee->sex;
            })
            ->addColumn('first_name', function (RiwayatPensiun $r) {
                return $r->obj_employee->first_name;
            })
            ->addColumn('unit_kerja', function (RiwayatPensiun $r) {
                if ($r->obj_employee->obj_satker) {
                    return $r->obj_employee->obj_satker->name;
                }
                return "Belum di tempatkan!";
            })
            ->addColumn('jabatan', function (RiwayatPensiun $r) {
                $last = $r->obj_employee->obj_riwayat_jabatan->last();
                return  $last->nama_jabatan;
            })
            ->addColumn('sisa_masa_kerja', function (RiwayatPensiun $r) {
                $days = $r->tgl_pensiun->diffInDays(Carbon::now());
                $month = (int) ($days / 30);
                $day = $days % 30;
                return  "{$month} Bulan {$day} Hari";
            })
            ->addColumn('usia', function (RiwayatPensiun $r) {
                $months = $r->obj_employee->usia;
                $thn = (int)($months / 12);
                $bl = $months % 12;
                return "{$thn} Tahun {$bl} Bulan";
            })
            ->addColumn('tmt_jabatan', function (RiwayatPensiun $r) {
                $last = $r->obj_employee->obj_riwayat_jabatan->last();
                if ($last) {
                    return $last->tmt_jabatan->format('d-m-Y');
                }
                return "-";
            })
            ->addColumn('tgl_pensiun', function (RiwayatPensiun $r) {
                $tgl_pensiun = $r->tgl_pensiun;
                if ($tgl_pensiun) {
                    return $tgl_pensiun->format('d-m-Y');
                }
                return "-";
            })
            ->addColumn('pangkat', function (RiwayatPensiun $r) {
                $last = $r->obj_employee->obj_riwayat_pangkat->last();
                return  $last->obj_pangkat->name . " - " . $last->obj_pangkat->kode;
            })

            ->make(true);
    }
    public function dt_mpp()
    {
        $query = Employee::aktif()->akanPensiun()->with(['obj_riwayat_jabatan', 'obj_satker', 'obj_riwayat_pangkat.obj_pangkat']);
        $query->orderBy('first_name', 'asc');
        return  DataTables::eloquent($query)
            ->only(['no', 'sex', 'usia', 'action', 'first_name', 'intro', 'nip_baru', 'jabatan', 'pangkat', 'unit_kerja', 'tgl_pensiun', 'tmt_jabatan', 'sisa_masa_kerja'])
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
            ->addColumn('jabatan', function (Employee $user) {
                $last = $user->obj_riwayat_jabatan->last();
                return  $last->nama_jabatan;
            })
            ->addColumn('sisa_masa_kerja', function (Employee $user) {
                $days = $user->tgl_pensiun->diffInDays(Carbon::now());
                $month = (int) ($days / 30);
                $day = $days % 30;
                return  "{$month} Bulan {$day} Hari";
            })
            ->addColumn('usia', function (Employee $user) {
                $months = $user->usia;
                $thn = (int)($months / 12);
                $bl = $months % 12;
                return "{$thn} Tahun {$bl} Bulan";
            })
            ->addColumn('tmt_jabatan', function (Employee $user) {
                $last = $user->obj_riwayat_jabatan->last();
                if ($last) {
                    return $last->tmt_jabatan->format('d-m-Y');
                }
                return "-";
            })
            ->addColumn('tgl_pensiun', function (Employee $user) {
                $tgl_pensiun = $user->tgl_pensiun;
                if ($tgl_pensiun) {
                    return $tgl_pensiun->format('d-m-Y');
                }
                return "-";
            })
            ->addColumn('pangkat', function (Employee $user) {
                $last = $user->obj_riwayat_pangkat->last();
                return  $last->obj_pangkat->name . " - " . $last->obj_pangkat->kode;
            })

            ->make(true);
    }
    public function dt_tusk()
    {
        $query = Employee::aktif()->akanPensiun()->with(['obj_riwayat_jabatan', 'obj_satker', 'obj_riwayat_pangkat.obj_pangkat']);
        $query->orderBy('first_name', 'asc');
        return  DataTables::eloquent($query)
            ->only(['no', 'sex', 'usia', 'action', 'first_name', 'intro', 'nip_baru', 'jabatan', 'pangkat', 'unit_kerja', 'tgl_pensiun', 'tmt_jabatan', 'sisa_masa_kerja'])
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
            ->addColumn('jabatan', function (Employee $user) {
                $last = $user->obj_riwayat_jabatan->last();
                return  $last->nama_jabatan;
            })
            ->addColumn('sisa_masa_kerja', function (Employee $user) {
                $days = $user->tgl_pensiun->diffInDays(Carbon::now());
                $month = (int) ($days / 30);
                $day = $days % 30;
                return  "{$month} Bulan {$day} Hari";
            })
            ->addColumn('usia', function (Employee $user) {
                $months = $user->usia;
                $thn = (int)($months / 12);
                $bl = $months % 12;
                return "{$thn} Tahun {$bl} Bulan";
            })
            ->addColumn('tmt_jabatan', function (Employee $user) {
                $last = $user->obj_riwayat_jabatan->last();
                if ($last) {
                    return $last->tmt_jabatan->format('d-m-Y');
                }
                return "-";
            })
            ->addColumn('tgl_pensiun', function (Employee $user) {
                $tgl_pensiun = $user->tgl_pensiun;
                if ($tgl_pensiun) {
                    return $tgl_pensiun->format('d-m-Y');
                }
                return "-";
            })
            ->addColumn('pangkat', function (Employee $user) {
                $last = $user->obj_riwayat_pangkat->last();
                return  $last->obj_pangkat->name . " - " . $last->obj_pangkat->kode;
            })

            ->make(true);
    }
    public function dt_album()
    {
        $query = Employee::aktif()->akanPensiun()->with(['obj_riwayat_jabatan', 'obj_satker', 'obj_riwayat_pangkat.obj_pangkat']);
        $query->orderBy('first_name', 'asc');
        return  DataTables::eloquent($query)
            ->only(['no', 'sex', 'usia', 'action', 'first_name', 'intro', 'nip_baru', 'jabatan', 'pangkat', 'unit_kerja', 'tgl_pensiun', 'tmt_jabatan', 'sisa_masa_kerja'])
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
            ->addColumn('jabatan', function (Employee $user) {
                $last = $user->obj_riwayat_jabatan->last();
                return  $last->nama_jabatan;
            })
            ->addColumn('sisa_masa_kerja', function (Employee $user) {
                $days = $user->tgl_pensiun->diffInDays(Carbon::now());
                $month = (int) ($days / 30);
                $day = $days % 30;
                return  "{$month} Bulan {$day} Hari";
            })
            ->addColumn('usia', function (Employee $user) {
                $months = $user->usia;
                $thn = (int)($months / 12);
                $bl = $months % 12;
                return "{$thn} Tahun {$bl} Bulan";
            })
            ->addColumn('tmt_jabatan', function (Employee $user) {
                $last = $user->obj_riwayat_jabatan->last();
                if ($last) {
                    return $last->tmt_jabatan->format('d-m-Y');
                }
                return "-";
            })
            ->addColumn('tgl_pensiun', function (Employee $user) {
                $tgl_pensiun = $user->tgl_pensiun;
                if ($tgl_pensiun) {
                    return $tgl_pensiun->format('d-m-Y');
                }
                return "-";
            })
            ->addColumn('pangkat', function (Employee $user) {
                $last = $user->obj_riwayat_pangkat->last();
                return  $last->obj_pangkat->name . " - " . $last->obj_pangkat->kode;
            })

            ->make(true);
    }
}
