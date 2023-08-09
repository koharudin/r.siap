<?php

namespace App\Admin\Forms\Requests;

use App\Admin\Forms\Requests\FormRequest;
use App\Admin\Selectable\GridJabatan;
use App\Admin\Selectable\GridPejabatPenetap;
use App\Admin\Selectable\GridPendidikan;
use App\Admin\Selectable\GridUnitKerja;
use App\Http\Traits\FormRiwayatPendidikanTrait;
use App\Models\Eselon;
use App\Models\JenisKenaikanGaji;
use App\Models\JenisKP;
use App\Models\KategoriLayanan;
use App\Models\Pangkat;
use App\Models\PejabatPenetap;
use App\Models\Pendidikan;
use App\Models\RiwayatAngkaKredit;
use App\Models\RiwayatGaji;
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

class FormRiwayatGaji extends FF
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = 'Riwayat Gaji';


    public function grid()
    {
        $grid = new Grid(new RiwayatGaji());
        $grid->model()->orderBy('tgl_sk','asc');
        $grid->column('no_sk', __('NO SK'));
        $grid->column('tgl_sk', __('TGL SK'))->display(function($o){
            if($o){
                return $this->tgl_sk->format('d-m-Y');
            }
            return "-";
        });
        $grid->column('tmt_sk', __('TMT SK'))->display(function($o){
            if($o){
                return $this->tmt_sk->format('d-m-Y');
            }
            return "-";
        });
        $grid->column('objPangkat.name', __('PANGKAT'));
        $grid->column('masakerja_tahun', __('MASA KERJA TAHUN'));
        $grid->column('masakerja_bulan', __('MASA KERJA BULAN'));
        $grid->column('objJenisKenaikanGaji.name', __('JENIS KENAIKAN'));
        $grid->column('gaji_pokok', __('GAJI POKOK'));
        return $grid;
    }
    /**
     * Build a form here.
     */
    public function form()
    {
        $form = $this;
        $form->hidden('employee_id', __('Employee id'));
        $form->text('no_sk', __('NO SK'));
        $form->date('tgl_sk', __('TGL SK'))->default(date('Y-m-d'));
        $form->date('tmt_sk', __('TMT SK'))->default(date('Y-m-d'));
        $form->select('pangkat_id', __('PANGKAT'))->options(Pangkat::all()->pluck('name','id'));

       
        $form->number('masakerja_tahun', __('MASA KERJA TAHUN'));
        $form->number('masakerja_bulan', __('MASA KERJA BULAN'));
        $form->select('jenis_kenaikan', __('JENIS KENAIKAN'))->options(JenisKenaikanGaji::all()->pluck('name','id'));
        $form->decimal('gaji_pokok', __('GAJI POKOK'));
        
        $form->divider("Pejabat Penetap");
        $form->belongsTo('pejabat_penetap_id',GridPejabatPenetap::class,'PEJABAT PENETAP');
        $form->text('pejabat_penetap_nama', __('PEJABAT PENETAP NAMA'));
        $form->text('pejabat_penetap_jabatan', __('PEJABAT PENETAP JABATAN'));
        $form->text('pejabat_penetap_nip', __('PEJABAT PENETAP NIP'));

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
    }
    public function onCreateForm()
    {
        $data = [];
        return parent::edit($data);
    }
    public function onRefCreateForm($ref_id)
    {
        $record = RiwayatGaji::findOrFail($ref_id);
        $data = $record->toArray();
        $old_data = $record->toArray();
        request()->session()->flash('old_data', $old_data);
        return $this->edit($data);
    }
}
