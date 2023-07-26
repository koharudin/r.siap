<?php

namespace App\Admin\Controllers\ProfilePegawai;

use App\Models\RiwayatDiklatStruktural;
use Encore\Admin\Auth\Permission;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class RiwayatDiklatStrukturalController extends ProfileController
{
    public $activeTab = 'riwayat_diklat_struktural';
    public $klasifikasi_id = 12;    
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Riwayat Diklat Struktural';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RiwayatDiklatStruktural());
        $grid->model()->orderBy('tahun','asc');
        $grid->model()->orderBy('tgl_mulai','asc');
        
        $grid->column('diklat', __('DIKLAT'));
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
        $show = new Show(RiwayatDiklatStruktural::findOrFail($id));

        $show->field('nama_diklat', __('NAMA DIKLAT'));
        $show->field('tempat', __('TEMPAT'));
        $show->field('penyelenggara', __('PENYELENGGARA'));
        $show->field('angkatan', __('ANGKATAN'));
        $show->field('tahun', __('TAHUN'));
        $show->field('tgl_mulai', __('TGL MULAI'));
        $show->field('tgl_selesai', __('TGL SELESAI'));
        $show->field('no_sttpp', __('NO STTPP'));
        $show->field('tgl_sttpp', __('TGL STTPP'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('jumlah_jam', __('JUMLAH JAM'));
        $show->field('diklat', __('DIKLAT'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new RiwayatDiklatStruktural());

        $form->hidden('employee_id', __('Employee id'));
        $form->text('nama_diklat', __('NAMA DIKLAT'));
        $form->text('tempat', __('TEMPAT'));
        $form->text('penyelenggara', __('PENYELENGGARA'));
        $form->text('angkatan', __('ANGKATAN'));
        $form->number('tahun', __('TAHUN'));
        $form->date('tgl_mulai', __('TGL MULAI'))->default(date('Y-m-d'));
        $form->date('tgl_selesai', __('TGL SELESAI'))->default(date('Y-m-d'));
        $form->text('no_sttpp', __('NO STTPP'));
        $form->date('tgl_sttpp', __('TGL STTPP'))->default(date('Y-m-d'));
        $form->number('jumlah_jam', __('JUMLAH JAM'));
        $form->text('diklat', __('DIKLAT'));

        return $form;
    }
}
