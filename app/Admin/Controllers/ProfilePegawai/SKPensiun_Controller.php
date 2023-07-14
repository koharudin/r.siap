<?php

namespace App\Admin\Controllers\ProfilePegawai;

use App\Models\Employee;
use App\Models\JenisPensiun;
use App\Models\Pangkat;
use App\Models\RiwayatPensiun;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Form;

class SKPensiun_Controller extends  ProfileController
{

    public $title = 'SK Pensiun';
    public $activeTab = 'riwayat_sk_pensiun';

    public function detail($id)
    {
        return Admin::content(function (Content $content) {
            $this->index($content);
        });
    }
    public function form()
    {
        
        $form = new Form(new RiwayatPensiun());
        $form->hidden('employee_id', 'ID');
        // Add an input box of type text
        $form->text('no_bkn', 'NO BKN');
        $form->date('tgl_bkn', 'TGL BKN');
        $form->text('no_sk', 'NO SK PENSIUN')->required(true);
        $form->date('tgl_pensiun', 'TANGGAL PENSIUN')->required(true);
        $form->date('tmt_pensiun', 'TMT PENSIUN')->required(true);
        $form->select('pangkat_id', 'PANGKAT (GOL RUANG)')->options(Pangkat::all()->pluck('name','id'));
        $form->text('masa_kerja_tahun', 'MASA KERJA TAHUN');
        $form->text('masa_kerja_bulan', 'MASA KERJA BULAN');
        $form->text('unit_kerja', 'UNIT KERJA');

        $form->tools(function ($tools) {
            $tools->disableList();
            $tools->disableView();
            $tools->disableDelete();
        });
        if (!Admin::user()->can('save-skpensiun')) {
            $form->disableSubmit();
        }
        // callback after save
        $form->saved(function (Form $form) {
            return back();
        });
        
        $r = RiwayatPensiun::where('employee_id', $this->getProfileId())->get()->first();
        if ($r) {
            $form  =  $form->edit($r->id);
            $form->setAction('riwayat_sk_pensiun/' . $r->id);
            $form->setTitle(' ');
        } else {
            $form->setAction('riwayat_sk_pensiun');
        }
        return $form;
    }
}
