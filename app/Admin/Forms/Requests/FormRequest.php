<?php

namespace App\Admin\Forms\Requests;

use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;

class FormRequest extends Form
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = '';

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

        return back();
    }
    public function detail(){
        $f = new Form();
        $f->disableReset();
        $f->disableSubmit();
        $this->oldForm($f);
        return new Box('Old Value',$f);
    }
    public function oldForm(Form $form){

    }
    /**
     * Build a form here.
     */
    public function form()
    {
        $this->text('name')->rules('required');
        $this->email('email')->rules('email');
        $this->datetime('created_at');
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
