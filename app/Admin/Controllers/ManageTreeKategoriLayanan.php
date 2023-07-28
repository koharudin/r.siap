<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\KategoriLayanan;
use App\Models\UnitKerja;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ManageTreeKategoriLayanan extends AdminController
{

    use ModelForm;

    public function index(Content $content)
    {
        return Admin::content(function (Content $content) {
            $content->header('Kategori Layanan');
            $content->body(KategoriLayanan::tree());
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new KategoriLayanan());

        $form->select('parent_id', __('PARENT '))->options(KategoriLayanan::all()->pluck('name','id'));
        $form->text('name', __('NAMA'));
        $form->text('form_request_class', __('Form Class'));
        $form->select('enabled','ENABLED ?')->options([1 => 'AKTIF', 2 => 'NON AKTIF']);
        return $form;
    }
}
