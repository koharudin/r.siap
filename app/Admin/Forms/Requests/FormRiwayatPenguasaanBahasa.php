<?php

namespace App\Admin\Forms\Requests;

use App\Admin\Forms\Requests\FormRequest;
use App\Admin\Selectable\GridDiklat;
use App\Admin\Selectable\GridPendidikan;
use App\Admin\Selectable\GridUnitKerja;
use App\Http\Traits\FormRiwayatPendidikanTrait;
use App\Models\JenisBahasa;
use App\Models\JenisKelamin;
use App\Models\JenisPekerjaan;
use App\Models\KategoriLayanan;
use App\Models\KemampuanBicara;
use App\Models\Pendidikan;
use App\Models\RiwayatAnak;
use App\Models\RiwayatDiklatFungsional;
use App\Models\RiwayatDiklatStruktural;
use App\Models\RiwayatDiklatTeknis;
use App\Models\RiwayatDp3;
use App\Models\RiwayatKinerja;
use App\Models\RiwayatKursus;
use App\Models\RiwayatNikah;
use App\Models\RiwayatOrangTua;
use App\Models\RiwayatOrganisasi;
use App\Models\RiwayatPendidikan;
use App\Models\RiwayatPengalamanKerja;
use App\Models\RiwayatPenguasaanBahasa;
use App\Models\RiwayatPensiun;
use App\Models\RiwayatPotensiDiri;
use App\Models\RiwayatRekamMedis;
use App\Models\RiwayatSaudara;
use App\Models\RiwayatSeminar;
use App\Models\RiwayatUjiKompetensi;
use App\Models\RiwayatUsulan;
use App\Models\StatusAnak;
use App\Models\StatusMenikah;
use App\Models\UnitKerja;
use Encore\Admin\Form;
use Encore\Admin\Form\Row;
use Encore\Admin\Grid;
use Encore\Admin\Widgets\StepForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormRiwayatPenguasaanBahasa extends FF
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = 'Riwayat Penguasaan Bahasa';

    public function grid()
    {
        $grid = new Grid(new RiwayatPenguasaanBahasa());
        $grid->model()->orderBy('nama_bahasa','asc');
        $grid->column('obj_jenis_bahasa.name', __('JENIS BAHASA'));
        $grid->column('nama_bahasa', __('NAMA BAHASA'));
        $grid->column('obj_kemampuan_bicara.name', __('KEMAMPUAN BICARA'));
        $grid->column('jenis_sertifikasi', __('JENIS SERTIFIKASI'));
        $grid->column('lembaga_sertifikasi', __('LEMBAGA SERTIFIKASI'));
        $grid->column('skor', __('SKOR'));
        $grid->column('tgl_expired', __('TGL KADALUARSA'))->display(function ($o) {
            if ($o) {
                return $this->tgl_expired->format('d-m-Y');
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
        $form->select('jenis_bahasa', __('JENIS BAHASA'))->options(JenisBahasa::all()->pluck('name','id'));
        $form->text('nama_bahasa', __('NAMA BAHASA'));
        $form->select('kemampuan_bicara', __('KEMAMPUAN BICARA'))->options(KemampuanBicara::all()->pluck('name','id'));
        $form->text('jenis_sertifikasi', __('JENIS SERTIFIKASI'));
        $form->text('lembaga_sertifikasi', __('LEMBAGA SERTIFIKASI'));
        $form->text('skor', __('SKOR'));
        $form->date('tgl_expired', __('TGL KADALUARSA'))->default(date('Y-m-d'));
        
        return $form;
    }
    public function onCreateForm()
    {
        $data = [];
        return parent::edit($data);
    }
    public function onRefCreateForm($ref_id)
    {
        $record = RiwayatPenguasaanBahasa::findOrFail($ref_id);
        $data = $record->toArray();
        $old_data = $record->toArray();
        request()->session()->flash('old_data', $old_data);
        return $this->edit($data);
    }

}
