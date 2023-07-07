<?php

namespace App\Admin\Controllers;

use App\Models\GolonganDarah;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ManageGolonganDarahController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Golongan Darah';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new GolonganDarah());

        $grid->column('id', __('Golongan Darah'));

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
        $show = new Show(GolonganDarah::findOrFail($id));

        $show->field('id', __('Golongan Darah'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new GolonganDarah());
        $form->text("id","Golongan Darah");
        return $form;
    }
}
