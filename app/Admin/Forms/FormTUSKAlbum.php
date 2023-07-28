<?php

namespace App\Admin\Forms;

use App\Admin\Selectable\GridPejabatPenetap;
use App\Models\Employee;
use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;

class FormTUSKAlbum extends Form
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
    public $title = 'TUSK -> ALBUM';

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
        $e->status_pegawai_id = 3;
        $e->save();

        $e->obj_riwayat_pensiun->tgl_bkn = $request->tgl_bkn;
        $e->obj_riwayat_pensiun->no_bkn = $request->no_bkn;
        $e->obj_riwayat_pensiun->save();
        admin_success("Pegawai [{$e->nip_baru}] ".$e->first_name." berhasil dipindahkan ke ALBUM Pensiun");

        return redirect(route('admin.pensiun.tusk'));
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $this->hidden('employee_id');
        $this->date('tgl_pensiun','TANGGAL PENSIUN');
        $this->date('tgl_bkn','TANGGAL BKN');
        $this->text('no_bkn','NO BKN')->required(true);
        $this->display('tmt_pensiun','TMT PENSIUN');
        $this->belongsTo('pejabat_penetap_id', GridPejabatPenetap::class, 'PEJABAT PENETAP');
        $this->text('pejabat_penetap_jabatan', __('JABATAN'));
        $this->text('pejabat_penetap_nip', __('NIP'));
        $this->text('pejabat_penetap_nama', __('NAMA'));
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
            'tgl_pensiun'       => $riwayat_pensiun->tgl_pensiun,
            'tmt_pensiun' =>$tmt->format('d-m-Y'),
            'tgl_bkn'      => $riwayat_pensiun->tgl_bkn,
            'no_bkn' => $riwayat_pensiun->no_bkn,
        ];
    }
}
