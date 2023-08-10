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
use App\Models\RiwayatKursus;
use App\Models\RiwayatPendidikan;
use App\Models\RiwayatPensiun;
use App\Models\RiwayatSeminar;
use App\Models\RiwayatUsulan;
use Encore\Admin\Form;
use Encore\Admin\Form\Row;
use Encore\Admin\Grid;
use Encore\Admin\Widgets\StepForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormRiwayatSeminar extends FF
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = 'Riwayat Diklat Seminar';


    public function grid()
    {
        $grid = new Grid(new RiwayatSeminar());
        $grid->model()->orderBy('tgl_mulai','asc');
        $grid->model()->where('jenis_piagam',2); 
        $grid->column('nama', __('NAMA'));
        $grid->column('tempat', __('TEMPAT'));
        $grid->column('penyelenggara', __('PENYELENGGARA'));
        $grid->column('tgl_mulai', __('TGL MULAI'))->display(function ($o) {
            if ($o) {
                return $this->tgl_mulai->format('d-m-Y');
            }
            return "-";
        });
        $grid->column('tgl_selesai', __('TGL SELESAI'))->display(function ($o) {
            if ($o) {
                return $this->tgl_selesai->format('d-m-Y');
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
        $form->text('nama', __('NAMA'));
        $form->text('tempat', __('TEMPAT'));
        $form->text('penyelenggara', __('PENYELENGGARA'));
        $form->date('tgl_mulai', __('TGL MULAI'))->default(date('Y-m-d'));
        $form->date('tgl_selesai', __('TGL SELESAI'))->default(date('Y-m-d'));
        $form->text('no_piagam', __('NO PIAGAM'));
        $form->date('tgl_piagam', __('TGL PIAGAM'))->default(date('Y-m-d'));
        $form->text('status', __('STATUS'));
        $form->text('peran', __('PERAN'));
        return $form;
    }
    public function onCreateForm()
    {
        $data = [];
        return parent::edit($data);
    }
    public function onRefCreateForm($ref_id)
    {
        $record = RiwayatSeminar::findOrFail($ref_id);
        $data = $record->toArray();
        $old_data = $record->toArray();
        request()->session()->flash('old_data', $old_data);
        return $this->edit($data);
    }
}
