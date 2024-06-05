<?php

namespace App\Admin\Controllers\ProfilePegawai;

use App\Models\RiwayatRekamMedis;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class RiwayatRekamMedisController  extends ProfileController
{
    public $activeTab = 'riwayat_rekam_medis';
    public $klasifikasi_id = -100;       
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Riwayat Rekam Medis';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RiwayatRekamMedis());
        $grid->model()->orderBy('tgl_periksa','desc');
        $grid->column('tgl_periksa', __('TANGGAL PERIKSA'))->display(function ($o) {
            if ($o) {
                return $this->tgl_periksa->format('d-m-Y');
            }
            return "-";
        });
        $grid->column('keluhan', __('KELUHAN'));
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
        $show = new Show(RiwayatRekamMedis::findOrFail($id));

        $show->field('tgl_periksa', __('TGL PERIKSA'));
        $show->field('keluhan', __('KELUHAN'));
        $show->field('diagnosa', __('DIAGNOSA'));
        $show->field('jenis_pemeriksaan', __('JENIS PEMERIKSAAN'));
        $show->field('tindakan', __('TINDAKAN'));
        $show->field('dokter', __('DOKTER'));
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new RiwayatRekamMedis());

        $form->hidden('employee_id', __('Employee id'));
        $form->date('tgl_periksa', __('TGL PERIKSA'))->default(date('Y-m-d'));
        $form->textarea('keluhan', __('KELUHAN'));
        $form->textarea('diagnosa', __('DIAGNOSA'));
        $form->text('jenis_pemeriksaan', __('JENIS PEMERIKSAAN'));
        $form->textarea('tindakan', __('TINDAKAN'));
        $form->text('dokter', __('DOKTER'));
        $form->textarea('keterangan', __('KETERANGAN'));

        return $form;
    }
}
