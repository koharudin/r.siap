<?php

namespace App\Admin\Forms\Requests;

use App\Admin\Forms\Requests\FormRequest;
use App\Models\Employee;
use App\Models\KategoriLayanan;
use App\Models\RiwayatUsulan;
use Encore\Admin\Form\Row;
use Encore\Admin\Widgets\Form;
use Encore\Admin\Widgets\StepForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FormFoto extends FormRequest
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = 'Foto';

    /**
     * Build a form here.
     */
    public function form()
    {
        $this->image("foto","Foto")->disk('minio_request');     
        $this->disableReset();
        $this->disableSubmit();
    }

    public function data(){
        return parent::data();
    }
    public function refData()
    {
        $record = Employee::find($this->getRecordRefId());
        return $record->toArray();
    }
    public function oldData(){
        if ($this->record_id) {
            $record = RiwayatUsulan::findOrFail($this->getRecordId());
            return json_decode($record->old_data,true);
        }
        if ($this->record_ref_id) {
            $data = $this->refData(); 
            $data['foto'] = Storage::disk('minio_foto')->url($data['foto']);
            return $data;
        }
    }
}
