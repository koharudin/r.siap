<?php

namespace App\Admin\Controllers\ProfilePegawai;

use App\Models\RiwayatKursus;
use App\Models\DiklatSiasn;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class RiwayatKursusController extends ProfileController
{
    public $activeTab = 'riwayat_kursus';
    public $klasifikasi_id = 15;

    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Riwayat Kursus';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RiwayatKursus());

        $grid->model()->orderBy('tgl_mulai', 'asc');
        $grid->column('nama', __('NAMA KURSUS'));
        $grid->column('penyelenggara', __('PENYELENGGARA'));
        $grid->column('tahun', __('TAHUN'));
        $grid->column('tgl_mulai', __('TGL MULAI'))->display(function($o) {
            if($o) {
                return $this->tgl_mulai->format('d-m-Y');
            }
            return "-";
        });
        $grid->column('tgl_selesai', __('TGL SELESAI'))->display(function($o) {
            if($o) {
                return $this->tgl_selesai->format('d-m-Y');
            }
            return "-";
        });
        $grid->column('lama_jam', __('JUMLAH JAM'));
        $grid->column('flag_integrasi', __('INTEGRASI SIASN'))->display(function($o) {
            if($o == 2) {
                return "Sudah";
            } else if($o == 1 or $o == null) {
                return "Belum";
            }
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
        $show = new Show(RiwayatKursus::findOrFail($id));

        $show->field('obj_jenis.jenis_diklat', __('JENIS DIKLAT'));
        $show->field('nama', __('NAMA KURSUS'));
        $show->field('penyelenggara', __('PENYELENGGARA'));
        $show->field('tempat', __('TEMPAT'));
        $show->field('angkatan', __('ANGKATAN'));
        $show->field('no_sttpp', __('NO SERTIFIKAT'));
        $show->field('tgl_sttpp', __('TGL SERTIFIKAT'));
        $show->field('tahun', __('TAHUN'));
        $show->field('tgl_mulai', __('TGL MULAI'));
        $show->field('tgl_selesai', __('TGL SELESAI'));
        $show->field('lama_jam', __('JUMLAH JAM'));
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new RiwayatKursus());

        $form->hidden('employee_id', __('Employee ID'));
        $form->hidden('flag_integrasi', __('Status Integrasi'));
        $form->select('jenis_diklat_siasn', __('JENIS DIKLAT'))->options(DiklatSiasn::where('jenis_sertifikat', 'P')->where('id_siasn', '!=', 9)->pluck('jenis_diklat', 'id_siasn'))->required();
        $form->text('nama', __('NAMA KURSUS'))->required();
        $form->text('penyelenggara', __('PENYELENGGARA'))->required();
        $form->text('tempat', __('TEMPAT'));
        $form->text('angkatan', __('ANGKATAN'));
        $form->text('no_sttpp', __('NO SERTIFIKAT'))->required();
        $form->date('tgl_sttpp', __('TGL SERTIFIKAT'))->default(date('Y-m-d'));
        $form->number('tahun', __('TAHUN'))->required();
        $form->date('tgl_mulai', __('TGL MULAI'))->default(date('Y-m-d'))->required();
        $form->date('tgl_selesai', __('TGL SELESAI'))->default(date('Y-m-d'))->required();
        $form->number('lama_jam', __('JUMLAH JAM'))->required();

        $form->saving(function(Form $form) {
            $form->flag_integrasi = 1;
        });
        return $form;
    }
}
