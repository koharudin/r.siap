<?php

namespace App\Admin\Controllers\ProfilePegawai;

use App\Models\RiwayatMutasi;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class RiwayatMutasiController extends ProfileController
{
    public $activeTab = 'riwayat_mutasi';
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Riwayat Mutasi';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RiwayatMutasi());

        $grid->column('id', __('ID'));
        $grid->column('satker_lama', __('SATKER LAMA'));
        $grid->column('satker_baru', __('SATKER BARU'));
        $grid->column('no_sk', __('NO SK'));
        $grid->column('tgl_sk', __('TGL SK'));
        $grid->column('tmt_sk', __('TMT SK'));
        $grid->column('pejabat_penetap_jabatan', __('PEJABAT PENETAP'));

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
        $show = new Show(RiwayatMutasi::findOrFail($id));

        $show->field('satker_lama', __('SATKER LAMA'));
        $show->field('satker_baru', __('SATKER BARU'));
        $show->field('no_sk', __('NO SK'));
        $show->field('tgl_sk', __('TGL SK'));
        $show->field('tmt_sk', __('TMT SK'));
        $show->field('pejabat_penetap_nip', __('PEJABAT PENETAP NIP'));
        $show->field('pejabat_penetap_nama', __('PEJABAT PENETAP NAMA'));
        $show->field('pejabat_penetap_jabatan', __('PEJABAT PENETAP JABATAN'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new RiwayatMutasi());

        $form->hidden('employee_id', __('Employee id'));
        $form->text('satker_lama', __('SATKER LAMA'));
        $form->text('satker_baru', __('SATKER BARU'));
        $form->text('no_sk', __('NO SK'));
        $form->date('tgl_sk', __('TGL SK'))->default(date('Y-m-d'));
        $form->date('tmt_sk', __('TMT SK'))->default(date('Y-m-d'));
        $form->text('pejabat_penetap_nip', __('PEJABAT PENETAP NIP'));
        $form->text('pejabat_penetap_nama', __('PEJABAT PENETAP NAMA'));
        $form->text('pejabat_penetap_jabatan', __('PEJABAT PENETAP JABATAN'));

        return $form;
    }
}
