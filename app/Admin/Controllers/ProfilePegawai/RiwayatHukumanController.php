<?php

namespace App\Admin\Controllers\ProfilePegawai;

use App\Models\Hukuman;
use App\Models\RiwayatHukuman;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class RiwayatHukumanController  extends ProfileController
{
    public $activeTab = 'riwayat_hukuman';
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Riwayat Hukuman';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RiwayatHukuman());
        
        $grid->column('nama_hukuman.hukuman', __('Hukuman'));
        $grid->column('no_sk', __('NO SK'));
        $grid->column('tgl_sk', __('TGL SK'));
        $grid->column(('PELANGGARAN'), __(('PELANGGARAN')));
        $grid->column('tmt_sk', __('TMT SK'));
        $grid->column('pejabat_penetap_jabatan', __('Pejabat penetap jabatan'));
        $grid->column('pejabat_penetap_nip', __('Pejabat penetap nip'));
        $grid->column('pejabat_penetap_nama', __('Pejabat penetap nama'));

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
        $show = new Show(RiwayatHukuman::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('employee_id', __('Employee id'));
        $show->field('simpeg_id', __('Simpeg id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('no_sk', __('NO SK'));
        $show->field('tgl_sk', __('TGL SK'));
        $show->field(('PELANGGARAN'), __(('PELANGGARAN')));
        $show->field('tmt_sk', __('TMT SK'));
        $show->field('pejabat_penetap_id', __('Pejabat penetap id'));
        $show->field('pejabat_penetap_jabatan', __('Pejabat penetap jabatan'));
        $show->field('pejabat_penetap_nip', __('Pejabat penetap nip'));
        $show->field('pejabat_penetap_nama', __('Pejabat penetap nama'));
        $show->field('tmt_akhir', __('Tmt akhir'));
        $show->field('pejabat_penetap_akhir_id', __('Pejabat penetap akhir id'));
        $show->field('pejabat_penetap_akhir_jabatan', __('Pejabat penetap akhir jabatan'));
        $show->field('pejabat_penetap_akhir_nip', __('Pejabat penetap akhir nip'));
        $show->field('pejabat_penetap_akhir_nama', __('Pejabat penetap akhir nama'));
        $show->field('sk_akhir', __('Sk akhir'));
        $show->field('tgl_sk_akhir', __('Tgl sk akhir'));
        $show->field('hukuman_id', __('Hukuman id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new RiwayatHukuman());

        $form->hidden('employee_id', __('Employee id'));
        
        $form->textarea(('PELANGGARAN'), __(('PELANGGARAN')));
        
        $form->divider('SK HUKUMAN');
        $form->text('no_sk', __('NO SK'));
        $form->date('tgl_sk', __('TGL SK'))->default(date('Y-m-d'));
        $form->date('tmt_sk', __('TMT SK'))->default(date('Y-m-d'));

        $form->text('pejabat_penetap_id', __('Pejabat penetap id'));
        $form->text('pejabat_penetap_jabatan', __('Pejabat penetap jabatan'));
        $form->text('pejabat_penetap_nip', __('Pejabat penetap nip'));
        $form->text('pejabat_penetap_nama', __('Pejabat penetap nama'));
        $form->divider('SK PECABUTAN HUKUMAN');
        $form->date('tmt_akhir', __('Tmt akhir'))->default(date('Y-m-d'));
        $form->text('pejabat_penetap_akhir_id', __('Pejabat penetap akhir id'));
        $form->text('pejabat_penetap_akhir_jabatan', __('Pejabat penetap akhir jabatan'));
        $form->text('pejabat_penetap_akhir_nip', __('Pejabat penetap akhir nip'));
        $form->text('pejabat_penetap_akhir_nama', __('Pejabat penetap akhir nama'));
        $form->text('sk_akhir', __('Sk akhir'));
        $form->date('tgl_sk_akhir', __('Tgl sk akhir'))->default(date('Y-m-d'));
        $form->select('hukuman_id')->options(Hukuman::all()->pluck('hukuman','simpeg_id'));
        return $form;
    }
}
