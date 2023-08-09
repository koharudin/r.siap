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
use App\Models\RiwayatUsulan;
use App\Models\StatusJabatan;
use App\Models\TipeJabatan;
use App\Models\UnitKerja;
use Encore\Admin\Form;
use Encore\Admin\Form\Row;
use Encore\Admin\Grid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormRiwayatMutasi extends FF
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = 'Riwayat Mutasi';


    public function grid()
    {
        $grid = new Grid(new RiwayatMutasi());
        $grid->model()->orderBy('tgl_sk','asc');
        $grid->column('satker_lama', __('SATKER LAMA'));
        $grid->column('satker_baru', __('SATKER BARU'));
        $grid->column('no_sk', __('NO SK'));
        $grid->column('tgl_sk', __('TGL SK'))->display(function ($o) {
            if ($o) {
                return $this->tgl_sk->format('d-m-Y');
            }
            return "-";
        });
        $grid->column('tmt_sk', __('TMT SK'))->display(function ($o) {
            if ($o) {
                return $this->tmt_sk->format('d-m-Y');
            }
            return "-";
        });
        $grid->column('pejabat_penetap_jabatan', __('PEJABAT PENETAP'));
        
        return $grid;
    }
    /**
     * Build a form here.
     */
    public function form()
    {
        $form = $this;
        $form->hidden('employee_id', __('Employee id'));
        $form->belongsTo('satker_id_lama',GridUnitKerja::class,'SATKER LAMA');
        $form->text('satker_lama', __('SATKER LAMA'));
        $form->belongsTo('satker_id_baru',GridUnitKerja::class,'SATKER BARU');
        $form->text('satker_baru', __('SATKER BARU'));
        $form->text('no_sk', __('NO SK'));
        $form->date('tgl_sk', __('TGL SK'))->default(date('Y-m-d'));
        $form->date('tmt_sk', __('TMT SK'))->default(date('Y-m-d'));
        $form->belongsTo('pejabat_penetap_id',GridPejabatPenetap::class,'PEJABAT PENETAP');
        $form->text('pejabat_penetap_jabatan', __('JABATAN'));
        $form->text('pejabat_penetap_nip', __('NIP'));
        $form->text('pejabat_penetap_nama', __('NAMA'));
    
        $form->saving(function (Form $form) {
            if($form->pejabat_penetap_id){
                $r =  PejabatPenetap::where('id',$form->pejabat_penetap_id)->get()->first();
                if($r){
                    $form->pejabat_penetap_jabatan = $r->jabatan;
                    $form->pejabat_penetap_nip = $r->nip;
                    $form->pejabat_penetap_nama = $r->nama;
                }
            }
            if($form->satker_id_lama){
                $r =  UnitKerja::where('id',$form->satker_id_lama)->get()->first();
                if($r){
                    $form->satker_lama = $r->name;
                }
            }
            if($form->satker_id_baru){
                $r =  UnitKerja::where('id',$form->satker_id_baru)->get()->first();
                if($r){
                    $form->satker_baru = $r->name;
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
        $record = RiwayatMutasi::findOrFail($ref_id);
        $data = $record->toArray();
        $old_data = $record->toArray();
        request()->session()->flash('old_data', $old_data);
        return $this->edit($data);
    }
}
