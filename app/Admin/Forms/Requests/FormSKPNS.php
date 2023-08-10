<?php

namespace App\Admin\Forms\Requests;

use App\Admin\Selectable\GridPejabatPenetap;
use App\Models\Pangkat;
use App\Models\PejabatPenetap;
use App\Models\RiwayatAngkaKredit;
use App\Models\RiwayatPangkat;
use Encore\Admin\Form;

class FormSKPNS extends FF
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = 'SK PNS';

    /**
     * Build a form here.
     */
    public function buildForm()
    {
        $form = $this;
        $form->hidden('employee_id', 'ID');
        // Add an input box of type text
        $form->text('no_sk', 'NO. SURAT KEPUTUSAN')->required(true);
        $form->date('tgl_sk', 'TGL SURAT KEPUTUSAN')->required(true);
        $form->date('tmt_pns', 'TMT PNS')->required(true);
        $form->text('no_prajab', 'NO. DIKLAT PRAJABATAN');
        $form->date('tgl_prajab', 'TGL DIKLAT PRAJABATAN');
        $form->text('no_ujikes', 'NO. SURAT UJI KESEHATAN');
        $form->date('tgl_ujikes', 'TGL TGL SURAT UJI KESEHATAN');
        $form->select('pangkat_id', 'PANGKAT (GOL RUANG)')->options(Pangkat::all()->pluck('name', 'id'));
        $form->select('sumpah', 'SUMPAH')->options(['1' => 'Ya', '0' => 'Tidak']);
        $form->fieldset('PEJABAT YANG MENETAPKAN ', function (Form $form) {
            $form->belongsTo('pejabat_penetap_id', GridPejabatPenetap::class, 'PEJABAT PENETAP');
            $form->text('pejabat_penetap_jabatan', 'JABATAN');
            $form->text('pejabat_penetap_nip', 'NIP');
            $form->text('pejabat_penetap_nama', 'NAMA');
        });

        $form->tools(function ($tools) {
            $tools->disableList();
            $tools->disableView();
            $tools->disableDelete();
        });
        $form->saving(function (Form $form) {
            if ($form->pejabat_penetap_id) {
                $r =  PejabatPenetap::where('id', $form->pejabat_penetap_id)->get()->first();
                if ($r) {
                    $form->pejabat_penetap_jabatan = $r->jabatan;
                    $form->pejabat_penetap_nip = $r->nip;
                    $form->pejabat_penetap_nama = $r->nama;
                }
            }
        });
    }
    public function onCreateForm()
    {
        $data = [];
        return parent::edit($data);
    }
}
