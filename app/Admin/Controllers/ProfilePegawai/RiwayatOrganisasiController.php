<?php

namespace App\Admin\Controllers\ProfilePegawai;

use App\Models\RiwayatOrganisasi;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class RiwayatOrganisasiController extends ProfileController
{
    public $activeTab = 'riwayat_organisasi';
    public $klasifikasi_id = 33;    
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Riwayat Organisasi';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RiwayatOrganisasi());

        $grid->column('nama', __('ORGANISASI'));
        $grid->column('jabatan', __('JABATAN'));
        $grid->column('awal', __('AWAL'));
        $grid->column('akhir', __('AKHIR'));
        $grid->column('pimpinan', __('PIMPINAN'));
        $grid->column('tempat', __('TEMPAT'));

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
        $show = new Show(RiwayatOrganisasi::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('nama', __('NAMA ORGANISASI'));
        $show->field('jabatan', __('JABATAN'));
        $show->field('awal', __('AWAL'));
        $show->field('akhir', __('AKHIR'));
        $show->field('pimpinan', __('PIMPINAN'));
        $show->field('tempat', __('TEMPAT'));
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new RiwayatOrganisasi());
        $form->hidden('employee_id', __('Employee id'));
        $form->text('nama', __('NAMA ORGANISASI'));
        $form->text('jabatan', __('JABATAN'));
        $form->date('awal', __('AWAL'))->default(date('Y-m-d'));
        $form->date('akhir', __('AKHIR'))->default(date('Y-m-d'));
        $form->text('pimpinan', __('PIMPINAN'));
        $form->text('tempat', __('TEMPAT'));
        $form->hidden('employee_id', __('Employee id'));

        return $form;
    }
}
