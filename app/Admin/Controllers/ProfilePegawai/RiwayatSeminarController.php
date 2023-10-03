<?php

namespace App\Admin\Controllers\ProfilePegawai;

use App\Models\RiwayatSeminar;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class RiwayatSeminarController extends ProfileController
{
    public $activeTab = 'riwayat_seminar';
    public $klasifikasi_id = 16;

    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Riwayat Seminar';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RiwayatSeminar());

        $grid->model()->where('jenis_piagam', 2);
        $grid->model()->orderBy('tgl_mulai', 'asc');
        $grid->column('nama', __('NAMA SEMINAR'));
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
        $grid->column('jumlah_jam', __('JUMLAH JAM'));
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
        $show = new Show(RiwayatSeminar::findOrFail($id));

        $show->field('nama', __('NAMA SEMINAR'));
        $show->field('penyelenggara', __('PENYELENGGARA'));
        $show->field('tempat', __('TEMPAT'));
        $show->field('no_piagam', __('NO SERTIFIKAT'));
        $show->field('tgl_piagam', __('TGL SERTIFIKAT'));
        $show->field('tahun', __('TAHUN'));
        $show->field('tgl_mulai', __('TGL MULAI'));
        $show->field('tgl_selesai', __('TGL SELESAI'));
        $show->field('jumlah_jam', __('JUMLAH JAM'));
        $show->field('status', __('STATUS'));
        $show->field('peran', __('PERAN'));
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new RiwayatSeminar());

        $form->hidden('employee_id', __('Employee ID'));
        $form->hidden('flag_integrasi', __('Status Integrasi'));
        $form->hidden('jenis_diklat_siasn', __('JENIS DIKLAT'));
        $form->text('nama', __('NAMA SEMINAR'))->required();
        $form->text('penyelenggara', __('PENYELENGGARA'))->required();
        $form->text('tempat', __('TEMPAT'));
        $form->text('no_piagam', __('NO SERTIFIKAT'))->required();
        $form->date('tgl_piagam', __('TGL SERTIFIKAT'))->default(date('Y-m-d'));
        $form->number('tahun', __('TAHUN'))->required();
        $form->date('tgl_mulai', __('TGL MULAI'))->default(date('Y-m-d'))->required();
        $form->date('tgl_selesai', __('TGL SELESAI'))->default(date('Y-m-d'))->required();
        $form->number('jumlah_jam', __('JUMLAH JAM'))->required();
        $form->text('status', __('STATUS'));
        $form->text('peran', __('PERAN'));

        $form->saving(function(Form $form) {
            $form->flag_integrasi = 1;
            $form->jenis_diklat_siasn = 9;
        });
        return $form;
    }
}
