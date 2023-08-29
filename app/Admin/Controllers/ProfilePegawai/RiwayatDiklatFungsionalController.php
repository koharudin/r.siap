<?php

namespace App\Admin\Controllers\ProfilePegawai;

use App\Admin\Selectable\GridDiklat;
use App\Models\RiwayatDiklatFungsional;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class RiwayatDiklatFungsionalController  extends ProfileController
{
    public $activeTab = 'riwayat_diklat_fungsional';
    public $klasifikasi_id = 13; 
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Riwayat Diklat Fungsional';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RiwayatDiklatFungsional());
        $grid->model()->where('jenis_diklat',2); 
        $grid->model()->orderBy('tahun','asc');
        $grid->model()->orderBy('tgl_mulai','asc');
        $grid->column('nama_diklat', __('NAMA DIKLAT'));
        $grid->column('tempat', __('TEMPAT'));
        $grid->column('penyelenggara', __('PENYELENGGARA'));
        $grid->column('angkatan', __('ANGKATAN'));
        $grid->column('tahun', __('TAHUN'));
        $grid->column('tgl_mulai', __('TGL MULAI'))->display(function ($o) {
            if ($o) {
                return $this->tgl_mulai->format('d-m-Y');
            }
            return "-";
        });
        $grid->column('tgl_selesai', __('TGL SELESAI'))->display(function ($o) {
            if ($o) {
                return $this->tgl_selesai->format('d-m-Y');
            }
            return "-";
        });
        $grid->column('no_sttpp', __('NO STTPP'));
        $grid->column('tgl_sttpp', __('TGL STTPP'));
        $grid->column('jumlah_jam', __('JUMLAH JAM'));
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
        $show = new Show(RiwayatDiklatFungsional::findOrFail($id));

        $show->field('jenis_diklat', __('JENIS DIKLAT'));
        $show->field('nama_diklat', __('NAMA DIKLAT'));
        $show->field('tempat', __('TEMPAT'));
        $show->field('penyelenggara', __('PENYELENGGARA'));
        $show->field('angkatan', __('ANGKATAN'));
        $show->field('tahun', __('TAHUN'));
        $show->field('tgl_mulai', __('TGL MULAI'));
        $show->field('tgl_selesai', __('TGL SELESAI'));
        $show->field('no_sttpp', __('NO STTPP'));
        $show->field('tgl_sttpp', __('TGL STTPP'));
        $show->field('diklat_id', __('DIKLAT ID'));
        $show->field('jumlah_jam', __('JUMLAH JAM'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new RiwayatDiklatFungsional());

        $form->hidden('employee_id', __('Employee id'));
        $form->hidden('jenis_diklat', __('JENIS DIKLAT'));
        $form->text('nama_diklat', __('NAMA DIKLAT'));
        $form->text('tempat', __('TEMPAT'));
        $form->text('penyelenggara', __('PENYELENGGARA'));
        $form->text('angkatan', __('ANGKATAN'));
        $form->number('tahun', __('TAHUN'));
        $form->date('tgl_mulai', __('TGL MULAI'))->default(date('Y-m-d'));
        $form->date('tgl_selesai', __('TGL SELESAI'))->default(date('Y-m-d'));
        $form->text('no_sttpp', __('NO STTPP'));
        $form->date('tgl_sttpp', __('TGL STTPP'));
        $form->belongsTo('diklat_id', GridDiklat::class, 'DIKLAT ID');
        $form->text('jumlah_jam', __('JUMLAH JAM'));

        $form->saving(function (Form $form) {
           $form->jenis_diklat = 2; //diklat fungsional
        });
        return $form;
    }
}
