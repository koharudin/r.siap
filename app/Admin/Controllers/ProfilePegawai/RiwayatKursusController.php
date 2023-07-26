<?php

namespace App\Admin\Controllers\ProfilePegawai;

use App\Models\RiwayatKursus;
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
        $grid->model()->orderBy('tahun','asc');
        $grid->model()->orderBy('tgl_mulai','asc');
        $grid->column('nama', __('NAMA'));
        $grid->column('tempat', __('TEMPAT'));
        $grid->column('penyelenggara', __('PENYELENGGARA'));
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

        $show->field('id', __('Id'));
        $show->field('nama', __('NAMA'));
        $show->field('tempat', __('TEMPAT'));
        $show->field('penyelenggara', __('PENYELENGGARA'));
        $show->field('angkatan', __('ANGKATAN'));
        $show->field('tahun', __('TAHUN'));
        $show->field('tgl_mulai', __('TGL MULAI'));
        $show->field('tgl_selesai', __('TGL SELESAI'));
        $show->field('no_sttpp', __('NO PIAGAM'));
        $show->field('tgl_sttpp', __('TGL PIAGAM'));
        $show->field('lama_jam', __('LAMA JAM'));

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
        $form->hidden('employee_id', __('Employee id'));
        $form->text('nama', __('NAMA'));
        $form->text('tempat', __('TEMPAT'));
        $form->text('penyelenggara', __('PENYELENGGARA'));
        $form->number('angkatan', __('ANGKATAN'));
        $form->number('tahun', __('TAHUN'));
        $form->date('tgl_mulai', __('TGL MULAI'))->default(date('Y-m-d'));
        $form->date('tgl_selesai', __('TGL SELESAI'))->default(date('Y-m-d'));
        $form->text('no_sttpp', __('NO PIAGAM'));
        $form->date('tgl_sttpp', __('TGL PIAGAM'))->default(date('Y-m-d'));
        $form->number('lama_jam', __('LAMA JAM'));

        return $form;
    }
}
