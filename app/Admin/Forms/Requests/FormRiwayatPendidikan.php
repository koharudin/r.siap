<?php

namespace App\Admin\Forms\Requests;

use App\Admin\Forms\Requests\FormRequest;
use App\Admin\Selectable\GridPendidikan;
use App\Http\Traits\FormRiwayatPendidikanTrait;
use App\Models\KategoriLayanan;
use App\Models\RiwayatPendidikan;
use App\Models\RiwayatPensiun;
use App\Models\RiwayatUsulan;
use Encore\Admin\Form\Row;
use Encore\Admin\Grid;
use Encore\Admin\Widgets\Form;
use Encore\Admin\Widgets\StepForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormRiwayatPendidikan extends FormRequest
{
    use FormRiwayatPendidikanTrait;
    /**
     * The form title.
     *
     * @var string
     */
    public $title = 'Riwayat Pendidikan';


    public function grid()
    {
        $grid = new Grid(new RiwayatPendidikan());
        $grid->model()->orderBy('tahun', 'asc');
        $grid->model()->where('employee_id', $this->getProfileId());
        $grid->column('jurusan', __('JURUSAN'));
        $grid->column('nama_sekolah', __('NAMA SEKOLAH'));
        $grid->column('tempat_sekolah', __('TEMPAT SEKOLAH'));
        $grid->column('tahun', __('TAHUN'));
        return $grid;
    }
    public function oldForm(Form $form)
    {
        $form->display("xx");
    }
    /**
     * Build a form here.
     */
    public function buildForm()
    {
        $this->attachForm($this);
        $this->disableSubmit();
        $this->disableReset();
    }

    public function refData()
    {
        $record = RiwayatPendidikan::find($this->getRecordRefId());
        return $record->toArray();
    }
   
    public function oldData()
    {
        if ($this->record_id) {
            $record = RiwayatUsulan::findOrFail($this->getRecordId());
            return json_decode($record->old_data,true);
        }
        if ($this->record_ref_id) {
            return $this->refData();
        }
    }

    public function onTerima(RiwayatUsulan $usulan){
        $data = json_decode($usulan->new_data,true);
        if($usulan->ref_id){
            $record = RiwayatPendidikan::find($usulan->ref_id);
            if($usulan->action ==2){
                foreach($record->toArray() as $key=>$val){
                    if(array_key_exists($key,$data)){
                        $record->{$key} = $data[$key];
                    }
                }
                $record->save();
            }
            if($usulan->action ==1){
                $record = new RiwayatPendidikan();
                $record->employee_id = $usulan->employee_id;
                foreach($record->toArray() as $key=>$val){
                    if(array_key_exists($key,$data)){
                        $record->{$key} = $data[$key];
                    }
                }
                $record->save();
            }
            if($usulan->action ==1){
                $record = RiwayatPendidikan::find($usulan->ref_id);
                $record->delete();
            }
        }

    }
}
