<?php

namespace App\Admin\Forms\Requests;

use App\Admin\Forms\Requests\FormRequest;
use App\Admin\Selectable\GridDiklat;
use App\Admin\Selectable\GridPejabatPenetap;
use App\Admin\Selectable\GridPendidikan;
use App\Admin\Selectable\GridPenghargaan;
use App\Http\Traits\FormRiwayatPendidikanTrait;
use App\Models\KategoriLayanan;
use App\Models\Pendidikan;
use App\Models\RiwayatDiklatFungsional;
use App\Models\RiwayatDiklatStruktural;
use App\Models\RiwayatDiklatTeknis;
use App\Models\RiwayatDp3;
use App\Models\RiwayatKursus;
use App\Models\RiwayatPendidikan;
use App\Models\RiwayatPenghargaan;
use App\Models\RiwayatPensiun;
use App\Models\RiwayatSeminar;
use App\Models\RiwayatUjiKompetensi;
use App\Models\RiwayatUsulan;
use Encore\Admin\Form;
use Encore\Admin\Form\Row;
use Encore\Admin\Grid;
use Encore\Admin\Widgets\StepForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormRiwayatPenghargaan extends FF
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = 'Riwayat Penghargaan';


    public function grid()
    {
        $grid = new Grid(new RiwayatPenghargaan());
        $grid->model()->orderBy('tgl_sk', 'asc');
        $grid->column('nama_penghargaan', __('NAMA PENGHARGAAN'));
        $grid->column('no_sk', __('NO SK'));
        $grid->column('tgl_sk', __('TGL SK'))->display(function ($o) {
            if ($o) {
                return $this->tgl_sk->format('d-m-Y');
            }
            return "-";
        });
        $grid->column('pejabat_penetap', __('PEJABAT PENETAP'));
        $grid->column('tahun', __('TAHUN'));
        $grid->column('jenis_penghargaan', __('JENIS PENGHARGAAN'));

        return $grid;
    }
    /**
     * Build a form here.
     */
    public function buildForm()
    {
        $form = $this;
        $form->belongsTo('jenis_penghargaan_id', GridPenghargaan::class, __('JENIS PENGHARGAAN'));
        $form->hidden('employee_id', __('Employee id'));
        $form->text('no_sk', __('NO SK'));
        $form->date('tgl_sk', __('TGL SK'))->default(date('Y-m-d'));
        $form->number('tahun', __('TAHUN'));
        $form->belongsTo('pejabat_penetap_id', GridPejabatPenetap::class, 'PEJABAT PENETAP');
        $form->text('pejabat_penetap_jabatan', __('JABATAN'));
        $form->text('pejabat_penetap_nip', __('NIP'));
        $form->text('pejabat_penetap_nama', __('NAMA'));

        $form->saving(function (Form $form) {
            if ($form->pejabat_penetap_id) {
                $r =  PejabatPenetap::where('id', $form->pejabat_penetap_id)->get()->first();
                if ($r) {
                    $form->pejabat_penetap_jabatan = $r->jabatan;
                    $form->pejabat_penetap_nip = $r->nip;
                    $form->pejabat_penetap_nama = $r->nama;
                }
            }
        });

        return $form;
    }
    public function onCreateForm()
    {
        $data = [];
        return parent::edit($data);
    }
    public function onRefCreateForm($ref_id)
    {
        $record = RiwayatPenghargaan::findOrFail($ref_id);
        $data = $record->toArray();
        $old_data = $record->toArray();
        request()->session()->flash('old_data', $old_data);
        return $this->edit($data);
    }
}
