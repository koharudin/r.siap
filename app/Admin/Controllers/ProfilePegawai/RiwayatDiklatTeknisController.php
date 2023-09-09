<?php

namespace App\Admin\Controllers\ProfilePegawai;

use App\Admin\Selectable\GridDiklat;
use App\Admin\Selectable\GridUnitKerja;
use App\Models\RiwayatDiklatTeknis;
use App\Models\DiklatSiasn;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class RiwayatDiklatTeknisController extends ProfileController
{
    public $activeTab = 'riwayat_diklat_teknis';
    public $klasifikasi_id = 14;
    
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Riwayat Diklat Teknis';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RiwayatDiklatTeknis());
        
        $grid->model()->where('jenis_diklat', 1);
        $grid->model()->orderBy('tgl_mulai', 'asc');
        $grid->column('nama_diklat', __('NAMA DIKLAT'));
        $grid->column('penyelenggara', __('PENYELENGGARA'));
        $grid->column('tahun', __('TAHUN'));
        $grid->column('tgl_mulai', __('TGL MULAI'))->display(function($o) {
            if($o) {
                return $this->tgl_mulai->format('d-m-Y');
            }
            return "-";
        });
        $grid->column('tgl_selesai', __('TGL SELESAI'))->display(function($o) {
            if($o) {
                return $this->tgl_selesai->format('d-m-Y');
            }
            return "-";
        });
        $grid->column('jumlah_jam', __('JUMLAH JAM'));
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
        $show = new Show(RiwayatDiklatTeknis::findOrFail($id));

        $show->field('obj_jenis.jenis_diklat', __('JENIS DIKLAT'));
        $show->field('nama_diklat', __('NAMA DIKLAT'));
        $show->field('penyelenggara', __('PENYELENGGARA'));
        $show->field('tempat', __('TEMPAT'));
        $show->field('angkatan', __('ANGKATAN'));
        $show->field('no_sttpp', __('NO SERTIFIKAT'));
        $show->field('tgl_sttpp', __('TGL SERTIFIKAT'));
        $show->field('tahun', __('TAHUN'));
        $show->field('tgl_mulai', __('TGL MULAI'));
        $show->field('tgl_selesai', __('TGL SELESAI'));
        $show->field('jumlah_jam', __('JUMLAH JAM'));
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new RiwayatDiklatTeknis());

        $form->hidden('employee_id', __('Employee ID'));
        $form->hidden('jenis_diklat', __('JENIS DIKLAT'));
        $form->hidden('flag_integrasi', __('Status Integrasi'));
        $form->select('jenis_diklat_siasn', __('JENIS DIKLAT'))->options(DiklatSiasn::whereIn('jenis_sertifikat', array('T', 'P'))->pluck('jenis_diklat', 'id_siasn'))->required();
        $form->text('nama_diklat', __('NAMA DIKLAT'))->required();
        $form->text('penyelenggara', __('PENYELENGGARA'))->required();
        $form->text('tempat', __('TEMPAT'));
        $form->text('angkatan', __('ANGKATAN'));
        $form->text('no_sttpp', __('NO SERTIFIKAT'))->required();
        $form->date('tgl_sttpp', __('TGL SERTIFIKAT'))->default(date('Y-m-d'));
        $form->number('tahun', __('TAHUN'))->required();
        $form->date('tgl_mulai', __('TGL MULAI'))->default(date('Y-m-d'))->required();
        $form->date('tgl_selesai', __('TGL SELESAI'))->default(date('Y-m-d'))->required();
        $form->number('jumlah_jam', __('JUMLAH JAM'))->required();
        // $form->belongsTo('diklat_id', GridDiklat::class, 'DIKLAT ID');

        $form->saving(function(Form $form) {
           $form->jenis_diklat = 1; //diklat teknis
           $form->flag_integrasi = 1;
        });
        return $form;
    }
}
