<?php

namespace App\Admin\Controllers\ProfilePegawai;

use App\Admin\Selectable\GridPejabatPenetap;
use App\Models\Employee;
use App\Models\JenisPensiun;
use App\Models\Pangkat;
use App\Models\PejabatPenetap;
use App\Models\RiwayatPangkat;
use App\Models\RiwayatPensiun;
use App\Models\RiwayatSKCPNS;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Form;

class SKCPNS_Controller extends  ProfileController
{

    public $title = 'SK CPNS';
    public $activeTab = 'riwayat_sk_cpns';
    public $klasifikasi_id = 3;

    public function detail($id)
    {
        return Admin::content(function (Content $content) {
            $this->index($content);
        });
    }
    public function form()
    {

        $form = new Form(new RiwayatSKCPNS());
        $form->hidden('employee_id', 'ID');
        // Add an input box of type text
        $form->select('pangkat_id', 'PANGKAT (GOL RUANG)')->options(Pangkat::all()->pluck('name', 'id'));
        $form->text('no_sk', 'NO SK')->required(true);
        $form->date('tgl_sk', 'TANGGAL SK')->required(true);
        $form->date('tmt_cpns', 'TMT CPNS')->required(true);

        $form->fieldset('PEJABAT YANG MENETAPKAN SK CPNS', function (Form $form) {
            $form->belongsTo('pejabat_penetap_id', GridPejabatPenetap::class, 'PEJABAT PENETAP');
            $form->text('pejabat_penetap_jabatan', 'JABATAN');
            $form->text('pejabat_penetap_nip', 'NIP');
            $form->text('pejabat_penetap_nama', 'NAMA');
        });
        $form->text('masa_kerja_tahun', 'MASA KERJA (TAHUN)');
        $form->text('masa_kerja_bulan', 'MASA KERJA (BULAN)');
        $form->date('tgl_tugas', 'TANGGAL TUGAS');
        $form->fieldset('PENYESUAIAN MASA KERJA', function (Form $form) {
            $form->text('no_sk_penyesuaian_mk', 'NO SK');
            $form->date('tgl_sk_penyesuaian_mk', 'TANGGAL SK');
            $form->date('tmt_sk_penyesuaian_mk', 'TMT SK');
            $form->text('pejabat_penetap_sk_penyesuaian_mk', 'NO SK');
            $form->text('tambahan_tahun', 'TAMBAHAN MASA KERJA (TAHUN)');
            $form->text('tambahan_bulan', 'TAMBAHAN MASA KERJA (BULAN)');
        });
        $form->divider();
        $form->text('total_tahun', 'MASA KERJA AKUMULASI (TAHUN)');
        $form->text('total_bulan', 'MASA KERJA AKUMULASI (BULAN)');

        $form->tools(function ($tools) {
            $tools->disableList();
            $tools->disableView();
            $tools->disableDelete();
        });
        if (!Admin::user()->can('save-skcpns')) {
            $form->disableSubmit();
        }
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

        // callback after save
        $form->saved(function (Form $form) {
            return back();
        });

        $r = RiwayatSKCPNS::where('employee_id', $this->getProfileId())->get()->first();
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
