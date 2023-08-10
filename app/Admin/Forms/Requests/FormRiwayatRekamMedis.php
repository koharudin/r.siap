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
use App\Models\RiwayatRekamMedis;
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

class FormRiwayatRekamMedis extends FF
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = 'Riwayat Rekam Medis';


    public function grid()
    {
        $grid = new Grid(new RiwayatRekamMedis());
        $grid->model()->orderBy('tgl_periksa','asc');
        $grid->column('tgl_periksa', __('TANGGAL PERIKSA'))->display(function ($o) {
            if ($o) {
                return $this->tgl_periksa->format('d-m-Y');
            }
            return "-";
        });
        $grid->column('keluhan', __('KELUHAN'));
        return $grid;
    }
    /**
     * Build a form here.
     */
    public function buildForm()
    {
        $form = $this;
        $form->hidden('employee_id', __('Employee id'));
        $form->date('tgl_periksa', __('TGL PERIKSA'))->default(date('Y-m-d'));
        $form->textarea('keluhan', __('KELUHAN'));
        $form->textarea('diagnosa', __('DIAGNOSA'));
        $form->text('jenis_pemeriksaan', __('JENIS PEMERIKSAAN'));
        $form->textarea('tindakan', __('TINDAKAN'));
        $form->text('dokter', __('DOKTER'));
        $form->textarea('keterangan', __('KETERANGAN'));

        return $form;
    }
    public function onCreateForm()
    {
        $data = [];
        return parent::edit($data);
    }
    public function onRefCreateForm($ref_id)
    {
        $record = RiwayatRekamMedis::findOrFail($ref_id);
        $data = $record->toArray();
        $old_data = $record->toArray();
        request()->session()->flash('old_data', $old_data);
        return $this->edit($data);
    }
}
