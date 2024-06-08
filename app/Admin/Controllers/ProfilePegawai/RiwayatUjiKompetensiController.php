<?php

namespace App\Admin\Controllers\ProfilePegawai;

use App\Models\RiwayatUjiKompetensi;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Jabatan;
use App\Models\UnitKerja;
use App\Admin\Selectable\GridJabatan;
use App\Admin\Selectable\GridJabatanStruktural;
use App\Admin\Selectable\GridUnitKerja;

class RiwayatUjiKompetensiController extends ProfileController
{
    public $activeTab = 'riwayat_uji_kompetensi';
    public $klasifikasi_id = 100;
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Riwayat Uji Kompetensi';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RiwayatUjiKompetensi());
        $grid->model()->orderBy('tanggal', 'desc');
        $grid->column('tanggal', __('TANGGAL'))->display(function ($o) {
            if($o) {
                return $this->tanggal->format('d-m-Y');
            }
            return "-";
        });
        $grid->column('jabatan', __('JABATAN'));
        $grid->column('satker', __('UNIT KERJA'));
        $grid->column('kategori', __('KATEGORI PEMETAAN'));
        $grid->column('metode', __('METODE'));
        $grid->column('kotak', __('KOTAK TALENTA'));

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
        $show = new Show(RiwayatUjiKompetensi::findOrFail($id));

        $show->field('tipe_jabatan_id', 'TIPE JABATAN')->as(function($value) {
            $str = "-";
            if($value == 1) {
                $str = "Fungsional";
            } else if($value == 2) {
                $str = "Struktural";
            }
            return $str;
        });
        $show->field('jabatan', __('JABATAN'));
        $show->field('satker', __('UNIT KERJA'));
        $show->field('kategori', __('KATEGORI PEMETAAN'));
        $show->field('metode', __('METODE'));
        $show->field('keterangan', __('KETERANGAN'));
        $show->field('kotak', __('KOTAK'));
        $show->field('kotak', 'KOTAK')->as(function($value) {
            return "Kotak ".$value;
        });
        $show->field('tanggal', __('TANGGAL'));
        $show->field('tanggal', 'TANGGAL')->as(function($value) {
            return (!empty($value)) ? $value->format('d-m-Y') : "-";
        });

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new RiwayatUjiKompetensi());
        $form->footer(function ($footer) {
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();        
        });

        $form->hidden('employee_id', __('Employee Id'));
        $form->hidden('jabatan_id');
        $form->hidden('jabatan');
        $form->hidden('satker');
        $form->select('tipe_jabatan_id', __('TIPE JABATAN'))->options([1 => 'Fungsional', 2 => 'Struktural'])->when('in', [1], function (Form $form) {
            $form->belongsTo('jabatan_id_fungsional', GridJabatan::class, 'JABATAN FUNGSIONAL')->required();
        })->when('in', [2], function (Form $form) {
            $form->belongsTo('jabatan_id_struktural', GridJabatanStruktural::class, 'JABATAN STRUKTURAL')->required();
        })->required();
        // $form->select('jabatan_id', __('JABATAN'))->options(Jabatan::all()->pluck('name', 'id'));
        // $form->text('unit_kerja_id', __('UNIT KERJA'));
        $form->belongsTo('unit_kerja_id', GridUnitKerja::class, __('UNIT KERJA'))->required();
        $form->select('kategori', __('KATEGORI PEMETAAN'))->options(['Optimal' => 'Optimal', 'Cukup Optimal' => 'Cukup Optimal', 'Kurang Optimal' => 'Kurang Optimal'])->required();
        $form->select('metode', __('METODE'))->options(['SJT' => 'SJT', 'AC' => 'AC', 'CACT' => 'CACT']);
        $form->select('kotak', __('KOTAK TALENTA'))->options([1 => 'Kotak 1', 2 => 'Kotak 2', 3 => 'Kotak 3', 4 => 'Kotak 4', 5 => 'Kotak 5', 6 => 'Kotak 6', 7 => 'Kotak 7', 8 => 'Kotak 8', 9 => 'Kotak 9',]);
        $form->date('tanggal', __('TANGGAL'))->required();
        $form->submitted(function (Form $form) {
            $form->ignore('jabatan_id_fungsional');
            $form->ignore('jabatan_id_struktural');
        });
        $form->saving(function (Form $form) {
            $jabatan_id_fungsional = request()->input('jabatan_id_fungsional');
            $jabatan_id_struktural = request()->input('jabatan_id_struktural');
            if(in_array($form->tipe_jabatan_id, [2])) {
                if($jabatan_id_struktural) {
                    $form->jabatan_id = $jabatan_id_struktural;
                    $form->jabatan = UnitKerja::find($form->jabatan_id)->pejabat_jabatan;
                } else
                    $form->jabatan_id = null;
            } else {
                if($jabatan_id_fungsional) {
                    $form->jabatan_id = $jabatan_id_fungsional;
                    $form->jabatan = Jabatan::find($form->jabatan_id)->name;
                } else
                    $form->jabatan_id = null;
            }
            if($form->unit_kerja_id) {
                $unit_kerja = UnitKerja::where('id', $form->unit_kerja_id)->get()->first();
                if($unit_kerja) {
                    $form->satker = $unit_kerja->name;
                }
            }
        });

        return $form;
    }
}
