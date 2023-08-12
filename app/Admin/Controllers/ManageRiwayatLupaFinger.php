<?php

namespace App\Admin\Controllers;

use App\Models\Employee;
use App\Models\Presensi\RiwayatLupaFinger;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ManageRiwayatLupaFinger extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Riwayat Lupa Finger';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RiwayatLupaFinger());

        $grid->model()->load(['obj_employee']);
        $grid->column('obj_employee.first_name', __('PEGAWAI'))->display(function($o){
            return $this->obj_employee->first_name." <br> ".$this->obj_employee->nip_baru;
        });
        $grid->column('tgl', __('TGL'));
        $grid->column('jenis', __('JENIS'));
        $grid->column('datang_lama', __('DATANG LAMA'));
        $grid->column('pulang_lama', __('PULANG LAMA'));
        $grid->column('jam_datang', __('JAM DATANG'));
        $grid->column('jam_pulang', __('JAM PULANG'));
        $grid->column('tgl_verifikasi', __('TGL VERIFIKASI'));
        $grid->column('keterangan', __('KETERANGAN'));

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
        $show = new Show(RiwayatLupaFinger::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('simpeg_id', __('Simpeg id'));
        $show->field('employee_id', __('Employee id'));
        $show->field('tgl', __('TGL'));
        $show->field('jenis', __('JENIS'));
        $show->field('datang_lama', __('DATANG LAMA'));
        $show->field('pulang_lama', __('PULANG LAMA'));
        $show->field('jam_datang', __('JAM DATANG'));
        $show->field('jam_pulang', __('JAM PULANG'));
        $show->field('tgl_verifikasi', __('TGL VERIFIKASI'));
        $show->field('keterangan', __('KETERANGAN'));
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
        $form = new Form(new RiwayatLupaFinger());

        $form->select('employee_id', __('PEGAWAI'))->required()->options(function ($id) {
            $user = Employee::find($id);
        
            if ($user) {
                return [$user->id => $user->first_name."-<b>{$user->nip_baru}</b>"];
            }
        })->ajax('/admin/api/employee');
        $form->date('tgl', __('TGL'))->default(date('Y-m-d'));
        $form->number('jenis', __('JENIS'));
        $form->datetime('datang_lama', __('DATANG LAMA'))->default(date('Y-m-d H:i:s'));
        $form->datetime('pulang_lama', __('PULANG LAMA'))->default(date('Y-m-d H:i:s'));
        $form->datetime('jam_datang', __('JAM DATANG'))->default(date('Y-m-d H:i:s'));
        $form->datetime('jam_pulang', __('JAM PULANG'))->default(date('Y-m-d H:i:s'));
        $form->date('tgl_verifikasi', __('TGL VERIFIKASI'))->default(date('Y-m-d'));
        $form->text('keterangan', __('KETERANGAN'));

        return $form;
    }
}
