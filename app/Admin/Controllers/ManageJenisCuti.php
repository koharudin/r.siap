<?php

namespace App\Admin\Controllers;

use App\Models\Presensi\JenisCuti;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ManageJenisCuti extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'JenisCuti';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new JenisCuti());

        $grid->column('name', __('NAMA'));
        $grid->column('batas_tahun_penangguhan', __('BATAS TAHUN PENANGGUHAN'));
        $grid->column('batas_cuti',__('BATAS CUTI'));
        $grid->column('satuan_cuti', __('SATUAN CUTI'));
        $grid->column('jatah_cuti', __('JATAH CUTI'));
        $grid->actions(function($actions){
            $actions->disableDelete();
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
        $show = new Show(JenisCuti::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('NAMA'));
        $show->field('batas_tahun_penangguhan', __('BATAS TAHUN PENANGGUHAN'));
        $show->field('batas_cuti',__('BATAS CUTI'));
        $show->field('satuan_cuti', __('SATUAN CUTI'));
        $show->field('jatah_cuti', __('JATAH CUTI'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new JenisCuti());

        $form->text('name', __('NAMA'))->required(true);
        $form->number('batas_tahun_penangguhan', __('BATAS TAHUN PENANGGUHAN'));
        $form->number('batas_cuti',__('BATAS CUTI'));
        $form->text('satuan_cuti', __('SATUAN CUTI'));
        $form->text('jatah_cuti', __('JATAH CUTI'));

        return $form;
    }
}
