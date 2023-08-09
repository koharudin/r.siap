<?php

namespace App\Admin\Forms\Requests;

use App\Admin\Forms\Requests\FormRequest;
use App\Admin\Selectable\GridPendidikan;
use App\Http\Traits\FormRiwayatPendidikanTrait;
use App\Models\KategoriLayanan;
use App\Models\Pendidikan;
use App\Models\RiwayatPendidikan;
use App\Models\RiwayatPensiun;
use App\Models\RiwayatUsulan;
use Encore\Admin\Form as AdminForm;
use Encore\Admin\Form\Row;
use Encore\Admin\Grid;
use Encore\Admin\Widgets\Form;
use Encore\Admin\Widgets\StepForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormRiwayatPendidikan extends FF
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = 'Riwayat Pendidikan';


    public function grid()
    {
        $grid = new Grid(new RiwayatPendidikan());
        $grid->model()->orderBy('tahun', 'asc');
        $grid->column('jurusan', __('JURUSAN'));
        $grid->column('nama_sekolah', __('NAMA SEKOLAH'));
        $grid->column('tempat_sekolah', __('TEMPAT SEKOLAH'));
        $grid->column('tahun', __('TAHUN'));
        return $grid;
    }
    /**
     * Build a form here.
     */
    public function form()
    {
        $form = $this;
        $form->hidden('employee_id', __('Employee id'));
        $form->belongsTo('pendidikan_id', GridPendidikan::class, 'PENDIDIKAN');
        $form->text('jurusan', __('JURUSAN'));
        $form->text('nama_sekolah', __('NAMA SEKOLAH'));
        $form->text('tempat_sekolah', __('TEMPAT SEKOLAH'));
        $form->text('no_sttb', __('NO STTB'));
        $form->date('tgl_sttb', __('TGL STTB'))->default(date('Y-m-d'));
        $form->text('tahun', __('TAHUN'));
        $form->text('akreditasi', __('AKREDITASI'));
        $form->text('ipk', __('IPK'));
        $form->text('kepala_sekolah', __('KEPALA SEKOLAH'));

        $form->saving(function (AdminForm $form) {
            if ($form->pendidikan_id) {
                $r =  Pendidikan::where('id', $form->pendidikan_id)->get()->first();
                if ($r) {
                    $form->jurusan = $r->name;
                }
            }
        });
        return $this;
    }
    public function onCreateForm(){
        $data = [
           
        ];
        return parent::edit($data);
    }
    public function onRefCreateForm($ref_id){
        $record= RiwayatPendidikan::findOrFail($ref_id);
        $data = $record->toArray();
        $old_data = $record->toArray();
        request()->session()->flash('old_data', $old_data);
        return $this->edit($data);
    }
}
