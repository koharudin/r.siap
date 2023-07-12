<?php

namespace App\Admin\Controllers\ProfilePegawai;

use App\Models\RiwayatDp3;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class RiwayatDp3Controller extends  ProfileController
{
    public $activeTab = 'riwayat_dp3';
    public $klasifikasi_id = 17;
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Riwayat DP3';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RiwayatDp3());
        $grid->column('tahun', __('TAHUN'));
        $grid->column('kesetiaan', __('KESETIAAN'));
        $grid->column('prestasi', __('PRESTASI'));
        $grid->column('tanggung_jawab', __('TANGGUNG JAWAB'));
        $grid->column('ketaatan', __('KETAATAN'));
        $grid->column('kejujuran', __('KEJUJURAN'));
        $grid->column('kerjasama', __('KERJASAMA'));
        $grid->column('prakarsa', __('PRAKARSA'));
        $grid->column('kepemimpinan', __('KEPEMIMPINAN'));

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
        $show = new Show(RiwayatDp3::findOrFail($id));

        $show->field('tahun', __('TAHUN'));
        $show->field('kesetiaan', __('KESETIAAN'));
        $show->field('prestasi', __('PRESTASI'));
        $show->field('tanggung_jawab', __('TANGGUNG JAWAB'));
        $show->field('ketaatan', __('KETAATAN'));
        $show->field('kejujuran', __('KEJUJURAN'));
        $show->field('kerjasama', __('KERJASAMA'));
        $show->field('prakarsa', __('PRAKARSA'));
        $show->field('kepemimpinan', __('KEPEMIMPINAN'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new RiwayatDp3());
        $form->hidden('employee_id', __('Employee id'));
        $form->decimal('kesetiaan', __('KESETIAAN'));
        $form->decimal('prestasi', __('PRESTASI'));
        $form->decimal('tanggung_jawab', __('TANGGUNG JAWAB'));
        $form->decimal('ketaatan', __('KETAATAN'));
        $form->decimal('kejujuran', __('KEJUJURAN'));
        $form->decimal('kerjasama', __('KERJASAMA'));
        $form->decimal('prakarsa', __('PRAKARSA'));
        $form->decimal('kepemimpinan', __('KEPEMIMPINAN'));

        return $form;
    }
}
