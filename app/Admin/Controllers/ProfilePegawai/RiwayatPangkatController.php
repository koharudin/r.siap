<?php

namespace App\Admin\Controllers\ProfilePegawai;

use App\Models\RiwayatPangkat;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class RiwayatPangkatController extends ProfileController
{
    public $activeTab = 'riwayat_pangkat';
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Riwayat Pangkat';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RiwayatPangkat());
        $grid->column('no_sk', __('NO SK'));
        $grid->column('tgl_sk', __('TGL SK'));
        $grid->column('pangkat_id', __('PANGKAT'));
        $grid->column('jenis_kp', __('JENIS KP'));
        $grid->column('penetap_nip', __('PENETAP NIP'));
        $grid->column('penetap_nama', __('PENETAP NAMA'));
        $grid->column('penetap_jabatan', __('PENETAP JABATAN'));

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
        $show = new Show(RiwayatPangkat::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('simpeg_id', __('SIMPEG ID'));
        $show->field('stlud', __('STLUD'));
        $show->field('no_stlud', __('NO STLUD'));
        $show->field('tgl_stlud', __('TGL STLUD'));
        $show->field('no_nota', __('NO NOTA'));
        $show->field('tgl_nota', __('TGL NOTA'));
        $show->field('no_sk', __('NO SK'));
        $show->field('tgl_sk', __('TGL SK'));
        $show->field('tmt_pangkat', __('TMT PANGKAT'));
        $show->field('pejabat_penetap', __('PEJABAT PENETAP'));
        $show->field('kredit', __('KREDIT'));
        $show->field('pangkat_id', __('PANGKAT'));
        $show->field('jenis_kp', __('JENIS KP'));
        $show->field('keterangan', __('KETERANGAN'));
        $show->field('penetap_nip', __('PENETAP NIP'));
        $show->field('penetap_nama', __('PENETAP NAMA'));
        $show->field('jenis_ket', __('JENIS KET'));
        $show->field('tmt_pak', __('TMT PAK'));
        $show->field('penetap_jabatan', __('PENETAP JABATAN'));
        $show->field('masakerja_thn', __('MASA KERJA TAHUN'));
        $show->field('masakerja_bln', __('MASA KERJA BULAN'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new RiwayatPangkat());
        $form->hidden('employee_id', __('Employee id'));
        $form->text('stlud', __('STLUD'));
        $form->text('no_stlud', __('NO STLUD'));
        $form->date('tgl_stlud', __('TGL STLUD'))->default(date('Y-m-d'));
        $form->text('no_nota', __('NO NOTA'));
        $form->date('tgl_nota', __('TGL NOTA'))->default(date('Y-m-d'));
        $form->text('no_sk', __('NO SK'));
        $form->date('tgl_sk', __('TGL SK'))->default(date('Y-m-d'));
        $form->date('tmt_pangkat', __('TMT PANGKAT'))->default(date('Y-m-d'));
        $form->text('pejabat_penetap', __('PEJABAT PENETAP'));
        $form->decimal('kredit', __('KREDIT'));
        $form->text('pangkat_id', __('PANGKAT'));
        $form->text('jenis_kp', __('JENIS KP'));
        $form->text('keterangan', __('KETERANGAN'));
        $form->text('penetap_nip', __('PENETAP NIP'));
        $form->text('penetap_nama', __('PENETAP NAMA'));
        $form->text('jenis_ket', __('JENIS KET'));
        $form->date('tmt_pak', __('TMT PAK'))->default(date('Y-m-d'));
        $form->text('penetap_jabatan', __('PENETAP JABATAN'));
        $form->number('masakerja_thn', __('MASA KERJA TAHUN'));
        $form->number('masakerja_bln', __('MASA KERJA BULAN'));

        return $form;
    }
}
