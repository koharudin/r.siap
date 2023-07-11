<?php

namespace App\Admin\Controllers;

use App\Models\DokumenPegawai;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DokumenPegawaiController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Dokumen Pegawai';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new DokumenPegawai());
       
        $grid->filter(function($filter) use($grid){
            $filter->expand();
            $filter->disableIdFilter();
            $filter->where(function ($query) {
                $query->whereHas('obj_pegawai', function ($query) {
                    $query->where('first_name', 'ilike', "%{$this->input}%")->orWhere('nip_baru', 'ilike', "%{$this->input}%");
                });
            
            }, 'Nama/NIP Pegawai');
        });
        $grid->column('id', __('ID'));
        $grid->column('obj_klasifikasi_dokumen.name', __('KLASIFIKASI'));
        $grid->column('nama', __('Nama'));
        $grid->file('file', __('File'))->display(function($file){
            $disk = Storage::disk('minio_dokumen');
            if(Str::of($file)->trim()->isNotEmpty()){
                if($disk->exists($file)) {
                    $url = $disk->temporaryUrl(
                        $file, now()->addMinutes(5)
                    );
                    return "<a target='_blank' href='{$url}'>Lihat</a>";
                }   
            }
        });
        $grid->column('pk1', __('PK1'));
        $grid->column('pk2', __('PK2'));
        $grid->column('ref_id', __('REF ID'));
        $grid->column('simpeg_id', __('SIMPEG ID'));
        $grid->actions(function ($actions) {
            $actions->disableDelete();
            $actions->disableEdit();
        });
        $grid->disableCreateButton();
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(DokumenPegawai::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('klasifikasi_id', __('KLASIFIKASI'));
        $show->field('nama', __('Nama'));
        $show->field('file', __('File'));
        $show->field('pk1', __('PK1'));
        $show->field('pk2', __('PK2'));
        $show->field('ref_id', __('REF ID'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('simpeg_id', __('SIMPEG ID'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new DokumenPegawai());

        $form->number('klasifikasi_id', __('KLASIFIKASI'));
        $form->text('nama', __('Nama'));
        $form->file('file', __('File'));
        $form->text('pk1', __('PK1'));
        $form->text('pk2', __('PK2'));
        $form->number('ref_id', __('REF ID'));
        $form->number('simpeg_id', __('SIMPEG ID'));

        return $form;
    }
}
