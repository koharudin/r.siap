<?php

namespace App\Admin\Controllers\ProfilePegawai;

use App\Admin\Selectable\GridUnitKerja;
use App\Models\Agama;
use App\Models\DokumenPegawai;
use App\Models\Employee;
use App\Models\GolonganDarah;
use App\Models\JenisKelamin;
use App\Models\RiwayatPangkat;
use App\Models\StatusPegawai;
use App\Models\StatusPernikahan;
use Carbon\Carbon;
use Encore\Admin\Auth\Permission;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Form;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\URL;
use MBence\OpenTBSBundle\Services\OpenTBS;

class DataPersonalController extends  ProfileController
{

    public $title = 'Data Personal';

    public function detail($id)
    {
        return Admin::content(function (Content $content) {
            $this->index($content);
        });
    }
    public function form()
    {
        $form = new Form(new Employee());
        $profile_id = $this->getProfileId();
        $form->tools(function ($tools) use ($profile_id) {
            $tools->add('<a href="' . route('admin.cetak-drh-singkat', ['profile_id' => $profile_id]) . '" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-download"></i>&nbsp;&nbsp;Cetak DRH Singkat</a>');
            $tools->add('<a href="' . route('admin.cetak-drh-lengkap', ['profile_id' => $profile_id]) . '" target="_blank" class="btn btn-sm btn-danger"><i class="fa fa-download"></i>&nbsp;&nbsp;Cetak DRH Lengkap</a>');
        });
        $form->column(1 / 2, function ($form) {
            //$form->fill($this->data());
            $form->hidden('id', 'ID');
            $form->image('foto', 'FOTO')->disk("minio_foto")->name(function ($file) {
                return $this->data['nip_baru'] . "_" . md5(uniqid()) . "." . $file->guessExtension();
            })->hidePreview();
            // Add an input box of type text
            $form->text('first_name', 'NAMA');

            //$form->display("obj_agama.name", "AGAMA");
            $form->text('nip_baru', 'NIP');
            $form->date('tgl_pensiun', 'TANGGAL PENSIUN');
            $form->text('gelar_depan', 'GELAR DEPAN');
            $form->text('gelar_belakang', 'GELAR BELAKANG');
            $form->text('birth_place', 'TEMPAT LAHIR');
            $form->date('birth_date', 'TANGGAL LAHIR');
            $form->belongsTo('unit_id', GridUnitKerja::class, 'UNIT KERJA');
        });
        $form->column(1 / 2, function ($form) {
            $form->select('agama_id', 'AGAMA')->options(Agama::all()->pluck('name', 'id'));
            $form->select('sex', 'JENIS KELAMIN')->options(JenisKelamin::all()->pluck("name", "id"));
            $form->select('status_pegawai_id', 'TIPE PEGAWAI')->options(StatusPegawai::all()->pluck('name', 'id'));
            $form->select('status_kawin', 'STATUS PERNIKAHAN')->options(StatusPernikahan::all()->pluck('name', 'id'));
            $form->select('golongan_darah', 'GOLONGAN DARAH')->options(GolonganDarah::all()->pluck('id', 'id'));
            $form->textarea('alamat', 'ALAMAT');
            $form->text('no_hp', 'HANDPHONE');
            $form->text('email', 'EMAIL');
            $form->text('email_kantor', 'EMAIL DINAS');
            $form->text('karpeg', 'NO. KARPEG');
            $form->text('taspen', 'TASPEN');
            $form->text('npwp', 'NPWP');
            $form->text('askes', 'ASKES');
            $form->text('nik', 'NIK');
            $form->text('pin_absen', 'PIN ABSEN');
            $form->image('dokumen_ktp', 'KTP')->disk("minio_dokumen")->name(function ($file) {
                return $this->data['nip_baru'] . "_" . md5(uniqid()) . "." . $file->guessExtension();
            })->hidePreview()->downloadable();
        });

        $form->submitted(function (Form $form) {
            $form->ignore('dokumen_ktp');
        });
        $form->saved(function (Form $form) {
            $file = request()->file('dokumen_ktp');
            if ($file) {
                $d = $form->fields()->first(function ($f) {
                    return ($f->column() == 'dokumen_ktp');
                });
                $newFileName = $d->prepare($file);
                $keys = explode("#", $form->model()->simpeg_id);
                $arr = [
                    'id' => $form->model()->id,
                    'klasifikasi_id' => 1
                ];
                DataPersonalController::saveDokumenUpload($file->getClientOriginalName(), $newFileName, $arr);
            }
        });
        $form->tools(function ($tools) {
            $tools->disableList();
            $tools->disableView();
            $tools->disableDelete();
        });
        if (!Admin::user()->can('save-data_personal')) {
            $form->disableSubmit();
        }
        //
        //$form->disableReset();
        $form->saved(function (Form $form) {
            return back();
        });
        $r = Employee::with(['obj_agama'])->where('id', $this->getProfileId())->get()->first();
        if ($r) {
            $form  =  $form->edit($r->id);
            $data = $form->model()->toArray();
            $dok = DokumenPegawai::where('klasifikasi_id', 1)->where('ref_id', $this->getProfileId())->get()->first();
            if ($dok) {
                $data = array_merge($data, ['dokumen_ktp' => $dok->file]);
            }
            $form->fields()->each(function ($field) use ($data) {
                $field->fill($data);
            });
            $form->setAction('data_personal/' . $r->id);
            $form->setTitle(' ');
        } else {
            $form->setAction('data_personal');
        }
        return $form;
    }
    public function cetak_drh_singkat()
    {
        $e = $this->getEmployee();
        $arr_e = $e->toArray();
        $arr_e['t_nama_gelar'] = $e->nama_gelar;
        $arr_e['t_ttd'] = $e->ttd;
        $arr_e['t_sex'] = $e->t_sex;
        $arr_e['t_statuskawin'] = $e->t_statuskawin;
        $arr_e['t_agama'] = $e->t_agama;
        $arr_e['t_tipe_pegawai'] = $e->t_tipe_pegawai;

        $e->load('obj_riwayat_pangkat');
        $e_pkt = $e->obj_riwayat_pangkat->last();
        $pkt_arr = $e_pkt->toArray();
        $pkt_arr['t_tmt_pangkat'] = $e_pkt->t_tmt_pangkat;
        $pkt_arr['t_pangkat_golongan'] = $e_pkt->t_pangkat_golongan;
        $pkt_arr['t_masa_kerja'] = $e_pkt->t_masa_kerja;

        $e->load('obj_riwayat_jabatan');
        $e_jab = $e->obj_riwayat_jabatan->last();
        $jab_arr = $e_jab->toArray();
        $jab_arr['t_jenis_jabatan'] = $e_jab->t_tipe_jabatan;
        $jab_arr['t_tmt_jabatan'] = $e_jab->t_tmt_jabatan;

        $e->load('obj_riwayat_pendidikan');
        $e_pend = $e->obj_riwayat_pendidikan->last();
        $pend_arr = $e_pend->toArray();
        $pend_arr['tingkat_pendidikan'] = $e_pend->t_pendidikan;


        $TBS = new OpenTBS();
        \Carbon\Carbon::setLocale('id');
        // load your template
        $file = base_path() . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'drh_singkat.docx';
        $TBS->LoadTemplate($file);
        $TBS->MergeField('e', $arr_e);
        $TBS->MergeField('pkt', $pkt_arr);
        $TBS->MergeField('jab', $jab_arr);
        $TBS->MergeField('pend', $pend_arr);
        $now = Carbon::now();
        $today = $now->isoFormat('dddd, D MMMM Y');
        $today_ymd = $now->isoFormat('YMMDD');
        $TBS->MergeField('o', array('date' => $today));
        // send the file
        //$TBS->Show(OPENTBS_FILE, 'drh2.docx');
        $TBS->Show(OPENTBS_DOWNLOAD, "drhsingkat_{$e->nip_baru}_{$today_ymd}.docx");
    }
    public function cetak_drh_lengkap()
    {
        $e = $this->getEmployee();
        $arr_e = $e->toArray();
        $arr_e['t_nama_gelar'] = $e->nama_gelar;
        $arr_e['t_ttd'] = $e->ttd;
        $arr_e['t_sex'] = $e->t_sex;
        $arr_e['t_statuskawin'] = $e->t_statuskawin;
        $arr_e['t_agama'] = $e->t_agama;
        $arr_e['t_tipe_pegawai'] = $e->t_tipe_pegawai;
        $e->load('obj_riwayat_jabatan');
        $jabatan =  $e->obj_riwayat_jabatan->last();
        $arr_e['jabatan'] = $jabatan ? $jabatan->nama_jabatan : '-';
        $e->load('obj_satker');
        $arr_e['t_unit_kerja'] = $e->obj_satker->name;
        $e->load('obj_riwayat_pangkat');
        $pkt_cpns = $e->obj_riwayat_pangkat->filter(function ($o) {
            return $o->is_cpns_pns == RiwayatPangkat::SK_CPNS;
        });
        $pkt_cpns = $pkt_cpns->first();
        $arr_e['t_tmt_cpns'] = $pkt_cpns ? $pkt_cpns->tmt_pangkat->format('d-m-Y') : '-';
        $pkt_pns = $e->obj_riwayat_pangkat->filter(function ($o) {
            return $o->is_cpns_pns == RiwayatPangkat::SK_PNS;
        });
        $pkt_pns = $pkt_pns->first();
        $arr_e['t_tmt_pns'] = $pkt_pns ? $pkt_pns->tmt_pangkat->format('d-m-Y') : '-';
        $arr_e['t_masa_kerja'] = '';

        $TBS = new OpenTBS();
        \Carbon\Carbon::setLocale('id');
        // load your template
        $file = base_path() . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'drh_lengkap.docx';
        $TBS->LoadTemplate($file);
        $TBS->MergeField('e', $arr_e);
        $now = Carbon::now();
        $today = $now->isoFormat('dddd, D MMMM Y');
        $today_ymd = $now->isoFormat('YMMDD');
        $TBS->MergeField('o', array('date' => $today));
        $e->load('obj_riwayat_pendidikan');
        //dd($e->obj_riwayat_pendidikan);
        $TBS->MergeBlock('rp', $e->obj_riwayat_pendidikan);

        $e->load('obj_riwayat_pangkat');
        $pkt_arr = [];
        $e->obj_riwayat_pangkat->each(function ($t) use (&$pkt_arr) {
            $r_arr = $t->toArray();
            $r_arr['t_tmt'] = $t->t_tmt_pangkat;
            $r_arr['t_pangkat_golongan_ruang'] = $t->t_pangkat_golongan;
            $r_arr['t_jeniskp'] = $t->t_jeniskp;
            $pkt_arr[] = $r_arr;
        });
        $TBS->MergeBlock('pkt', $pkt_arr);

        $e->load('obj_riwayat_prestasi_kerja');
        $kin_arr = [];
        $e->obj_riwayat_prestasi_kerja->each(function ($t) use (&$kin_arr) {
            $r_arr = $t->toArray();
            $r_arr['t_tmt'] = $t->t_tmt_pangkat;
            $r_arr['t_pangkat_golongan_ruang'] = $t->t_pangkat_golongan;
            $r_arr['t_jeniskp'] = $t->t_jeniskp;
            $kin_arr[] = $r_arr;
        });
        $TBS->MergeBlock('kin', $kin_arr);


        $e->load('obj_riwayat_uji_kompetensi');
        $uk_arr = [];
        $e->obj_riwayat_uji_kompetensi->each(function ($t) use (&$uk_arr) {
            $r_arr = $t->toArray();
            $r_arr['tahun'] = $t->t_tahun;
            $uk_arr[] = $r_arr;
        });
        $TBS->MergeBlock('uk', $uk_arr);


        $e->load('obj_riwayat_jabatan');
        $jab_arr = [];
        $e->obj_riwayat_jabatan->each(function ($t) use (&$jab_arr) {
            $r_arr = $t->toArray();
            $r_arr['t_tmt'] = $t->t_tmt_jabatan;
            $r_arr['t_unit'] = $t->unit_text;
            $r_arr['t_jeniskp'] = $t->t_jeniskp;
            $jab_arr[] = $r_arr;
        });
        $TBS->MergeBlock('jab', $jab_arr);

        $e->load('obj_riwayat_mutasi');
        $mut_arr = [];
        $e->obj_riwayat_mutasi->each(function ($t) use (&$mut_arr) {
            $r_arr = $t->toArray();
            $r_arr['t_tgl_sk'] = $t->t_tgl_sk;
            $mut_arr[] = $r_arr;
        });
        $TBS->MergeBlock('mut', $mut_arr);

        $e->load('obj_riwayat_penghargaan');
        $aw_arr = [];
        $e->obj_riwayat_penghargaan->each(function ($t) use (&$aw_arr) {
            $r_arr = $t->toArray();
            $r_arr['name'] = $t->nama_penghargaan;
            $r_arr['pejabat_penetap'] = $t->pejabat_penetap_jabatan;
            $aw_arr[] = $r_arr;
        });
        $TBS->MergeBlock('aw', $aw_arr);

        $e->load('obj_riwayat_hukuman');
        $huk_arr = [];
        $e->obj_riwayat_hukuman->each(function ($t) use (&$huk_arr) {
            $r_arr = $t->toArray();
            $r_arr['name'] = $t->obj_hukuman->name;
            $r_arr['t_tmt_sk'] = $t->t_tmt_sk;
            $huk_arr[] = $r_arr;
        });
        $TBS->MergeBlock('huk', $huk_arr);

        $e->load('obj_riwayat_diklat_struktural');
        $dstruk_arr = [];
        $e->obj_riwayat_diklat_struktural->each(function ($t) use (&$dstruk_arr) {
            $r_arr = $t->toArray();
            $r_arr['name'] = $t->nama_diklat;
            $r_arr['jp'] = $t->jumlah_jam;
            $dstruk_arr[] = $r_arr;
        });
        $TBS->MergeBlock('ko1', $dstruk_arr);

        $e->load('obj_riwayat_diklat_fungsional');
        $dfung_arr = [];
        $e->obj_riwayat_diklat_fungsional->each(function ($t) use (&$dfung_arr) {
            $r_arr = $t->toArray();
            $r_arr['name'] = $t->nama_diklat;
            $r_arr['jp'] = $t->jumlah_jam;
            $dfung_arr[] = $r_arr;
        });

        $TBS->MergeBlock('ko2', $dfung_arr);

        $e->load('obj_riwayat_diklat_teknis');
        $dfung_arr = [];
        $e->obj_riwayat_diklat_teknis->each(function ($t) use (&$dfung_arr) {
            $r_arr = $t->toArray();
            $r_arr['name'] = $t->nama_diklat;
            $r_arr['jp'] = $t->jumlah_jam;
            $dfung_arr[] = $r_arr;
        });
        $TBS->MergeBlock('ko3', $dfung_arr);

        $e->load('obj_riwayat_seminar');
        $d_arr = [];
        $e->obj_riwayat_seminar->each(function ($t) use (&$d_arr) {
            $r_arr = $t->toArray();
            $r_arr['tahun'] = $t->t_tahun;
            $d_arr[] = $r_arr;
        });
        $TBS->MergeBlock('ko4', $d_arr);


        $e->load('obj_riwayat_kursus');
        $d_arr = [];
        $e->obj_riwayat_kursus->each(function ($t) use (&$d_arr) {
            $r_arr = $t->toArray();
            $d_arr[] = $r_arr;
        });
        $TBS->MergeBlock('ko5', $d_arr);

        // send the file
        //$TBS->Show(OPENTBS_FILE, 'drh2.docx');
        $TBS->Show(OPENTBS_DOWNLOAD, "drhlengkap_{$e->nip_baru}_{$today_ymd}.docx");
    }
}
