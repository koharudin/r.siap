<?php

namespace App\Admin\Controllers\ProfilePegawai;

use App\Admin\Selectable\GridPejabatPenetap;
use App\Admin\Selectable\GridPenghargaan;
use App\Models\PejabatPenetap;
use App\Models\Penghargaan;
use App\Models\RiwayatPenghargaan;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Admin\Controllers\SiasnController;

class RiwayatPenghargaanController extends ProfileController
{
    public $activeTab = 'riwayat_penghargaan';
    public $klasifikasi_id = 19;
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Riwayat Penghargaan';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RiwayatPenghargaan());
        $grid->model()->orderBy('tgl_sk', 'desc');

        $grid->column('nama_penghargaan', __('NAMA PENGHARGAAN'));
        $grid->column('no_sk', __('NOMOR SK'));
        $grid->column('tgl_sk', __('TANGGAL SK'))->display(function ($o) {
            if($o) {
                return $this->tgl_sk->format('d-m-Y');
            }
            return "-";
        });
        $grid->column('tahun', __('TAHUN'));
        $grid->column('id_siasn', __('INTG.<br>MYASN'))->display(function($o) {
            if(!empty($this->id_siasn)) {
                $label = 'success';
                $status = '<i class="fa fa-check"></i>';
            } else {
                $label = 'danger';
                $status = '<i class="fa fa-times"></i>';
            }
            return "<span class='label label-$label'>".$status."</span>";
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
        $riwayatPenghargaan = RiwayatPenghargaan::findOrFail($id);
        $show = new Show($riwayatPenghargaan);
        $apiData = SiasnController::get_penghargaan($riwayatPenghargaan->id_siasn);
        $apiData = (array) $apiData;

        $show->field('nama_penghargaan', 'NAMA PENGHARGAAN')->as(function($value) {
            return $value ?? '-';
        });
        $show->field('api_data1', ' ')->unescape()->as(function() use($apiData) {
            $value = (!empty($apiData['hargaNama'])) ? $apiData['hargaNama'] : "-";
            return "<span style='color: blue;'>".$value."</span>&nbsp;<span style='font-size: 11px;'>(dari MyASN)</span>";
        });
        $show->divider();

        $show->field('no_sk', 'NOMOR SK')->as(function($value) {
            return $value ?? '-';
        });
        $show->field('api_data2', ' ')->unescape()->as(function() use($apiData) {
            $value = (!empty($apiData['skNomor'])) ? $apiData['skNomor'] : "-";
            return "<span style='color: blue;'>".$value."</span>&nbsp;<span style='font-size: 11px;'>(dari MyASN)</span>";
        });
        $show->divider();

        $show->field('tgl_sk', 'TANGGAL SK')->as(function($value) {
            return (!empty($value)) ? $value->format('d-m-Y') : "-";
        });
        $show->field('api_data3', ' ')->unescape()->as(function() use($apiData) {
            $value = (!empty($apiData['skDate'])) ? $apiData['skDate'] : "-";
            return "<span style='color: blue;'>".$value."</span>&nbsp;<span style='font-size: 11px;'>(dari MyASN)</span>";
        });
        $show->divider();

        $show->field('tahun', 'TAHUN')->as(function($value) {
            return $value ?? '-';
        });
        $show->field('api_data4', ' ')->unescape()->as(function() use($apiData) {
            $value = (!empty($apiData['tahun'])) ? $apiData['tahun'] : "-";
            return "<span style='color: blue;'>".$value."</span>&nbsp;<span style='font-size: 11px;'>(dari MyASN)</span>";
        });
        $show->divider();

        $show->field('pejabat_penetap_nama', 'PENETAP NAMA')->as(function($value) {
            return $value ?? '-';
        });
        $show->field('pejabat_penetap_jabatan', 'PENETAP JABATAN')->as(function($value) {
            return $value ?? '-';
        });

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new RiwayatPenghargaan());

        $form->hidden('employee_id', __('Employee id'));
        $form->hidden('flag_integrasi');
        $form->belongsTo('jenis_penghargaan_id', GridPenghargaan::class, __('PENGHARGAAN'))->required();
        $form->display('nama_penghargaan', __('NAMA PENGHARGAAN'));
        $form->text('no_sk', __('NOMOR SK'))->required();
        $form->date('tgl_sk', __('TANGGAL SK'))->required();
        $form->number('tahun', __('TAHUN'))->required();
        $form->text('pejabat_penetap_nama', __('PENETAP NAMA'));
        $form->text('pejabat_penetap_jabatan', __('PENETAP JABATAN'));

        $form->saving(function (Form $form) {
            if($form->jenis_penghargaan_id) {
                $r = Penghargaan::where('id', $form->jenis_penghargaan_id)->get()->first();
                if($r) {
                    $form->nama_penghargaan = $r->name;
                }
            }
            $form->flag_integrasi = 1;
        });

        return $form;
    }
}
