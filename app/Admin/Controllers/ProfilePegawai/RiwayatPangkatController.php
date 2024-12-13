<?php

namespace App\Admin\Controllers\ProfilePegawai;

use Illuminate\Http\UploadedFile;
use App\Admin\Selectable\GridPejabatPenetap;
use App\Admin\Controllers\SiasnController;
use App\Models\DokumenPegawai;
use App\Models\JenisKP;
use App\Models\Pangkat;
use App\Models\PejabatPenetap;
use App\Models\RiwayatPangkat;
use Encore\Admin\Auth\Permission;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class RiwayatPangkatController extends ProfileController
{
    public $activeTab = 'riwayat_pangkat';
    public $klasifikasi_id = 5;
	
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Riwayat Pangkat';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RiwayatPangkat());
		
        $grid->model()->orderBy('tmt_pangkat', 'desc');
        $grid->column('obj_pangkat.kode', __('GOLONGAN'));
		$grid->column('obj_pangkat.name', __('PANGKAT'));
        $grid->column('no_sk', __('NOMOR SK'));
        $grid->column('tgl_sk', __('TANGGAL SK'))->display(function($o) {
            if($o) {
                return $this->tgl_sk->format('d-m-Y');
            }
            return "-";
        });
		$grid->column('tmt_pangkat', __('TMT PANGKAT'))->display(function($o) {
            if($o) {
                return $this->tmt_pangkat->format('d-m-Y');
            }
            return "-";
        });
        $grid->column('obj_jenis_kenaikan_pangkat.name', __('JENIS KP'));
        $grid->column('id_siasn', __('INTG.<br>MYASN'))->display(function($o) {
            if(!empty($this->id_siasn)) {
                $label = 'success';
                $status = '<i class="fa fa-check"></i>';
            } else {
                $label = 'danger';
                $status = '<i class="fa fa-times"></i>';
            }
            return "<span class='label label-$label'>".$status."</span>";
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
        $riwayatPangkat = RiwayatPangkat::findOrFail($id);
        $show = new Show($riwayatPangkat);
        $apiData = SiasnController::get_nip_pangkat($riwayatPangkat->obj_pegawai->nip_baru, $riwayatPangkat->id_siasn);
        $apiData = (array) $apiData;
        // var_dump(session('token_sso'));
        // dd($riwayatPangkat->obj_pegawai->nip_baru);
        // die();

        $show->field(__('GOL./PANGKAT'))->as(function() {
            return (!empty($this->obj_pangkat)) ? $this->obj_pangkat->kode.' - '.$this->obj_pangkat->name : "-";
        });
        $show->field('api_data1', ' ')->unescape()->as(function() use($apiData) {
            $value = (!empty($apiData['golongan'])) ? $apiData['golongan'] : "-";
            return "<span style='color: blue;'>".$value."</span>&nbsp;<span style='font-size: 11px;'>(dari MyASN)</span>";
        });
        $show->divider();
        
        $show->field('no_sk', 'NOMOR SK')->as(function($value) {
            return $value ?? '-';
        });
        $show->field('api_data2', ' ')->unescape()->as(function() use($apiData) {
            $value = (!empty($apiData['skNomor'])) ? $apiData['skNomor'] : "-";
            return "<span style='color: blue;'>".$value."</span>&nbsp;<span style='font-size: 11px;'>(dari MyASN)</span>";
        });
        $show->divider();

        $show->field('tgl_sk', 'TANGGAL SK')->as(function($value) {
            return (!empty($value)) ? $value->format('d-m-Y') : "-";
        });
        $show->field('api_data3', ' ')->unescape()->as(function() use($apiData) {
            $value = (!empty($apiData['skTanggal'])) ? $apiData['skTanggal'] : "-";
            return "<span style='color: blue;'>".$value."</span>&nbsp;<span style='font-size: 11px;'>(dari MyASN)</span>";
        });
        $show->divider();

        $show->field('tmt_pangkat', 'TMT PANGKAT')->as(function($value) {
            return (!empty($value)) ? $value->format('d-m-Y') : "-";
        });
        $show->field('api_data4', ' ')->unescape()->as(function() use($apiData) {
            $value = (!empty($apiData['tmtGolongan'])) ? $apiData['tmtGolongan'] : "-";
            return "<span style='color: blue;'>".$value."</span>&nbsp;<span style='font-size: 11px;'>(dari MyASN)</span>";
        });
        $show->divider();

        $show->field('no_nota', 'NOMOR PERTEK')->as(function($value) {
            return $value ?? '-';
        });
        $show->field('api_data5', ' ')->unescape()->as(function() use($apiData) {
            $value = (!empty($apiData['noPertekBkn'])) ? $apiData['noPertekBkn'] : "-";
            return "<span style='color: blue;'>".$value."</span>&nbsp;<span style='font-size: 11px;'>(dari MyASN)</span>";
        });
        $show->divider();

        $show->field('tgl_nota', 'TANGGAL PERTEK')->as(function($value) {
            return (!empty($value)) ? $value->format('d-m-Y') : "-";
        });
        $show->field('api_data6', ' ')->unescape()->as(function() use($apiData) {
            $value = (!empty($apiData['tglPertekBkn'])) ? $apiData['tglPertekBkn'] : "-";
            return "<span style='color: blue;'>".$value."</span>&nbsp;<span style='font-size: 11px;'>(dari MyASN)</span>";
        });
        $show->divider();

        $show->field('obj_jenis_kenaikan_pangkat.name', 'JENIS KP')->as(function($value) {
            return $value ?? '-';
        });
        $show->field('api_data7', ' ')->unescape()->as(function() use($apiData) {
            $value = (!empty($apiData['jenisKPNama'])) ? $apiData['jenisKPNama'] : "-";
            return "<span style='color: blue;'>".$value."</span>&nbsp;<span style='font-size: 11px;'>(dari MyASN)</span>";
        });
        $show->divider();

        $show->field(__('MASA KERJA'))->as(function() {
            $masaKerjaThn = (!empty($this->masakerja_thn)) ? $this->masakerja_thn : "-";
            $masaKerjaBln = (!empty($this->masakerja_bln)) ? $this->masakerja_bln : "-";
            return $masaKerjaThn.' Tahun '.$masaKerjaBln.' Bulan';
        });
        $show->field('api_data8', ' ')->unescape()->as(function() use($apiData) {
            $value = (!empty($apiData['masaKerjaGolongan'])) ? $apiData['masaKerjaGolongan'] : "-";
            return "<span style='color: blue;'>".$value."</span>&nbsp;<span style='font-size: 11px;'>(dari MyASN)</span>";
        });
        $show->divider();

        $show->field('penetap_nama', 'PENETAP NAMA')->as(function($value) {
            return $value ?? '-';
        });
        $show->field('penetap_jabatan', 'PENETAP JABATAN')->as(function($value) {
            return $value ?? '-';
        });

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new RiwayatPangkat());

        $form->hidden('employee_id', __('Employee ID'));
		$form->select('pangkat_id', __('PANGKAT'))->options(Pangkat::selectRaw("concat(kode, ' - ', name) as nama, id")->pluck('nama', 'id'))->required();        
		$form->text('no_sk', __('NOMOR SK'))->required();
        $form->date('tgl_sk', __('TANGGAL SK'))->required();
        $form->date('tmt_pangkat', __('TMT PANGKAT'))->required();
        $form->text('no_nota', __('NOMOR PERTEK'))->required();
        $form->date('tgl_nota', __('TANGGAL PERTEK'))->required();
        $form->select('jenis_kp', __('JENIS KP'))->options(JenisKP::where('sapk_jenis_kp_id', '!=', null)->pluck('name', 'id'))->required();
		$form->number('masakerja_thn', __('MASA KERJA TAHUN'))->required();
        $form->number('masakerja_bln', __('MASA KERJA BULAN'))->required();
        $form->divider("Pejabat Penetap");
		$form->text('pejabat_penetap_nama', __('PENETAP NAMA'));
		$form->text('pejabat_penetap_jabatan', __('PENETAP JABATAN'));

        return $form;
    }
}
