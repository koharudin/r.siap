<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\CustomRowAction;
use App\Admin\Actions\HapusUsulanAction;
use App\Admin\Actions\UbahUsulanAction;
use App\Admin\Forms\Requests\ChooseAction;
use App\Admin\Forms\Requests\ChooseCategory;
use App\Admin\Forms\Requests\FormChooseCategory;
use App\Admin\Forms\Requests\FormDetailCategory;
use App\Admin\Forms\Requests\FormDetailKategory;
use App\Admin\Forms\Requests\FormDetailRequest;
use App\Admin\Forms\Requests\FormRequest;
use App\Http\Controllers\Controller;
use App\Models\KategoriLayanan;
use App\Models\RiwayatUsulan;
use App\Models\RiwayatUsulanLog;
use App\Models\StatusUsulan;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Form\Row;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row as LayoutRow;
use Encore\Admin\Show;
use Encore\Admin\Widgets\MultipleSteps;
use Illuminate\Support\Facades\DB;

class VerifikasiUsulanController extends Controller
{
    protected $title = 'Verifikasi Usulan';

    protected function title()
    {
        return $this->title;
    }

    public function do($id, Content $content)
    {
        
        $usulan = RiwayatUsulan::findOrFail($id);
        if ($usulan->status_id == StatusUsulan::TOLAK || $usulan->status_id == StatusUsulan::TERIMA) {
            admin_error("Pesan", "DATA USULAN TIDAK DAPAT DIPROSES VERIFIKASI. ");
            return back();
        }
        $usulan->keterangan = request('keterangan_usulan');
        if (request('btn_action_') == 'TOLAK') {
            admin_success("Pesan", "Data usulan ditolak");
            $usulan->status_id = StatusUsulan::TOLAK;
            $usulan->save();
            $f = new $usulan->obj_kategori_layanan->form_request_class;
            $f->onTolak($usulan);
            $log = new RiwayatUsulanLog();
            $log->request_id = $usulan->id;
            $log->user_id = Admin::user()->id;
            $log->log  = "USULAN DITOLAK";
            $log->save();
        }
       
        if (request('btn_action_') == 'TERIMA') {
            DB::transaction(function() use($usulan){
                $usulan->status_id = StatusUsulan::TERIMA;
                $usulan->save();
                $f = new $usulan->obj_kategori_layanan->form_request_class;
                $f->onTerima($usulan);
                $log = new RiwayatUsulanLog();
                $log->request_id = $usulan->id;
                $log->user_id = Admin::user()->id;
                $log->log  = "USULAN DITERIMA";
                $log->save();
                admin_success("Pesan", "Data usulan diTERIMA");
            });
            
        }
        return back();
    }
    public function form($id, Content $content)
    {
        $content->breadcrumb(
            ['text' => 'Dashboard', 'url' => route('admin.home')],
            ['text' => 'Daftar Verifikasi', 'url' => route('admin.usulan.grid_verifikasi')],
            ['text' => 'Form Verifikasi']
        );
        $o = RiwayatUsulan::with(['obj_employee','obj_kategori_layanan'])->findOrFail($id);
        $f = new $o->obj_kategori_layanan->form_request_class;
        $f->form()->readOnly();
        $f->record = $o;
        $f->textarea("keterangan_usulan", "Alasan")->required(true);
        $f->onEditForm($id);
        $f->setView('admin::form-request-verifikasi');
        $f->setAction(route("admin.usulan.do_verifikasi", ['id' => $id]));
        if ($o->status_id == StatusUsulan::SEND) {
            $f->able2verify = true;
        } else {
            $f->able2verify = false;
        }
        return $content
            ->title("Verifikasi Usulan")
            ->description($this->description['index'] ?? trans('admin.list'))
            ->body($f);
    }
    public function grid(Content $content)
    {
        $grid  = new Grid(new RiwayatUsulan());
        $grid->model()->load(['obj_status', 'obj_kategori_layanan', 'obj_employee']);
        $grid->model()->terbaru()->inboxVerifikasi();
        $grid->disableRowSelector();
        $grid->disableBatchActions();
        $grid->expandFilter();
        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->where(function ($query) {
                $query->whereHas('obj_employee', function ($query) {
                    $query->where('first_name', 'ilike', "%{$this->input}%")->orWhere('nip_baru', 'ilike', "%{$this->input}%");
                });
            }, 'Nama/NIP Pegawai');
        });
        $grid->column('obj_employee.first_name', 'Nama Pegawai');
        $grid->column('obj_employee.nip_baru', 'NIP Pegawai');
        $grid->column('obj_kategori_layanan.name', 'Kategori Layanan');
        $grid->column('obj_status.name', 'Kategori Layanan')->display(function ($o) {
            if ($this->obj_status->id == StatusUsulan::DRAFT) {
                return "<span class='label label-default'>{$o}</span>";
            } else if ($this->obj_status->id == StatusUsulan::SEND) {
                return "<span class='label label-primary'>{$o}</span>";
            } else if ($this->obj_status->id == StatusUsulan::TERIMA) {
                return "<span class='label label-info'><i class='fa fa-check'></i> {$o}</span>";
            } else if ($this->obj_status->id == StatusUsulan::TOLAK) {
                return "<span class='label label-danger'><i class='fa fa-remove'></i> {$o}</span>";
            }
            return $o;
        });
        $grid->column('created_at', 'Diajukan pada')->display(function ($o) {
            return $this->created_at->diffForHumans();
        });
        $grid->column('updated_at', 'Perubahan pada')->display(function ($o) {
            return $this->updated_at->diffForHumans();
        });
        $grid->actions(function ($actions) {
            $actions->disableView();
            $actions->disableEdit();
            $actions->disableDelete();
            if ($this->row->status_id == StatusUsulan::SEND) {
                $actions->add(new CustomRowAction("<i class='fa fa-search'/> Verifikasi Usulan", route("admin.usulan.form_verifikasi", ['id' => $this->getKey()])));
            }
            $actions->add(new CustomRowAction("<i class='fa fa-file'/> Detail Usulan", route("admin.verifikasi.detail", ['id' => $this->getKey()])));
        });
        return $content
            ->title($this->title())
            ->description($this->description['index'] ?? trans('admin.list'))
            ->body($grid);
    }
    public function detail($id, Content $content)
    {
        $content->breadcrumb(
            ['text' => 'Dashboard', 'url' => route('admin.home')],
            ['text' => 'Daftar Verifikasi', 'url' => route('admin.usulan.grid_verifikasi')],
            ['text' => 'Detail Usulan']
        );
        $o = RiwayatUsulan::with(['obj_kategori_layanan'])->findOrFail($id);
        $f = new $o->obj_kategori_layanan->form_request_class;
        $f->form();
        $f->onEditForm($id);
        $f->setView('admin::form-request-detail');
        $grid = new Grid(new RiwayatUsulanLog());
        $grid->setTitle("Daftar Log");
        $grid->disableRowSelector();
        $grid->disableCreateButton();
        $grid->disableActions();
        $grid->disableColumnSelector();
        $grid->disableExport();
        $grid->disableFilter();
        $grid->model()->where('request_id', $id);
        $grid->model()->orderBy('created_at', 'asc');
        $grid->column('log', 'KETERANGAN');
        $grid->column('created_at', 'WAKTU')->display(function ($o) {
            return $this->created_at->format('Y-m-d H:i:s');
        });
        $grid->column('obj_user.username', 'OLEH');
        return $content
            ->title("Detail Usulan")
            ->description($this->description['index'] ?? trans('admin.list'))
            ->body($f)
            ->body($grid);
    }
}
