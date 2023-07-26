<?php

namespace App\Admin\Controllers\ProfilePegawai;

use App\Models\RiwayatPengalamanKerja;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class RiwayatPengalamanKerjaController extends ProfileController
{
    public $activeTab = 'riwayat_pengalaman_kerja';
    public $klasifikasi_id = 2;
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Riwayat Pengalaman Kerja';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RiwayatPengalamanKerja());
        $grid->model()->orderBy('tgl_kerja','asc');
        $grid->column('instansi', __('INSTANSI'));
        $grid->column('jabatan', __('JABATAN'));
        $grid->column('masa_kerja_tahun', __('MASA KERJA TAHUN'));
        $grid->column('masa_kerja_bulan', __('MASA KERJA BULAN'));
        $grid->column('tgl_kerja', __('TGL KERJA'))->display(function ($o) {
            if ($o) {
                return $this->tgl_kerja->format('d-m-Y');
            }
            return "-";
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
        $show = new Show(RiwayatPengalamanKerja::findOrFail($id));


        $show->field('instansi', __('INSTANSI'));
        $show->field('jabatan', __('JABATAN'));
        $show->field('masa_kerja_tahun', __('MASA KERJA TAHUN'));
        $show->field('masa_kerja_bulan', __('MASA KERJA BULAN'));
        $show->field('tgl_kerja', __('TGL KERJA'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new RiwayatPengalamanKerja());

        $form->hidden('employee_id', __('Employee id'));
        $form->text('instansi', __('INSTANSI'));
        $form->text('jabatan', __('JABATAN'));
        $form->number('masa_kerja_tahun', __('MASA KERJA TAHUN'));
        $form->number('masa_kerja_bulan', __('MASA KERJA BULAN'));
        $form->date('tgl_kerja', __('TGL KERJA'))->default(date('Y-m-d'));

        return $form;
    }
}
