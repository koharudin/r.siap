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
use App\Models\RiwayatOrangTua;
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

class FormRiwayatOrangTua extends FF
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = 'Riwayat Orang Tua';


    public function grid()
    {
        $grid = new Grid(new RiwayatOrangTua());
        $grid->model()->whereIn("status",[1,2]);
        $grid->model()->orderBy('status','asc');
        $grid->column('name', __('NAMA'));
        $grid->column('status', __('STATUS'))->display(function ($status) {
            if($status==2){
                return "Ibu";
            }
            else if ($status==1){
                return "Ayah";
            }
            else return "-";
        });
        $grid->column('birth_date', __('TGL LAHIR'))->display(function ($o) {
            if ($o) {
                return $this->birth_date->format('d-m-Y');
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
        $form->select('status')->options(['1'=>'Ayah','2'=>'Ibu'])->required(true);

        $form->hidden('employee_id', __('Employee id'));
        $form->text('name', __('NAMA'));
        $form->text('birth_place', __('TEMPAT LAHIR'));
        $form->date('birth_date', __('TANGGAL LAHIR'))->default(date('Y-m-d'));
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
        $record = RiwayatOrangTua::findOrFail($ref_id);
        $data = $record->toArray();
        $old_data = $record->toArray();
        request()->session()->flash('old_data', $old_data);
        return $this->edit($data);
    }
}
