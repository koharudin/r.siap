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

class KpIntegrasi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'integrasi:kp {--tmt=}';

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
        $tmt = $this->option("tmt");
        $log = array();
        $now = date('Y-m-d H:i:s');
        $token_api = SiasnController::token_api();
        $token_login = SiasnController::token_login();
        $id_pangkat = SiasnController::list_kp_instansi($tmt, $token_login, $token_api);
        while($id_pangkat['code'] == 401) {
            $token_api = SiasnController::token_api();
            $token_login = SiasnController::token_login();
            $id_pangkat = SiasnController::list_kp_instansi($tmt, $token_login, $token_api);
        }
        $response = $id_pangkat['response'];
        if(isset($response->count)) {
            $total = $response->count;
            $info = "Total Data Pangkat ".$total."\n";
            array_push($log, $info);
            $this->info($info);
            $info = "nip_siasn|pangkat_siasn|tmt_siasn|jenis_kp|id_riwayat_siap|status_siap|sisa_integrasi";
            array_push($log, $info);
            if(!$total < 1) {
                $status = "";
                $id = 0;
                $idJenis = 0;
                $pangkatSiasn = $response->data;
                foreach($pangkatSiasn as $data) {
                    $total--;
                    if($data->statusUsulan == 32) {
                        $idEmployee = Employee::getIdByNip($data->nipBaru);
                        if(!empty($idEmployee)) {
                            $pangkatSiap = RiwayatPangkat::where('employee_id', $idEmployee)->where('pangkat_id', $data->golonganBaruId)->first();
                            if(!empty($pangkatSiap)) {
                                $id = $pangkatSiap->id;
                                $pangkatSiap->id_siasn = $data->id;
                                $pangkatSiap->save();
                                $status = "Pangkat sudah ada";
                            } else {
                                $rw_pangkat = new RiwayatPangkat;
                                $rw_pangkat->employee_id = $idEmployee;
                                $rw_pangkat->no_nota = $data->no_pertek;
                                $rw_pangkat->no_sk = $data->no_sk;
                                $rw_pangkat->tgl_nota = $data->tgl_pertek;
                                $rw_pangkat->tgl_sk = $data->tgl_sk;
                                $rw_pangkat->pangkat_id = $data->golonganBaruId;
                                $rw_pangkat->tmt_pangkat = $data->tmtKp;
                                $rw_pangkat->masakerja_thn = $data->masa_kerja_tahun;
                                $rw_pangkat->masakerja_bln = $data->masa_kerja_bulan;
                                $rw_pangkat->id_siasn = $data->id;
                                
                                $jenisKp = str_replace("Kenaikan Pangkat ", "", $data->jenis_kp);
                                $jenis_kp = JenisKP::select('id')->where('name', 'like', '%'.$jenisKp.'%')->first();
                                if(!empty($jenis_kp)) {
                                    $rw_pangkat->jenis_kp = $jenis_kp->id;
                                    $idJenis = $jenis_kp->id;
                                } else {
                                    $rw_pangkat->jenis_kp = null;
                                }

                                if($rw_pangkat->save()) {
                                    $id = $rw_pangkat->id;
                                    $status = "Pangkat berhasil ditambah";
                                } else {
                                    $status = "Pangkat gagal ditambah";
                                }
                            }
                        } else {
                            $status = "NIP tidak ada";
                        }
                    } else {
                        $status = "Status usulan belum selesai";
                    }
                    $info = "'".$data->nipBaru."|".$data->golonganBaruId."|".$data->tmtKp."|".$idJenis."|".$id."|".$status."|".$total;
                    array_push($log, $info);
                    $this->info($info);
                }
            }
        } else {
            $info = $id_pangkat['code']." ".$response->message;
            array_push($log, $info);
            $this->info($info);
        }
        $end = date('Y-m-d H:i:s');
        $lama = strtotime($now);
        $baru = strtotime($end);
        $diff = $baru - $lama;
        $info = "\nHasilnya ".number_format($diff,0,",",".")." detik";
        $this->info($info);
        array_push($log, $info);
        $name = "log_kp_".date('Ymd_His').".txt";
        $log = implode("\n", $log);
        Storage::disk('local')->put($name, $log);
    }
}
