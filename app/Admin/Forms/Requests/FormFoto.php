<?php

namespace App\Admin\Forms\Requests;

use App\Models\Employee;
use App\Models\RiwayatUsulan;
use Encore\Admin\Form;
use Encore\Admin\Form\Field;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FormFoto extends FF
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = 'Foto Pegawai';


    public function form(){
        $this->text('first_name');
        $this->image('foto')->disk('minio_foto');
        return $this;
    }
    public function onCreateForm(){
        $record= Employee::findOrFail($this->employee_id);
        $data = [
            'foto'=>$record->foto,
            'first_name'=>$record->first_name
        ];
        request()->session()->flash('old_data', $data);
        return parent::edit($data);
    }
    
}
