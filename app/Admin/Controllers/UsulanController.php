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
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Form as WidgetsForm;
use Encore\Admin\Widgets\MultipleSteps;

class UsulanController extends Controller
{
    protected $title = 'Usulan';

    protected function title()
    {
        return $this->title;
    }
    public function me(Content $content)
    {
        $grid  = new Grid(new RiwayatUsulan());
        $grid->model()->where('employee_id', Admin::user()->obj_employee->id);
        $grid->model()->orderBy('updated_at','desc');
        $totalUsulan = RiwayatUsulan::all()->count();
        $grid->header(function ($query) use ($totalUsulan) {
            return "<h2>Total Usulan : " . $totalUsulan . "</h2>";
        });
        $content->breadcrumb(
            ['text' => 'Dashboard', 'url' => route('admin.home')],
            ['text' => 'Usulan Saya', 'url' => route('admin.usulan.saya')],
            ['text' => 'Buat Baru']
        );
        $grid->tools(function ($tools) {
            $tools->append("<a class='btn btn-sm btn-primary' href='" . route('admin.usulan.buat_baru') . "'><i class='fa fa-plus'></i> Buat Baru</a>");
        });
        //$grid->model()->load(['obj_status']);
        $grid->disableRowSelector();
        $grid->disableBatchActions();
        $grid->disableCreateButton();
        $grid->disableColumnSelector();
        $grid->column('obj_kategori_layanan.name', 'Kategori Layanan');
        $grid->column('action', 'Aksi')->display(function ($o) {
            if ($o == 1) {
                return "Buat Baru";
            } else if ($o == 2) {
                return "Perubahan data";
            } else if ($o == 3) {
                return "Penghapusan data";
            }
        });
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
        $grid->column('created_at', 'Dibuat pada')->display(function ($o) {
            return $this->created_at->diffForHumans();
        });
        $grid->column('updated_at', 'Perubahan pada')->display(function ($o) {
            return $this->updated_at->diffForHumans();
        });
        $grid->filter(function ($filter) {
            $filter->disableIDFilter();
        });
        $grid->disableFilter();
        $grid->actions(function ($actions) {
            $actions->disableView();
            $actions->disableEdit();
            $actions->disableDelete();
            if(!($this->row->status_id ==3 ||$this->row->status_id ==4 ||$this->row->status_id ==5)){
                $actions->add(new CustomRowAction("Ubah Usulan", route("admin.usulan.edit", ['id' => $this->getKey()])));
            }
            
            $actions->add(new CustomRowAction("Detail Usulan", route("admin.usulan.detail", ['id' => $this->getKey()])));
        });
        return $content
            ->title($this->title())
            ->description($this->description['index'] ?? trans('admin.list'))
            ->body($grid);
    }

