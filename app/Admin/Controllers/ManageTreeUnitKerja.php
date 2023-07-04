<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\UnitKerja;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ManageTreeUnitKerja extends AdminController
{

    use ModelForm;

    public function index(Content $content)
    {
        return Admin::content(function (Content $content) {
            $content->header('Unit Kerja');
            $content->body(UnitKerja::tree());
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new UnitKerja());

        $form->number('parent_id', __('Parent id'));
        $form->text('name', __('Name'));
        $form->textarea('path', __('Path'));
        $form->text('pejabat_jabatan', __('Jabatan'));
        $form->text('pejabat_nip', __('Pejabat nip'));
        $form->text('pejabat_nama', __('Pejabat nama'));

        return $form;
    }
}
