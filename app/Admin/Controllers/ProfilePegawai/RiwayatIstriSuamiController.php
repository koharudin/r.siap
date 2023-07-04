<?php

namespace App\Admin\Controllers\ProfilePegawai;

use App\Models\RiwayatIstriSuami;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class RiwayatIstriSuamiController extends ProfileController
{
    public $activeTab = 'riwayat_istrisuami';

    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Riwayat Istri Suami';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RiwayatIstriSuami());
        $grid->column('id', __('ID'));
        $grid->column('name', __('NAMA'));
        $grid->column('birth_place', __('TEMPAT LAHIR'));
        $grid->column('birth_date', __('TANGGAL LAHIR'));
        $grid->column('buku_nikah', __('BUKU NIKAH'));
        $grid->column('no_karis', __('NO KARIS'));
        $grid->column('tgl_kawin', __('TGL KAWIN'));

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
        $show = new Show(RiwayatIstriSuami::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('name', __('NAMA'));
        $show->field('birth_place', __('TEMPAT LAHIR'));
        $show->field('birth_date', __('TANGGAL LAHIR'));
        $show->field('buku_nikah', __('BUKU NIKAH'));
        $show->field('no_karis', __('NO KARIS'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('tgl_kawin', __('TGL KAWIN'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new RiwayatIstriSuami());
        $form->hidden('employee_id', __('Employee id'));
        $form->text('name', __('NAMA'));
        $form->text('birth_place', __('TEMPAT LAHIR'));
        $form->date('birth_date', __('TANGGAL LAHIR'))->default(date('Y-m-d'));
        $form->text('buku_nikah', __('BUKU NIKAH'));
        $form->text('no_karis', __('NO KARIS'));    
        $form->hidden('employee_id', __('Employee id'));
        $form->date('tgl_kawin', __('TGL KAWIN'))->default(date('Y-m-d'));

        return $form;
    }
}
