<?php

namespace App\Admin\Controllers\ProfilePegawai;

use App\Models\Employee;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Form;

class DataPersonalController extends  ProfileController
{

    public $title = 'Data Personal';

    public function index(Content $content)
    {
        $r = Employee::with(['obj_agama'])->where('id', $this->profile_id)->get()->first();
        $form = $this->form();
        if ($r) {
            $form  =  $form->edit($r->id);
            $form->setAction('data_personal/' . $r->id);
            $form->setTitle(' ');
        } else {
            $form->setAction('data_personal');
        }
        return $content
            ->title($this->title())
            ->description($this->description['index'] ?? trans('admin.list'))
            ->body($this->header()->render())
            ->body($this->headerTab())
            ->body($form->render());
    }
    public function detail($id)
    {
        return Admin::content(function (Content $content) {
            $this->index($content);
        });
    }
    public function form()
    {
        $form = new Form(new Employee());
        //$form->fill($this->data());
        $form->hidden('id', 'ID');
        // Add an input box of type text
        $form->text('first_name', 'NAMA');
        $form->text('obj_agama.name', 'AGAMA');
        $form->text('nip_baru', 'NIP');
        $form->text('gelar_depan', 'GELAR DEPAN');
        $form->text('gelar_belakang', 'GELAR BELAKANG');
        $form->text('birth_place', 'TEMPAT LAHIR');
        $form->text('birth_date', 'TANGGAL LAHIR');
        $form->text('sex', 'JENIS KELAMIN');
        $form->text('status_kawin', 'STATUS PERNIKAHAN');
        $form->text('golongan_darah', 'GOLONGAN DARAH');

        $form->tools(function ($tools) {
            $tools->disableList();
            $tools->disableView();
            $tools->disableDelete();
        });
        //$form->disableSubmit();
        //$form->disableReset();
        // callback after save
        $form->saved(function (Form $form) {
            return back();
        });
        return $form;
    }
}
