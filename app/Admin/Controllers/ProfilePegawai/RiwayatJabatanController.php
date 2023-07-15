<?php

namespace App\Admin\Controllers\ProfilePegawai;

use App\Admin\Selectable\GridJabatan;
use Illuminate\Http\UploadedFile;
use App\Admin\Selectable\GridPejabatPenetap;
use App\Admin\Selectable\GridUnitKerja;
use App\Models\DokumenPegawai;
use App\Models\Eselon;
use App\Models\JenisKP;
use App\Models\Pangkat;
use App\Models\PejabatPenetap;
use App\Models\RiwayatJabatan;
use App\Models\RiwayatPangkat;
use App\Models\TipeJabatan;
use App\Models\UnitKerja;
use Encore\Admin\Auth\Permission;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Storage;

class RiwayatJabatanController extends ProfileController
{
    public $activeTab = 'riwayat_jabatan';
    public $klasifikasi_id = 6;
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Riwayat Jabatan';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $employee = $this->getEmployee();
        $grid = new Grid(new RiwayatJabatan());
        $grid->model()->orderBy('tmt_jabatan','desc');
        $grid->column('nama_jabatan', __('JABATAN'));
        $grid->column('unit_text', __('UNIT KERJA'));
        $grid->column('tmt_jabatan', __('TMT JABATAN'));
        $grid->column('no_sk', __('NO SK'));
        $grid->column('tgl_sk', __('TGL SK'));
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
        $show = new Show(RiwayatJabatan::findOrFail($id));

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
        $form = new Form(new RiwayatJabatan());
        $form->hidden('employee_id', __('Employee id'));
        
       
        $form->text('no_sk', __('NO SK'));
        $form->date('tgl_sk', __('TGL SK'))->default(date('Y-m-d'));
        $form->date('tmt_jabatan', __('TMT JABATAN'))->default(date('Y-m-d'));
        $form->select('tipe_jabatan_id', __('TIPE JABATAN'))->options(TipeJabatan::all()->pluck('name', 'id'))->when('in',[1,6], function (Form $form) {
            $form->select('eselon', __('ESELON'))->options(Eselon::all()->pluck('name', 'id'));
            $form->date('tmt_eselon', __('TMT ESELON'))->default(date('Y-m-d'));
            $form->belongsTo('jabatan_struktural_id', GridUnitKerja::class, 'JABATAN');
        })->when('in',[2,3,4,5],function(Form $form){
            $form->belongsTo('fungsional_id', GridJabatan::class, 'JABATAN');
        });
        $form->text('nama_jabatan', __('NAMA JABATAN'));
        $form->text('no_pelantikan', __('NO PELANTIKAN'));
        $form->date('tgl_pelantikan', __('TGL PELANTIKAN'))->default(date('Y-m-d'));
        $form->text('tunjangan', __('TUNJANGAN'));
        $form->date('bln_dibayar', __('BULAN DIBAYAR'));
        $form->belongsTo('unit_id',GridUnitKerja::class, __('UNIT KERJA'));
        $form->text("unit_text",__("UNIT KERJA"));
        $form->text('keterangan', __('KETERANGAN'));

        $form->divider("Pejabat Penetap");
        $form->belongsTo('pejabat_penetap_id', GridPejabatPenetap::class, 'PEJABAT PENETAP');
        $form->text('pejabat_penetap_jabatan', __('JABATAN'));
        $form->text('pejabat_penetap_nip', __('NIP'));
        $form->text('pejabat_penetap_nama', __('NAMA'));
        $form->divider();
        $d = $form->file('dokumen', 'DOKUMEN PENDUKUNG')->disk('minio_dokumen')->uniqueName();

        $form->submitted(function (Form $form) use ($d) {
            $form->ignore('dokumen');
            $form->ignore('jabatan_struktural_id');
        });
        $_this = $this;
        $form->saving(function (Form $form) use ($d, $_this) {
            if ($form->pejabat_penetap_id) {
                $r =  PejabatPenetap::where('id', $form->pejabat_penetap_id)->get()->first();
                if ($r) {
                    $form->pejabat_penetap_jabatan = $r->jabatan;
                    $form->pejabat_penetap_nip = $r->nip;
                    $form->pejabat_penetap_nama = $r->nama;
                }
            }
            if($form->unit_id){
                $unit_kerja =  UnitKerja::where('id',$form->unit_id)->get()->first();
                if($unit_kerja){
                    $form->unit_text = $unit_kerja->name;
                }
            }
        });
        $form->saved(function (Form $form) use ($d, $_this) {
            $file = request()->file('dokumen');
            if ($file) {
                $newFileName = $d->prepare($file);
                $keys = explode("#", $form->model()->simpeg_id);
                $arr = [
                    'id' => $form->model()->id,
                    'klasifikasi_id' => 5,
                    'pk1' => sizeof($keys) == 2 ? $keys[0] : null,
                    'pk2' => sizeof($keys) == 2 ? $keys[1] : null,
                ];
                $_this->saveDokumenUpload($file->getClientOriginalName(), $newFileName, $arr);
            }
        });
        return $form;
    }
}
