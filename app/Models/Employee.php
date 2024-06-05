<?php

namespace App\Models;

use Carbon\Carbon;
use \Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;
use Exception;

class Employee extends Model
{
    use HasFactory;
    public $table = 'employee';
    public $primaryKey = 'id';
    public $timestamps = true;

    public const STATUS_PENSIUN = 3;

    public function showPhoto()
    {
        if ($this->foto && !($this->foto == '' || $this->foto == ' ' || $this->foto == '  ')) {
            return route('admin.download.foto', ['f' => base64_encode($this->foto)]);
        }
        return null;
    }
    public function scopeAktif($query)
    {
        $query->whereIn('status_pegawai_id', [0, 1, 2]);
    }
    public function scopePensiun($query)
    {
        $query->whereIn('status_pegawai_id', [3]);
    }
    public function getBup()
    {
        $last = $this->obj_riwayat_jabatan->last();
		if(!$last){
			throw new Exception ("Tidak ditemukan jabatan terkahir ".$this->nip_baru);
		}
        if ($last->tipe_jabatan_id == 1 || $last->tipe_jabatan_id == 6) {
            $obj = $last->obj_jabatan_struktural;
            return $obj ? $obj->bup : null;
        } else if ($last->tipe_jabatan_id == 2) {
            return $last->obj_tipe_jabatan->bup;
        } else if ($last->tipe_jabatan_id >= 3 && $last->tipe_jabatan_id <= 5) {
            $obj = $last->obj_jabatan_fungsional;
            return $obj ? $obj->bup : null;
        }
    }
    public function getTmtPensiun($tglPensiun)
    {
        if ($tglPensiun) {
            if ($tglPensiun->day == 1) {
                return $tglPensiun;
            } else {
                $tglPensiun->addMonth();
                $tglPensiun->day = 1;
                return $tglPensiun;
            }
        }
        return null;
    }
    public function setTanggalPensiun()
    {
        $bup = $this->getBup();
        $bday = $this->birth_date;
        if ($bup) {
            $pensiun = $bday->addYear($bup);
            $this->load('obj_riwayat_pensiun');
            $this->tgl_pensiun = $pensiun->setDay($pensiun->daysInMonth);
            $obj_riwayat_pensiun = $this->obj_riwayat_pensiun;
            if (!$obj_riwayat_pensiun) {
                $obj_riwayat_pensiun = new RiwayatPensiun();
                $obj_riwayat_pensiun->employee_id = $this->id;
            }
            $obj_riwayat_pensiun->tgl_pensiun = $this->tgl_pensiun;
            $obj_riwayat_pensiun->tmt_pensiun = $this->getTmtPensiun($this->tgl_pensiun);
            $obj_riwayat_pensiun->save();
        } else {
            $this->tgl_pensiun = null;
        }
        $this->save();
        return $this->tgl_pensiun;
    }
    public function obj_satker()
    {
        return $this->hasOne(UnitKerja::class, 'id', 'unit_id');
    }
    public function obj_agama()
    {
        return $this->hasOne(Agama::class, 'id', 'agama_id');
    }
    public function obj_riwayat_pensiun()
    {
        return $this->hasOne(RiwayatPensiun::class, 'employee_id', 'id');
    }
    public function obj_riwayat_prestasi_kerja()
    {
        return $this->hasMany(RiwayatKinerja::class, 'employee_id', 'id')->orderBy('tgl_penilaian', 'asc');
    }
    public function obj_riwayat_angkakredit()
    {
        return $this->hasMany(RiwayatAngkaKredit::class, 'employee_id', 'id')->orderBy('tmt_pak', 'asc');
    }
    public function obj_riwayat_uji_kompetensi()
    {
        return $this->hasMany(RiwayatUjiKompetensi::class, 'employee_id', 'id')->orderBy('tanggal', 'asc');
    }
    public function obj_requests()
    {
        return $this->hasMany(Request::class, 'employee_id', 'id');
    }
    public function obj_riwayat_pangkat()
    {
        return $this->hasMany(RiwayatPangkat::class, 'employee_id', 'id')->orderBy('tmt_pangkat', 'asc');
    }
    public function obj_riwayat_kgb()
    {
        return $this->hasMany(RiwayatGaji::class, 'employee_id', 'id')->orderBy('tmt_sk', 'asc');
    }
    public function obj_riwayat_anak()
    {
        return $this->hasMany(RiwayatAnak::class, 'employee_id', 'id')->orderBy('birth_date', 'asc');
    }
    public function obj_last_riwayat_jabatan()
    {
        return $this->hasOne(RiwayatJabatan::class, 'id', 'last_riwayat_jabatan_id');
    }
    public function obj_last_riwayat_pangkat()
    {
        return $this->hasOne(RiwayatPangkat::class, 'id', 'last_riwayat_pangkat_id');
    }
    public function obj_last_riwayat_kgb()
    {
        return $this->hasOne(RiwayatGaji::class, 'id', 'last_riwayat_kgb_id');
    }
    public function obj_riwayat_pendidikan()
    {
        return $this->hasMany(RiwayatPendidikan::class, 'employee_id', 'id')->orderBy('tahun', 'asc');
    }
    public function obj_last_riwayat_pendidikan()
    {
        return $this->hasOne(RiwayatPendidikan::class, 'id', 'last_riwayat_pendidikan_id');
    }
    public function obj_riwayat_mutasi()
    {
        return $this->hasMany(RiwayatMutasi::class, 'employee_id', 'id')->orderBy('tgl_sk', 'asc');
    }
    public function obj_riwayat_skcpns()
    {
        return $this->hasMany(RiwayatSKCPNS::class, 'employee_id', 'id')->orderBy('tgl_sk', 'desc');
    }
    public function obj_riwayat_skpns()
    {
        return $this->hasMany(RiwayatSKPNS::class, 'employee_id', 'id')->orderBy('tgl_sk', 'desc');
    }
    public function obj_riwayat_sumpah()
    {
        return $this->hasMany(RiwayatSumpah::class, 'employee_id', 'id')->orderBy('tgl_sumpah', 'desc');
    }
    public function obj_riwayat_mertua()
    {
        return $this->hasMany(RiwayatOrangTua::class, 'employee_id', 'id')->whereIn('status',[3,4])->orderBy('birth_date', 'desc');
    }
    public function obj_riwayat_organisasi()
    {
        return $this->hasMany(RiwayatOrganisasi::class, 'employee_id', 'id');
    }
    public function obj_riwayat_orangtua()
    {
        return $this->hasMany(RiwayatOrangTua::class, 'employee_id', 'id')->orderBy('birth_date', 'desc');
    }
    public function obj_riwayat_pengalamankerja()
    {
        return $this->hasMany(RiwayatPengalamanKerja::class, 'employee_id', 'id')->orderBy('tgl_kerja', 'desc');
    }
    public function obj_riwayat_potensidiri()
    {
        return $this->hasMany(RiwayatPotensiDiri::class, 'employee_id', 'id')->orderBy('tahun', 'desc');
    }
    public function obj_riwayat_rekammedis()
    {
        return $this->hasMany(RiwayatRekamMedis::class, 'employee_id', 'id')->orderBy('tgl_periksa', 'desc');
    }
    public function obj_riwayat_saudara()
    {
        return $this->hasMany(RiwayatSaudara::class, 'employee_id', 'id')->orderBy('birth_date', 'desc');
    }
    public function obj_riwayat_ujikompetensi()
    {
        return $this->hasMany(RiwayatUjiKompetensi::class, 'employee_id', 'id')->orderBy('tanggal', 'desc');
    }
    public function calculateNilaiMasaKerja()
    {
        $latestSKCPNS = $this->obj_riwayat_skcpns->sortByDesc('tmt_cpns')->first();
        if ($latestSKCPNS) {
            $cpnsDate = $latestSKCPNS->tmt_cpns;
            $now = now();
            $lengthOfService = $cpnsDate->diff($now);
            $totalMonths = ($lengthOfService->y);

            $ranges = [
                ['min' => 0, 'max' => 4, 'value' => 40],
                ['min' => 4, 'max' => 8, 'value' => 140],
                ['min' => 8, 'max' => 12, 'value' => 225],
                ['min' => 12, 'max' => 16, 'value' => 295],
                ['min' => 16, 'max' => 20, 'value' => 355],
                ['min' => 20, 'max' => 28, 'value' => 400],
                ['min' => 28, 'max' => 32, 'value' => 430],
                ['min' => 32, 'max' => null, 'value' => 450],
            ];

            foreach ($ranges as $range) {
                if (
                    ($range['max'] === null && $totalMonths >= $range['min']) ||
                    ($range['max'] !== null && $totalMonths >= $range['min'] && $totalMonths < $range['max'])
                ) {
                    return $range['value'];
                }
            }
        }
        return 0;
    }
    public function obj_riwayat_jabatan()
    {
        return $this->hasMany(RiwayatJabatan::class, 'employee_id', 'id')->orderBy('tmt_jabatan', 'asc');
    }
    public function obj_riwayat_dp3()
    {
        return $this->hasMany(RiwayatDp3::class, 'employee_id', 'id')->orderBy('tahun', 'asc');
    }
    public function obj_riwayat_gaji()
    {
        return $this->hasMany(RiwayatGaji::class, 'employee_id', 'id')->orderBy('tmt_sk', 'asc');
    }
    
