<?php

namespace App\Admin\Controllers;

use App\Models\Employee;
use App\Models\Presensi\RiwayatIzinLain;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ManageRiwayatIzinLain extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Riwayat Izin Lain';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RiwayatIzinLain());

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
        $grid->column('jenis_izin', __('JENIS IZIN'))->display(function($o){
            return @RiwayatIzinLain::list_jenis[$o];
        });
        $grid->column('keterangan', __('KETERANGAN'));
        $grid->column('tgl_mulai', __('TGL MULAI'));
        $grid->column('tgl_selesai', __('TGL SELESAI'));

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
        $show = new Show(RiwayatIzinLain::findOrFail($id));

        $show->field('jenis_izin', __('JENIS IZIN'));
        $show->field('keterangan', __('KETERANGAN'));
        $show->field('tgl_mulai', __('TGL MULAI'));
        $show->field('tgl_selesai', __('TGL SELESAI'));
        $show->field('status_pot',__('STATUS POTONGAN'));
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new RiwayatIzinLain());

        $form->select('employee_id', __('PEGAWAI'))->required()->options(function ($id) {
            $user = Employee::find($id);
        
            if ($user) {
                return [$user->id => $user->first_name."-<b>{$user->nip_baru}</b>"];
            }
        })->ajax('/admin/api/employee');
        $form->select('jenis_izin', __('JENIS IZIN'))->options(RiwayatIzinLain::list_jenis);
        $form->text('keterangan', __('KETERANGAN'));
        $form->date('tgl_mulai', __('TGL MULAI'))->default(date('Y-m-d'));
        $form->date('tgl_selesai', __('TGL SELESAI'))->default(date('Y-m-d'));
        $form->number('status_pot',__('STATUS POTONGAN'));

        return $form;
    }
}
