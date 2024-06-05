<?php

namespace App\Admin\Controllers\ProfilePegawai;

use App\Admin\Selectable\GridUnitKerja;
use App\Models\RiwayatKinerja;
use App\Models\UnitKerja;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class RiwayatKinerjaController extends ProfileController
{
    public $activeTab = 'riwayat_prestasi_kerja';
    public $klasifikasi_id = 18;
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Riwayat Kinerja';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RiwayatKinerja());
        $grid->model()->orderBy('tgl_penilaian', 'desc');
        $grid->column('tahun', __('TAHUN'));
        $grid->column('nilai', __('HASIL KERJA'));
        $grid->column('perilaku', __('PERILAKU KERJA'));
        $grid->column('predikat', __('PREDIKAT KERJA'));
        $grid->column('tgl_penilaian', __('TANGGAL PENILAIAN'))->display(function ($o) {
            if ($o) {
                return $this->tgl_penilaian->format('d-m-Y');
            }
            return "-";
        });
        $grid->column('satuan_kerja', __('SATUAN  KERJA'));
        $grid->column('jabatan', __('JABATAN'));
        // $grid->column('nilai_skp', __('NILAI SKP'));
        // $grid->column('nilai_perilaku', __('NILAI PERILAKU'));

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
        $show = new Show(RiwayatKinerja::findOrFail($id));

        $show->field('tahun', __('TAHUN'));
        $show->field('nilai', __('NILAI'));
        $show->field('tgl_penilaian', __('TANGGAL PENILAIAN'));
        $show->field('satuan_kerja', __('SATUAN  KERJA'));
        $show->field('jabatan', __('JABATAN'));
        $show->field('nilai_skp', __('NILAI SKP'));
        $show->field('nilai_perilaku', __('NILAI PERILAKU'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new RiwayatKinerja());

        $form->hidden('employee_id', __('Employee id'));
        $form->number('tahun', __('TAHUN'));
        $form->text('nilai', __('NILAI'));
        $form->date('tgl_penilaian', __('TANGGAL PENILAIAN'))->default(date('Y-m-d'));
        $form->belongsTo('satuan_kerja_id', GridUnitKerja::class, 'UNIT KERJA');
        $form->text('satuan_kerja', __('SATUAN  KERJA'));
        $form->text('jabatan', __('JABATAN'));
        $form->decimal('nilai_skp', __('NILAI SKP'));
        $form->decimal('nilai_perilaku', __('NILAI PERILAKU'));
        $form->saving(function (Form $form) {
            $satuan_kerja_id = request()->input('satuan_kerja_id');
            if ($satuan_kerja_id) {
                $unit_kerja =  UnitKerja::where('id', $satuan_kerja_id)->get()->first();
                if ($unit_kerja) {
                    $form->satuan_kerja = $unit_kerja->name;
                }
            }
        });
        $form->submitted(function (Form $form) {
            $form->ignore('satuan_kerja_id');
        });
        return $form;
    }
}
