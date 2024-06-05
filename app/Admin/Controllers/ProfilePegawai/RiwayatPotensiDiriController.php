<?php

namespace App\Admin\Controllers\ProfilePegawai;

use App\Models\RiwayatPotensiDiri;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class RiwayatPotensiDiriController  extends ProfileController
{
    public $activeTab = 'riwayat_potensi_diri';
    public $klasifikasi_id = 20;       
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Riwayat Potensi Diri';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RiwayatPotensiDiri());
        $grid->model()->orderBy('tahun','desc');
        $grid->column('tahun', __('TAHUN'));
        $grid->column('tanggung_jawab', __('TANGGUNG JAWAB'));
        $grid->column('motivasi', __('MOTIVASI'));
        $grid->column('minat', __('MINAT'));
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
        $show = new Show(RiwayatPotensiDiri::findOrFail($id));

        $show->field('tahun', __('TAHUN'));
        $show->field('tanggung_jawab', __('TANGGUNG JAWAB'));
        $show->field('motivasi', __('MOTIVASI'));
        $show->field('minat', __('MINAT'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new RiwayatPotensiDiri());
        $form->hidden('employee_id', __('Employee id'));
        $form->decimal('tahun', __('TAHUN'));
        $form->textarea('tanggung_jawab', __('TANGGUNG JAWAB'));
        $form->textarea('motivasi', __('MOTIVASI'));
        $form->textarea('minat', __('MINAT'));

        return $form;
    }
}
