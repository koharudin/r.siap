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
use App\Models\RiwayatPendidikan;
use App\Models\RiwayatPensiun;
use App\Models\RiwayatUsulan;
use Encore\Admin\Form;
use Encore\Admin\Form\Row;
use Encore\Admin\Grid;
use Encore\Admin\Widgets\StepForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormRiwayatDiklatTeknis extends FF
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = 'Riwayat Diklat Teknis';


    public function grid()
    {
        $grid = new Grid(new RiwayatDiklatTeknis());
        $grid->model()->where('jenis_diklat',1); 
        $grid->column('nama_diklat', __('NAMA DIKLAT'));
        $grid->column('tempat', __('TEMPAT'));
        $grid->column('penyelenggara', __('PENYELENGGARA'));
        $grid->column('angkatan', __('ANGKATAN'));
        $grid->column('tahun', __('TAHUN'));
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
    public function form()
    {
        $form = $this;
        $form->hidden('employee_id', __('Employee id'));
        $form->hidden('jenis_diklat', __('JENIS DIKLAT'));
        $form->text('nama_diklat', __('NAMA DIKLAT'));
        $form->text('tempat', __('TEMPAT'));
        $form->text('penyelenggara', __('PENYELENGGARA'));
        $form->text('angkatan', __('ANGKATAN'));
        $form->number('tahun', __('TAHUN'));
        $form->date('tgl_mulai', __('TGL MULAI'))->default(date('Y-m-d'));
        $form->date('tgl_selesai', __('TGL SELESAI'))->default(date('Y-m-d'));
        $form->text('no_sttpp', __('NO STTPP'));
        $form->date('tgl_sttpp', __('TGL STTPP'))->default(date('Y-m-d'));
        $form->belongsTo('diklat_id', GridDiklat::class, 'DIKLAT ID');

        $form->saving(function (Form $form) {
           $form->jenis_diklat = 1; //diklat teknis
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
        $record = RiwayatDiklatTeknis::findOrFail($ref_id);
        $data = $record->toArray();
        $old_data = $record->toArray();
        request()->session()->flash('old_data', $old_data);
        return $this->edit($data);
    }
}
