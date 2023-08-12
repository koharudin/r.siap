<?php

namespace App\Admin\Controllers;

use App\Models\Presensi\DetailJenisCuti;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ManageDetailJenisCuti extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Detail Jenis Cuti';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new DetailJenisCuti());

        $grid->column('id', __('Id'));
        $grid->column('jenis_cuti_id', __('Jenis cuti id'));
        $grid->column('name', __('Name'));
        $grid->column('jatah_hari_cuti', __('Jatah hari cuti'));
        $grid->column('satuan_cuti', __('Satuan cuti'));
        $grid->column('persen_pot_cuti', __('Persen pot cuti'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('deleted_at', __('Deleted at'));

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
        $show = new Show(DetailJenisCuti::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('jenis_cuti_id', __('Jenis cuti id'));
        $show->field('name', __('Name'));
        $show->field('jatah_hari_cuti', __('Jatah hari cuti'));
        $show->field('satuan_cuti', __('Satuan cuti'));
        $show->field('persen_pot_cuti', __('Persen pot cuti'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('deleted_at', __('Deleted at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new DetailJenisCuti());

        $form->number('jenis_cuti_id', __('Jenis cuti id'));
        $form->text('name', __('Name'));
        $form->number('jatah_hari_cuti', __('Jatah hari cuti'));
        $form->number('satuan_cuti', __('Satuan cuti'));
        $form->decimal('persen_pot_cuti', __('Persen pot cuti'));

        return $form;
    }
}
