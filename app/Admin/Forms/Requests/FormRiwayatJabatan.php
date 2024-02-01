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
use App\Models\RiwayatPangkat;
use App\Models\RiwayatPendidikan;
use App\Models\RiwayatPensiun;
use App\Models\RiwayatUsulan;
use App\Models\StatusJabatan;
use App\Models\TipeJabatan;
use App\Models\UnitKerja;
use Encore\Admin\Form;
use Encore\Admin\Form\Row;
use Encore\Admin\Grid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormRiwayatJabatan extends FF
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = 'Riwayat Jabatan';


    public function grid()
    {
        $grid = new Grid(new RiwayatJabatan());
        $grid->model()->orderBy('tmt_jabatan', 'desc');
        $grid->column('nama_jabatan', __('JABATAN'));
        $grid->column('unit_text', __('UNIT KERJA'));
        $grid->column('tmt_jabatan', __('TMT JABATAN'))->display(function ($o) {
            if ($o) {
                return $this->tmt_jabatan->format('d-m-Y');
            }
            return "-";
        });
        $grid->column('no_sk', __('NO SK'));
        $grid->column('tgl_sk', __('TGL SK'))->display(function ($o) {
            if ($o) {
                return $this->tgl_sk->format('d-m-Y');
            }
            return "-";
        });
        $grid->column('pejabat_penetap_jabatan', __('PENETAP JABATAN'));

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
        $form->date('tmt_jabatan', __('TMT JABATAN'))->default(date('Y-m-d'));
        $form->select('tipe_jabatan_id', __('TIPE JABATAN'))->options(TipeJabatan::all()->pluck('name', 'id'))->when('in', [1, 6], function (Form $form) {
            $form->select('eselon', __('ESELON'))->options(Eselon::all()->pluck('name', 'id'));
            $form->date('tmt_eselon', __('TMT ESELON'))->default(date('Y-m-d'));
            $form->belongsTo('jabatan_id', GridUnitKerja::class, 'JABATAN');
        })->when('in', [2, 3, 4, 5], function (Form $form) {
            $form->belongsTo('jabatan_id', GridJabatan::class, 'JABATAN');
        });
        $form->text('nama_jabatan', __('NAMA JABATAN'));
        $form->text('no_pelantikan', __('NO PELANTIKAN'));
        $form->date('tgl_pelantikan', __('TGL PELANTIKAN'))->default(date('Y-m-d'));
        $form->text('tunjangan', __('TUNJANGAN'));
        $form->date('bln_dibayar', __('BULAN DIBAYAR'));
        $form->belongsTo('unit_id', GridUnitKerja::class, __('UNIT KERJA'));
        $form->text("unit_text", __("UNIT KERJA"));
        $form->select('status_jabatan_id', __('STATUS JABATAN'))->options(StatusJabatan::all()->pluck('name', 'id'));

        $form->divider("Pejabat Penetap");
        $form->belongsTo('pejabat_penetap_id', GridPejabatPenetap::class, 'PEJABAT PENETAP');
        $form->text('pejabat_penetap_jabatan', __('JABATAN'));
        $form->text('pejabat_penetap_nip', __('NIP'));
        $form->text('pejabat_penetap_nama', __('NAMA'));

        $form->submitted(function (Form $form) use ($d) {
            $form->ignore('dokumen');
            $form->ignore('jabatan_struktural_id');
        });
        $_this = $this;
        $form->saving(function (Form $form) use ($d, $_this) {
            if ($form->pejabat_penetap_id) {
                $r =  PejabatPenetap::where('id', $form->pejabat_penetap_id)->get()->first();
                if ($r) {
                    $form->pejabat_penetap_jabatan = $r->jabatan;
                    $form->pejabat_penetap_nip = $r->nip;
                    $form->pejabat_penetap_nama = $r->nama;
                }
            }
            if ($form->unit_id) {
                $unit_kerja =  UnitKerja::where('id', $form->unit_id)->get()->first();
                if ($unit_kerja) {
                    $form->unit_text = $unit_kerja->name;
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
        $record = RiwayatJabatan::findOrFail($ref_id);
        $data = $record->toArray();
        $old_data = $record->toArray();
        request()->session()->flash('old_data', $old_data);
        return $this->edit($data);
    }
}
