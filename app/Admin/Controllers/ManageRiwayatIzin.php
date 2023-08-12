<?php

namespace App\Admin\Controllers;

use App\Admin\Selectable\GridEmployee;
use App\Models\Employee;
use App\Models\Presensi\RiwayatIzin;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ManageRiwayatIzin extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Riwayat Izin';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RiwayatIzin());
        $grid->header(function ($query) {
            return 'Dinas Luar';
        });
        $grid->model()->load(['obj_employee']);
        $grid->model()->orderTanggal();
        $grid->filter(function($filter) use($grid){
            $filter->expand();
            $filter->disableIdFilter();
            $filter->where(function ($query) {
                $query->whereHas('obj_employee', function ($query) {
                    $query->where('first_name', 'ilike', "%{$this->input}%")->orWhere('nip_baru', 'ilike', "%{$this->input}%");
                });
            
            }, 'Nama/NIP Pegawai');
        });
        
        $grid->column('obj_employee.first_name', __('PEGAWAI'))->display(function($o){
            if($this->obj_employee){
                return $this->obj_employee->first_name." <br> ".$this->obj_employee->nip_baru;
            }
            else return "<b>-Tidak ditemukan pegawai-</b>";
        });
        $grid->column('nip_pemberi_tugas', __('PEMBERI TUGAS'));
        $grid->column('tgl_mulai', __('TGL MULAI'));
        $grid->column('tgl_selesai', __('TGL SELESAI'));
        $grid->column('no_sk', __('NO SK'));
        $grid->column('tgl_sk', __('TGL SK'));
        $grid->tools(function ($tools) {
            $tools->append("<a class='btn btn-sm btn-danger' href='".route('admin.manage_riwayat_izin.buat_massal')."'><i class='fa fa-cog'></i> &nbsp; Buat Massal</a>");
        });
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(RiwayatIzin::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('simpeg_id', __('Simpeg id'));
        $show->field('employee_id', __('Employee id'));
        $show->field('nip_pemberi_tugas', __('PEMBERI TUGAS'));
        $show->field('tgl_mulai', __('TGL MULAI'));
        $show->field('tgl_selesai', __('TGL SELESAI'));
        $show->field('lama_izin', __('LAMA IZIN'));
        $show->field('keterangan', __('KETERANGAN'));
        $show->field('no_sk', __('NO SK'));
        $show->field('tgl_sk', __('TGL SK'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new RiwayatIzin());

        $form->select('employee_id', __('PEGAWAI'))->required()->options(function ($id) {
            $user = Employee::find($id);
        
            if ($user) {
                return [$user->id => $user->first_name."-<b>{$user->nip_baru}</b>"];
            }
        })->ajax('/admin/api/employee');;
        $form->text('nip_pemberi_tugas', __('PEMBERI TUGAS'));
        $form->date('tgl_mulai', __('TGL MULAI'))->default(date('Y-m-d'));
        $form->date('tgl_selesai', __('TGL SELESAI'))->default(date('Y-m-d'));
        $form->number('lama_izin', __('LAMA IZIN'));
        $form->text('keterangan', __('KETERANGAN'));
        $form->text('no_sk', __('NO SK'));
        $form->date('tgl_sk', __('TGL SK'))->default(date('Y-m-d'));

        return $form;
    }
    public function massal(Content $content){
        $form = new Form(new RiwayatIzin());
        $form->setAction(route('admin.manage_riwayat_izin.buat_massal'));
        $form->text('nip_pemberi_tugas', __('PEMBERI TUGAS'));
        $form->date('tgl_mulai', __('TGL MULAI'))->required();
        $form->date('tgl_selesai', __('TGL SELESAI'))->required();
        $form->number('lama_izin', __('LAMA IZIN'));
        $form->text('keterangan', __('KETERANGAN'));
        $form->text('no_sk', __('NO SK'));
        $form->date('tgl_sk', __('TGL SK'));
        $form->belongsToMany('employees', GridEmployee::class, __('Pegawai yang Dinas Luar'))->required();
        if(request()->isMethod('POST')){
            $employees = request('employees');
            foreach($employees as $employee){
                $record = new RiwayatIzin();
                
                $record->employee_id = $employee;
                $record->nip_pemberi_tugas  = request('');
                $record->tgl_mulai  = request('tgl_mulai');
                $record->tgl_selesai  = request('tgl_selesai');
                $record->lama_izin  = request('lama_izin');
                $record->keterangan  = request('keterangan');
                $record->no_sk  = request('no_sk');
                $record->tgl_sk  = request('tgl_sk');
                if($employee){
                    $record->save();
                }
            }
            admin_success('Pesan', 'Data berhasil di proses');
            return redirect(route('admin.manage_riwayat_izin.index'));
        }
        return $content
            ->title($this->title())
            ->description($this->description['edit'] ?? trans('admin.edit'))
            ->body($form);
    }
}
