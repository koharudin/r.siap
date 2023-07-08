<?php

namespace App\Admin\Controllers;

use App\Models\Employee;
use App\Models\StatusPernikahan;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ManageEmployee extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Employee';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Employee());

        $grid->column('id', __('Id'));
        // column not in table
        $grid->column('foto')->display(function ($foto) {
            $disk = Storage::disk('minio_foto');
            if(Str::of($foto)->trim()->isNotEmpty()){
                if($disk->exists($foto)) {
                    $url = $disk->temporaryUrl(
                        $foto, now()->addMinutes(5)
                    );
                    return $url;
                }   
            }
            return config("admin.default_avatar");            
        })->image('',100,100);
        $grid->column('first_name', __('First name'));
        $grid->column('last_name', __('Last name'));
        $grid->column('nip_baru', __('Nip baru'));
        $grid->column('email_kantor', __('Email kantor'));
        $grid->column('email', __('Email'));
        $grid->expandFilter();  
        $grid->filter(function($filter){    
            $filter->disableIdFilter();
            $filter->where(function ($query) {
                $query->where('first_name','ilike',"%".$this->input.'%');
        },'Nama Pegawai');
            $filter->like('nip_baru', 'NIP Pegawai');
        });
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
        $show = new Show(Employee::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('first_name', __('First name'));
        $show->field('last_name', __('Last name'));
        $show->field('agama_id', __('Agama id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('simpeg_id', __('Simpeg id'));
        $show->field('nip_baru', __('Nip baru'));
        $show->field('gelar_depan', __('Gelar depan'));
        $show->field('gelar_belakang', __('Gelar belakang'));
        $show->field('birth_place', __('Birth place'));
        $show->field('birth_date', __('Birth date'));
        $show->field('sex', __('Sex'));
        $show->field('status_kawin', __('Status kawin'));
        $show->field('golongan_darah', __('Golongan darah'));
        $show->field('email_kantor', __('Email kantor'));
        $show->field('email', __('Email'));
        $show->field('foto', __('Foto'));
        $show->field('alamat', __('Alamat'));
        $show->field('karpeg', __('Karpeg'));
        $show->field('taspen', __('Taspen'));
        $show->field('npwp', __('Npwp'));
        $show->field('askes', __('Askes'));
        $show->field('nik', __('Nik'));
        $show->field('no_hp', __('No hp'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Employee());
        $disk = Storage::disk('minio_foto');
        $form->image('foto', __('Foto'))->disk('minio_foto');
        $form->text('first_name', __('First name'));
        $form->text('last_name', __('Last name'));
        $form->number('agama_id', __('Agama id'));
        $form->text('simpeg_id', __('Simpeg id'));
        $form->text('nip_baru', __('Nip baru'));
        $form->text('gelar_depan', __('Gelar depan'));
        $form->text('gelar_belakang', __('Gelar belakang'));
        $form->text('birth_place', __('Birth place'));
        $form->date('birth_date', __('Birth date'))->default(date('Y-m-d'));
        $form->select('sex', __('Sex'))->options(JenisKelamin::all()->pluck("name","id"));
        $form->select('status_kawin', __('Status kawin'))->options(StatusPernikahan::all()->pluck('name','id'));
        $form->select('golongan_darah', __('Golongan darah'))->options(GolonganDarah::all()->pluck('id','id'));
        $form->text('email_kantor', __('Email kantor'));
        $form->email('email', __('Email'));
        $form->textarea('alamat', __('Alamat'));
        $form->text('karpeg', __('Karpeg'));
        $form->text('taspen', __('Taspen'));
        $form->text('npwp', __('Npwp'));
        $form->text('askes', __('Askes'));
        $form->text('nik', __('Nik'));
        $form->text('no_hp', __('No hp'));

        return $form;
    }
}