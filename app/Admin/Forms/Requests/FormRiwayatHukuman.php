<?php

namespace App\Admin\Forms\Requests;

use App\Admin\Forms\Requests\FormRequest;
use App\Admin\Selectable\GridDiklat;
use App\Admin\Selectable\GridPejabatPenetap;
use App\Admin\Selectable\GridPendidikan;
use App\Admin\Selectable\GridUnitKerja;
use App\Http\Traits\FormRiwayatPendidikanTrait;
use App\Models\Hukuman;
use App\Models\JenisBahasa;
use App\Models\JenisKelamin;
use App\Models\JenisPekerjaan;
use App\Models\KategoriLayanan;
use App\Models\KemampuanBicara;
use App\Models\PejabatPenetap;
use App\Models\Pendidikan;
use App\Models\RiwayatAnak;
use App\Models\RiwayatDiklatFungsional;
use App\Models\RiwayatDiklatStruktural;
use App\Models\RiwayatDiklatTeknis;
use App\Models\RiwayatDp3;
use App\Models\RiwayatHukuman;
use App\Models\RiwayatKinerja;
use App\Models\RiwayatKursus;
use App\Models\RiwayatNikah;
use App\Models\RiwayatOrangTua;
use App\Models\RiwayatOrganisasi;
use App\Models\RiwayatPendidikan;
use App\Models\RiwayatPengalamanKerja;
use App\Models\RiwayatPenguasaanBahasa;
use App\Models\RiwayatPensiun;
use App\Models\RiwayatPotensiDiri;
use App\Models\RiwayatRekamMedis;
use App\Models\RiwayatSaudara;
use App\Models\RiwayatSeminar;
use App\Models\RiwayatUjiKompetensi;
use App\Models\RiwayatUsulan;
use App\Models\StatusAnak;
use App\Models\StatusMenikah;
use App\Models\UnitKerja;
use Encore\Admin\Form;
use Encore\Admin\Form\Row;
use Encore\Admin\Grid;
use Encore\Admin\Widgets\StepForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormRiwayatHukuman extends FF
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = 'Riwayat Hukuman';

    public function grid()
    {
        $grid = new Grid(new RiwayatHukuman());
        $grid->model()->orderBy('tmt_sk','asc');

        $grid->column('obj_hukuman.hukuman', __('HUKUMAN'));
        $grid->column('no_sk', __('NO SK'));
        $grid->column('tgl_sk', __('TGL SK'))->display(function ($o) {
            if ($o) {
                return $this->tgl_sk->format('d-m-Y');
            }
            return "-";
        });
        $grid->column(('pelanggaran'), __(('PELANGGARAN')));
        $grid->column('tmt_sk', __('TMT SK'))->display(function ($o) {
            if ($o) {
                return $this->tmt_sk->format('d-m-Y');
            }
            return "-";
        });
        $grid->column('pejabat_penetap_jabatan', __('PEJABAT PENETAP JABATAN'));

        return $grid;
    }
    /**
     * Build a form here.
     */
    public function buildForm()
    {
        $form = $this;
        $form->hidden('employee_id', __('Employee id'));
        
        $form->textarea(('pelanggaran'), __(('PELANGGARAN')));
        
        $form->divider('SK HUKUMAN');
        $form->text('no_sk', __('NO SK'));
        $form->date('tgl_sk', __('TGL SK'))->default(date('Y-m-d'));
        $form->date('tmt_sk', __('TMT SK'))->default(date('Y-m-d'));

        $form->divider("PEJABAT PENETAP");
        $form->belongsTo('pejabat_penetap_id',GridPejabatPenetap::class,'PEJABAT PENETAP');

        $form->text('pejabat_penetap_jabatan', __('PEJABAT PENETAP JABATAN'));
        $form->text('pejabat_penetap_nip', __('PEJABAT PENETAP NIP'));
        $form->text('pejabat_penetap_nama', __('PEJABAT PENETAP NAMA'));
        $form->divider('SK PECABUTAN HUKUMAN');
        $form->date('tmt_akhir', __('TMT AKHIR'))->default(date('Y-m-d'));
        $form->belongsTo('pejabat_penetap_akhir_id',GridPejabatPenetap::class,'PEJABAT PENETAP');
        $form->text('pejabat_penetap_akhir_jabatan', __('PEJABAT PENETAP AKHIR JABATAN'));
        $form->text('pejabat_penetap_akhir_nip', __('PEJABAT PENETAP AKHIR NIP'));
        $form->text('pejabat_penetap_akhir_nama', __('PEJABAT PENETAP AKHIR NAMA'));
        $form->text('sk_akhir', __('SK AKHIR'));
        $form->date('tgl_sk_akhir', __('TGL  AKHIR'))->default(date('Y-m-d'));
        $form->select('hukuman_id','HUKUMAN')->options(Hukuman::all()->pluck('name','id'));

        $form->saving(function (Form $form) {
            if($form->pejabat_penetap_id){
                $r =  PejabatPenetap::where('id',$form->pejabat_penetap_id)->get()->first();
                if($r){
                    $form->pejabat_penetap_jabatan = $r->jabatan;
                    $form->pejabat_penetap_nip = $r->nip;
                    $form->pejabat_penetap_nama = $r->nama;
                }
            }
        });

        $form->saving(function (Form $form) {
            if($form->pejabat_penetap_akhir_id){
                $r =  PejabatPenetap::where('id',$form->pejabat_penetap_akhir_id)->get()->first();
                if($r){
                    $form->pejabat_penetap_akhir_jabatan = $r->jabatan;
                    $form->pejabat_penetap_akhir_nip = $r->nip;
                    $form->pejabat_penetap_akhir_nama = $r->nama;
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
        $record = RiwayatHukuman::findOrFail($ref_id);
        $data = $record->toArray();
        $old_data = $record->toArray();
        request()->session()->flash('old_data', $old_data);
        return $this->edit($data);
    }
}
