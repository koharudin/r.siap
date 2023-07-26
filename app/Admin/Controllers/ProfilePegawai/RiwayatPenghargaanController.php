<?php

namespace App\Admin\Controllers\ProfilePegawai;

use App\Admin\Selectable\GridPejabatPenetap;
use App\Admin\Selectable\GridPenghargaan;
use App\Models\PejabatPenetap;
use App\Models\Penghargaan;
use App\Models\RiwayatPenghargaan;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class RiwayatPenghargaanController extends ProfileController
{
    public $activeTab = 'riwayat_penghargaan';
    public $klasifikasi_id = 19;   
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Riwayat Penghargaan';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RiwayatPenghargaan());
        $grid->model()->orderBy('tgl_sk','asc');
        $grid->column('nama_penghargaan', __('NAMA PENGHARGAAN'));
        $grid->column('no_sk', __('NO SK'));
        $grid->column('tgl_sk', __('TGL SK'))->display(function ($o) {
            if ($o) {
                return $this->tgl_sk->format('d-m-Y');
            }
            return "-";
        });
        $grid->column('pejabat_penetap', __('PEJABAT PENETAP'));
        $grid->column('tahun', __('TAHUN'));
        $grid->column('jenis_penghargaan', __('JENIS PENGHARGAAN'));

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
        $show = new Show(RiwayatPenghargaan::findOrFail($id));

        $show->field('nama_penghargaan', __('NAMA PENGHARGAAN'));
        $show->field('no_sk', __('NO SK'));
        $show->field('tgl_sk', __('TGL SK'));
        $show->field('pejabat_penetap', __('PEJABAT PENETAP'));
        $show->field('tahun', __('TAHUN'));
        $show->field('jenis_penghargaan', __('JENIS PENGHARGAAN'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new RiwayatPenghargaan());

        $form->hidden('employee_id', __('Employee id'));
        $form->text('nama_penghargaan', __('NAMA PENGHARGAAN'));
        $form->text('no_sk', __('NO SK'));
        $form->date('tgl_sk', __('TGL SK'))->default(date('Y-m-d'));
        $form->number('tahun', __('TAHUN'));
        $form->belongsTo('jenis_penghargaan_id',GridPenghargaan::class, __('JENIS PENGHARGAAN'));
        $form->text('jenis_penghargaan', __('JENIS PENGHARGAAN'));
        
        $form->belongsTo('pejabat_penetap_id',GridPejabatPenetap::class,'PEJABAT PENETAP');
        $form->text('pejabat_penetap_jabatan', __('JABATAN'));
        $form->text('pejabat_penetap_nip', __('NIP'));
        $form->text('pejabat_penetap_nama', __('NAMA'));

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

        return $form;
    }
}
