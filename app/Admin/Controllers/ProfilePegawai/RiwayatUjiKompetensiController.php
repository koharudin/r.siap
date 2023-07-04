<?php

namespace App\Admin\Controllers\ProfilePegawai;

use App\Models\RiwayatUjiKompetensi;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class RiwayatUjiKompetensiController extends ProfileController
{
    public $activeTab = 'riwayat_uji_kompetensi';
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Riwayat Uji Kompetensi';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RiwayatUjiKompetensi());

        $grid->column('jabatan', __('JABATAN'));
        $grid->column('satker', __('SATKER'));
        $grid->column('keterangan', __('KETERANGAN'));
        $grid->column('tanggal', __('TANGGAL'));

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
        $show = new Show(RiwayatUjiKompetensi::findOrFail($id));

        $show->field('jabatan', __('JABATAN'));
        $show->field('satker', __('SATKER'));
        $show->field('keterangan', __('KETERANGAN'));
        $show->field('tanggal', __('TANGGAL'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new RiwayatUjiKompetensi());
        $form->hidden('employee_id', __('Employee id'));
        $form->text('jabatan', __('JABATAN'));
        $form->text('satker', __('SATKER'));
        $form->text('keterangan', __('KETERANGAN'));
        $form->date('tanggal', __('TANGGAL'))->default(date('Y-m-d'));

        return $form;
    }
}
