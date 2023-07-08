<?php

namespace App\Admin\Controllers\ProfilePegawai;

use App\Admin\Selectable\GridPejabatPenetap;
use App\Models\JenisKP;
use App\Models\Pangkat;
use App\Models\PejabatPenetap;
use App\Models\RiwayatPangkat;
use Encore\Admin\Auth\Permission;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class RiwayatPangkatController extends ProfileController
{
    public $activeTab = 'riwayat_pangkat';
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Riwayat Pangkat';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RiwayatPangkat());
        $grid->column('no_sk', __('NO SK'));
        $grid->column('tgl_sk', __('TGL SK'));
        $grid->column('obj_pangkat.name', __('PANGKAT'));
        $grid->column('obj_jenis_kenaikan_pangkat.name', __('JENIS KP'));
        $grid->column('pejabat_penetap_nip', __('PENETAP NIP'));
        $grid->column('pejabat_penetap_nama', __('PENETAP NAMA'));
        $grid->column('pejabat_penetap_jabatan', __('PENETAP JABATAN'));

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
        $show = new Show(RiwayatPangkat::findOrFail($id));

        $show->field('stlud', __('STLUD'));
        $show->field('no_stlud', __('NO STLUD'));
        $show->field('tgl_stlud', __('TGL STLUD'));
        $show->field('no_nota', __('NO NOTA'));
        $show->field('tgl_nota', __('TGL NOTA'));
        $show->field('no_sk', __('NO SK'));
        $show->field('tgl_sk', __('TGL SK'));
        $show->field('tmt_pangkat', __('TMT PANGKAT'));
        $show->field('kredit', __('KREDIT'));
        $show->field('obj_pangkat.name', __('PANGKAT'));
        $show->field('obj_jenis_kenaikan_pangkat.name', __('JENIS KP'));
        $show->field('keterangan', __('KETERANGAN'));
        $show->field('jenis_ket', __('JENIS KET'));
        $show->field('tmt_pak', __('TMT PAK'));
        $show->field('masakerja_thn', __('MASA KERJA TAHUN'));
        $show->field('masakerja_bln', __('MASA KERJA BULAN'));
        $show->divider("PEJABAT PENETAP");
        $show->field('penetap_nip', __('PENETAP NIP'));
        $show->field('penetap_nama', __('PENETAP NAMA'));
        $show->field('penetap_jabatan', __('PENETAP JABATAN'));
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new RiwayatPangkat());
        $form->hidden('employee_id', __('Employee id'));
        $form->text('stlud', __('STLUD'));
        $form->text('no_stlud', __('NO STLUD'));
        $form->date('tgl_stlud', __('TGL STLUD'))->default(date('Y-m-d'));
        $form->text('no_nota', __('NO NOTA'));
        $form->date('tgl_nota', __('TGL NOTA'))->default(date('Y-m-d'));
        $form->text('no_sk', __('NO SK'));
        $form->date('tgl_sk', __('TGL SK'))->default(date('Y-m-d'));
        $form->date('tmt_pangkat', __('TMT PANGKAT'))->default(date('Y-m-d'));
        
        $form->decimal('kredit', __('KREDIT'));
        $form->select('pangkat_id', __('PANGKAT'))->options(Pangkat::all()->pluck('name','id'));
        $form->select('jenis_kp', __('JENIS KP'))->options(JenisKP::all()->pluck('name','id'));
        $form->text('keterangan', __('KETERANGAN'));
        $form->text('jenis_ket', __('JENIS KET'));
        $form->date('tmt_pak', __('TMT PAK'))->default(date('Y-m-d'));
        $form->number('masakerja_thn', __('MASA KERJA TAHUN'));
        $form->number('masakerja_bln', __('MASA KERJA BULAN'));
        $form->divider("Pejabat Penetap");
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
        });
        return $form;
    }
    
}
