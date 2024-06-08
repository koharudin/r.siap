<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Jabatan;
use App\Models\UnitKerja;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ManageTreeJabatan extends AdminController
{

    use ModelForm;

    public function index(Content $content)
    {
        return Admin::content(function (Content $content) {
            $content->header('Jabatan');
            $content->body(Jabatan::tree());
        });
    }
    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Jabatan());
        
        $form->select('parent_id', __('Parent id'))->options(Jabatan::all()->pluck('name','id'));
        $form->text('name', __('Name'));
        $form->number('bup', __('Batas Usia Pensiun'));
        // $form->select('grade', __('Kelas Jabatan'))->options(['17' => '17', '16' => '16', '15' => '15', '14' => '14', '13' => '13', '12' => '12', '11' => '11', '10' => '10', '9' => '9', '8' => '8',
        //     '7' => '7', '6' => '6', '5' => '5', '4' => '4', '3' => '3', '2' => '2', '1' => '1']);
        
        return $form;
    }
}
