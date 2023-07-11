<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\KlasifikasiDokumen;
use App\Models\UnitKerja;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ManageTreeKlasifikasiDokumenController extends AdminController
{

    use ModelForm;

    public function index(Content $content)
    {
        return Admin::content(function (Content $content) {
            $content->header('Klasifikasi Dokumen');
            $content->body(KlasifikasiDokumen::tree());
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new KlasifikasiDokumen());

        $form->select('parent_id', __('Parent id'))->options(KlasifikasiDokumen::all()->pluck('name','id'));
        $form->text('name', __('Name'));

        return $form;
    }
}
