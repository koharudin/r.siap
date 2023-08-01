<?php

namespace App\Admin\Forms\Requests;

use App\Models\KategoriLayanan;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;

class FormDetailRequest extends Form
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = 'Kategori Layanan';

    /**
     * Handle the form request.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request)
    {
        //dump($request->all());

        admin_success('Processed successfully.');

        return next($request->all());
    }
  
    /**
     * Build a form here.
     */
    public function form()
    {
        $this->select('kategori_layanan_id','Kategori Layanan')->options(KategoriLayanan::orderBy('order','asc')->get()->pluck('name','id'));
    }

    /**
     * The data of the form.
     *
     * @return array $data
     */
    public function data()
    {
        return [
            'name'       => 'John Doe',
            'email'      => 'John.Doe@gmail.com',
            'created_at' => now(),
        ];
    }
    public function oldData(){

    }
    public function render()
    {
        $this->prepareForm();

        $this->prepareHandle();
        
        $vars = $this->getVariables();
        $vars['oldData'] = $this->oldData();
        $form = view('admin::widgets.form_request', $vars)->render();

        if (!($title = $this->title()) || !$this->inbox) {
            return $form;
        }

        return (new Box($title, $form))->render();
    }
}
