<?php

namespace App\Admin\Forms\Requests;

use App\Admin\Forms\Requests\FormRequest;
use App\Models\KategoriLayanan;
use Encore\Admin\Form\Row;
use Encore\Admin\Widgets\Form;
use Encore\Admin\Widgets\StepForm;
use Illuminate\Http\Request;

class FormFoto extends FormRequest
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = 'Foto';

    /**
     * Handle the form request.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request)
    {
       
    }
    public function oldForm(Form $form){
        $form->display("xx");
    }
    /**
     * Build a form here.
     */
    public function form()
    {
        $this->text("first_name","NAMA");
        $this->image("foto","Foto")->disk('minio_foto');     
    }

    
    /**
     * The data of the form.
     *
     * @return array $data
     */
    public function data()
    {
        return [
            'first_name'=>'Andin',
            'kategori_layanan_id'       => null
        ];
    }
    public function oldData(){
        return [
            'first_name' => 'Ayudhia'
        ];
    }
}
