<?php

namespace App\Admin\Controllers;

use App\Admin\Selectable\GridPejabatPenetap;
use App\Models\Employee;
use App\Models\Presensi\DetailJenisCuti;
use App\Models\Presensi\RiwayatCuti;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ManageRiwayatCuti extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Riwayat Cuti';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RiwayatCuti());
        $grid->model()->load(['obj_employee','obj_detail_jenis_cuti']);
        $grid->column('obj_employee.first_name', __('PEGAWAI'))->display(function($o){
            return $this->obj_employee->first_name." <br> ".$this->obj_employee->nip_baru;
        });
        $grid->column('obj_detail_jenis_cuti.name', __('JENIS CUTI'));
        $grid->column('tgl_mulai', __('TGL MULAI'));
        $grid->column('tgl_selesai', __('TGL SELESAI'));
        $grid->column('pejabat_jabatan', __('PEJABAT TTD'));

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
        $show = new Show(RiwayatCuti::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('simpeg_id', __('Simpeg id'));
        $show->field('employee_id', __('Employee id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('id_detail_jenis_cuti', __('JENIS CUTI'));
        $show->field('tgl_mulai', __('TGL MULAI'));
        $show->field('tgl_selesai', __('TGL SELESAI'));
        $show->field('lama_cuti', __('LAMA CUTI'));
        $show->field('sisa_saldo', __('SISA SALDO'));
        $show->field('no_sk', __('NO SK'));
        $show->field('tgl_sk', __('TGL SK'));
        $show->field('keterangan', __('KETERANGAN'));
        $show->field('pejabat_id', __('Pejabat id'));
        $show->field('pejabat_nama', __('NAMA'));
        $show->field('pejabat_nip', __('NIP'));
        $show->field('pejabat_jabatan', __('JABATAN'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new RiwayatCuti());

        if($form->isCreating()){
            $form->select('employee_id', __('PEGAWAI'))->required()->options(function ($id) {
                $user = Employee::find($id);
            
                if ($user) {
                    return [$user->id => $user->first_name."-<b>{$user->nip_baru}</b>"];
                }
            })->ajax('/admin/api/employee');
        }
        else {
            $form->display('employee_id','PEGAWAI')->customFormat(function($o){
                $e  = Employee::findOrFail($o);
                return $e->first_name." - <b>{$e->nip_baru}</b>";
            });
        }
        $form->select('id_detail_jenis_cuti', __('JENIS CUTI'))->options(DetailJenisCuti::all()->pluck('name','id'))->required();
        $form->date('tgl_mulai', __('TGL MULAI'))->default(date('Y-m-d'))->required();
        $form->date('tgl_selesai', __('TGL SELESAI'))->default(date('Y-m-d'))->required();
        $form->number('lama_cuti', __('LAMA CUTI'));
        $form->number('sisa_saldo', __('SISA SALDO'));
        $form->text('no_sk', __('NO SK'));
        $form->date('tgl_sk', __('TGL SK'))->default(date('Y-m-d'));
        $form->text('keterangan', __('KETERANGAN'));
        $form->fieldset('PEJABAT TTD',function($form){
            $form->belongsTo('pejabat_id',GridPejabatPenetap::class, __('PEJABAT'));
            $form->text('pejabat_nama', __('NAMA'));
            $form->text('pejabat_nip', __('NIP'));
            $form->text('pejabat_jabatan', __('JABATAN'));
        });
        return $form;
    }
}
