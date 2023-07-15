<?php

namespace App\Admin\Forms;

use App\Models\Agama;
use App\Models\Employee;
use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;

class Settings extends Form
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
    public $title = 'Settings';

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

        admin_success('Processed Settings successfully.');
        admin_toastr('Message Settings...', 'success');
        return back();
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $this->display('agama_id','AGAMA');
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
        $data =  $this->employee->toArray();
        if(@$data['agama_id']){
            $agama = Agama::findOrFail($data['agama_id']);
            $data['agama_id'] = $agama['name'];
        }
        return $data;
        return [
            'name'       => 'John Doe',
            'email'      => 'John.Doe@gmail.com',
            'created_at' => now(),
        ];
    }
}
