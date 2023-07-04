<?php

namespace App\Admin\Controllers;

use App\Models\UnitKerja;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ManageUnitKerja extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'UnitKerja';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new UnitKerja());

        $grid->column('id', __('Id'));
        $grid->column('parent_id', __('Parent id'));
        $grid->column('name', __('Name'));
        $grid->column('pejabat_jabatan', __('Jabatan'));

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
        $show = new Show(UnitKerja::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('parent_id', __('Parent id'));
        $show->field('name', __('Name'));
        $show->field('simpeg_id', __('Simpeg id'));
        $show->field('path', __('Path'));
        $show->field('pejabat_jabatan', __('Pejabat jabatan'));
        $show->field('pejabat_nip', __('Pejabat nip'));
        $show->field('pejabat_nama', __('Pejabat nama'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new UnitKerja());

        $form->number('parent_id', __('Parent id'));
        $form->text('name', __('Name'));
        $form->textarea('path', __('Path'));
        $form->text('pejabat_jabatan', __('Jabatan'));
        $form->text('pejabat_nip', __('Pejabat nip'));
        $form->text('pejabat_nama', __('Pejabat nama'));

        return $form;
    }
}
