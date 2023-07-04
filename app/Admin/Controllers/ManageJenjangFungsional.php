<?php

namespace App\Admin\Controllers;

use App\Models\JenjangFungsional;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ManageJenjangFungsional extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Jenjang Fungsional';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new JenjangFungsional());

        $grid->column('id', __('ID'));
        $grid->column('name', __('NAMA'));
        $grid->column('min', __('MIN'));
        $grid->column('max', __('MAX'));

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
        $show = new Show(JenjangFungsional::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('name', __('NAMA'));
        $show->field('min', __('MIN'));
        $show->field('max', __('MAX'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new JenjangFungsional());

        $form->text('name', __('NAMA'));
        $form->number('min', __('MIN'));
        $form->number('max', __('MAX'));

        return $form;
    }
}
