<?php

namespace App\Admin\Forms\Requests;

use App\Admin\Forms\Requests\FormRequest;
use App\Admin\Selectable\GridDiklat;
use App\Admin\Selectable\GridPendidikan;
use App\Admin\Selectable\GridUnitKerja;
use App\Http\Traits\FormRiwayatPendidikanTrait;
use App\Models\JenisKelamin;
use App\Models\JenisPekerjaan;
use App\Models\KategoriLayanan;
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

class FormRiwayatOrganisasi extends FF
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = 'Riwayat Organisasi';

    public function grid()
    {
        $grid = new Grid(new RiwayatOrganisasi());
        $grid->model()->orderBy('awal','asc');
        $grid->column('nama', __('ORGANISASI'));
        $grid->column('jabatan', __('JABATAN'));
        $grid->column('awal', __('AWAL'))->display(function ($o) {
            if ($o) {
                return $this->awal->format('d-m-Y');
            }
            return "-";
        });
        $grid->column('akhir', __('AKHIR'))->display(function ($o) {
            if ($o) {
                return $this->akhir->format('d-m-Y');
            }
            return "-";
        });
        $grid->column('pimpinan', __('PIMPINAN'));
        $grid->column('tempat', __('TEMPAT'));

        return $grid;
    }
    /**
     * Build a form here.
     */
    public function buildForm()
    {
        $form = $this;
        $form->hidden('employee_id', __('Employee id'));
        $form->text('nama', __('NAMA ORGANISASI'));
        $form->text('jabatan', __('JABATAN'));
        $form->date('awal', __('AWAL'))->default(date('Y-m-d'));
        $form->date('akhir', __('AKHIR'))->default(date('Y-m-d'));
        $form->text('pimpinan', __('PIMPINAN'));
        $form->text('tempat', __('TEMPAT'));
        $form->hidden('employee_id', __('Employee id'));

        return $form;
    }
    public function onCreateForm()
    {
        $data = [];
        return parent::edit($data);
    }
    public function onRefCreateForm($ref_id)
    {
        $record = RiwayatOrganisasi::findOrFail($ref_id);
        $data = $record->toArray();
        $old_data = $record->toArray();
        request()->session()->flash('old_data', $old_data);
        return $this->edit($data);
    }
}
