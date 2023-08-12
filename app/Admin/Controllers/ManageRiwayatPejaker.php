<?php

namespace App\Admin\Controllers;

use App\Admin\Selectable\GridEmployee;
use App\Models\Employee;
use App\Models\Presensi\RiwayatPejaker;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ManageRiwayatPejaker extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Riwayat Pejaker';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RiwayatPejaker());

        $grid->model()->load(['obj_employee']);
        $grid->model()->orderTanggal();
        $grid->filter(function($filter) use($grid){
            $filter->expand();
            $filter->disableIdFilter();
            $filter->where(function ($query) {
                $query->whereHas('obj_employee', function ($query) {
                    $query->where('first_name', 'ilike', "%{$this->input}%")->orWhere('nip_baru', 'ilike', "%{$this->input}%");
                });
            
            }, 'Nama/NIP Pegawai');
        });
        $grid->column('obj_employee.first_name', __('PEGAWAI'))->display(function($o){
            if($this->obj_employee){
                return $this->obj_employee->first_name." <br> ".$this->obj_employee->nip_baru;
            }
            else return "<b>-Tidak ditemukan pegawai-</b>";
        });
        $grid->column('tgl_pejaker', __('TGL PEJAKER'));
        $grid->column('jam_masuk', __('JAM MASUK'));
        $grid->column('jam_keluar', __('JAM KELUAR'));
        $grid->tools(function ($tools) {
            $tools->append("<a class='btn btn-sm btn-danger' href='".route('admin.manage_riwayat_pejaker.buat_massal')."'><i class='fa fa-cog'></i> &nbsp; Buat Massal</a>");
        });
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(RiwayatPejaker::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('simpeg_id', __('Simpeg id'));
        $show->field('employee_id', __('Employee id'));
        $show->field('jam_masuk', __('JAM MASUK'));
        $show->field('jam_keluar', __('JAM KELUAR'));
        $show->field('no_sk', __('NO SK'));
        $show->field('tgl_sk', __('TGL SK'));
        $show->field('tgl_pejaker', __('TGL PEJAKER'));
        $show->field('alasan', __('ALASAN'));
        $show->field('keterangan', __('KETERANGAN'));
        $show->field('jenis', __('JENIS'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new RiwayatPejaker());

        $form->select('employee_id', __('PEGAWAI'))->required()->options(function ($id) {
            $user = Employee::find($id);
        
            if ($user) {
                return [$user->id => $user->first_name."-<b>{$user->nip_baru}</b>"];
            }
        })->ajax('/admin/api/employee');
        $form->date('tgl_pejaker', __('TGL PEJAKER'))->default(date('Y-m-d'));
        $form->select('alasan', __('ALASAN'))->options(RiwayatPejaker::list_alasan)->when("=","1",function($form){
            $form->time('jam_masuk', __('JAM MASUK'))->default(date('H:i:s'))->required();    
        })->when("=","2",function($form){
            $form->time('jam_keluar', __('JAM KELUAR'))->default(date('H:i:s'))->required();   
        })->when("=","3",function($form){
            $form->time('jam_masuk', __('JAM MASUK'))->default(date('H:i:s'))->required();
            $form->time('jam_keluar', __('JAM KELUAR'))->default(date('H:i:s'))->required(); 
        });
       
        $form->text('no_sk', __('NO SK'));
        $form->date('tgl_sk', __('TGL SK'))->default(date('Y-m-d'))->required();
        
       
        $form->text('keterangan', __('KETERANGAN'));
        $form->select('jenis', __('JENIS'))->options(RiwayatPejaker::list_jenis);

        return $form;
    }

    public function massal(Content $content){
        $form = new Form(new RiwayatPejaker());
        $form->setAction(route('admin.manage_riwayat_pejaker.buat_massal'));
        $form->date('tgl_pejaker', __('TGL PEJAKER'))->default(date('Y-m-d'));
        $form->select('alasan', __('ALASAN'))->options(RiwayatPejaker::list_alasan)->when("=","1",function($form){
            $form->time('jam_masuk', __('JAM MASUK'))->default(date('H:i:s'))->required();    
        })->when("=","2",function($form){
            $form->time('jam_keluar', __('JAM KELUAR'))->default(date('H:i:s'))->required();   
        })->when("=","3",function($form){
            $form->time('jam_masuk', __('JAM MASUK'))->default(date('H:i:s'))->required();
            $form->time('jam_keluar', __('JAM KELUAR'))->default(date('H:i:s'))->required(); 
        });
       
        $form->text('no_sk', __('NO SK'));
        $form->date('tgl_sk', __('TGL SK'))->default(date('Y-m-d'))->required();
        
       
        $form->text('keterangan', __('KETERANGAN'));
        $form->select('jenis', __('JENIS'))->options(RiwayatPejaker::list_jenis);

        $form->belongsToMany('employees', GridEmployee::class, __('Pegawai yang Penyesuian Jam Kerja'))->required();
        if(request()->isMethod('POST')){
            $employees = request('employees');
            foreach($employees as $employee){
                $record = new RiwayatPejaker();
                
                $record->employee_id = $employee;
                $record->jam_masuk = request('jam_masuk');
                $record->jam_keluar = request('jam_keluar');
                $record->no_sk = request('no_sk');
                $record->tgl_sk = request('tgl_sk');
                $record->tgl_pejaker = request('tgl_pejaker');
                $record->alasan = request('alasan');
                $record->keterangan = request('keterangan');
                $record->jenis  = request('jenis');

                if($employee){
                    $record->save();
                }
            }
            admin_success('Pesan', 'Data berhasil di proses');
            return redirect(route('admin.manage_riwayat_pejaker.index'));
        }
        return $content
            ->title($this->title())
            ->description($this->description['edit'] ?? trans('admin.edit'))
            ->body($form);
    }
}
