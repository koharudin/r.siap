<?php

namespace App\Admin\Controllers;

use App\Models\Hukuman;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;

class ManageHukumanController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Hukuman';

    public function index(Content $content)
    {
       
        return Admin::content(function (Content $content) {
            $content->header('Hukuman');
            $content->body(Hukuman::tree());
        });
    }
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Hukuman());

        $grid->column('id', __('Id'));
        $grid->column('parent_id', __('Parent id'));
        $grid->column('simpeg_id', __('Simpeg id'));
        $grid->column('hukuman', __('Hukuman'));
        $grid->column('jenis', __('Jenis'));
        $grid->column('jumlah_min', __('Jumlah min'));
        $grid->column('jumlah_max', __('Jumlah max'));
        $grid->column('jenis_efek', __('Jenis efek'));
        $grid->column('durasi_efek', __('Durasi efek'));
        $grid->column('proses', __('Proses'));
        $grid->column('rentang', __('Rentang'));
        $grid->column('efek', __('Efek'));
        $grid->column('tingkat', __('Tingkat'));
        $grid->column('keterangan', __('Keterangan'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('order', __('Order'));

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
        $show = new Show(Hukuman::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('parent_id', __('Parent id'));
        $show->field('simpeg_id', __('Simpeg id'));
        $show->field('hukuman', __('Hukuman'));
        $show->field('jenis', __('Jenis'));
        $show->field('jumlah_min', __('Jumlah min'));
        $show->field('jumlah_max', __('Jumlah max'));
        $show->field('jenis_efek', __('Jenis efek'));
        $show->field('durasi_efek', __('Durasi efek'));
        $show->field('proses', __('Proses'));
        $show->field('rentang', __('Rentang'));
        $show->field('efek', __('Efek'));
        $show->field('tingkat', __('Tingkat'));
        $show->field('keterangan', __('Keterangan'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
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
        $form = new Form(new Hukuman());

        $form->number('parent_id', __('Parent id'));
        $form->text('simpeg_id', __('Simpeg id'));
        $form->text('hukuman', __('Hukuman'));
        $form->decimal('jenis', __('Jenis'));
        $form->decimal('jumlah_min', __('Jumlah min'));
        $form->decimal('jumlah_max', __('Jumlah max'));
        $form->decimal('jenis_efek', __('Jenis efek'));
        $form->decimal('durasi_efek', __('Durasi efek'));
        $form->decimal('proses', __('Proses'));
        $form->decimal('rentang', __('Rentang'));
        $form->decimal('efek', __('Efek'));
        $form->decimal('tingkat', __('Tingkat'));
        $form->text('keterangan', __('Keterangan'));
        $form->number('order', __('Order'))->default(1);

        return $form;
    }
}
