<?php

namespace App\Admin\Controllers;

use App\Models\Bank;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ManageBank extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Bank';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Bank());

        $grid->column('id', __('ID'));
        $grid->column('name', __('NAMA'));

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
        $show = new Show(Bank::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('name', __('NAMA'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Bank());

        $form->text('name', __('NAMA'));

        return $form;
    }
}
