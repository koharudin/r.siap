<?php

namespace App\Admin\Forms\Pensiun;

use App\Admin\Selectable\GridPejabatPenetap;
use App\Models\Employee;
use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;

class FormAkan2MPP extends Form
{
    protected $employee;

    public function setEmployee(Employee $employee){
        $this->employee = $employee;
    }
    /**
     * The form title.
     *
     * @var string
     */
    public $title = 'AKAN PENSIUN -> MPP';

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
        $employee_id = $request->employee_id;
        $e = Employee::with('obj_riwayat_pensiun')->findOrFail($employee_id);

        $e->obj_riwayat_pensiun->mpp = "v";
        
        $e->obj_riwayat_pensiun->save();
        admin_success("Pegawai [{$e->nip_baru}] ".$e->first_name." berhasil dipindahkan ke MPP");

        return redirect(route('admin.pensiun.akan-pensiun'));
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $this->hidden('employee_id');
        $this->display('nip','NIP');
        $this->display('name','NAMA');
    }

    /**
     * The data of the form.
     *
     * @return array $data
     */
    public function data()
    {
        $riwayat_pensiun = $this->employee->obj_riwayat_pensiun;
        $tmt = $riwayat_pensiun->tgl_pensiun;
        $tmt->addDays(1);
        return [
            'employee_id'=>$this->employee->id,
            'nip'       => $this->employee->nip_baru,
            'name'       => $this->employee->first_name,
        ];
    }
}
