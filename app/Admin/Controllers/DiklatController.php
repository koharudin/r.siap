<?php

namespace App\Admin\Controllers;

use App\Models\Diklat;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class DiklatController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Diklat';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    public function index(Content $content)
    {
        return Admin::content(function (Content $content) {
            $content->header('Unit Kerja');
            $content->body(Diklat::tree());
        });
    }
    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Diklat::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('parent_id', __('Parent id'));
        $show->field('name', __('Name'));
        $show->field('keterangan', __('Keterangan'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('simpeg_id', __('Simpeg id'));
        $show->field('order', __('Order'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Diklat());

        $form->number('parent_id', __('Parent id'));
        $form->text('name', __('Name'));
        $form->text('keterangan', __('Keterangan'));
        $form->text('simpeg_id', __('Simpeg id'));
        $form->number('order', __('Order'))->default(1);

        return $form;
    }
}
