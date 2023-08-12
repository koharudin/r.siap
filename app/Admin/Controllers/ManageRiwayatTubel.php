<?php

namespace App\Admin\Controllers;

use App\Admin\Selectable\GridEmployee;
use App\Admin\Selectable\GridPejabatPenetap;
use App\Models\Employee;
use App\Models\PejabatPenetap;
use App\Models\Presensi\RiwayatTubel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ManageRiwayatTubel extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Riwayat Tubel';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RiwayatTubel());
        
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
        $grid->column('jenis', __('JENIS'));
        $grid->column('tujuan',__('TUJUAN'));
        $grid->column('isian',__('ISIAN'));
        $grid->column('tgl_mulai', __('TGL MULAI'));
        $grid->column('tgl_selesai', __('TGL SELESAI'));
        $grid->column('no_sk', __('NO SK'));
        $grid->column('tgl_sk', __('TGL SK'));
        $grid->column('pejabat_jabatan', __('PEJABAT PENETAP'));
        $grid->tools(function ($tools) {
            $tools->append("<a class='btn btn-sm btn-danger' href='".route('admin.manage_riwayat_tubel.buat_massal')."'><i class='fa fa-cog'></i> &nbsp; Buat Massal</a>");
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
        $show = new Show(RiwayatTubel::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('simpeg_id', __('Simpeg id'));
        $show->field('employee_id', __('Employee id'));
        $show->field('jenis', __('JENIS'));
        $show->field('tujuan',__('TUJUAN'));
        $show->field('isian',__('ISIAN'));
        $show->field('tgl_mulai', __('TGL MULAI'));
        $show->field('tgl_selesai', __('TGL SELESAI'));
        $show->field('no_sk', __('NO SK'));
        $show->field('tgl_sk', __('TGL SK'));
        $show->field('pejabat_id', __('Pejabat id'));
        $show->field('pejabat_jabatan', __('PEJABAT PENETAP'));
        $show->field('pejabat_nip', __('Pejabat nip'));
        $show->field('pejabat_nama', __('Pejabat nama'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new RiwayatTubel());

        if($form->isCreating()){
            $form->select('employee_id', __('PEGAWAI'))->required()->options(function ($id) {
                $user = Employee::find($id);
            
                if ($user) {
                    return [$user->id => $user->first_name."-<b>{$user->nip_baru}</b>"];
                }
            })->ajax('/admin/api/employee');
        }
        else {
            $form->display('employee_id','PEGAWAI')->customFormat(function($o){
                $e  = Employee::findOrFail($o);
                return $e->first_name." - <b>{$e->nip_baru}</b>";
            });
        }
        $form->text('jenis', __('JENIS'));
        $form->text('tujuan',__('TUJUAN'));
        $form->text('isian',__('ISIAN'));
        $form->date('tgl_mulai', __('TGL MULAI'))->default(date('Y-m-d'));
        $form->date('tgl_selesai', __('TGL SELESAI'))->default(date('Y-m-d'));
        $form->text('no_sk', __('NO SK'));
        $form->date('tgl_sk', __('TGL SK'))->default(date('Y-m-d'));
        $form->fieldset('PEJABAT TTD',function($form){
            $form->belongsTo('pejabat_id',GridPejabatPenetap::class, __('PEJABAT'));
            $form->text('pejabat_nama', __('NAMA'));
            $form->text('pejabat_nip', __('NIP'));
            $form->text('pejabat_jabatan', __('JABATAN'));
        });

        $form->saving(function (Form $form) {
            if($form->pejabat_id){
                $r =  PejabatPenetap::where('id',$form->pejabat_id)->get()->first();
                if($r){
                    $form->pejabat_jabatan = $r->jabatan;
                    $form->pejabat_nip = $r->nip;
                    $form->pejabat_nama = $r->nama;
                }
            }
        });

        return $form;
    }
    public function massal(Content $content){
        $form = new Form(new RiwayatTubel());
        $form->setAction(route('admin.manage_riwayat_tubel.buat_massal'));
        $form->select('jenis', __('JENIS '))->options(RiwayatTubel::list_jenis)->required();
        $form->text('tujuan',__('TUJUAN'))->required();
        $form->text('isian',__('ISIAN'));
        $form->date('tgl_mulai', __('TGL MULAI'))->default(date('Y-m-d'))->required();
        $form->date('tgl_selesai', __('TGL SELESAI'))->default(date('Y-m-d'))->required();
        $form->text('no_sk', __('NO SK'));
        $form->date('tgl_sk', __('TGL SK'))->default(date('Y-m-d'));
        $form->fieldset('PEJABAT TTD',function($form){
            $form->belongsTo('pejabat_id',GridPejabatPenetap::class, __('PEJABAT'));
            $form->text('pejabat_nama', __('NAMA'));
            $form->text('pejabat_nip', __('NIP'));
            $form->text('pejabat_jabatan', __('JABATAN'));
        });

        $form->belongsToMany('employees', GridEmployee::class, __('Pegawai yang Tugas Belajar'))->required();
        if(request()->isMethod('POST')){
            $employees = request('employees');
            foreach($employees as $employee){
                $o = new RiwayatTubel();
                
                $o->employee_id = $employee;
                $o->jenis = request("jenis");
                $o->tujuan = request("tujuan");
                $o->isian = request("isian");
                $o->tgl_mulai = request("tgl_mulai");
                $o->tgl_selesai = request("tgl_selesai");
                $o->no_sk = request("no_sk");
                $o->tgl_sk = request("tgl_sk");
                $p  = PejabatPenetap::find(request('pejabat_id'));
                $o->pejabat_id = request("pejabat_id");
                $o->pejabat_nama = $p?$p->nama:null;
                $o->pejabat_nip = $p?$p->nip:null;
                $o->pejabat_jabatan = $p?$p->jabatan:null;

                if($employee){
                    $o->save();
                }
            }
            admin_success('Pesan', 'Data berhasil di proses');
            return redirect(route('admin.manage_riwayat_tubel.index'));
        }
        return $content
            ->title($this->title())
            ->description($this->description['edit'] ?? trans('admin.edit'))
            ->body($form);
    }
}
