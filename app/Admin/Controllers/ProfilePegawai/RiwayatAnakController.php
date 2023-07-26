<?php

namespace App\Admin\Controllers\ProfilePegawai;

use App\Models\JenisKelamin;
use App\Models\RiwayatAnak;
use App\Models\StatusAnak;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class RiwayatAnakController extends ProfileController
{
    public $activeTab = 'riwayat_anak';
    public $klasifikasi_id = 25; 
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Riwayat Anak';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RiwayatAnak());
        $grid->model()->orderBy('birth_date','asc');
        $grid->column('name', __('NAMA'));
        $grid->column('birth_place', __('TEMPAT LAHIR'));
        $grid->column('birth_date', __('TANGGAL LAHIR'))->display(function ($o) {
            if ($o) {
                return $this->birth_date->format('d-m-Y');
            }
            return "-";
        });
        $grid->column('obj_jenis_kelamin.name', __('JENIS KELAMIN'));
        $grid->column('obj_status_anak.name', __('STATUS KELUARGA'));
        $grid->column('status_tunjangan', __('STATUS TUNJANGAN'));
        $grid->column('bln_dibayar', __('BLN DIBAYAR'));
        $grid->column('bln_akhir_dibayar', __('BLN AKHIR DIBAYAR'));

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
        $show = new Show(RiwayatAnak::findOrFail($id));

        $show->field('name', __('NAMA'));
        $show->field('birth_place', __('TEMPAT LAHIR'));
        $show->field('birth_date', __('TANGGAL LAHIR'));
        $show->field('jenis_kelamin', __('JENIS KELAMIN'));
        $show->field('status_keluarga', __('STATUS KELUARGA'));
        $show->field('status_tunjangan', __('STATUS TUNJANGAN'));
        $show->field('bln_dibayar', __('BLN DIBAYAR'));
        $show->field('bln_akhir_dibayar', __('BLN AKHIR DIBAYAR'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new RiwayatAnak());

        $form->hidden('employee_id', __('Employee id'));
        $form->text('name', __('NAMA'));
        $form->text('birth_place', __('TEMPAT LAHIR'));
        $form->date('birth_date', __('TANGGAL LAHIR'))->default(date('Y-m-d'));
        $form->select('jenis_kelamin', __('JENIS KELAMIN'))->options(JenisKelamin::all()->pluck('name','id'));
        $form->text('pekerjaan', __('PEKERJAAN'));
        $form->select('status_keluarga', __('STATUS KELUARGA'))->options(StatusAnak::all()->pluck('name','id'));
        $form->select('status_tunjangan', __('STATUS TUNJANGAN'))->options(['1' => 'Dapat',  '0' => 'Tidak']);
        $form->date('bln_dibayar', __('BLN DIBAYAR'))->default(date('Y-m-d'));
        $form->date('bln_akhir_dibayar', __('BLN AKHIR DIBAYAR'))->default(date('Y-m-d'));

        return $form;
    }
}
