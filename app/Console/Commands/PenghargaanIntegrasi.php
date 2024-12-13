<?php

namespace App\Console\Commands;

use App\Helpers\AppHelper;
use Illuminate\Console\Command;
use App\Models\RiwayatPenghargaan;
use App\Models\DokumenPegawai;
use App\Admin\Controllers\SiasnController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use DateTime;

class PenghargaanIntegrasi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string 
     */
    protected $signature = 'integrasi:penghargaan {--flag=}';

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
        $flag = $this->option("flag");
        $flag = (!empty($flag)) ? $flag : 1;
        $log = array();
        $now = date('Y-m-d H:i:s');
        $penghargaan = RiwayatPenghargaan::with([
            'obj_jenis_penghargaan:id,id_penghargaan_siasn',
            'obj_employee:id,id_pns_bkn,nip_baru'
        ])->whereIn('flag_integrasi', [$flag])
            ->get(['id', 'id_siasn', 'jenis_penghargaan_id', 'employee_id', 'no_sk', 'tgl_sk', 'tahun']);
        $total = count($penghargaan);
        $info = "Total Data Penghargaan ".$total."\n";
        array_push($log, $info);
        $this->info($info);
        $info = "id_riwayat_siap|message_siasn|status_siasn|id_riwayat_siasn|message_dokumen|status_dokumen|sisa_integrasi";
        array_push($log, $info);
        if(!$total < 1) {
            $token_api = SiasnController::token_api();
            $token_login = SiasnController::token_login();
            $klasifikasi_id = 19;
            foreach($penghargaan as $data) {
                $total--;
                $id = $data->id_siasn;
                $hargaId = (string) $data->obj_jenis_penghargaan->id_penghargaan_siasn;
                $skNomor = $data->no_sk;
                $pnsOrangId = $data->obj_employee->id_pns_bkn;
                $skDate = date('d-m-Y', strtotime($data->tgl_sk));
                $tahun = $data->tahun;

                $id_penghargaan = SiasnController::save_penghargaan($id, $hargaId, $pnsOrangId, $skDate, $skNomor, $tahun, $token_login, $token_api);
                while($id_penghargaan['code'] == 401) {
                    $token_api = SiasnController::token_api();
                    $token_login = SiasnController::token_login();
                    $id_penghargaan = SiasnController::save_penghargaan($id, $hargaId, $pnsOrangId, $skDate, $skNomor, $tahun, $token_login, $token_api);
                }
                $response = $id_penghargaan['response'];
                $id_riwayat = '-';
                $messagePath = '-';
                $message = '-';
                $code = '-';
                $success = '-';
                if(isset($response->success)) {
                    $message = $response->message;
                    $success = ($response->success) ? 'true' : 'false';
                    if($response->success == true) {
                        $dokumen = DokumenPegawai::select('file')->where('ref_id', $data->id)->where('klasifikasi_id', $klasifikasi_id)->first();
                        $file = $dokumen['file'];
                        $id_riwayat = $response->mapData->rwPenghargaanId;
                        $id_ref_dokumen = '892';
                        $flag_integrasi = 2;
                        if(!empty($file)) {
                            $path = SiasnController::upload_dok_rw($file, $id_ref_dokumen, $id_riwayat, $token_login, $token_api);
                            while($path['code'] == 401) {
                                $token_api = SiasnController::token_api();
                                $token_login = SiasnController::token_login();
                                $path = SiasnController::upload_dok_rw($file, $id_ref_dokumen, $id_riwayat, $token_login, $token_api);
                            }
                            $responsePath = $path['response'];
                            if(isset($responsePath->code)) {
                                $code = $responsePath->code;
                                $messagePath = $responsePath->message;
                                if($code == 1) {
                                    $flag_integrasi = 3;
                                }
                            }
                        }
                        DB::table('riwayat_penghargaan')
                            ->where('id', $data->id)
                            ->update(['id_siasn' => $id_riwayat, 'flag_integrasi' => $flag_integrasi]);
                    }
                }
                $info = $data->id."|".$message."|".$success."|".$id_riwayat."|".$messagePath."|".$code."|".$total;
                $this->info($info);
                array_push($log, $info);
            }
        }
        $end = date('Y-m-d H:i:s');
        $lama = strtotime($now);
        $baru = strtotime($end);
        $diff = $baru - $lama;
        $info = "\nHasilnya ".number_format($diff,0,",",".")." detik";
        $this->info($info);
        array_push($log, $info);
        $name = "log_penghargaan_".date('Ymd_His').".txt";
        $log = implode("\n", $log);
        Storage::disk('local')->put($name, $log);
    }
}
