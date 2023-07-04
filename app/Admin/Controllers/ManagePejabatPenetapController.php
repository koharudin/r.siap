<?php

namespace App\Admin\Controllers;

use App\Models\PejabatPenetap;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ManagePejabatPenetapController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Pejabat Penetap';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new PejabatPenetap());

        $grid->column('id', __('ID'));
        $grid->column('jabatan', __('JABATAN'));
        $grid->column('nama', __('NAMA'));
        $grid->column('nip', __('NIP'));
        $grid->column('tahun_awal', __('TAHUN AWAL'));
        $grid->column('tahun_akhir', __('TAHUN AKHIR'));
        
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
        $show = new Show(PejabatPenetap::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('nama', __('NAMA'));
        $show->field('nip', __('NIP'));
        $show->field('golongan', __('GOLONGAN'));
        $show->field('pangkat', __('PANGKAT'));
        $show->field('tahun_awal', __('TAHUN AWAL'));
        $show->field('tahun_akhir', __('TAHUN AKHIR'));
        $show->field('satker_id', __('SATKER ID'));
        $show->field('jabatan', __('JABATAN'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new PejabatPenetap());

        $form->text('jabatan', __('JABATAN'));
        $form->text('nama', __('NAMA'));
        $form->text('nip', __('NIP'));
        $form->text('golongan', __('GOLONGAN'));
        $form->text('pangkat', __('PANGKAT'));
        $form->number('tahun_awal', __('TAHUN AWAL'));
        $form->number('tahun_akhir', __('TAHUN AKHIR'));

        return $form;
    }
}
