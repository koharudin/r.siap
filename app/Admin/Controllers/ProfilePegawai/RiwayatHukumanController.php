<?php

namespace App\Admin\Controllers\ProfilePegawai;

use App\Admin\Selectable\GridPejabatPenetap;
use App\Models\Hukuman;
use App\Models\PejabatPenetap;
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
        $grid->model()->orderBy('tmt_sk','asc');

        $grid->column('obj_hukuman.hukuman', __('HUKUMAN'));
        $grid->column('no_sk', __('NO SK'));
        $grid->column('tgl_sk', __('TGL SK'))->display(function ($o) {
            if ($o) {
                return $this->tgl_sk->format('d-m-Y');
            }
            return "-";
        });
        $grid->column(('pelanggaran'), __(('PELANGGARAN')));
        $grid->column('tmt_sk', __('TMT SK'))->display(function ($o) {
            if ($o) {
                return $this->tmt_sk->format('d-m-Y');
            }
            return "-";
        });
        $grid->column('pejabat_penetap_jabatan', __('PEJABAT PENETAP JABATAN'));

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

        $show->field('no_sk', __('NO SK'));
        $show->field('tgl_sk', __('TGL SK'));
        $show->field(('pelanggaran'), __(('PELANGGARAN')));
        $show->field('tmt_sk', __('TMT SK'));
        $show->divider('');
        $show->field('pejabat_penetap_jabatan', __('PEJABAT PENETAP JABATAN'));
        $show->field('pejabat_penetap_nip', __('PEJABAT PENETAP NIP'));
        $show->field('pejabat_penetap_nama', __('PEJABAT PENETAP NAMA'));
        $show->field('tmt_akhir', __('TMT AKHIR'));
        $show->field('pejabat_penetap_akhir_jabatan', __('PEJABAT PENETAP AKHIR JABATAN'));
        $show->field('pejabat_penetap_akhir_nip', __('PEJABAT PENETAP AKHIR NIP'));
        $show->field('pejabat_penetap_akhir_nama', __('PEJABAT PENETAP AKHIR NAMA'));
        $show->field('sk_akhir', __('SK AKHIR'));
        $show->field('tgl_sk_akhir', __('TGL  AKHIR'));
        $show->field('hukuman_id', __('HUKUMAN'));

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
        
        $form->textarea(('pelanggaran'), __(('PELANGGARAN')));
        
        $form->divider('SK HUKUMAN');
        $form->text('no_sk', __('NO SK'));
        $form->date('tgl_sk', __('TGL SK'))->default(date('Y-m-d'));
        $form->date('tmt_sk', __('TMT SK'))->default(date('Y-m-d'));

        $form->divider("PEJABAT PENETAP");
        $form->belongsTo('pejabat_penetap_id',GridPejabatPenetap::class,'PEJABAT PENETAP');

        $form->text('pejabat_penetap_jabatan', __('PEJABAT PENETAP JABATAN'));
        $form->text('pejabat_penetap_nip', __('PEJABAT PENETAP NIP'));
        $form->text('pejabat_penetap_nama', __('PEJABAT PENETAP NAMA'));
        $form->divider('SK PECABUTAN HUKUMAN');
        $form->date('tmt_akhir', __('TMT AKHIR'))->default(date('Y-m-d'));
        $form->belongsTo('pejabat_penetap_akhir_id',GridPejabatPenetap::class,'PEJABAT PENETAP');
        $form->text('pejabat_penetap_akhir_jabatan', __('PEJABAT PENETAP AKHIR JABATAN'));
        $form->text('pejabat_penetap_akhir_nip', __('PEJABAT PENETAP AKHIR NIP'));
        $form->text('pejabat_penetap_akhir_nama', __('PEJABAT PENETAP AKHIR NAMA'));
        $form->text('sk_akhir', __('SK AKHIR'));
        $form->date('tgl_sk_akhir', __('TGL  AKHIR'))->default(date('Y-m-d'));
        $form->select('hukuman_id','HUKUMAN')->options(Hukuman::all()->pluck('name','id'));

        $form->saving(function (Form $form) {
            if($form->pejabat_penetap_id){
                $r =  PejabatPenetap::where('id',$form->pejabat_penetap_id)->get()->first();
                if($r){
                    $form->pejabat_penetap_jabatan = $r->jabatan;
                    $form->pejabat_penetap_nip = $r->nip;
                    $form->pejabat_penetap_nama = $r->nama;
                }
            }
        });

        $form->saving(function (Form $form) {
            if($form->pejabat_penetap_id){
                $r =  PejabatPenetap::where('id',$form->pejabat_penetap_akhir_id)->get()->first();
                if($r){
                    $form->pejabat_penetap_akhir_jabatan = $r->jabatan;
                    $form->pejabat_penetap_akhir_nip = $r->nip;
                    $form->pejabat_penetap_akhir_nama = $r->nama;
                }
            }
        });
        
        return $form;
    }
}
