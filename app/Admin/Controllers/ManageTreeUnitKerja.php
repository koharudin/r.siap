<?php

namespace App\Admin\Controllers;

use App\Admin\Selectable\GridEselon;
use App\Http\Controllers\Controller;
use App\Models\Eselon;
use App\Models\UnitKerja;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Encore\Admin\Tree;

class ManageTreeUnitKerja extends AdminController
{

    use ModelForm;

    public function treeView()
    {
        //$menuModel = config('admin.database.menu_model');
        //dd($menuModel);
        $menuModel = "App\Models\UnitKerja";
        $tree = new Tree(new $menuModel());
        /*
        $tree->branch(function ($branch) {
            return "{$branch['id']} - {$branch['name']} <a class='btn btn-primary btn-sm' href='./manage_unit_kerja/{$branch['id']}/edit'>Edit</a>";
        });
        */
        return $tree;
    }
    public function index(Content $content)
    {
        return Admin::content(function (Content $content) {
            $content->header('Unit Kerja');
            $content->body($this->treeView()->render());
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

        $form->display('parent.name', __('PARENT'));
        $form->text('name', __('Name'));
        $form->text('bup', __('BUP'));
        $form->select('eselon_id', 'ESELON')->options(Eselon::all()->pluck('name', 'id'));
        $form->text('pejabat_jabatan', __('JABATAN'));

        $form->display('path', __('Path'));
        $form->fieldset("Pejabat Saat Ini", function ($form) {
            $form->display('pejabat_nip', __('PEJABAT NIP'));
            $form->display('pejabat_nama', __('PEJABAT NAMA'));
        });

        return $form;
    }
}
