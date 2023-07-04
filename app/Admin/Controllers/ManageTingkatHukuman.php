<?php

namespace App\Admin\Controllers;

use App\Models\TingkatHukuman;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ManageTingkatHukuman extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Tingkat Hukuman';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new TingkatHukuman());

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
        $show = new Show(TingkatHukuman::findOrFail($id));

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
        $form = new Form(new TingkatHukuman());

        $form->text('name', __('NAMA'));

        return $form;
    }
}
