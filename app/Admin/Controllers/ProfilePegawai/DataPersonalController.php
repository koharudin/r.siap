<?php

namespace App\Admin\Controllers\ProfilePegawai;

use App\Admin\Selectable\GridUnitKerja;
use App\Models\Agama;
use App\Models\DokumenPegawai;
use App\Models\Employee;
use App\Models\GolonganDarah;
use App\Models\JenisKelamin;
use App\Models\StatusPernikahan;
use Encore\Admin\Auth\Permission;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Form;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\URL;

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
        $profile_id = $this->getProfileId();
        $form->tools(function($tools) use($profile_id) {
            $tools->add('<a href="'.route('admin.cetak-drh-singkat',['profile_id'=>$profile_id]).'" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-download"></i>&nbsp;&nbsp;Cetak DRH Singkat</a>');
            $tools->add('<a href="'.route('admin.cetak-drh-lengkap',['profile_id'=>$profile_id]).'" target="_blank" class="btn btn-sm btn-danger"><i class="fa fa-download"></i>&nbsp;&nbsp;Cetak DRH Lengkap</a>');
        });
        $form->column(1 / 2, function ($form) {
            //$form->fill($this->data());
            $form->hidden('id', 'ID');
            $form->image('foto','FOTO')->disk("minio_foto")->name(function($file){
               return $this->data['nip_baru']."_".md5(uniqid()).".".$file->guessExtension();
            })->hidePreview();
            // Add an input box of type text
            $form->text('first_name', 'NAMA');
           
            //$form->display("obj_agama.name", "AGAMA");
            $form->text('nip_baru', 'NIP');
            $form->date('tgl_pensiun', 'TANGGAL PENSIUN');
            $form->text('gelar_depan', 'GELAR DEPAN');
            $form->text('gelar_belakang', 'GELAR BELAKANG');
            $form->text('birth_place', 'TEMPAT LAHIR');
            $form->date('birth_date', 'TANGGAL LAHIR');
            $form->belongsTo('unit_id',GridUnitKerja::class,'UNIT KERJA');
            
        });
        $form->column(1 / 2, function ($form) {
            $form->select('agama_id', 'AGAMA')->options(Agama::all()->pluck('name','id'));
            $form->select('sex', 'JENIS KELAMIN')->options(JenisKelamin::all()->pluck("name", "id"));
            $form->select('status_kawin', 'STATUS PERNIKAHAN')->options(StatusPernikahan::all()->pluck('name', 'id'));
            $form->select('golongan_darah', 'GOLONGAN DARAH')->options(GolonganDarah::all()->pluck('id', 'id'));
            $form->textarea('alamat', 'ALAMAT');
            $form->text('no_hp', 'HANDPHONE');
            $form->text('email', 'EMAIL');
            $form->text('email_kantor', 'EMAIL DINAS');
            $form->text('karpeg', 'NO. KARPEG');
            $form->text('taspen', 'TASPEN');
            $form->text('npwp', 'NPWP');
            $form->text('askes', 'ASKES');
            $form->text('nik', 'NIK');
            $form->text('pin_absen', 'PIN ABSEN');
            $form->image('dokumen_ktp','KTP')->disk("minio_dokumen")->name(function($file){
                return $this->data['nip_baru']."_".md5(uniqid()).".".$file->guessExtension();
             })->hidePreview()->downloadable();
        });

        $form->submitted(function (Form $form) {
            $form->ignore('dokumen_ktp');
        });
        $form->saved(function (Form $form)  {
            $file = request()->file('dokumen_ktp');
            if ($file) {
                $d = $form->fields()->first(function($f){
                    return ($f->column() == 'dokumen_ktp');
                });
                $newFileName = $d->prepare($file);
                $keys = explode("#", $form->model()->simpeg_id);
                $arr = [
                    'id' => $form->model()->id,
                    'klasifikasi_id' => 1
                ];
                DataPersonalController::saveDokumenUpload($file->getClientOriginalName(), $newFileName, $arr);
            }
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
            $data = $form->model()->toArray();
            $dok=DokumenPegawai::where('klasifikasi_id',1)->where('ref_id',$this->getProfileId())->get()->first();
            if($dok){
                $data = array_merge($data,['dokumen_ktp'=>$dok->file]);
            }
            $form->fields()->each(function($field) use($data){
                $field->fill($data);
            });
            $form->setAction('data_personal/' . $r->id);
            $form->setTitle(' ');
        } else {
            $form->setAction('data_personal');
        }
        return $form;
    }
    public function cetak_drh_singkat(){
        echo "singkat";
    }
    public function cetak_drh_lengkap(){
        echo "lengkap";
    }
}
