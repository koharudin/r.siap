<?php

namespace App\Admin\Controllers\ProfilePegawai;

use App\Models\RiwayatPendidikan;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class RiwayatPendidikanController extends ProfileController
{
    public $activeTab = 'riwayat_pendidikan';
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Riwayat Pendidikan';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RiwayatPendidikan());

        $grid->column('pendidikan_id', __('Pendidikan id'));
        $grid->column('jurusan', __('Jurusan'));
        $grid->column('nama_sekolah', __('Nama sekolah'));
        $grid->column('tempat_sekolah', __('Tempat sekolah'));
        $grid->column('tahun', __('Tahun'));
       
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
        $show = new Show(RiwayatPendidikan::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('employee_id', __('Employee id'));
        $show->field('pendidikan_id', __('Pendidikan id'));
        $show->field('jurusan', __('Jurusan'));
        $show->field('nama_sekolah', __('Nama sekolah'));
        $show->field('tempat_sekolah', __('Tempat sekolah'));
        $show->field('no_sttb', __('No sttb'));
        $show->field('tgl_sttb', __('Tgl sttb'));
        $show->field('tahun', __('Tahun'));
        $show->field('simpeg_id', __('Simpeg id'));
        $show->field('kepala_sekolah', __('Kepala sekolah'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new RiwayatPendidikan());

        $form->hidden('employee_id', __('Employee id'));
        $form->text('pendidikan_id', __('Pendidikan id'));
        $form->text('jurusan', __('Jurusan'));
        $form->text('nama_sekolah', __('Nama sekolah'));
        $form->text('tempat_sekolah', __('Tempat sekolah'));
        $form->text('no_sttb', __('No sttb'));
        $form->date('tgl_sttb', __('Tgl sttb'))->default(date('Y-m-d'));
        $form->text('tahun', __('Tahun'));
        $form->text('simpeg_id', __('Simpeg id'));
        $form->text('kepala_sekolah', __('Kepala sekolah'));

        return $form;
    }
}
