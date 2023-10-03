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
		
        $grid->model()->orderBy('tmt_pangkat', 'asc');
        $grid->column('obj_pegawai.nip_baru', 'NIP')->display(function($value) {
            $this->nip = $value;
            return $value;
        })->hide();
        $grid->column('obj_pangkat.kode', __('GOLONGAN'));
		$grid->column('obj_pangkat.name', __('PANGKAT'));
        $grid->column('no_sk', __('NO SK'));
        $grid->column('tgl_sk', __('TGL SK'))->display(function($o) {
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
        //$grid->column('pejabat_penetap_nip', __('PENETAP NIP'));
        //$grid->column('pejabat_penetap_nama', __('PENETAP NAMA'));
        //$grid->column('pejabat_penetap_jabatan', __('PENETAP JABATAN'));
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
        $show = new Show(RiwayatPangkat::findOrFail($id));
        $apiData = SiasnController::get_nip_pangkat($id);
        $this->apiData = $apiData;
        // var_dump($apiData);
        // die();

        $show->field(__('PANGKAT/GOLONGAN'))->as(function() {
            return (!empty($this->obj_pangkat)) ? $this->obj_pangkat->name.' - '.$this->obj_pangkat->kode : "-";
        });
        $show->field('api_data1', 'data siasn')->unescape()->as(function() use($apiData) {
            $value = "-";
            if(isset($apiData['golongan']) and $apiData['golongan'] != "") {
                $value = $apiData['golongan'];
            }
            return "<span style='color: blue;'>".$value."</span>";
        });
        $show->divider();
        $show->field('no_sk', 'NO SK')->as(function($value) {
            return $value ?? '-';
        });
        $show->field('api_data2', 'data siasn')->unescape()->as(function() use($apiData) {
            $value = "-";
            if(isset($apiData['skNomor']) and $apiData['skNomor'] != "") {
                $value = $apiData['skNomor'];
            }
            return "<span style='color: blue;'>".$value."</span>";
        });
        $show->divider();
        $show->field('tgl_sk', 'TGL SK')->as(function($value) {
            return (!empty($value)) ? $value->format('d-m-Y') : "-";
        });
        $show->field('api_data3', 'data siasn')->unescape()->as(function() use($apiData) {
            $value = "-";
            if(isset($apiData['skTanggal']) and $apiData['skTanggal'] != "") {
                $value = $apiData['skTanggal'];
            }
            return "<span style='color: blue;'>".$value."</span>";
        });
        $show->divider();
        $show->field('tmt_pangkat', 'TMT PANGKAT')->as(function($value) {
            return (!empty($value)) ? $value->format('d-m-Y') : "-";
        });
        $show->field('api_data4', 'data siasn')->unescape()->as(function() use($apiData) {
            $value = "-";
            if(isset($apiData['tmtGolongan']) and $apiData['tmtGolongan'] != "") {
                $value = $apiData['tmtGolongan'];
            }
            return "<span style='color: blue;'>".$value."</span>";
        });
        $show->divider();
        $show->field('no_nota', 'NO PERTEK')->as(function($value) {
            return $value ?? '-';
        });
        $show->field('api_data5', 'data siasn')->unescape()->as(function() use($apiData) {
            $value = "-";
            if(isset($apiData['noPertekBkn']) and $apiData['noPertekBkn'] != "") {
                $value = $apiData['noPertekBkn'];
            }
            return "<span style='color: blue;'>".$value."</span>";
        });
        $show->divider();
        $show->field('tgl_nota', 'TGL PERTEK')->as(function($value) {
            return (!empty($value)) ? $value->format('d-m-Y') : "-";
        });
        $show->field('api_data6', 'data siasn')->unescape()->as(function() use($apiData) {
            $value = "-";
            if(isset($apiData['tglPertekBkn']) and $apiData['tglPertekBkn'] != "") {
                $value = $apiData['tglPertekBkn'];
            }
            return "<span style='color: blue;'>".$value."</span>";
        });
        $show->divider();
        $show->field('kredit', 'ANGKA KREDIT UTAMA')->as(function($value) {
            return $value ?? '-';
        });
        $show->field('api_data7', 'data siasn')->unescape()->as(function() use($apiData) {
            $value = "-";
            if(isset($apiData['jumlahKreditUtama']) and $apiData['jumlahKreditUtama'] != "") {
                $value = $apiData['jumlahKreditUtama'];
            }
            return "<span style='color: blue;'>".$value."</span>";
        });
        $show->divider();
        $show->field('kredit_tambahan', 'ANGKA KREDIT TAMBAHAN')->as(function($value) {
            return $value ?? '-';
        });
        $show->field('api_data8', 'data siasn')->unescape()->as(function() use($apiData) {
            $value = "-";
            if(isset($apiData['jumlahKreditTambahan']) and $apiData['jumlahKreditTambahan'] != "") {
                $value = $apiData['jumlahKreditTambahan'];
            }
            return "<span style='color: blue;'>".$value."</span>";
        });
        $show->divider();
        $show->field('obj_jenis_kenaikan_pangkat.name', 'JENIS KP')->as(function($value) {
            return $value ?? '-';
        });
        $show->field('api_data9', 'data siasn')->unescape()->as(function() use($apiData) {
            $value = "-";
            if(isset($apiData['jenisKPNama']) and $apiData['jenisKPNama'] != "") {
                $value = $apiData['jenisKPNama'];
            }
            return "<span style='color: blue;'>".$value."</span>";
        });
        $show->divider();
        $show->field('masakerja_thn', 'MASA KERJA TAHUN')->as(function($value) {
            return $value ?? '-';
        });
        $show->field('api_data10', 'data siasn')->unescape()->as(function() use($apiData) {
            $value = "-";
            if(isset($apiData['masaKerjaGolonganTahun']) and $apiData['masaKerjaGolonganTahun'] != "") {
                $value = $apiData['masaKerjaGolonganTahun'];
            }
            return "<span style='color: blue;'>".$value."</span>";
        });
        $show->divider();
        $show->field('masakerja_bln', 'MASA KERJA BULAN')->as(function($value) {
            return $value ?? '-';
        });
        $show->field('api_data11', 'data siasn')->unescape()->as(function() use($apiData) {
            $value = "-";
            if(isset($apiData['masaKerjaGolonganBulan']) and $apiData['masaKerjaGolonganBulan'] != "") {
                $value = $apiData['masaKerjaGolonganBulan'];
            }
            return "<span style='color: blue;'>".$value."</span>";
        });
        $show->divider();
        $show->field('tmt_pak', 'TMT PAK')->as(function($value) {
            return (!empty($value)) ? $value->format('d-m-Y') : "-";
        });
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
        //$form->text('stlud', __('STLUD'));
        //$form->text('no_stlud', __('NO STLUD'));
        //$form->date('tgl_stlud', __('TGL STLUD'))->default(date('Y-m-d'));
		$form->select('pangkat_id', __('PANGKAT'))->options(Pangkat::selectRaw("concat(name, ' - ', kode) as nama, id")->pluck('nama', 'id'))->required();        
		$form->text('no_sk', __('NO SK'))->required();
        $form->date('tgl_sk', __('TGL SK'))->default(date('Y-m-d'))->required();
        $form->date('tmt_pangkat', __('TMT PANGKAT'))->default(date('Y-m-d'))->required();
        $form->text('no_nota', __('NO PERTEK'))->required();
        $form->date('tgl_nota', __('TGL PERTEK'))->default(date('Y-m-d'))->required();
        $form->decimal('kredit', __('ANGKA KREDIT UTAMA'))->required();
		$form->decimal('kredit_tambahan', __('ANGKA KREDIT TAMBAHAN'))->required();
		$form->date('tmt_pak', __('TMT PAK'))->default(date('Y-m-d'));
        $form->select('jenis_kp', __('JENIS KP'))->options(JenisKP::where('sapk_jenis_kp_id', '!=', null)->pluck('name', 'id'))->required();
		$form->number('masakerja_thn', __('MASA KERJA TAHUN'))->required();
        $form->number('masakerja_bln', __('MASA KERJA BULAN'))->required();
        //$form->text('keterangan', __('KETERANGAN'));
        //$form->text('jenis_ket', __('JENIS KET'));
        $form->divider("Pejabat Penetap");
        //$form->belongsTo('pejabat_penetap_id', GridPejabatPenetap::class, 'PEJABAT PENETAP');
		$form->text('pejabat_penetap_nama', __('PENETAP NAMA'));
        //$form->text('pejabat_penetap_nip', __('PENETAP NIP'));
		$form->text('pejabat_penetap_jabatan', __('PENETAP JABATAN'));

        /* $_this = $this;
        $form->saving(function(Form $form) use($_this) {
            if($form->pejabat_penetap_id) {
                $r = PejabatPenetap::where('id', $form->pejabat_penetap_id)->get()->first();
                if($r) {
                    $form->pejabat_penetap_jabatan = $r->jabatan;
                    $form->pejabat_penetap_nip = $r->nip;
                    $form->pejabat_penetap_nama = $r->nama;
                }
            }
        }); */

        return $form;
    }
}
