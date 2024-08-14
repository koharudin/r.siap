<?php

namespace App\Console\Commands;

use App\Helpers\AppHelper;
use Illuminate\Console\Command;
use App\Models\RiwayatJabatan;
use App\Models\DokumenPegawai;
use App\Admin\Controllers\SiasnController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class JabatanIntegrasi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string 
     */
    protected $signature = 'integrasi:jabatan {--flag=}';

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
        $jabatan = RiwayatJabatan::with([
            'obj_jabatan_fungsional:id,id_jabatan_siasn',
            'obj_unit_kerja:id,eselon_id,id_unit_siasn',
            'obj_tipe_jabatan:id,jenis_jabatan_siasn',
            'obj_employee:id,id_pns_bkn',
            'obj_status_jabatan:id,id_status_jabatan_siasn'
        ])->whereIn('flag_integrasi', [$flag])
            ->get(['id', 'id_siasn', 'jabatan_id', 'unit_id', 'tipe_jabatan_id', 'employee_id', 'status_jabatan_id', 'no_sk', 'tgl_sk', 'tmt_jabatan', 'tgl_pelantikan', ]);
        $total = count($jabatan);
        $info = "Total Data Jabatan ".$total."\n";
        array_push($log, $info);
        $this->info($info);
        $info = "id_riwayat_siap|message_siasn|status_siasn|id_riwayat_siasn|message_dokumen|status_dokumen|sisa_integrasi";
        array_push($log, $info);
        if(!$total < 1) {
            $token_api = SiasnController::token_api();
            $token_login = SiasnController::token_login();
            $instansiId = "A5EB03E23C07F6A0E040640A040252AD";
            $satuanKerjaId = "A5EB03E240FEF6A0E040640A040252AD";
            $klasifikasi_id = 6;
            foreach($jabatan as $data) {
                $total--;
                $jenisJabatan = (string) $data->obj_tipe_jabatan->jenis_jabatan_siasn;
                $eselonId = ($jenisJabatan == 1) ? (string) $data->obj_unit_kerja->eselon_id : null;
                $id = $data->id_siasn;
                $jabatanId = ($jenisJabatan == 1) ? null : $data->obj_jabatan_fungsional->id_jabatan_siasn;
                $nomorSk = $data->no_sk;
                $pnsId = $data->obj_employee->id_pns_bkn;
                $tanggalSk = date('d-m-Y', strtotime($data->tgl_sk));
                $tmtJabatan = date('d-m-Y', strtotime($data->tmt_jabatan));
                $tmtPelantikan = date('d-m-Y', strtotime($data->tgl_pelantikan));
                $unorId = $data->obj_unit_kerja->id_unit_siasn;
                $jenisPenugasanId = ($data->obj_status_jabatan && $jenisJabatan == 1) ? $data->obj_status_jabatan->id_status_jabatan_siasn : null;
                
                $id_jabatan = SiasnController::save_jabatan($id, $eselonId, $instansiId, $jabatanId, $jenisJabatan, $nomorSk,
                    $pnsId, $satuanKerjaId, $tanggalSk, $tmtJabatan, $tmtPelantikan, $unorId, $jenisPenugasanId, $token_login, $token_api);
                while($id_jabatan['code'] == 401) {
                    $token_api = SiasnController::token_api();
                    $token_login = SiasnController::token_login();
                    $id_jabatan = SiasnController::save_jabatan($id, $eselonId, $instansiId, $jabatanId, $jenisJabatan, $nomorSk,
                        $pnsId, $satuanKerjaId, $tanggalSk, $tmtJabatan, $tmtPelantikan, $unorId, $jenisPenugasanId, $token_login, $token_api);
                }
                // print_r($id_jabatan);
                $response = $id_jabatan['response'];
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
                        DB::table('riwayat_jabatan')
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
        $name = "log_jabatan_".date('Ymd_His').".txt";
        $log = implode("\n", $log);
        Storage::disk('local')->put($name, $log);
    }
}
