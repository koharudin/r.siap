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
use App\Models\RiwayatUsulan;
use Encore\Admin\Form;
use Encore\Admin\Form\Row;
use Encore\Admin\Grid;
use Encore\Admin\Widgets\StepForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormRiwayatDP3 extends FF
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = 'Riwayat DP3';


    public function grid()
    {
        $grid = new Grid(new RiwayatDp3());
        $grid->model()->orderBy('tahun','asc');
        $grid->column('tahun', __('TAHUN'));
        $grid->column('kesetiaan', __('KESETIAAN'));
        $grid->column('prestasi', __('PRESTASI'));
        $grid->column('tanggung_jawab', __('TANGGUNG JAWAB'));
        $grid->column('ketaatan', __('KETAATAN'));
        $grid->column('kejujuran', __('KEJUJURAN'));
        $grid->column('kerjasama', __('KERJASAMA'));
        $grid->column('prakarsa', __('PRAKARSA'));
        $grid->column('kepemimpinan', __('KEPEMIMPINAN'));

        return $grid;
    }
    /**
     * Build a form here.
     */
    public function form()
    {
        $form = $this;
        $form->hidden('employee_id', __('Employee id'));
        $form->decimal('kesetiaan', __('KESETIAAN'));
        $form->decimal('prestasi', __('PRESTASI'));
        $form->decimal('tanggung_jawab', __('TANGGUNG JAWAB'));
        $form->decimal('ketaatan', __('KETAATAN'));
        $form->decimal('kejujuran', __('KEJUJURAN'));
        $form->decimal('kerjasama', __('KERJASAMA'));
        $form->decimal('prakarsa', __('PRAKARSA'));
        $form->decimal('kepemimpinan', __('KEPEMIMPINAN'));

        return $form;
    }
    public function onCreateForm()
    {
        $data = [];
        return parent::edit($data);
    }
    public function onRefCreateForm($ref_id)
    {
        $record = RiwayatDp3::findOrFail($ref_id);
        $data = $record->toArray();
        $old_data = $record->toArray();
        request()->session()->flash('old_data', $old_data);
        return $this->edit($data);
    }
}
