<?php

namespace App\Admin\Controllers\ProfilePegawai;

use App\Models\RiwayatSumpah;
use Encore\Admin\Auth\Permission;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class RiwayatSumpahController extends ProfileController
{
    public $activeTab = 'riwayat_sumpah';
    public $klasifikasi_id = 8;
    
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Riwayat Sumpah';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RiwayatSumpah());
        $grid->model()->orderBy('tgl_sumpah','desc');
        $grid->column('no_sumpah', __('NO SUMPAH'));
        $grid->column('tgl_sumpah', __('TGL SUMPAH'))->display(function ($o) {
            if ($o) {
                return $this->tgl_sumpah->format('d-m-Y');
            }
            return "-";
        });
        $grid->column('keterangan', __('KETERANGAN'));

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
        $show = new Show(RiwayatSumpah::findOrFail($id));

        $show->field('no_sumpah', __('NO SUMPAH'));
        $show->field('tgl_sumpah', __('TGL SUMPAH'));
        $show->field('pengambil_sumpah', __('PENGAMBIL SUMPAH'));
        $show->field('saksi_1', __('SAKSI 1'));
        $show->field('saksi_2', __('SAKSI 2'));
        $show->field('keterangan', __('KETERANGAN'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new RiwayatSumpah());

        $form->hidden('employee_id', __('Employee id'));
        $form->text('no_sumpah', __('NO SUMPAH'));
        $form->date('tgl_sumpah', __('TGL SUMPAH'))->default(date('Y-m-d'));
        $form->text('keterangan', __('KETERANGAN'));

        return $form;
    }
}
