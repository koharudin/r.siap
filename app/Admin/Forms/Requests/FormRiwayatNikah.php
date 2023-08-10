<?php

namespace App\Admin\Forms\Requests;

use App\Admin\Forms\Requests\FormRequest;
use App\Admin\Selectable\GridDiklat;
use App\Admin\Selectable\GridPendidikan;
use App\Admin\Selectable\GridUnitKerja;
use App\Http\Traits\FormRiwayatPendidikanTrait;
use App\Models\JenisPekerjaan;
use App\Models\KategoriLayanan;
use App\Models\Pendidikan;
use App\Models\RiwayatDiklatFungsional;
use App\Models\RiwayatDiklatStruktural;
use App\Models\RiwayatDiklatTeknis;
use App\Models\RiwayatDp3;
use App\Models\RiwayatKinerja;
use App\Models\RiwayatKursus;
use App\Models\RiwayatNikah;
use App\Models\RiwayatOrangTua;
use App\Models\RiwayatPendidikan;
use App\Models\RiwayatPengalamanKerja;
use App\Models\RiwayatPensiun;
use App\Models\RiwayatPotensiDiri;
use App\Models\RiwayatRekamMedis;
use App\Models\RiwayatSeminar;
use App\Models\RiwayatUjiKompetensi;
use App\Models\RiwayatUsulan;
use App\Models\StatusMenikah;
use App\Models\UnitKerja;
use Encore\Admin\Form;
use Encore\Admin\Form\Row;
use Encore\Admin\Grid;
use Encore\Admin\Widgets\StepForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormRiwayatNikah extends FF
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = 'Riwayat Nikah';


    public function grid()
    {
        $grid = new Grid(new RiwayatNikah());
        $grid->model()->orderBy('tgl_kawin','asc');
        $grid->column('name', __('NAMA SUAMI/ISTRI'));
        $grid->column('obj_status_menikah.name', __('STATUS PERNIKAHAN'));
        
        $grid->column('urutan_pasangan', __('SUAMI/ISTRI KE'));
        $grid->column('status_tunjangan', __('SEBAGAI AHLI WARIS'))->display(function ($o) {
            if($o==1) return "<span class='label label-info'>Ya</span>";
            else return "-";
        });
        $grid->column('tgl_kawin', __('TGL NIKAH'))->display(function ($o) {
            if ($o) {
                return $this->tgl_kawin->format('d-m-Y');
            }
            return "-";
        });
        $grid->column('tgl_sk_cerai', __('TGL SK CERAI'))->display(function ($o) {
            if ($o) {
                return $this->tgl_sk_cerai->format('d-m-Y');
            }
            return "-";
        });

        $grid->column('obj_jenis_pekerjaan.name', __('JENIS PEKERJAAN'));

        $grid->column('pekerjaan', __('PEKERJAAN'));

        return $grid;
    }
    /**
     * Build a form here.
     */
    public function form()
    {
        $form = $this;
        $form->select('jenis_pekerjaan', __('JENIS PEKERJAAN'))->options(JenisPekerjaan::all()->pluck('name','id'));
        $form->text('nip', __('NIP'));

        $form->text('name', __('NAMA SUAMI/ISTRI'));
        $form->text('birth_place', __('TEMPAT LAHIR'));
        $form->date('birth_date', __('TANGGAL LAHIR'))->default(date('Y-m-d'));
        
        $form->select('status', __('STATUS PERNIKAHAN'))->options(StatusMenikah::all()->pluck('name','id'));
        $form->text('pekerjaan', __('PEKERJAAN'));
        $form->text('tempat_pekerjaan', __('TEMPAT PEKERJAAN'));
        $form->select('status_tunjangan', __('SEBAGAI AHLI WARIS'))->options(['1' => 'Ya',  '0' => 'Tidak']);
        $form->select('sdh_dibayar', __('SUDAH DIBAYAR'))->options(['1' => 'Ya',  '0' => 'Tidak']);
        $form->date('bulan_dibayar', __('BULAN DIBAYAR'))->default(date('Y-m-d'));    
        
        

        $form->divider('KETERANGAN NIKAH');
        $opts = [];
        for($i=1;$i<=20;$i++){
            $opts[]=$i;
        }
        $form->hidden('employee_id', __('Employee id'));
        $form->select('urutan_nikah', __('NIKAH KE'))->options($opts);
        $form->date('tgl_kawin', __('TGL NIKAH'))->default(date('Y-m-d'));
        $form->text('urutan_pasangan', __('SUAMI/ISTRI KE'));
        $form->text('buku_nikah', __('NO BUKU NIKAH'));
        $form->text('no_karis', __('NO KARIS'));
        
        $form->divider('KETERANGAN CERAI');
        $form->text('no_sk_cerai', __('NO SK CERAI'));
        $form->date('tmt_sk_cerai', __('TMT SK CERAI'))->default(date('Y-m-d'));
        $form->date('tgl_sk_cerai', __('TGL SK CERAI'))->default(date('Y-m-d'));

        return $form;
    }
    public function onCreateForm()
    {
        $data = [];
        return parent::edit($data);
    }
    public function onRefCreateForm($ref_id)
    {
        $record = RiwayatNikah::findOrFail($ref_id);
        $data = $record->toArray();
        $old_data = $record->toArray();
        request()->session()->flash('old_data', $old_data);
        return $this->edit($data);
    }
}
