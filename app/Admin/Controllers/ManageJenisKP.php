<?php

namespace App\Admin\Controllers;

use App\Models\JenisKP;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ManageJenisKP extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Jenis Kenaikan Pangkat';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new JenisKP());

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
        $show = new Show(JenisKP::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('name', __('NAMA'));
        $show->field('sapk_jenis_kp_id', __('SAPK JENIS KP ID'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new JenisKP());

        $form->text('name', __('NAMA'));
        $form->text('sapk_jenis_kp_id', __('SAPK JENIS KP ID'));

        return $form;
    }
}
