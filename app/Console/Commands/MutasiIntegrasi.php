<?php

namespace App\Console\Commands;

use App\Helpers\AppHelper;
use Illuminate\Console\Command;
use App\Models\RiwayatMutasi;
use App\Models\DokumenPegawai;
use App\Admin\Controllers\SiasnController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use DateTime;

class MutasiIntegrasi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string 
     */
    protected $signature = 'integrasi:mutasi {--flag=}';

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
        $mutasi = RiwayatMutasi::with([
            'obj_riwayat_jabatan:id,jabatan_id,tipe_jabatan_id,tmt_jabatan',
            'obj_unit_kerja_baru:id,id_unit_siasn',
            'obj_employee:id,id_pns_bkn,nip_baru'
        ])->whereIn('flag_integrasi', [$flag])
            ->get(['id', 'id_siasn', 'riwayat_jabatan_id', 'satker_id_baru', 'employee_id', 'no_sk', 'tgl_sk', 'tmt_sk']);
        $total = count($mutasi);
        $info = "Total Data Mutasi ".$total."\n";
        array_push($log, $info);
        $this->info($info);
        $info = "id_riwayat_siap|message_siasn|status_siasn|id_riwayat_siasn|message_dokumen|status_dokumen|sisa_integrasi";
        array_push($log, $info);
        if(!$total < 1) {
            $token_api = SiasnController::token_api();
            $token_login = SiasnController::token_login();
            $instansiId = "A5EB03E23C07F6A0E040640A040252AD";
            $satuanKerjaId = "A5EB03E240FEF6A0E040640A040252AD";
            $jenisMutasiId = "MU";
            $klasifikasi_id = 7;
            foreach($mutasi as $data) {
                $total--;
                $tmtJabatan = date('d-m-Y', strtotime($data->obj_riwayat_jabatan->tmt_jabatan));
                $id = $data->id_siasn;
                $jabatanId = $data->obj_riwayat_jabatan->obj_jabatan_fungsional->id_jabatan_siasn;
                $jenisJabatan = (string) $data->obj_riwayat_jabatan->obj_tipe_jabatan->jenis_jabatan_siasn;
                $nomorSk = $data->no_sk;
                $pnsId = $data->obj_employee->id_pns_bkn;
                $tanggalSk = date('d-m-Y', strtotime($data->tgl_sk));
                $tmtMutasi = date('d-m-Y', strtotime($data->tmt_sk));
                $unorId = $data->obj_unit_kerja_baru->id_unit_siasn;

                $id_mutasi = SiasnController::save_mutasi($id, $instansiId, $jabatanId, $jenisJabatan, $jenisMutasiId, $nomorSk, $pnsId,
                    $satuanKerjaId, $tanggalSk, $tmtJabatan, $tmtMutasi, $unorId, $token_login, $token_api);
                while($id_mutasi['code'] == 401) {
                    $token_api = SiasnController::token_api();
                    $token_login = SiasnController::token_login();
                    $id_mutasi = SiasnController::save_mutasi($id, $instansiId, $jabatanId, $jenisJabatan, $jenisMutasiId, $nomorSk, $pnsId,
                        $satuanKerjaId, $tanggalSk, $tmtJabatan, $tmtMutasi, $unorId, $token_login, $token_api);
                }
                $response = $id_mutasi['response'];
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
                        $id_riwayat = $response->mapData->rwJabatanId;
                        $id_ref_dokumen = '872';
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
                        DB::table('riwayat_mutasi')
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
        $name = "log_mutasi_".date('Ymd_His').".txt";
        $log = implode("\n", $log);
        Storage::disk('local')->put($name, $log);
    }
}
