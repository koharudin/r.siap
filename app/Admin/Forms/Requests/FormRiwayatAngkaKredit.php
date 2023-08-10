<?php

namespace App\Admin\Forms\Requests;

use App\Admin\Forms\Requests\FormRequest;
use App\Admin\Selectable\GridPendidikan;
use App\Admin\Selectable\GridUnitKerja;
use App\Http\Traits\FormRiwayatPendidikanTrait;
use App\Models\KategoriLayanan;
use App\Models\Pangkat;
use App\Models\Pendidikan;
use App\Models\RiwayatAngkaKredit;
use App\Models\RiwayatPendidikan;
use App\Models\RiwayatPensiun;
use App\Models\RiwayatUsulan;
use App\Models\UnitKerja;
use Encore\Admin\Form as AdminForm;
use Encore\Admin\Form\Row;
use Encore\Admin\Grid;
use Encore\Admin\Widgets\Form;
use Encore\Admin\Widgets\StepForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormRiwayatAngkaKredit extends FF
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = 'Riwayat Angka Kredit';


    public function grid()
    {
        $grid = new Grid(new RiwayatAngkaKredit());
        $grid->model()->orderBy('tgl_sk', 'asc');
        $grid->column('no_sk', __('NO SK'));
        $grid->column('tgl_sk', __('TGL SK'));
        $grid->column('dt_awal_penilaian', __('TGL AWAL PENILAIAN'));
        $grid->column('dt_akhir_penilaian', __('TGL AKHIR PENILAIAN'));
        $grid->column('jabatan', __('JABATAN'));
        $grid->column('unit_kerja', __('UNIT KERJA'));
        $grid->column('obj_pangkat.name', __('PANGKAT'));
        $grid->column('ak_lama', __('AK LAMA'));
        $grid->column('ak_baru', __('AK BARU'));
        $grid->column('tmt_pak', __('TMT PAK'));
        return $grid;
    }
    /**
     * Build a form here.
     */
    public function buildForm()
    {
        $form = $this;
        $form->hidden('employee_id', __('Employee id'));
        $form->text('no_sk', __('NO SK'));
        $form->date('tgl_sk', __('TGL SK'))->default(date('Y-m-d'));
        $form->date('dt_awal_penilaian', __('TGL AWAL PENILAIAN'))->default(date('Y-m-d'));
        $form->date('dt_akhir_penilaian', __('TGL AKHIR PENILAIAN'))->default(date('Y-m-d'));

        $form->text('jabatan', __('JABATAN'));
        $form->belongsTo('unit_kerja_id', GridUnitKerja::class, 'UNIT KERJA');
        $form->display('unit_kerja', __('UNIT KERJA'));
        $form->select('pangkat_id', __('PANGKAT'))->options(Pangkat::all()->pluck("name", "id"));
        $form->decimal('ak_lama', __('AK LAMA'));
        $form->decimal('ak_baru', __('AK BARU'));
        $form->textarea('keterangan', __('KETERANGAN'));
        $form->date('tmt_pak', __('TMT PAK'))->default(date('Y-m-d'));

        $form->saving(function (AdminForm $form) {
            if ($form->unit_kerja_id) {
                $unit_kerja =  UnitKerja::where('id', $form->unit_kerja_id)->get()->first();
                if ($unit_kerja) {
                    $form->unit_kerja = $unit_kerja->name;
                }
            }
        });
        
        return $this;
    }
    public function onCreateForm()
    {
        $data = [];
        return parent::edit($data);
    }
    public function onRefCreateForm($ref_id)
    {
        $record = RiwayatAngkaKredit::findOrFail($ref_id);
        $data = $record->toArray();
        $old_data = $record->toArray();
        request()->session()->flash('old_data', $old_data);
        return $this->edit($data);
    }
}
