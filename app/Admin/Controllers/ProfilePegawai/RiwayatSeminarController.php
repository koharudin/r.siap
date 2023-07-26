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
        $grid->model()->orderBy('tgl_mulai','asc');
        $grid->model()->where('jenis_piagam',2); 
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
        $form->date('tgl_mulai', __('TGL MULAI'))->default(date('Y-m-d'));
        $form->date('tgl_selesai', __('TGL SELESAI'))->default(date('Y-m-d'));
        $form->text('no_piagam', __('NO PIAGAM'));
        $form->date('tgl_piagam', __('TGL PIAGAM'))->default(date('Y-m-d'));
        $form->text('status', __('STATUS'));
        $form->text('peran', __('PERAN'));

        return $form;
    }
}
