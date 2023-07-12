<?php

namespace App\Admin\Controllers\ProfilePegawai;

use App\Models\RiwayatPenghargaan;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class RiwayatPenghargaanController extends ProfileController
{
    public $activeTab = 'riwayat_penghargaan';
    public $klasifikasi_id = 19;   
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Riwayat Penghargaan';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RiwayatPenghargaan());

        $grid->column('nama_penghargaan', __('NAMA PENGHARGAAN'));
        $grid->column('no_sk', __('NO SK'));
        $grid->column('tgl_sk', __('TGL SK'));
        $grid->column('pejabat_penetap', __('PEJABAT PENETAP'));
        $grid->column('tahun', __('TAHUN'));
        $grid->column('jenis_penghargaan', __('JENIS PENGHARGAAN'));

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
        $show = new Show(RiwayatPenghargaan::findOrFail($id));

        $show->field('nama_penghargaan', __('NAMA PENGHARGAAN'));
        $show->field('no_sk', __('NO SK'));
        $show->field('tgl_sk', __('TGL SK'));
        $show->field('pejabat_penetap', __('PEJABAT PENETAP'));
        $show->field('tahun', __('TAHUN'));
        $show->field('jenis_penghargaan', __('JENIS PENGHARGAAN'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new RiwayatPenghargaan());

        $form->hidden('employee_id', __('Employee id'));
        $form->text('nama_penghargaan', __('NAMA PENGHARGAAN'));
        $form->text('no_sk', __('NO SK'));
        $form->date('tgl_sk', __('TGL SK'))->default(date('Y-m-d'));
        $form->text('pejabat_penetap', __('PEJABAT PENETAP'));
        $form->number('tahun', __('TAHUN'));
        $form->text('jenis_penghargaan', __('JENIS PENGHARGAAN'));

        return $form;
    }
}
