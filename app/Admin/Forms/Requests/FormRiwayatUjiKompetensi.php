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
use App\Models\RiwayatSeminar;
use App\Models\RiwayatUjiKompetensi;
use App\Models\RiwayatUsulan;
use Encore\Admin\Form;
use Encore\Admin\Form\Row;
use Encore\Admin\Grid;
use Encore\Admin\Widgets\StepForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormRiwayatUjiKompetensi extends FF
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = 'Riwayat Uji Kompetensi';


    public function grid()
    {
        $grid = new Grid(new RiwayatUjiKompetensi());
        $grid->model()->orderBy('tanggal','asc');
        $grid->column('jabatan', __('JABATAN'));
        $grid->column('satker', __('SATKER'));
        $grid->column('keterangan', __('KETERANGAN'));
        $grid->column('tanggal', __('TANGGAL'))->display(function ($o) {
            if ($o) {
                return $this->tanggal->format('d-m-Y');
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
        $form->text('jabatan', __('JABATAN'));
        $form->text('satker', __('SATKER'));
        $form->text('keterangan', __('KETERANGAN'));
        $form->date('tanggal', __('TANGGAL'))->default(date('Y-m-d'));

        return $form;
    }
    public function onCreateForm()
    {
        $data = [];
        return parent::edit($data);
    }
    public function onRefCreateForm($ref_id)
    {
        $record = RiwayatUjiKompetensi::findOrFail($ref_id);
        $data = $record->toArray();
        $old_data = $record->toArray();
        request()->session()->flash('old_data', $old_data);
        return $this->edit($data);
    }
}
