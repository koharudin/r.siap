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
    protected $signature = 'integrasi:pangkat';

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
        // $path = "sk-instansi-A5EB03E23C07F6A0E040640A040252AD%2FINS.SK.01.03%2Fno-sign%2F1a7718bd181f446c24cc7e6aaa9b18cdd647c5704e553d455852aba9-2023-06-27T04%3A27%3A19.009293%2F1a7718bd181f446c24cc7e6aaa9b18cdd647c5704e553d455852aba9-2023-06-27T04%3A27%3A19.009293.pdf";
        // $token_api = SiasnController::token_api();
        // $token_login = SiasnController::token_login();
        // SiasnController::download_dok($path, $token_login, $token_api);
        $now = date('Y-m-d H:i:s');
        $error = array();
        $sudah = 0;
        $belum = 0;
        $gagal = 0;
        $pegawai = Employee::whereIn('status_pegawai_id', array(2, 23))->get();
        // $pegawai = Employee::where('id', 606)->get();
        if(!count($pegawai) < 1) {
            $total = count($pegawai);
            $no = 0;
            $token_api = SiasnController::token_api();
            $token_login = SiasnController::token_login();    
            $this->info("Jumlah Pegawai : ".$total."\n");
            foreach($pegawai as $data) {
                $no++;
                $total--;
                $pangkat = SiasnController::get_rw_pangkat($data->nip_baru, $token_login, $token_api);
                while(isset($pangkat->message) and ($pangkat->message == 'invalid or expired jwt' or $pangkat->message == 'Invalid Credentials')) {
                    $token_api = SiasnController::token_api();
                    $token_login = SiasnController::token_login();
                    $pangkat = SiasnController::get_rw_pangkat($data->nip_baru, $token_login, $token_api);
                }
                if($pangkat->code == 1) {
                    $pangkat_siap = RiwayatPangkat::where('employee_id', $data->id)->orderBy('tgl_sk', 'desc')->get();
                    foreach($pangkat->data as $item) {
                        $exist = 0;
                        foreach($pangkat_siap as $value) {
                            if($item->golonganId == $value->pangkat_id) {
                                $value->id_siasn = (isset($item->id) && $item->id != "") ? $item->id : null;
                                $value->dok_siasn = (!empty($item->path)) ? reset($item->path)->dok_id : null;
                                $value->save();
                                $exist = 1;
                                $sudah++;
                                $this->info($no.". ".$data->first_name." ==> ".$item->golongan." | Ada | Pegawai Kurang : ".$total);
                            }
                        }
                        if($exist == 0) {
                            try {
                                $rw_pangkat = new RiwayatPangkat;
                                $rw_pangkat->employee_id = $data->id;
                                $rw_pangkat->pangkat_id = (isset($item->golonganId) && $item->golonganId != "") ? $item->golonganId : null;
                                $rw_pangkat->no_sk = (isset($item->skNomor) && $item->skNomor != "") ? $item->skNomor : null;
                                $rw_pangkat->tgl_sk = (isset($item->skTanggal) && $item->skTanggal != "") ? $item->skTanggal : null;
                                $rw_pangkat->tmt_pangkat = (isset($item->tmtGolongan) && $item->tmtGolongan != "") ? $item->tmtGolongan : null;
                                $rw_pangkat->no_nota = (isset($item->noPertekBkn) && $item->noPertekBkn != "") ? $item->noPertekBkn : null;
                                $rw_pangkat->tgl_nota = (isset($item->tglPertekBkn) && $item->tglPertekBkn != "") ? $item->tglPertekBkn : null;
                                $rw_pangkat->kredit = (isset($item->jumlahKreditUtama) && $item->jumlahKreditUtama != "") ? $item->jumlahKreditUtama : null;
                                $rw_pangkat->kredit_tambahan = (isset($item->jumlahKreditTambahan) && $item->jumlahKreditTambahan != "") ? $item->jumlahKreditTambahan : null;
                                if(isset($item->jenisKPId) && $item->jenisKPId != "") {
                                    $jenis_kp = JenisKP::select('id')->where('sapk_jenis_kp_id', $item->jenisKPId)->first();
                                    $rw_pangkat->jenis_kp = $jenis_kp->id;
                                } else {
                                    $rw_pangkat->jenis_kp = null;
                                }
                                $rw_pangkat->masakerja_thn = (isset($item->masaKerjaGolonganTahun) && $item->masaKerjaGolonganTahun != "") ? $item->masaKerjaGolonganTahun : null;
                                $rw_pangkat->masakerja_bln = (isset($item->masaKerjaGolonganBulan) && $item->masaKerjaGolonganBulan != "") ? $item->masaKerjaGolonganBulan : null;
                                $rw_pangkat->id_siasn = (isset($item->id) && $item->id != "") ? $item->id : null;
                                $rw_pangkat->save();
                            } catch (QueryException $e) {
                                array_push($error, $data->nip_baru." ==> ".$e->getMessage());
                            }
                            $belum++;
                            $this->info($no.". ".$data->first_name." ==> ".$item->golongan." | Tidak Ada | Pegawai Kurang : ".$total);
                        }
                    }
                } else if($pangkat->code == 0) {
                    $this->info($no.". ".$data->first_name." | Gagal | Pegawai Kurang : ".$total);
                    array_push($error, $data->nip_baru." ==> ".$pangkat->data);
                }
            }
            if(!count($error) < 1) {
                $name = "log_pangkat_".date('Ymd_His').".txt";
                $error = implode("\n", $error);
                Storage::disk('local')->put($name, $error);
            }
            $end = date('Y-m-d H:i:s');
            $lama = strtotime($now);
            $baru = strtotime($end);
            $diff = $baru - $lama;
            $this->info("\nData Sudah : ".$sudah);
            $this->info("Data Belum : ".$belum);
            $this->info("Data Gagal : ".$gagal);
            $this->info("Selesai dalam ".number_format($diff, 0, ",", ".")." detik");
        } else {
            $this->info("=== DATA PEGAWAI KOSONG ===");
        }
    }
}
