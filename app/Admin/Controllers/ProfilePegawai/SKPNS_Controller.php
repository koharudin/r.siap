<?php

namespace App\Admin\Controllers\ProfilePegawai;

use App\Admin\Selectable\GridPejabatPenetap;
use App\Models\Employee;
use App\Models\JenisKP;
use App\Models\JenisPensiun;
use App\Models\Pangkat;
use App\Models\PejabatPenetap;
use App\Models\RiwayatPangkat;
use App\Models\RiwayatPensiun;
use App\Models\RiwayatSKCPNS;
use App\Models\RiwayatSKPNS;
use Carbon\Carbon;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Form;

class SKPNS_Controller extends  ProfileController
{

    public $title = 'SK PNS';
    public $activeTab = 'riwayat_sk_pns';
    public $klasifikasi_id = 4;

    public function detail($id)
    {
        return Admin::content(function (Content $content) {
            $this->index($content);
        });
    }
    public function form()
    {

        $form = new Form(new RiwayatSKPNS());
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
        $form->select('sumpah', 'SUMPAH')->options(['1'=>'Ya','0'=>'Tidak']);
        $form->fieldset('PEJABAT YANG MENETAPKAN ', function (Form $form) {
            $form->belongsTo('pejabat_penetap_id',GridPejabatPenetap::class,'PEJABAT PENETAP');
            $form->text('pejabat_penetap_jabatan', 'JABATAN');
            $form->text('pejabat_penetap_nip', 'NIP');
            $form->text('pejabat_penetap_nama', 'NAMA');
        });

        $form->tools(function ($tools) {
            $tools->disableList();
            $tools->disableView();
            $tools->disableDelete();
        });
        if (!Admin::user()->can('save-skcpns')) {
            $form->disableSubmit();
        }
        $form->saving(function (Form $form) {
            if($form->pejabat_penetap_id){
                $r =  PejabatPenetap::where('id',$form->pejabat_penetap_id)->get()->first();
                if($r){
                    $form->pejabat_penetap_jabatan = $r->jabatan;
                    $form->pejabat_penetap_nip = $r->nip;
                    $form->pejabat_penetap_nama = $r->nama;
                }
            }

            //cek ada riwayat skcpns ?
            $riwayat_skcpns = RiwayatPangkat::where('employee_id',$this->getProfileId())->where('is_cpns_pns',RiwayatPangkat::SK_CPNS)->get()->first();
            if(!$riwayat_skcpns){
                admin_error("Error", "Pegawai belum memiliki riwayat SK CPNS");
                return back();
            }
        });
        
        // callback after save
        $form->saved(function (Form $form) {
            return back();
        });

        $r = RiwayatSKPNS::where('employee_id', $this->getProfileId())->get()->first();
        if ($r) {
            $form  =  $form->edit($r->id);
            $form->setAction($this->activeTab . "/" . $r->id);
            $form->setTitle(' ');
        } else {
            $form->setAction($this->activeTab);
        }
        return $form;
    }
}