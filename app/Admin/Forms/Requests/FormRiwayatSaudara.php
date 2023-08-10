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

class FormRiwayatSaudara extends FF
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = 'Riwayat Saudara';

    public function grid()
    {
        $grid = new Grid(new RiwayatSaudara());
        $grid->model()->orderBy('birth_date','asc');
        $grid->column('name', __('NAMA'));
        $grid->column('birth_date', __('TGL LAHIR'))->display(function ($o) {
            if ($o) {
                return $this->birth_date->format('d-m-Y');
            }
            return "-";
        });
        $grid->column('telepon', __('TELEPON'));
        $grid->column('alamat', __('ALAMAT'));

        return $grid;
    }
    /**
     * Build a form here.
     */
    public function form()
    {
        $form = $this;
        $form->hidden('employee_id', __('Employee id'));
        $form->text('name', __('NAMA'));
        $form->text('birth_place', __('TEMPAT LAHIR'));
        $form->date('birth_date', __('TANGGAL LAHIR'))->default(date('Y-m-d'));
        $form->select('jenis_kelamin', __('JENIS KELAMIN'))->options(JenisKelamin::all()->pluck('name','id'));
        $form->text('pekerjaan', __('PEKERJAAN'));
        $form->textarea('alamat', __('ALAMAT'));
        $form->text('telepon', __('TELEPON'));

        return $form;
    }
    public function onCreateForm()
    {
        $data = [];
        return parent::edit($data);
    }
    public function onRefCreateForm($ref_id)
    {
        $record = RiwayatSaudara::findOrFail($ref_id);
        $data = $record->toArray();
        $old_data = $record->toArray();
        request()->session()->flash('old_data', $old_data);
        return $this->edit($data);
    }
}
