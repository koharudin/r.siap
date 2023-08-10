<?php

namespace App\Admin\Forms\Requests;

use App\Admin\Forms\Requests\FormRequest;
use App\Admin\Selectable\GridDiklat;
use App\Admin\Selectable\GridPendidikan;
use App\Http\Traits\FormRiwayatPendidikanTrait;
use App\Models\KategoriLayanan;
use App\Models\Pendidikan;
use App\Models\RiwayatDiklatFungsional;
use App\Models\RiwayatDiklatStruktural;
use App\Models\RiwayatDiklatTeknis;
use App\Models\RiwayatDp3;
use App\Models\RiwayatKursus;
use App\Models\RiwayatPendidikan;
use App\Models\RiwayatPensiun;
use App\Models\RiwayatPotensiDiri;
use App\Models\RiwayatSeminar;
use App\Models\RiwayatUjiKompetensi;
use App\Models\RiwayatUsulan;
use Encore\Admin\Form;
use Encore\Admin\Form\Row;
use Encore\Admin\Grid;
use Encore\Admin\Widgets\StepForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormRiwayatPotensiDiri extends FF
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = 'Riwayat Potensi Diri';


    public function grid()
    {
        $grid = new Grid(new RiwayatPotensiDiri());
        $grid->model()->orderBy('tahun','asc');
        $grid->column('tahun', __('TAHUN'));
        $grid->column('tanggung_jawab', __('TANGGUNG JAWAB'));
        $grid->column('motivasi', __('MOTIVASI'));
        $grid->column('minat', __('MINAT'));
        return $grid;
    }
    /**
     * Build a form here.
     */
    public function buildForm()
    {
        $form = $this;
        $form->hidden('employee_id', __('Employee id'));
        $form->decimal('tahun', __('TAHUN'));
        $form->textarea('tanggung_jawab', __('TANGGUNG JAWAB'));
        $form->textarea('motivasi', __('MOTIVASI'));
        $form->textarea('minat', __('MINAT'));

        return $form;
    }
    public function onCreateForm()
    {
        $data = [];
        return parent::edit($data);
    }
    public function onRefCreateForm($ref_id)
    {
        $record = RiwayatPotensiDiri::findOrFail($ref_id);
        $data = $record->toArray();
        $old_data = $record->toArray();
        request()->session()->flash('old_data', $old_data);
        return $this->edit($data);
    }
}
