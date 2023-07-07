<?php

namespace App\Admin\Controllers;

use App\Models\Pendidikan;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

use Encore\Admin\Layout\Content;

class ManagePendidikanController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Pendidikan';

    use ModelForm;

    public function index(Content $content)
    {
        return Admin::content(function (Content $content) {
            $content->header('Pendidikan');
            $content->body(Pendidikan::tree());
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
        $show = new Show(Pendidikan::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('parent_id', __('Parent id'));
        $show->field('name', __('NAMA'));
        $show->field('pangkat_min', __('PANGKAT MIN'));
        $show->field('pangkat_max', __('PANGKAT MAX'));
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
        $form = new Form(new Pendidikan());

        $form->number('parent_id', __('Parent id'));
        $form->text('name', __('NAMA'));
        $form->text('pangkat_min', __('PANGKAT MIN'));
        $form->text('pangkat_max', __('PANGKAT MAX'));

        return $form;
    }
}
