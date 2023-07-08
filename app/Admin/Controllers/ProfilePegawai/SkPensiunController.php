<?php

namespace App\Admin\Controllers\ProfilePegawai;

use App\Models\Employee;
use App\Models\RiwayatPensiun;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Form;

class SkPensiunController extends  ProfileController
{

    public $title = 'SK Pensiun';
    public $activeTab = 'riwayat_sk_pensiun';

    public function index($profile_id, Content $content)
    {
        $r = RiwayatPensiun::where('employee_id', $this->getProfileId())->get()->first();
        if ($r) {
            $form  =  $this->form()->edit($r->id);
            $form->setAction('riwayat_sk_pensiun/' . $r->id);
            $form->setTitle(' ');
        } else {
            $form = $this->form();
            $form->setAction('riwayat_sk_pensiun');
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

        $form = new Form(new RiwayatPensiun());
        $form->hidden('employee_id', 'ID');
        // Add an input box of type text
        $form->text('no_sk', 'NO SK');
        $form->date('tmt_pensiun', 'TMT Pensiun');
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
        return $form;
    }
}
