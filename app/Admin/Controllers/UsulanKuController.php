<?php

namespace App\Admin\Controllers;

use App\Admin\Forms\Requests\ChooseAction;
use App\Admin\Forms\Requests\ChooseCategory;
use App\Models\RiwayatUsulan;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Form\Row;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row as LayoutRow;
use Encore\Admin\Show;
use Encore\Admin\Widgets\MultipleSteps;

class UsulanKuController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Usulan Ku';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RiwayatUsulan());
        $grid->model()->load(['obj_status']);
        $grid->model()->where('employee_id', 578);
        $grid->column('obj_kategori_layanan.name', __('KATEGORI'));
        $grid->column('obj_status.name', __('Status'));
        $grid->column('created_at', __('DIUSULKAN PADA'))->display(function($o){
            return $this->created_at->diffForHumans();
        });
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
        $show = new Show(RiwayatUsulan::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('employee_id', __('Employee id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('old_data', __('Old data'));
        $show->field('new_data', __('New data'));
        $show->field('status', __('Status'));

        return $show;
    }


    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new RiwayatUsulan());

        $form->number('employee_id', __('Employee id'));
        $form->textarea('old_data', __('Old data'));
        $form->textarea('new_data', __('New data'));
        $form->number('status', __('Status'));

        return $form;
    }
    public function edit($id, Content $content)
    {
        $usulan = RiwayatUsulan::with(['obj_kategori_layanan'])->find($id);
        $form = new $usulan->obj_kategori_layanan->form_request_class;
        return $content
            ->title($this->title())
            ->description($this->description['edit'] ?? trans('admin.edit'))
            ->body($form);
    }
    public function create(Content $content)
    {
        $steps = [
            'choose_category'     => ChooseCategory::class,
            'choose_action' => ChooseAction::class
        ];
        return $content
            ->title($this->title())
            ->description($this->description['create'] ?? trans('admin.create'))
            ->body(MultipleSteps::make($steps));
    }
}
