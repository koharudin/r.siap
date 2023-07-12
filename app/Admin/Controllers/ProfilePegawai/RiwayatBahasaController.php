<?php

namespace App\Admin\Controllers\ProfilePegawai;

use App\Models\JenisBahasa;
use App\Models\KemampuanBicara;
use App\Models\RiwayatPenguasaanBahasa;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class RiwayatBahasaController  extends ProfileController
{
    public $activeTab = 'riwayat_penguasaan_bahasa';
    public $klasifikasi_id = 13; 
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Riwayat Penguasaan Bahasa';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RiwayatPenguasaanBahasa());

        $grid->column('obj_jenis_bahasa.name', __('JENIS BAHASA'));
        $grid->column('nama_bahasa', __('NAMA BAHASA'));
        $grid->column('obj_kemampuan_bicara.name', __('KEMAMPUAN BICARA'));
        $grid->column('jenis_sertifikasi', __('JENIS SERTIFIKASI'));
        $grid->column('lembaga_sertifikasi', __('LEMBAGA SERTIFIKASI'));
        $grid->column('skor', __('SKOR'));
        $grid->column('tgl_expired', __('TGL KADALUARSA'));

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
        $show = new Show(RiwayatPenguasaanBahasa::findOrFail($id));

        $show->field('jenis_bahasa', __('JENIS BAHASA'));
        $show->field('nama_bahasa', __('NAMA BAHASA'));
        $show->field('kemampuan_bicara', __('KEMAMPUAN BICARA'));
        $show->field('jenis_sertifikasi', __('JENIS SERTIFIKASI'));
        $show->field('lembaga_sertifikasi', __('LEMBAGA SERTIFIKASI'));
        $show->field('skor', __('SKOR'));
        $show->field('tgl_expired', __('TGL KADALUARSA'));
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new RiwayatPenguasaanBahasa());

        $form->hidden('employee_id', __('Employee id'));
        $form->select('jenis_bahasa', __('JENIS BAHASA'))->options(JenisBahasa::all()->pluck('name','id'));
        $form->text('nama_bahasa', __('NAMA BAHASA'));
        $form->select('kemampuan_bicara', __('KEMAMPUAN BICARA'))->options(KemampuanBicara::all()->pluck('name','id'));
        $form->text('jenis_sertifikasi', __('JENIS SERTIFIKASI'));
        $form->text('lembaga_sertifikasi', __('LEMBAGA SERTIFIKASI'));
        $form->text('skor', __('SKOR'));
        $form->date('tgl_expired', __('TGL KADALUARSA'))->default(date('Y-m-d'));
        return $form;
    }
}
