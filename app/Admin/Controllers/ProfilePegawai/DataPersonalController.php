<?php

namespace App\Admin\Controllers\ProfilePegawai;

use App\Admin\Selectable\GridUnitKerja;
use App\Models\Agama;
use App\Models\Employee;
use App\Models\GolonganDarah;
use App\Models\JenisKelamin;
use App\Models\StatusPernikahan;
use Encore\Admin\Auth\Permission;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Form;

class DataPersonalController extends  ProfileController
{

    public $title = 'Data Personal';

    public function detail($id)
    {
        return Admin::content(function (Content $content) {
            $this->index($content);
        });
    }
    public function form()
    {
        $form = new Form(new Employee());
        $form->column(1 / 2, function ($form) {
            //$form->fill($this->data());
            $form->hidden('id', 'ID');
            $form->image('foto','FOTO')->disk("minio_foto")->name(function($file){
               return $this->data['nip_baru']."_".md5(uniqid()).".".$file->guessExtension();
            });
            // Add an input box of type text
            $form->text('first_name', 'NAMA');
           
            //$form->display("obj_agama.name", "AGAMA");
            $form->text('nip_baru', 'NIP');
            $form->text('gelar_depan', 'GELAR DEPAN');
            $form->text('gelar_belakang', 'GELAR BELAKANG');
            $form->text('birth_place', 'TEMPAT LAHIR');
            $form->text('birth_date', 'TANGGAL LAHIR');
            $form->belongsTo('unit_id',GridUnitKerja::class,'UNIT KERJA');
            
        });
        $form->column(1 / 2, function ($form) {
            $form->select('agama_id', 'AGAMA')->options(Agama::all()->pluck('name','id'));
            $form->select('sex', 'JENIS KELAMIN')->options(JenisKelamin::all()->pluck("name", "id"));
            $form->select('status_kawin', 'STATUS PERNIKAHAN')->options(StatusPernikahan::all()->pluck('name', 'id'));
            $form->select('golongan_darah', 'GOLONGAN DARAH')->options(GolonganDarah::all()->pluck('id', 'id'));
            $form->text('no_hp', 'HANDPHONE');
            $form->text('email', 'EMAIL');
            $form->text('email_kantor', 'EMAIL DINAS');
            $form->text('karpeg', 'NO. KARPEG');
            $form->text('taspen', 'TASPEN');
            $form->text('npwp', 'NPWP');
            $form->text('askes', 'ASKES');
            $form->text('nik', 'NIK');
        });


        $form->tools(function ($tools) {
            $tools->disableList();
            $tools->disableView();
            $tools->disableDelete();
        });
        if (!Admin::user()->can('save-data_personal')) {
            $form->disableSubmit();
        }
        //
        //$form->disableReset();
        $form->saved(function (Form $form) {
            return back();
        });
        $r = Employee::with(['obj_agama'])->where('id', $this->getProfileId())->get()->first();
        if ($r) {
            $form  =  $form->edit($r->id);
            $form->setAction('data_personal/' . $r->id);
            $form->setTitle(' ');
        } else {
            $form->setAction('data_personal');
        }
        return $form;
    }
}
