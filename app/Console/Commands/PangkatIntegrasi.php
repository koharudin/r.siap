<?php

namespace App\Console\Commands;

use App\Helpers\AppHelper;
use Illuminate\Console\Command;
use App\Models\RiwayatPangkat;
use App\Models\DokumenPegawai;
use App\Models\Employee;
use App\Models\JenisKP;
use App\Admin\Controllers\SiasnController;
use Illuminate\Support\Facades\Storage;

class PangkatIntegrasi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'integrasi:golongan';

    /**
     * The console command description.
     *
     * @var string
     */ 
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $now = date('Y-m-d H:i:s');
        $error = array();
        $sudah = 0;
        $belum = 0;
        $gagal = 0;
        $pegawai = Employee::whereIn('status_pegawai_id', array(1, 2, 23))->get();
        // $pegawai = Employee::where('id', 606)->get();
        if(!count($pegawai) < 1) {
            $total = count($pegawai);
            $token_api = SiasnController::token_api();
            $token_login = SiasnController::token_login();
            $this->info("Total Data Pegawai ".$total."\n");
            foreach($pegawai as $data) {
                $total--;
                $this->info("Sekarang NIP ".$data->nip_baru." dan Total Pegawai Kurang : ".$total);
                $pangkat = SiasnController::get_rw_pangkat($data->nip_baru, $token_login, $token_api);
                $noerr = 0;
                while(isset($pangkat->message) and ($pangkat->message == 'invalid or expired jwt' or $pangkat->message == 'Invalid Credentials')) {
                    $token_api = SiasnController::token_api();
                    $token_login = SiasnController::token_login();
                    $pangkat = SiasnController::get_rw_pangkat($data->nip_baru, $token_login, $token_api);
                }
                if(!isset($pangkat->code)) {
                    $gagal++;
                    $this->info("Sekarang NIP ".$data->nip_baru." => Fail");
                    array_push($error, $data->nip_baru." => ".$data->first_name." => null");
                } else {
                    if($pangkat->code == 1) {
                        $pangkat_siap = RiwayatPangkat::where('employee_id', $data->id)->get();
                        foreach($pangkat->data as $item) {
                            $exist = 0;
                            $golongan_id = $item->golonganId;
                            if($data->status_pegawai_id == 23) {
                                if(!empty($item->golonganId)) {
                                    switch($item->golonganId) {
                                        case 31:
                                            $golongan_id = '09';
                                            break;
                                        case 23:
                                            $golongan_id = '07';
                                            break;
                                        case 32:
                                            $golongan_id = '10';
                                            break;
                                    }
                                }
                            }
                            foreach($pangkat_siap as $value) {
                                if($golongan_id == $value->pangkat_id) {
                                    $value->id_siasn = (!empty($item->id)) ? $item->id : null;
                                    // $value->dok_siasn = (!empty($item->path)) ? reset($item->path)->dok_id : null;
                                    $value->save();
                                    $exist = 1;
                                    $sudah++;
                                    $this->info("Sekarang NIP ".$data->nip_baru." => ".$item->golongan." => Exist");
                                }
                            }
                            if($exist == 0) {
                                try {
                                    $rw_pangkat = new RiwayatPangkat;
                                    $rw_pangkat->employee_id = $data->id;
                                    if($data->status_pegawai_id == 23) {
                                        if(!empty($item->golonganId)) {
                                            switch($item->golonganId) {
                                                case 31:
                                                    $rw_pangkat->pangkat_id = '09';
                                                    break;
                                                case 23:
                                                    $rw_pangkat->pangkat_id = '07';
                                                    break;
                                                case 32:
                                                    $rw_pangkat->pangkat_id = '10';
                                                    break;
                                            }
                                        } else {
                                            $rw_pangkat->pangkat_id = null;
                                        }
                                    } else {
                                        $rw_pangkat->pangkat_id = (!empty($item->golonganId)) ? $item->golonganId : null;
                                    }
                                    $rw_pangkat->no_sk = (!empty($item->skNomor)) ? $item->skNomor : null;
                                    $rw_pangkat->tgl_sk = (!empty($item->skTanggal)) ? $item->skTanggal : null;
                                    $rw_pangkat->tmt_pangkat = (!empty($item->tmtGolongan)) ? $item->tmtGolongan : null;
                                    $rw_pangkat->no_nota = (!empty($item->noPertekBkn)) ? $item->noPertekBkn : null;
                                    $rw_pangkat->tgl_nota = (!empty($item->tglPertekBkn)) ? $item->tglPertekBkn : null;
                                    $rw_pangkat->kredit = (isset($item->jumlahKreditUtama) && $item->jumlahKreditUtama != "") ? $item->jumlahKreditUtama : null;
                                    $rw_pangkat->kredit_tambahan = (isset($item->jumlahKreditTambahan) && $item->jumlahKreditTambahan != "") ? $item->jumlahKreditTambahan : null;
                                    if(!empty($item->jenisKPId)) {
                                        $jenis_kp = JenisKP::select('id')->where('sapk_jenis_kp_id', $item->jenisKPId)->first();
                                        $rw_pangkat->jenis_kp = $jenis_kp->id;
                                    } else {
                                        $rw_pangkat->jenis_kp = null;
                                    }
                                    $rw_pangkat->masakerja_thn = (isset($item->masaKerjaGolonganTahun) && $item->masaKerjaGolonganTahun != "") ? $item->masaKerjaGolonganTahun : null;
                                    $rw_pangkat->masakerja_bln = (isset($item->masaKerjaGolonganBulan) && $item->masaKerjaGolonganBulan != "") ? $item->masaKerjaGolonganBulan : null;
                                    $rw_pangkat->id_siasn = (!empty($item->id)) ? $item->id : null;
                                    // $rw_pangkat->dok_siasn = (!empty($item->path)) ? reset($item->path)->dok_id : null;
                                    $rw_pangkat->save();
                                } catch (QueryException $e) {
                                    $gagal++;
                                    $this->info("Sekarang NIP ".$data->nip_baru." => Fail");
                                    array_push($error, $data->nip_baru." => ".$data->first_name." => ".$e->getMessage());
                                }
                                $belum++;
                                $this->info("Sekarang NIP ".$data->nip_baru." => ".$item->golongan." => New");
                            }
                        }
                    } else {
                        $gagal++;
                        $this->info("Sekarang NIP ".$data->nip_baru." => Fail");
                        array_push($error, $data->nip_baru." => ".$data->first_name." => ".$pangkat->code);
                    }
                }
            }
            if(!count($error) < 1) {
                $name = "log_golongan_".date('Ymd_His').".txt";
                $error = implode("\n", $error);
                Storage::disk('local')->put($name, $error);
            }
            $end = date('Y-m-d H:i:s');
            $lama = strtotime($now);
            $baru = strtotime($end);
            $diff = $baru - $lama;
            $this->info("\nData Exist : ".$sudah);
            $this->info("Data New : ".$belum);
            $this->info("Data Fail : ".$gagal);
            $this->info("Hasilnya ".number_format($diff, 0, ",", ".")." detik");
        }
    }
}
