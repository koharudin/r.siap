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

        $grid->column('nama', __('NAMA'));
        $grid->column('tempat', __('TEMPAT'));
        $grid->column('penyelenggara', __('PENYELENGGARA'));
        $grid->column('tgl_mulai', __('TGL MULAI'));
        $grid->column('tgl_selesai', __('TGL SELESAI'));
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


        $show->field('nama', __('NAMA'));
        $show->field('tempat', __('TEMPAT'));
        $show->field('penyelenggara', __('PENYELENGGARA'));
        $show->field('angkatan', __('ANGKATAN'));
        $show->field('tgl_mulai', __('TGL MULAI'));
        $show->field('tgl_selesai', __('TGL SELESAI'));
        $show->field('no_piagam', __('NO PIAGAM'));
        $show->field('tgl_piagam', __('TGL PIAGAM'));
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
        $form->hidden('employee_id', __('Employee id'));
        $form->text('nama', __('NAMA'));
        $form->text('tempat', __('TEMPAT'));
        $form->text('penyelenggara', __('PENYELENGGARA'));
        $form->number('angkatan', __('ANGKATAN'));
        $form->date('tgl_mulai', __('TGL MULAI'))->default(date('Y-m-d'));
        $form->date('tgl_selesai', __('TGL SELESAI'))->default(date('Y-m-d'));
        $form->text('no_piagam', __('NO PIAGAM'));
        $form->date('tgl_piagam', __('TGL PIAGAM'))->default(date('Y-m-d'));
        $form->text('status', __('STATUS'));
        $form->text('peran', __('PERAN'));

        return $form;
    }
}
