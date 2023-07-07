<?php

namespace App\Admin\Controllers\ProfilePegawai;

use App\Admin\Selectable\GridPejabatPenetap;
use App\Admin\Selectable\GridUnitKerja;
use App\Models\PejabatPenetap;
use App\Models\RiwayatMutasi;
use App\Models\UnitKerja;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class RiwayatMutasiController extends ProfileController
{
    public $activeTab = 'riwayat_mutasi';
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Riwayat Mutasi';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RiwayatMutasi());

        $grid->column('satker_lama', __('SATKER LAMA'));
        $grid->column('satker_baru', __('SATKER BARU'));
        $grid->column('no_sk', __('NO SK'));
        $grid->column('tgl_sk', __('TGL SK'));
        $grid->column('tmt_sk', __('TMT SK'));
        $grid->column('pejabat_penetap_jabatan', __('PEJABAT PENETAP'));

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
        $show = new Show(RiwayatMutasi::findOrFail($id));

        $show->field('satker_lama', __('SATKER LAMA'));
        $show->field('satker_baru', __('SATKER BARU'));
        $show->field('no_sk', __('NO SK'));
        $show->field('tgl_sk', __('TGL SK'));
        $show->field('tmt_sk', __('TMT SK'));
        $show->field('pejabat_penetap_nip', __('PEJABAT PENETAP NIP'));
        $show->field('pejabat_penetap_nama', __('PEJABAT PENETAP NAMA'));
        $show->field('pejabat_penetap_jabatan', __('PEJABAT PENETAP JABATAN'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new RiwayatMutasi());

        $form->hidden('employee_id', __('Employee id'));
        $form->belongsTo('satker_id_lama',GridUnitKerja::class,'SATKER LAMA');
        $form->text('satker_lama', __('SATKER LAMA'));
        $form->belongsTo('satker_id_baru',GridUnitKerja::class,'SATKER BARU');
        $form->text('satker_baru', __('SATKER BARU'));
        $form->text('no_sk', __('NO SK'));
        $form->date('tgl_sk', __('TGL SK'))->default(date('Y-m-d'));
        $form->date('tmt_sk', __('TMT SK'))->default(date('Y-m-d'));
        $form->belongsTo('pejabat_penetap_id',GridPejabatPenetap::class,'PEJABAT PENETAP');
        $form->text('pejabat_penetap_jabatan', __('JABATAN'));
        $form->text('pejabat_penetap_nip', __('NIP'));
        $form->text('pejabat_penetap_nama', __('NAMA'));
        
        $form->saving(function (Form $form) {
            if($form->pejabat_penetap_id){
                $r =  PejabatPenetap::where('id',$form->pejabat_penetap_id)->get()->first();
                if($r){
                    $form->pejabat_penetap_jabatan = $r->jabatan;
                    $form->pejabat_penetap_nip = $r->nip;
                    $form->pejabat_penetap_nama = $r->nama;
                }
            }
            if($form->satker_id_lama){
                $r =  UnitKerja::where('id',$form->satker_id_lama)->get()->first();
                if($r){
                    $form->satker_lama = $r->name;
                }
            }
            if($form->satker_id_baru){
                $r =  UnitKerja::where('id',$form->satker_id_baru)->get()->first();
                if($r){
                    $form->satker_baru = $r->name;
                }
            }
        });

        return $form;
    }
}
