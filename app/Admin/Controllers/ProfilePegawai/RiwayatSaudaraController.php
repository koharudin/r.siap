<?php

namespace App\Admin\Controllers\ProfilePegawai;

use App\Models\JenisKelamin;
use App\Models\RiwayatSaudara;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class RiwayatSaudaraController  extends ProfileController
{
    public $activeTab = 'riwayat_saudara';
    public $klasifikasi_id = 26; 
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Riwayat Saudara';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RiwayatSaudara());

        $grid->column('name', __('NAMA'));
        $grid->column('telepon', __('TELEPON'));
        $grid->column('alamat', __('ALAMAT'));

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
        $show = new Show(RiwayatSaudara::findOrFail($id));

        $show->field('name', __('NAMA'));
        $show->field('birth_place', __('TEMPAT LAHIR'));
        $show->field('birth_date', __('TANGGAL LAHIR'));
        $show->field('jenis_kelamin', __('JENIS KELAMIN'));
        $show->field('pekerjaan', __('PEKERJAAN'));
        $show->field('alamat', __('ALAMAT'));
        $show->field('telepon', __('TELEPON'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new RiwayatSaudara());

        $form->hidden('employee_id', __('Employee id'));
        $form->text('name', __('NAMA'));
        $form->text('birth_place', __('TEMPAT LAHIR'));
        $form->date('birth_date', __('TANGGAL LAHIR'))->default(date('Y-m-d'));
        $form->select('jenis_kelamin', __('JENIS KELAMIN'))->options(JenisKelamin::all()->pluck('name','id'));
        $form->text('pekerjaan', __('PEKERJAAN'));
        $form->textarea('alamat', __('ALAMAT'));
        $form->text('telepon', __('TELEPON'));

        return $form;
    }
}
