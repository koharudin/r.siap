<?php

namespace App\Admin\Controllers;

use App\Models\Pangkat;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ManagePangkat extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Pangkat';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Pangkat());

        $grid->column('id', __('ID'));
        $grid->column('name', __('NAMA'));
        $grid->column('kode', __('KODE'));

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
        $show = new Show(Pangkat::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('name', __('NAMA'));
        $show->field('kode', __('KODE'));
        $show->field('simpeg_id', __('SIMPEG ID'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Pangkat());

        $form->text('name', __('NAMA'));
        $form->text('kode', __('KODE'));
        $form->text('simpeg_id', __('SIMPEG ID'));

        return $form;
    }
}
