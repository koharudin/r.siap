<?php

namespace App\Admin\Controllers;

use App\Models\Presensi\HariLibur;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ManageHariLibur extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Hari Libur';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new HariLibur());

        $grid->column('name', __('NAMA'));
        $grid->column('tgl', __('TANGGAL'));
        $grid->column('status_holiday', __('STATUS'));

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
        $show = new Show(HariLibur::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('NAMA'));
        $show->field('tgl', __('TANGGAL'));
        $show->field('status_holiday', __('STATUS'));
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
        $form = new Form(new HariLibur());

        $form->text('name', __('NAMA'));
        $form->date('tgl', __('TANGGAL'))->default(date('Y-m-d'));
        $form->number('status_holiday', __('STATUS'));

        return $form;
    }
}
