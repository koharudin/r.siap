<?php

namespace App\Admin\Forms\Requests;

use App\Admin\Forms\Requests\FormRequest;
use App\Admin\Selectable\GridDiklat;
use App\Admin\Selectable\GridPendidikan;
use App\Admin\Selectable\GridUnitKerja;
use App\Http\Traits\FormRiwayatPendidikanTrait;
use App\Models\KategoriLayanan;
use App\Models\Pendidikan;
use App\Models\RiwayatDiklatFungsional;
use App\Models\RiwayatDiklatStruktural;
use App\Models\RiwayatDiklatTeknis;
use App\Models\RiwayatDp3;
use App\Models\RiwayatKinerja;
use App\Models\RiwayatKursus;
use App\Models\RiwayatPendidikan;
use App\Models\RiwayatPensiun;
use App\Models\RiwayatPotensiDiri;
use App\Models\RiwayatSeminar;
use App\Models\RiwayatUjiKompetensi;
use App\Models\RiwayatUsulan;
use App\Models\UnitKerja;
use Encore\Admin\Form;
use Encore\Admin\Form\Row;
use Encore\Admin\Grid;
use Encore\Admin\Widgets\StepForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormRiwayatPrestasiKerja extends FF
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = 'Riwayat Prestasi Kerja';


    public function grid()
    {
        $grid = new Grid(new RiwayatKinerja());
        $grid->model()->orderBy('tgl_penilaian','asc');
        $grid->column('tahun', __('TAHUN'));
        $grid->column('nilai', __('NILAI'));
        $grid->column('tgl_penilaian', __('TANGGAL PENILAIAN'))->display(function ($o) {
            if ($o) {
                return $this->tgl_penilaian->format('d-m-Y');
            }
            return "-";
        });
        $grid->column('satuan_kerja', __('SATUAN  KERJA'));
        $grid->column('jabatan', __('JABATAN'));
        $grid->column('nilai_skp', __('NILAI SKP'));
        $grid->column('nilai_perilaku', __('NILAI PERILAKU'));

        return $grid;
    }
    /**
     * Build a form here.
     */
    public function buildForm()
    {
        $form = $this;
        $form->hidden('employee_id', __('Employee id'));
        $form->number('tahun', __('TAHUN'));
        $form->text('nilai', __('NILAI'));
        $form->date('tgl_penilaian', __('TANGGAL PENILAIAN'))->default(date('Y-m-d'));
        $form->belongsTo('satuan_kerja_id',GridUnitKerja::class,'UNIT KERJA');
        $form->text('satuan_kerja', __('SATUAN  KERJA'));
        $form->text('jabatan', __('JABATAN'));
        $form->decimal('nilai_skp', __('NILAI SKP'));
        $form->decimal('nilai_perilaku', __('NILAI PERILAKU'));
        $form->saving(function (Form $form) {
            if($form->satuan_kerja_id){
                $unit_kerja =  UnitKerja::where('id',$form->satuan_kerja_id)->get()->first();
                if($unit_kerja){
                    $form->satuan_kerja = $unit_kerja->name;
                }
            }
        });
        return $form;
    }
    public function onCreateForm()
    {
        $data = [];
        return parent::edit($data);
    }
    public function onRefCreateForm($ref_id)
    {
        $record = RiwayatKinerja::findOrFail($ref_id);
        $data = $record->toArray();
        $old_data = $record->toArray();
        request()->session()->flash('old_data', $old_data);
        return $this->edit($data);
    }
}
