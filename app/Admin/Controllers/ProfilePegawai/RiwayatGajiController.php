<?php

namespace App\Admin\Controllers\ProfilePegawai;

use App\Admin\Selectable\GridPejabatPenetap;
use App\Models\JenisKenaikanGaji;
use App\Models\Pangkat;
use App\Models\PejabatPenetap;
use App\Models\RiwayatGaji;
use Encore\Admin\Auth\Permission;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class RiwayatGajiController extends  ProfileController
{
    public $activeTab = 'riwayat_gaji';
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Riwayat Gaji';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RiwayatGaji());

        $grid->column('no_sk', __('NO SK'));
        $grid->column('tgl_sk', __('TGL SK'));
        $grid->column('tmt_sk', __('TMT SK'));
        $grid->column('objPangkat.name', __('PANGKAT'));
        $grid->column('masakerja_tahun', __('MASA KERJA TAHUN'));
        $grid->column('masakerja_bulan', __('MASA KERJA BULAN'));
        $grid->column('objJenisKenaikanGaji.name', _('JENIS KENAIKAN'));
        $grid->column('gaji_pokok', __('GAJI POKOK'));
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
        $show = new Show(RiwayatGaji::findOrFail($id));

        $show->field('no_sk', __('NO SK'));
        $show->field('tgl_sk', __('TGL SK'));
        $show->field('tmt_sk', __('TMT SK'));
        $show->field('pejabat_penetap_id', __('Pejabat penetap id'));
        $show->field('pejabat_penetap_nama', _('PEJABAT PENETAP NAMA'));
        $show->field('pejabat_penetap_jabatan', __('PEJABAT PENETAP JABATAN'));
        $show->field('pejabat_penetap_nip', __('PEJABAT PENETAP NIP'));
        $show->field('masakerja_tahun', __('MASA KERJA TAHUN'));
        $show->field('masakerja_bulan', __('MASA KERJA BULAN'));
        $show->field('jenis_kenaikan', _('JENIS KENAIKAN'));
        $show->field('gaji_pokok', __('GAJI POKOK'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new RiwayatGaji());

        $form->hidden('employee_id', __('Employee id'));
        $form->text('no_sk', __('NO SK'));
        $form->date('tgl_sk', __('TGL SK'))->default(date('Y-m-d'));
        $form->date('tmt_sk', __('TMT SK'))->default(date('Y-m-d'));
        $form->select('pangkat_id', _('PANGKAT'))->options(Pangkat::all()->pluck('name','id'));

       
        $form->number('masakerja_tahun', __('MASA KERJA TAHUN'));
        $form->number('masakerja_bulan', __('MASA KERJA BULAN'));
        $form->select('jenis_kenaikan', _('JENIS KENAIKAN'))->options(JenisKenaikanGaji::all()->pluck('name','id'));
        $form->decimal('gaji_pokok', __('GAJI POKOK'));
        
        $form->divider("Pejabat Penetap");
        $form->belongsTo('pejabat_penetap_id',GridPejabatPenetap::class,'PEJABAT PENETAP');
        $form->text('pejabat_penetap_nama', _('PEJABAT PENETAP NAMA'));
        $form->text('pejabat_penetap_jabatan', __('PEJABAT PENETAP JABATAN'));
        $form->text('pejabat_penetap_nip', __('PEJABAT PENETAP NIP'));
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
