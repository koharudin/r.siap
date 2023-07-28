<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\DetailPegawaiAction;
use App\Admin\Forms\FormAkan2MPP;
use App\Admin\Forms\FormMPP2TUSK;
use App\Admin\Forms\FormMPPAlbum;
use App\Admin\Forms\FormTUSKAlbum;
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
    public function generateTab()
    {
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
    public function mpp(Content $content)
    {
        $this->activeTab = route('admin.pensiun.mpp');
        $tab = $this->generateTab();
        return $content
            ->title($this->title)
            ->body($tab)
            ->body(view("pensiun.mpp"));
    }
    public function tusk(Content $content)
    {
        $this->activeTab = route('admin.pensiun.tusk');
        $tab = $this->generateTab();
        return $content
            ->title($this->title)
            ->body($tab)
            ->body(view("pensiun.tusk"));
    }
    public function album(Content $content)
    {
        $this->activeTab = route('admin.pensiun.album');
        $tab = $this->generateTab();
        return $content
            ->title($this->title)
            ->body($tab)
            ->body(view("pensiun.album"));
    }
    public function dt_akan_pensiun()
    {
        $query = Employee::aktif()->whereHas('obj_riwayat_pensiun', function ($q) {
            $q->akanPensiun();
        })->with(['obj_riwayat_jabatan', 'obj_satker', 'obj_riwayat_pangkat.obj_pangkat']);
        return  DataTables::eloquent($query)
            ->only(['no', 'sex', 'usia', 'action', 'first_name', 'intro', 'nip_baru', 'jabatan', 'pangkat', 'unit_kerja', 'tgl_pensiun', 'tmt_jabatan', 'sisa_masa_kerja'])
            ->addIndexColumn()
            ->addColumn('nip_baru', function (Employee $u) {
                return $u->nip_baru;
            })
            ->addColumn('sex', function (Employee $u) {
                return $u->sex;
            })
            ->addColumn('first_name', function (Employee $u) {
                return $u->first_name;
            })
            ->addColumn('unit_kerja', function (Employee $u) {
                if ($u->obj_satker) {
                    return $u->obj_satker->name;
                }
                return "Belum di tempatkan!";
            })
            ->addColumn('jabatan', function (Employee $u) {
                $last = $u->obj_riwayat_jabatan->last();
                return  $last->nama_jabatan;
            })
            ->addColumn('sisa_masa_kerja', function (Employee $u) {
                $days = $u->obj_riwayat_pensiun->tgl_pensiun->diffInDays(Carbon::now());
                $month = (int) ($days / 30);
                $day = $days % 30;
                return  "{$month} Bulan {$day} Hari";
            })
            ->addColumn('usia', function (Employee $u) {
                $months = $u->usia;
                $thn = (int)($months / 12);
                $bl = $months % 12;
                return "{$thn} Tahun {$bl} Bulan";
            })
            ->addColumn('tmt_jabatan', function (Employee $u) {
                $last = $u->obj_riwayat_jabatan->last();
                if ($last) {
                    return $last->tmt_jabatan->format('d-m-Y');
                }
                return "-";
            })
            ->addColumn('tgl_pensiun', function (Employee $u) {
                $tgl_pensiun = $u->obj_riwayat_pensiun->tgl_pensiun;
                if ($tgl_pensiun) {
                    return $tgl_pensiun->format('d-m-Y');
                }
                return "-";
            })
            ->addColumn('pangkat', function (Employee $u) {
                $last = $u->obj_riwayat_pangkat->last();
                return  $last->obj_pangkat->name . " - " . $last->obj_pangkat->kode;
            })
            ->addColumn('action', function (Employee $user) {
                return "<a class='btn btn-danger' href='" . route('admin.pensiun.akan2mpp.form',$user->id) . "'>Pindah ke MPP</a>";
            })
            ->make(true);
    }
    public function dt_mpp()
    {
        $query = Employee::aktif()->whereHas('obj_riwayat_pensiun', function ($q) {
            $q->mpp();
        })->with(['obj_riwayat_jabatan', 'obj_satker', 'obj_riwayat_pangkat.obj_pangkat']);
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
            ->addColumn('sisa_masa_kerja', function (Employee $u) {
                $days = $u->obj_riwayat_pensiun->tgl_pensiun->diffInDays(Carbon::now());
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
            ->addColumn('tgl_pensiun', function (Employee $u) {
                $tgl_pensiun = $u->obj_riwayat_pensiun->tgl_pensiun;
                if ($tgl_pensiun) {
                    return $tgl_pensiun->format('d-m-Y');
                }
                return "-";
            })
            ->addColumn('pangkat', function (Employee $user) {
                $last = $user->obj_riwayat_pangkat->last();
                return  $last->obj_pangkat->name . " - " . $last->obj_pangkat->kode;
            })
            ->addColumn('action', function (Employee $user) {
                return "<a class='btn btn-warning' href='" . route('admin.pensiun.mpp2tusk.form',$user->id) . "'>Pindah ke TUSK</a><a class='btn btn-danger' href='" . route('admin.pensiun.mpp2album.form',$user->id) . "'>Pindah ke ALBUM</a>";

            })
            ->make(true);
    }
    public function dt_tusk()
    {
        $query = Employee::aktif()->whereHas('obj_riwayat_pensiun', function ($q) {
            $q->tusk();
        })->with(['obj_riwayat_jabatan', 'obj_satker', 'obj_riwayat_pangkat.obj_pangkat']);
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
            ->addColumn('sisa_masa_kerja', function (Employee $u) {
                $days = $u->obj_riwayat_pensiun->tgl_pensiun->diffInDays(Carbon::now());
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
            ->addColumn('tgl_pensiun', function (Employee $u) {
                $tgl_pensiun = $u->obj_riwayat_pensiun->tgl_pensiun;
                if ($tgl_pensiun) {
                    return $tgl_pensiun->format('d-m-Y');
                }
                return "-";
            })
            ->addColumn('pangkat', function (Employee $user) {
                $last = $user->obj_riwayat_pangkat->last();
                return  $last->obj_pangkat->name . " - " . $last->obj_pangkat->kode;
            })
            ->addColumn('action', function (Employee $user) {
                return "<a class='btn btn-danger' href='" . route('admin.pensiun.tusk2album.form',$user->id) . "'>Pindah ke Album</a>";
            })
            ->make(true);
    }
    public function dt_album()
    {
        $query = Employee::pensiun()->with(['obj_riwayat_pensiun','obj_riwayat_jabatan', 'obj_satker', 'obj_riwayat_pangkat.obj_pangkat']);
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
            ->addColumn('sisa_masa_kerja', function (Employee $u) {
                $days = $u->obj_riwayat_pensiun->tgl_pensiun->diffInDays(Carbon::now());
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
            ->addColumn('tgl_pensiun', function (Employee $u) {
                $tgl_pensiun = $u->obj_riwayat_pensiun->tgl_pensiun;
                if ($tgl_pensiun) {
                    return $tgl_pensiun->format('d-m-Y');
                }
                return "-";
            })
            ->addColumn('pangkat', function (Employee $user) {
                $last = $user->obj_riwayat_pangkat->last();
                return  "-";
            })

            ->make(true);
    }

    public function tusk2AlbumForm(Content $content,$e_id)
    {
        $e =  Employee::with(['obj_riwayat_pensiun'])->find($e_id);
        if($e->status_pegawai_id == Employee::STATUS_PENSIUN){
            abort(401,"Pegawai sudah berstatus pensiun");
        }
        $form = new FormTUSKAlbum();
        $form->setEmployee($e);
        return $content
            ->title($this->title)
            ->body($form);
    }
    public function mpp2TUSKForm(Content $content,$e_id)
    {
        $e =  Employee::with(['obj_riwayat_pensiun'])->find($e_id);
        if($e->status_pegawai_id == Employee::STATUS_PENSIUN){
            abort(401,"Pegawai sudah berstatus pensiun");
        }
        $form = new FormMPP2TUSK();
        $form->setEmployee($e);
        return $content
            ->title($this->title)
            ->body($form);
    }
    public function mpp2AlbumForm(Content $content,$e_id)
    {
        $e =  Employee::with(['obj_riwayat_pensiun'])->find($e_id);
        if($e->status_pegawai_id == Employee::STATUS_PENSIUN){
            abort(401,"Pegawai sudah berstatus pensiun");
        }
        $form = new FormMPPAlbum();
        $form->setEmployee($e);
        return $content
            ->title($this->title)
            ->body($form);
    }
    public function akan2mppForm(Content $content,$e_id)
    {
        $e =  Employee::with(['obj_riwayat_pensiun'])->find($e_id);
        if($e->status_pegawai_id == Employee::STATUS_PENSIUN){
            abort(401,"Pegawai sudah berstatus pensiun");
        }
        $form = new FormAkan2MPP();
        $form->setEmployee($e);
        return $content
            ->title($this->title)
            ->body($form);
    }
}
