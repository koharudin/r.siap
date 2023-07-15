<?php

namespace App\Admin\Forms;

use App\Admin\Selectable\GridPejabatPenetap;
use App\Admin\Selectable\GridUnitKerja;
use App\Models\Eselon;
use App\Models\PejabatPenetap;
use App\Models\RiwayatJabatan;
use App\Models\TipeJabatan;
use App\Models\UnitKerja;
use Encore\Admin\Widgets\Form;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class FormRiwayatJabatan extends Form
{
    protected $model;
    public function setModel(RiwayatJabatan $model){
        $this->model = $model;
    }
    /**
     * The form title.
     *
     * @var string
     */
    public $title = 'Riwayat Jabatan';

    /**
     * Handle the form request.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request)
    {
        //dump($request->all());

        admin_success('Processed successfully.');

        return back();
    }

    public function edit($id){
        
    }
    /**
     * Build a form here.
     */
    public function form()
    {
        $form = $this;
        $form->hidden('employee_id', __('Employee id'));
        
        $form->select('tipe_jabatan_id', __('TIPE JABATAN'))->options(TipeJabatan::all()->pluck('name', 'id'))->when('in',[1,6], function (Form $form) {
            $form->select('eselon', __('ESELON'))->options(Eselon::all()->pluck('name', 'id'));
            $form->date('tmt_eselon', __('TMT ESELON'))->default(date('Y-m-d'));
        });
        $form->text('no_sk', __('NO SK'));
        $form->date('tgl_sk', __('TGL SK'))->default(date('Y-m-d'));
        $form->date('tmt_jabatan', __('TMT JABATAN'))->default(date('Y-m-d'));
        
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
    }

    /**
     * The data of the form.
     *
     * @return array $data
     */
    public function data()
    {
        return [
            'name'       => 'John Doe',
            'email'      => 'John.Doe@gmail.com',
            'created_at' => now(),
        ];
    }
}
