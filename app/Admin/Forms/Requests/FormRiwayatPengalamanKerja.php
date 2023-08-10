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
use App\Models\RiwayatPengalamanKerja;
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

class FormRiwayatPengalamanKerja extends FF
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = 'Riwayat Pengalaman Kerja';


    public function grid()
    {
        $grid = new Grid(new RiwayatPengalamanKerja());
        $grid->model()->orderBy('tgl_kerja','asc');
        $grid->column('instansi', __('INSTANSI'));
        $grid->column('jabatan', __('JABATAN'));
        $grid->column('masa_kerja_tahun', __('MASA KERJA TAHUN'));
        $grid->column('masa_kerja_bulan', __('MASA KERJA BULAN'));
        $grid->column('tgl_kerja', __('TGL KERJA'))->display(function ($o) {
            if ($o) {
                return $this->tgl_kerja->format('d-m-Y');
            }
            return "-";
        });
        return $grid;
    }
    /**
     * Build a form here.
     */
    public function buildForm()
    {
        $form = $this;
        $form->hidden('employee_id', __('Employee id'));
        $form->text('instansi', __('INSTANSI'));
        $form->text('jabatan', __('JABATAN'));
        $form->number('masa_kerja_tahun', __('MASA KERJA TAHUN'));
        $form->number('masa_kerja_bulan', __('MASA KERJA BULAN'));
        $form->date('tgl_kerja', __('TGL KERJA'))->default(date('Y-m-d'));

        return $form;
    }
    public function onCreateForm()
    {
        $data = [];
        return parent::edit($data);
    }
    public function onRefCreateForm($ref_id)
    {
        $record = RiwayatPengalamanKerja::findOrFail($ref_id);
        $data = $record->toArray();
        $old_data = $record->toArray();
        request()->session()->flash('old_data', $old_data);
        return $this->edit($data);
    }
}
