<?php

namespace App\Admin\Forms;

use App\Models\Employee;
use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;

class Config extends Form
{
    protected $employee;
    public function setEmployee(Employee $employee_){
        $this->employee = $employee_;
    }
    /**
     * The form title.
     *
     * @var string
     */
    public $title = 'Config';

    /**
     * Handle the form request.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request)
    {
        admin_toastr('Message Config...', 'warning');
        //dump($request->all());

        admin_success('Processed Config successfully.');

        return back();
    }

    /**
     * Build a form here.
     */
    public function form()
    {
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
}
