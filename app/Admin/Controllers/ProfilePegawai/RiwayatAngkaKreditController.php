<?php

namespace App\Admin\Controllers\ProfilePegawai;

use App\Models\RiwayatAngkaKredit;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class RiwayatAngkaKreditController extends ProfileController
{
    public $activeTab = 'riwayat_angkakredit';
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Riwayat Angka Kredit';

    /**
     * Make a grid builder.)
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RiwayatAngkaKredit());
        $grid->column('no_sk', __('NO SK'));
        $grid->column('tgl_sk', __('TGL SK'));
        $grid->column('dt_awal_penilaian', __('TGL AWAL PENILAIAN'));
        $grid->column('dt_akhir_penilaian', __('TGL AKHIR PENILAIAN'));
        $grid->column('jabatan', __('JABATAN'));
        $grid->column('unit_kerja', __('UNIT KERJA'));
        $grid->column('pangkat_id', __('PANGKAT'));
        $grid->column('ak_lama', _('AK LAMA'));
        $grid->column('ak_baru', __('AK BARU'));
        $grid->column('tmt_pak', __('TMT PAK'));

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
        $show = new Show(RiwayatAngkaKredit::findOrFail($id));


        $show->field('no_sk', __('NO SK'));
        $show->field('tgl_sk', __('TGL SK'));
        $show->field('dt_awal_penilaian', __('TGL AWAL PENILAIAN'));
        $show->field('dt_akhir_penilaian', __('TGL AKHIR PENILAIAN'));
        $show->field('jabatan', __('JABATAN'));
        $show->field('unit_kerja', __('UNIT KERJA'));
        $show->field('pangkat_id', __('PANGKAT'));
        $show->field('ak_lama', _('AK LAMA'));
        $show->field('ak_baru', __('AK BARU'));
        $show->field('keterangan', __('KETERANGAN'));
        $show->field('tmt_pak', __('TMT PAK'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new RiwayatAngkaKredit());
        $form->hidden('employee_id', __('Employee id'));
        $form->text('no_sk', __('NO SK'));
        $form->date('tgl_sk', __('TGL SK'))->default(date('Y-m-d'));
        $form->date('dt_awal_penilaian', __('TGL AWAL PENILAIAN'))->default(date('Y-m-d'));
        $form->date('dt_akhir_penilaian', __('TGL AKHIR PENILAIAN'))->default(date('Y-m-d'));

        $form->text('jabatan', __('JABATAN'));
        $form->text('unit_kerja', __('UNIT KERJA'));
        $form->text('pangkat_id', __('PANGKAT'));
        $form->decimal('ak_lama', _('AK LAMA'));
        $form->decimal('ak_baru', __('AK BARU'));
        $form->textarea('keterangan', __('KETERANGAN'));
        $form->date('tmt_pak', __('TMT PAK'))->default(date('Y-m-d'));

        return $form;
    }
}
