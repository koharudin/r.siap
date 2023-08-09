<?php

namespace App\Admin\Forms\Requests;

use App\Admin\Forms\Requests\FormRequest;
use App\Admin\Selectable\GridPejabatPenetap;
use App\Admin\Selectable\GridPendidikan;
use App\Admin\Selectable\GridUnitKerja;
use App\Http\Traits\FormRiwayatPendidikanTrait;
use App\Models\JenisKP;
use App\Models\KategoriLayanan;
use App\Models\Pangkat;
use App\Models\PejabatPenetap;
use App\Models\Pendidikan;
use App\Models\RiwayatAngkaKredit;
use App\Models\RiwayatPangkat;
use App\Models\RiwayatPendidikan;
use App\Models\RiwayatPensiun;
use App\Models\RiwayatUsulan;
use App\Models\UnitKerja;
use Encore\Admin\Form;
use Encore\Admin\Form\Row;
use Encore\Admin\Grid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormRiwayatPangkat extends FF
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = 'Riwayat Pangkat';


    public function grid()
    {
        $grid = new Grid(new RiwayatPangkat());
        $grid->model()->orderBy('tgl_sk', 'asc');
        $grid->column('no_sk', __('NO SK'));
        $grid->column('tgl_sk', __('TGL SK'))->display(function ($o) {
            if ($o) {
                return $this->tgl_sk->format('d-m-Y');
            }
            return "-";
        });
        $grid->column('obj_pangkat.name', __('PANGKAT'));
        $grid->column('obj_jenis_kenaikan_pangkat.name', __('JENIS KP'));
        $grid->column('pejabat_penetap_nip', __('PENETAP NIP'));
        $grid->column('pejabat_penetap_nama', __('PENETAP NAMA'));
        $grid->column('pejabat_penetap_jabatan', __('PENETAP JABATAN'));
        return $grid;
    }
    /**
     * Build a form here.
     */
    public function form()
    {
        $form = $this;
        $form->hidden('employee_id', __('Employee id'));
        $form->text('stlud', __('STLUD'));
        $form->text('no_stlud', __('NO STLUD'));
        $form->date('tgl_stlud', __('TGL STLUD'))->default(date('Y-m-d'));
        $form->text('no_nota', __('NO NOTA'));
        $form->date('tgl_nota', __('TGL NOTA'))->default(date('Y-m-d'));
        $form->text('no_sk', __('NO SK'));
        $form->date('tgl_sk', __('TGL SK'))->default(date('Y-m-d'));
        $form->date('tmt_pangkat', __('TMT PANGKAT'))->default(date('Y-m-d'));

        $form->decimal('kredit', __('KREDIT'));
        $form->select('pangkat_id', __('PANGKAT'))->options(Pangkat::all()->pluck('name', 'id'));
        $form->select('jenis_kp', __('JENIS KP'))->options(JenisKP::all()->pluck('name', 'id'));
        $form->text('keterangan', __('KETERANGAN'));
        $form->text('jenis_ket', __('JENIS KET'));
        $form->date('tmt_pak', __('TMT PAK'))->default(date('Y-m-d'));
        $form->number('masakerja_thn', __('MASA KERJA TAHUN'));
        $form->number('masakerja_bln', __('MASA KERJA BULAN'));
        $form->divider("Pejabat Penetap");
        $form->belongsTo('pejabat_penetap_id', GridPejabatPenetap::class, 'PEJABAT PENETAP');
        $form->text('pejabat_penetap_jabatan', __('JABATAN'));
        $form->text('pejabat_penetap_nip', __('NIP'));
        $form->text('pejabat_penetap_nama', __('NAMA'));

        $_this = $this;
        $form->saving(function (Form $form) use ($_this) {
            if ($form->pejabat_penetap_id) {
                $r =  PejabatPenetap::where('id', $form->pejabat_penetap_id)->get()->first();
                if ($r) {
                    $form->pejabat_penetap_jabatan = $r->jabatan;
                    $form->pejabat_penetap_nip = $r->nip;
                    $form->pejabat_penetap_nama = $r->nama;
                }
            }
        });
    }
    public function onCreateForm()
    {
        $data = [];
        return parent::edit($data);
    }
    public function onRefCreateForm($ref_id)
    {
        $record = RiwayatPangkat::findOrFail($ref_id);
        $data = $record->toArray();
        $old_data = $record->toArray();
        request()->session()->flash('old_data', $old_data);
        return $this->edit($data);
    }
}
