<?php

namespace App\Admin\Controllers;

use App\Models\Penghargaan;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ManagePenghargaan extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Penghargaan';

    public function index(Content $content)
    {
        return Admin::content(function (Content $content) {
            $content->header('Penghargaan');
            $content->body(Penghargaan::tree());
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
        $show = new Show(Penghargaan::findOrFail($id));

        $show->field('name', __('NAMA'));
        $show->field('keterangan', __('KETERANGAN'));
        $show->field('order', __('ORDER'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Penghargaan());

        $form->select('parent_id', __('PARENT ID'))->options(Penghargaan::all()->pluck('name','id'));
        $form->text('name', __('NAMA'));
        $form->text('keterangan', __('KETERANGAN'));
        $form->number('order', __('ORDER'))->default(1);

        return $form;
    }
}
