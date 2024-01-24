<?php

namespace App\Admin\Controllers;

use App\Models\Employee;
use App\Models\GolonganDarah;
use App\Models\JenisKelamin;
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
        $grid->column('FOTO')->display(function ($foto) {
            $disk = Storage::disk('minio_foto');
            if (Str::of($foto)->trim()->isNotEmpty()) {
                if ($disk->exists($foto)) {
                    $url = $disk->temporaryUrl(
                        $foto,
                        now()->addMinutes(5)
                    );
                    return $url;
                }
            }
            return config("admin.default_avatar");
        })->image('', 100, 100);
        $grid->column('first_name', __('NAMA DEPAN'));
        $grid->column('last_name', __('NAMA BELAKANG'));
        $grid->column('nip_baru', __('NIP'));
        $grid->column('email_kantor', __('EMAIL KANTOR'));
        $grid->column('email', __('EMAIL'));
        $grid->expandFilter();
        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->where(function ($query) {
                $query->where('first_name', 'ilike', "%" . $this->input . '%');
            }, 'Nama Pegawai');
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
        $show->field('first_name', __('NAMA DEPAN'));
        $show->field('last_name', __('NAMA BELAKANG'));
        $show->field('agama_id', __('AGAMA'));
        $show->field('nip_baru', __('NIP'));
        $show->field('gelar_depan', __('GELAR DEPAN'));
        $show->field('gelar_belakang', __('GELAR BELAKANG'));
        $show->field('birth_place', __('TEMPAT LAHIR'));
        $show->field('birth_date', __('TANGGAL LAHIR'));
        $show->field('sex', __('JENIS KELAMIN'));
        $show->field('status_kawin', __('STATUS KAWIN'));
        $show->field('golongan_darah', __('GOLONGAN DARAH'));
        $show->field('email_kantor', __('EMAIL KANTOR'));
        $show->field('email', __('EMAIL'));
        $show->field('foto', __('FOTO'));
        $show->field('alamat', __('ALAMAT'));
        $show->field('karpeg', __('KARPEG'));
        $show->field('taspen', __('TASPEN'));
        $show->field('npwp', __('NPWP'));
        $show->field('askes', __('ASKES'));
        $show->field('nik', __('NIK'));
        $show->field('no_hp', __('NO HP'));

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
        $form->image('foto', __('FOTO'))->disk('minio_foto');
        $form->text('first_name', __('NAMA DEPAN'));
        $form->text('last_name', __('NAMA BELAKANG'));
        $form->number('agama_id', __('AGAMA'));
        $form->text('nip_baru', __('NIP'));
        $form->text('gelar_depan', __('GELAR DEPAN'));
        $form->text('gelar_belakang', __('GELAR BELAKANG'));
        $form->text('birth_place', __('TEMPAT LAHIR'));
        $form->date('birth_date', __('TANGGAL LAHIR'))->default(date('Y-m-d'));
        $form->select('sex', __('JENIS KELAMIN'))->options(JenisKelamin::all()->pluck("name", "id"));
        $form->select('status_kawin', __('STATUS KAWIN'))->options(StatusPernikahan::all()->pluck('name', 'id'));
        $form->select('golongan_darah', __('GOLONGAN DARAH'))->options(GolonganDarah::all()->pluck('id', 'id'));
        $form->text('email_kantor', __('EMAIL KANTOR'));
        $form->email('email', __('EMAIL'));
        $form->textarea('alamat', __('ALAMAT'));
        $form->text('karpeg', __('KARPEG'));
        $form->text('taspen', __('TASPEN'));
        $form->text('npwp', __('NPWP'));
        $form->text('askes', __('ASKES'));
        $form->text('nik', __('NIK'));
        $form->text('no_hp', __('NO HP'));

        return $form;
    }
}