    public function buat_baru(Content $content)
    {

        $content->breadcrumb(
            ['text' => 'Dashboard', 'url' => route('admin.home')],
            ['text' => 'Usulan Saya', 'url' => route('admin.usulan.saya')],
            ['text' => 'Buat Baru']
        );
        $form = new WidgetsForm();
        $form->action(route('admin.usulan.buat_baru'));
        $form->select("kategori_id", 'Kategori Layanan')->options(KategoriLayanan::all()->pluck('name', 'id'));
        if (request()->isMethod('POST')) {
            return redirect(route('admin.usulan.kategori', ['id' => request('kategori_id')]));
        }
        return $content
            ->title("Pengajuan Usulan")
            ->description($this->description['index'] ?? trans('admin.list'))
            ->body(new Box("Pilih Layanan", $form->render()));
    }
    public function new_request($kategori_id, Content $content)
    {
        $content->breadcrumb(
            ['text' => 'Dashboard', 'url' => route('admin.home')],
            ['text' => 'Usulan Saya', 'url' => route('admin.usulan.saya')],
            ['text' => 'Buat Usulan']
        );
        $kategori = KategoriLayanan::findOrFail($kategori_id);
        $f = new $kategori->form_request_class;
        $f->setAction(route('admin.usulan.kategori', ['id' => $kategori_id]));
        $f->form();
        $f->employee_id = Admin::user()->obj_employee->id;
        $f->onCreateForm();
        if (request()->isMethod('POST')) {
            $status_id = 0;
            if (request('btn_action_') == 'DRAFT') {
                $status_id = 1;
            }
            if (request('btn_action_') == 'KIRIM') {
                $status_id = 2;
            }
            admin_success('Pesan', 'Data usulan berhasil dibuat');
            $f->store($kategori_id,null, $status_id, 1);
            return redirect(route('admin.usulan.saya'));
        }
        return $content
            ->title("Pembuatan Usulan")
            ->description($this->description['index'] ?? trans('admin.list'))
            ->body($f->show($kategori_id));
    }
    public function new_request_kategori($kategori_id, Content $content)
    {
        $content->breadcrumb(
            ['text' => 'Dashboard', 'url' => route('admin.home')],
            ['text' => 'Usulan Saya', 'url' => route('admin.usulan.saya')],
            ['text' => 'Buat Usulan']
        );
        $kategori = KategoriLayanan::findOrFail($kategori_id);
        $f = new $kategori->form_request_class;
        $f->setAction(route('admin.usulan.kategori', ['id' => $kategori_id]));
        $f->form();
        $f->employee_id = Admin::user()->obj_employee->id;
        $f->onCreateForm();
        if (request()->isMethod('POST')) {
            $status_id = 0;
            if (request('btn_action_') == 'DRAFT') {
                $status_id = 1;
            }
            if (request('btn_action_') == 'KIRIM') {
                $status_id = 2;
            }
            admin_success('Pesan', 'Data usulan berhasil dibuat');
            $f->store($kategori_id,null, $status_id, 2);
            return redirect(route('admin.usulan.saya'));
        }
        return $content
            ->title("Pembuatan Usulan")
            ->description($this->description['index'] ?? trans('admin.list'))
            ->body($f);
    }
    public function ubahFromRecord($kategori_id, $record_ref_id, Content $content)
    {
        $content->breadcrumb(
            ['text' => 'Dashboard', 'url' => route('admin.home')],
            ['text' => 'Usulan Saya', 'url' => route('admin.usulan.saya')],
            ['text' => 'Usulan Dari Riwayat']
        );
        $kategori = KategoriLayanan::findOrFail($kategori_id);
        $f = new $kategori->form_request_class;
        $f->setAction(route("admin.usulan.record.ubah", ['kategori_id' => $kategori_id, 'record_ref_id' => $record_ref_id]));
        $f->form();
        $f->onRefCreateForm($record_ref_id);
        if (request()->isMethod('POST')) {
            $status_id = 0;
            if (request('btn_action_') == 'DRAFT') {
                $status_id = 1;
            }
            if (request('btn_action_') == 'KIRIM') {
                $status_id = 2;
            }
            admin_success('Pesan', 'Data usulan berhasil dibuat');
            $f->store($kategori_id, $record_ref_id, $status_id,2);
            return redirect(route('admin.usulan.saya'));
        }


        $f->footer(function ($footer) {

            // disable reset btn
            $footer->disableReset();

            // disable submit btn
            $footer->disableSubmit();

            // disable `View` checkbox
            $footer->disableViewCheck();

            // disable `Continue editing` checkbox
            $footer->disableEditingCheck();

            // disable `Continue Creating` checkbox
            $footer->disableCreatingCheck();
        });
        return $content
            ->title("Usulan Perubahan Data")
            ->description($this->description['index'] ?? trans('admin.list'))
            ->body($f);
    }
    public function hapusFromRecord($kategori_id, $record_ref_id, Content $content)
    {

        $content->breadcrumb(
            ['text' => 'Dashboard', 'url' => route('admin.home')],
            ['text' => 'Usulan Saya', 'url' => route('admin.usulan.saya')],
            ['text' => 'Hapus Usulan']
        );
        $kategori = KategoriLayanan::findOrFail($kategori_id);
        if (request()->isMethod('GET')) {
            admin_warning("Pesan", "Anda yakin mau mengusulkan untuk menghapus data ini?");
        }
        $f = new $kategori->form_request_class;
        $f->form();
        $f->onRefCreateForm($record_ref_id);
        $f->setAction(route("admin.usulan.record.hapus", ['kategori_id' => $kategori_id, 'record_ref_id' => $record_ref_id]));
        $f->setView('admin::form-request-hapus');
        if (request()->isMethod('POST')) {
            $status_id = 0;
            if (request('btn_action_') == 'DRAFT') {
                $status_id = 1;
            }
            if (request('btn_action_') == 'KIRIM') {
                $status_id = 2;
            }
            admin_success('Pesan', 'Data usulan berhasil dibuat');
            $f->store($kategori_id, $record_ref_id, $status_id,3);
            return redirect(route('admin.usulan.saya'));
        }
        return $content
            ->title("Usulan Penghapusan Data")
            ->description($this->description['index'] ?? trans('admin.list'))
            ->body($f);
    }
    public function detail($id, Content $content)
    {
        $content->breadcrumb(
            ['text' => 'Dashboard', 'url' => route('admin.home')],
            ['text' => 'Usulan Saya', 'url' => route('admin.usulan.saya')],
            ['text' => 'Detail Usulan']
        );
        $o = RiwayatUsulan::with(['obj_kategori_layanan'])->findOrFail($id);
        $f = new $o->obj_kategori_layanan->form_request_class;
        $f->form();
        $f->onEditForm($id);
        $f->setView('admin.form-request-detail');
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
            return $this->created_at->format('d-m-Y H:i:s');
        });
        $grid->column('obj_user.username', 'OLEH');
        return $content
            ->title("Detail Usulan")
            ->description($this->description['index'] ?? trans('admin.list'))
            ->body($f)
            ->body($grid);
    }
    public function edit($id, Content $content)
    {
        // add breadcrumb since v1.5.7
        $content->breadcrumb(
            ['text' => 'Dashboard', 'url' => route('admin.home')],
            ['text' => 'Usulan Saya', 'url' => route('admin.usulan.saya')],
            ['text' => 'Ubah Usulan']
        );

        $o = RiwayatUsulan::with(['obj_kategori_layanan'])->findOrFail($id);

        $f = new $o->obj_kategori_layanan->form_request_class;
        $f->form();
        $f->setAction(route('admin.usulan.edit',['id'=>$id]));
        $f->onEditForm($id);
        if ($o->status == StatusUsulan::SEND) {
            $f->able2draft = false;
            $f->able2send = false;
        }
        if (request()->isMethod('POST')) {
            $status_id = 0;
            if (request('btn_action_') == 'DRAFT') {
                $status_id = 1;
            }
            if (request('btn_action_') == 'KIRIM') {
                $status_id = 2;
            }
            admin_success('Pesan', 'Data usulan berhasil diperbaharui');
            $f->update($id,null,$status_id,2);
            return redirect(route('admin.usulan.saya'));
        }
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
            return $this->created_at->format('d-m-Y H:i:s');
        });
        $grid->column('obj_user.username', 'OLEH');
        return $content
            ->title("Ubah Usulan")
            ->description($this->description['index'] ?? trans('admin.list'))
            ->body($f)
            ->body($grid);
    }
}