    public function obj_riwayat_diklat_struktural()
    {
        return $this->hasMany(RiwayatDiklatStruktural::class, 'employee_id', 'id')->orderBy('tahun', 'asc')->orderBy('tgl_mulai', 'asc');
    }
    public function obj_riwayat_diklat_fungsional()
    {
        return $this->hasMany(RiwayatDiklatFungsional::class, 'employee_id', 'id')->diklatfungsional()->orderBy('tahun', 'asc')->orderBy('tgl_mulai', 'asc');
    }
    public function obj_riwayat_diklat_teknis()
    {
        return $this->hasMany(RiwayatDiklatTeknis::class, 'employee_id', 'id')->diklatteknis()->orderBy('tahun', 'asc')->orderBy('tgl_mulai', 'asc');
    }
    public function obj_riwayat_hukuman()
    {
        return $this->hasMany(RiwayatHukuman::class, 'employee_id', 'id')->orderBy('tgl_sk', 'asc');
    }
    public function obj_riwayat_kinerja()
    {
        return $this->hasMany(RiwayatKinerja::class, 'employee_id', 'id')->orderBy('tahun', 'asc');
    }
    public function obj_riwayat_penghargaan()
    {
        return $this->hasMany(RiwayatPenghargaan::class, 'employee_id', 'id')->orderBy('tgl_sk', 'asc');
    }
    public function obj_riwayat_seminar()
    {
        return $this->hasMany(RiwayatSeminar::class, 'employee_id', 'id')->orderBy('tgl_mulai', 'asc');
    }
    public function obj_riwayat_kursus()
    {
        return $this->hasMany(RiwayatKursus::class, 'employee_id', 'id')->orderBy('tgl_mulai', 'asc');
    }
    public function obj_riwayat_nikah()
    {
        return $this->hasMany(RiwayatNikah::class, 'employee_id', 'id')->orderBy('tgl_kawin', 'asc');
    }
    public function obj_riwayat_penguasaanbahasa()
    {
        return $this->hasMany(RiwayatPenguasaanBahasa::class, 'employee_id', 'id')->orderBy('tgl_expired', 'asc');
    }
    public function getUsiaAttribute($from = null)
    {
        if ($from == null) {
            $from = Carbon::now();
        }
        return $this->birth_date->diffInMonths($from);
    }
    public function getNamaGelarAttribute()
    {
        $long_name = [];
        if ($this->gelar_depan) {
            $long_name[] = $this->gelar_depan;
        }
        $long_name[] = $this->first_name;
        if ($this->gelar_belakang) {
            $long_name[] = $this->gelar_belakang;
        }
        return trim(implode(" ", $long_name));
    }
    public function getTTDAttribute()
    {
        $txt = [];
        if ($this->birth_place) {
            $txt[] = $this->birth_place;
        }
        if ($this->birth_date) {
            $txt[] = $this->birth_date->format('d-m-Y');
        }
        return trim(implode(", ", $txt));
    }
    public function getTSexAttribute()
    {
        return JenisKelamin::find($this->sex)->name;
    }
    public function getTStatusKawinAttribute()
    {
        return StatusPernikahan::find($this->status_kawin)->name;
    }
    public function getTAgamaAttribute()
    {
        return Agama::find($this->agama_id)->name;
    }
    public function getTTipePegawaiAttribute()
    {
        return StatusPegawai::find($this->status_pegawai_id)->name;
    }

    public function updateLastRiwayatPangkat()
    {
        $this->load('obj_riwayat_pangkat');
        $last = $this->obj_riwayat_pangkat->last();
        if ($last) {
            $this->last_riwayat_pangkat_id = $last->id;
        } else
            $this->last_riwayat_pangkat_id = null;
        $this->save();
    }
    public function updateLastRiwayatJabatan()
    {
        $this->load('obj_riwayat_jabatan');
        $last = $this->obj_riwayat_jabatan->last();
        if ($last) {
            $this->last_riwayat_jabatan_id = $last->id;
        } else
            $this->last_riwayat_jabatan_id = null;
        $this->save();
    }
    public function updateLastRiwayatPendidikan()
    {
        $this->load('obj_riwayat_pendidikan');
        $last = $this->obj_riwayat_pendidikan->last();
        if ($last) {
            $this->last_riwayat_pendidikan_id = $last->id;
        } else
            $this->last_riwayat_pendidikan_id = null;
        $this->save();
    }

    public $dates = ['birth_date', 'tgl_pensiun'];
}
