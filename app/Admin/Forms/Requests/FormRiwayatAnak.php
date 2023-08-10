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

class FormRiwayatAnak extends FF
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = 'Riwayat Anak';


    public function grid()
    {
        $grid = new Grid(new RiwayatAnak());
        $grid->model()->orderBy('birth_date','asc');
        $grid->column('name', __('NAMA'));
        $grid->column('birth_place', __('TEMPAT LAHIR'));
        $grid->column('birth_date', __('TANGGAL LAHIR'))->display(function ($o) {
            if ($o) {
                return $this->birth_date->format('d-m-Y');
            }
            return "-";
        });
        $grid->column('obj_jenis_kelamin.name', __('JENIS KELAMIN'));
        $grid->column('obj_status_anak.name', __('STATUS KELUARGA'));
        $grid->column('status_tunjangan', __('STATUS TUNJANGAN'));
        $grid->column('bln_dibayar', __('BLN DIBAYAR'));
        $grid->column('bln_akhir_dibayar', __('BLN AKHIR DIBAYAR'));

        return $grid;
    }
    /**
     * Build a form here.
     */
    public function buildForm()
    {
        $form = $this;
        $form->hidden('employee_id', __('Employee id'));
        $form->text('name', __('NAMA'));
        $form->text('birth_place', __('TEMPAT LAHIR'));
        $form->date('birth_date', __('TANGGAL LAHIR'))->default(date('Y-m-d'));
        $form->select('jenis_kelamin', __('JENIS KELAMIN'))->options(JenisKelamin::all()->pluck('name','id'));
        $form->text('pekerjaan', __('PEKERJAAN'));
        $form->select('status_keluarga', __('STATUS KELUARGA'))->options(StatusAnak::all()->pluck('name','id'));
        $form->select('status_tunjangan', __('STATUS TUNJANGAN'))->options(['1' => 'Dapat',  '0' => 'Tidak']);
        $form->date('bln_dibayar', __('BLN DIBAYAR'))->default(date('Y-m-d'));
        $form->date('bln_akhir_dibayar', __('BLN AKHIR DIBAYAR'))->default(date('Y-m-d'));

        
        return $this;
    }
    public function onCreateForm()
    {
        $data = [];
        return parent::edit($data);
    }
    public function onRefCreateForm($ref_id)
    {
        $record = RiwayatAnak::findOrFail($ref_id);
        $data = $record->toArray();
        $old_data = $record->toArray();
        request()->session()->flash('old_data', $old_data);
        return $this->edit($data);
    }
}
