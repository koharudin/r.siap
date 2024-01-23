<?php

namespace App\Admin\Controllers;

use App\Models\RiwayatSKCPNS;
use App\Models\RiwayatJabatan;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class NilaiMasaKerjaPegawaiController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'RiwayatSKCPNS';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RiwayatSKCPNS());

        //$grid->column('id', __('Id'));
        $grid->column('employee_id', __('Employee id'));
        //$grid->column('no_nota', __('No nota'));
        //$grid->column('tgl_nota', __('Tgl nota'));
        //$grid->column('no_sk', __('No sk'));
        $grid->column('tgl_sk', __('Tgl sk')->date('Y-m-d'));
        $grid->column('tmt_cpns', __('Tmt cpns')->date('Y-m-d'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        //$grid->column('pejabat_penetap_id', __('Pejabat penetap id'));
        //$grid->column('pejabat_penetap_jabatan', __('Pejabat penetap jabatan'));
        //$grid->column('pejabat_penetap_nip', __('Pejabat penetap nip'));
        //$grid->column('pejabat_penetap_nama', __('Pejabat penetap nama'));
        //$grid->column('pangkat_id', __('Pangkat id'));
        //$grid->column('tgl_tugas', __('Tgl tugas'));
        //$grid->column('masa_kerja_tahun', __('Masa kerja tahun'));
        //$grid->column('masa_kerja_bulan', __('Masa kerja bulan'));
        //$grid->column('tambahan_tahun', __('Tambahan tahun'));
        //$grid->column('tambahan_bulan', __('Tambahan bulan'));
        //$grid->column('total_tahun', __('Total tahun'));
        //$grid->column('total_bulan', __('Total bulan'));
        //$grid->column('simpeg_id', __('Simpeg id'));
        //$grid->column('no_sk_penyesuaian_mk', __('No sk penyesuaian mk'));
        //$grid->column('tgl_sk_penyesuaian_mk', __('Tgl sk penyesuaian mk'));
        //$grid->column('tmt_sk_penyesuaian_mk', __('Tmt sk penyesuaian mk'));
        //$grid->column('pejabat_penetap_sk_penyesuaian_mk', __('Pejabat penetap sk penyesuaian mk'));

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
        $show = new Show(RiwayatSKCPNS::findOrFail($id));

        //$show->field('id', __('Id'));
        $show->field('employee_id', __('Employee id'));
        //$show->field('no_nota', __('No nota'));
        //$show->field('tgl_nota', __('Tgl nota'));
        //$show->field('no_sk', __('No sk'));
        $show->field('tgl_sk', __('Tgl sk')->date('Y-m-d'));
        $show->field('tmt_cpns', __('Tmt cpns')->date('Y-m-d'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        //$show->field('pejabat_penetap_id', __('Pejabat penetap id'));
        //$show->field('pejabat_penetap_jabatan', __('Pejabat penetap jabatan'));
        //$show->field('pejabat_penetap_nip', __('Pejabat penetap nip'));
        //$show->field('pejabat_penetap_nama', __('Pejabat penetap nama'));
        //$show->field('pangkat_id', __('Pangkat id'));
        //$show->field('tgl_tugas', __('Tgl tugas'));
        //$show->field('masa_kerja_tahun', __('Masa kerja tahun'));
        //$show->field('masa_kerja_bulan', __('Masa kerja bulan'));
        //$show->field('tambahan_tahun', __('Tambahan tahun'));
        //$show->field('tambahan_bulan', __('Tambahan bulan'));
        //$show->field('total_tahun', __('Total tahun'));
        //$show->field('total_bulan', __('Total bulan'));
        //$show->field('simpeg_id', __('Simpeg id'));
        //$show->field('no_sk_penyesuaian_mk', __('No sk penyesuaian mk'));
        //$show->field('tgl_sk_penyesuaian_mk', __('Tgl sk penyesuaian mk'));
        //$show->field('tmt_sk_penyesuaian_mk', __('Tmt sk penyesuaian mk'));
        //$show->field('pejabat_penetap_sk_penyesuaian_mk', __('Pejabat penetap sk penyesuaian mk'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    /*protected function form()
    {
        $form = new Form(new RiwayatSKCPNS());

        $form->number('employee_id', __('Employee id'));
        $form->text('no_nota', __('No nota'));
        $form->date('tgl_nota', __('Tgl nota'))->default(date('Y-m-d'));
        $form->text('no_sk', __('No sk'));
        $form->date('tgl_sk', __('Tgl sk'))->default(date('Y-m-d'));
        $form->date('tmt_cpns', __('Tmt cpns'))->default(date('Y-m-d'));
        $form->number('pejabat_penetap_id', __('Pejabat penetap id'));
        $form->text('pejabat_penetap_jabatan', __('Pejabat penetap jabatan'));
        $form->text('pejabat_penetap_nip', __('Pejabat penetap nip'));
        $form->text('pejabat_penetap_nama', __('Pejabat penetap nama'));
        $form->number('pangkat_id', __('Pangkat id'));
        $form->date('tgl_tugas', __('Tgl tugas'))->default(date('Y-m-d'));
        $form->number('masa_kerja_tahun', __('Masa kerja tahun'));
        $form->number('masa_kerja_bulan', __('Masa kerja bulan'));
        $form->number('tambahan_tahun', __('Tambahan tahun'));
        $form->number('tambahan_bulan', __('Tambahan bulan'));
        $form->number('total_tahun', __('Total tahun'));
        $form->number('total_bulan', __('Total bulan'));
        $form->text('simpeg_id', __('Simpeg id'));
        $form->text('no_sk_penyesuaian_mk', __('No sk penyesuaian mk'));
        $form->date('tgl_sk_penyesuaian_mk', __('Tgl sk penyesuaian mk'))->default(date('Y-m-d'));
        $form->date('tmt_sk_penyesuaian_mk', __('Tmt sk penyesuaian mk'))->default(date('Y-m-d'));
        $form->text('pejabat_penetap_sk_penyesuaian_mk', __('Pejabat penetap sk penyesuaian mk'));

        return $form;
    }*/
}