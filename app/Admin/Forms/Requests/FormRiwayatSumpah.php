<?php

namespace App\Admin\Forms\Requests;

use App\Admin\Forms\Requests\FormRequest;
use App\Admin\Selectable\GridJabatan;
use App\Admin\Selectable\GridPejabatPenetap;
use App\Admin\Selectable\GridPendidikan;
use App\Admin\Selectable\GridUnitKerja;
use App\Http\Traits\FormRiwayatPendidikanTrait;
use App\Models\Eselon;
use App\Models\JenisKP;
use App\Models\KategoriLayanan;
use App\Models\Pangkat;
use App\Models\PejabatPenetap;
use App\Models\Pendidikan;
use App\Models\RiwayatAngkaKredit;
use App\Models\RiwayatJabatan;
use App\Models\RiwayatMutasi;
use App\Models\RiwayatPangkat;
use App\Models\RiwayatPendidikan;
use App\Models\RiwayatPensiun;
use App\Models\RiwayatSumpah;
use App\Models\RiwayatUsulan;
use App\Models\StatusJabatan;
use App\Models\TipeJabatan;
use App\Models\UnitKerja;
use Encore\Admin\Form;
use Encore\Admin\Form\Row;
use Encore\Admin\Grid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormRiwayatSumpah extends FF
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = 'Riwayat Mutasi';


    public function grid()
    {
        $grid = new Grid(new RiwayatSumpah());
        $grid->model()->orderBy('tgl_sumpah','asc');
        $grid->column('no_sumpah', __('NO SUMPAH'));
        $grid->column('tgl_sumpah', __('TGL SUMPAH'))->display(function ($o) {
            if ($o) {
                return $this->tgl_sumpah->format('d-m-Y');
            }
            return "-";
        });
        $grid->column('keterangan', __('KETERANGAN'));
        return $grid;
    }
    /**
     * Build a form here.
     */
    public function form()
    {
        $form = $this;
        $form->hidden('employee_id', __('Employee id'));
        $form->text('no_sumpah', __('NO SUMPAH'));
        $form->date('tgl_sumpah', __('TGL SUMPAH'))->default(date('Y-m-d'));
        $form->text('keterangan', __('KETERANGAN'));
    }
    public function onCreateForm()
    {
        $data = [];
        return parent::edit($data);
    }
    public function onRefCreateForm($ref_id)
    {
        $record = RiwayatSumpah::findOrFail($ref_id);
        $data = $record->toArray();
        $old_data = $record->toArray();
        request()->session()->flash('old_data', $old_data);
        return $this->edit($data);
    }
}
