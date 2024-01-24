<?php

namespace App\Console\Commands;

use App\Helpers\AppHelper;
use Illuminate\Console\Command;
use App\Models\RiwayatHukuman;
use App\Models\DokumenPegawai;
use App\Models\Employee;
use App\Admin\Controllers\SiasnController;
use Illuminate\Support\Facades\Storage;

class HukumanIntegrasi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string 
     */
    protected $signature = 'integrasi:hukuman';

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
        $error = array();
        $now = date('Y-m-d H:i:s');
        $hukuman = RiwayatHukuman::where('flag_integrasi', 1)->get();
        if (!count($hukuman) < 1) {
            $token_api = SiasnController::token_api();
            $token_login = SiasnController::token_login();
            $kedudukanHukumId = "01";
            $total = count($hukuman);
            $no = 0;
            $this->info("Jumlah Data : " . $total . "\n");
            foreach ($hukuman as $data) {
                $no++;
                $total--;
                $id = $data->id_hukuman_siasn;
                $akhirHukumanTanggal = date('d-m-Y', strtotime($data->tmt_akhir));
                $alasanHukumanDisiplinId = $data->alasan_hukuman;
                $golonganId = $data->obj_employee->obj_riwayat_pangkat->first()->obj_pangkat->id;
                $hukumanTanggal = date('d-m-Y', strtotime($data->tmt_sk));
                $jenisHukumanId = $data->obj_hukuman->siasn_id;
                $jenisTingkatHukumanId = $data->obj_hukuman->id_tingkat;
                $kedudukanHukumId = $kedudukanHukumId;
                $masaBulan = (string)$data->masa_bulan;
                $masaTahun = (string)$data->masa_tahun;
                $nomorPp = $data->nomor_pp;
                $pnsOrangId = $data->obj_employee->id_pns_bkn;
                $skNomor = $data->no_sk;
                $skTanggal = date('d-m-Y', strtotime($data->tgl_sk));

                $id_hukuman = SiasnController::save_hukuman(
                    $id,
                    $akhirHukumanTanggal,
                    $alasanHukumanDisiplinId,
                    $golonganId,
                    $hukumanTanggal,
                    $jenisHukumanId,
                    $jenisTingkatHukumanId,
                    $kedudukanHukumId,
                    $masaBulan,
                    $masaTahun,
                    $nomorPp,
                    $pnsOrangId,
                    $skNomor,
                    $skTanggal,
                    $token_login,
                    $token_api
                );
                while ($id_hukuman->message == 'invalid or expired jwt' or $id_hukuman->message == 'Invalid Credentials') {
                    $token_api = SiasnController::token_api();
                    $token_login = SiasnController::token_login();
                    $id_hukuman = SiasnController::save_hukuman(
                        $id,
                        $akhirHukumanTanggal,
                        $alasanHukumanDisiplinId,
                        $golonganId,
                        $hukumanTanggal,
                        $jenisHukumanId,
                        $jenisTingkatHukumanId,
                        $kedudukanHukumId,
                        $masaBulan,
                        $masaTahun,
                        $nomorPp,
                        $pnsOrangId,
                        $skNomor,
                        $skTanggal,
                        $token_login,
                        $token_api
                    );
                }
                $this->info($no . ". " . $data->id . " ==> " . $id_hukuman->message . " | Data Kurang : " . $total);

                if ($id_hukuman->message == 'success') {
                    // $dokumen = DokumenPegawai::select('file')->where('ref_id', $data->id)->where('klasifikasi_id', $data->klasifikasi)->first();
                    // $file = $dokumen['file'];
                    // $id_ref_dokumen = '881';
                    $id_riwayat = $id_hukuman->mapData;
                    // if(!empty($file)) {
                    // $path = SiasnController::upload_dok_rw($file, $id_ref_dokumen, $id_riwayat, $token_login, $token_api);
                    // while($path->message == 'invalid or expired jwt' or $path->message == 'Invalid Credentials') {
                    // $token_api = SiasnController::token_api();
                    // $token_login = SiasnController::token_login();
                    // $path = SiasnController::upload_dok_rw($file, $id_ref_dokumen, $id_riwayat, $token_login, $token_api);
                    // }
                    // $this->info($no.". ".$data->klasifikasi." | ".$data->id." ==> ".$path->message." | Dokumen Kurang : ".$total);
                    // if($path->message == 'File berhasil di upload') {
                    // $data->flag_integrasi = 2;
                    // $data->id_diklat_siasn = $id_riwayat;
                    // $data->save();
                    // } else {
                    // array_push($error, $data->klasifikasi." | ".$data->id." ==> ".$path->message);
                    // }
                    // } else {
                    $this->info($no . ". " . $data->id . " ==> Dokumen Kosong | Dokumen Kurang : " . $total);
                    // $data->flag_integrasi = 2;
                    $data->id_hukuman_siasn = $id_riwayat;
                    $data->save();
                    // }
                } else {
                    array_push($error, $data->id . " ==> " . $id_hukuman->message);
                }
            }
            $end = date('Y-m-d H:i:s');
            $lama = strtotime($now);
            $baru = strtotime($end);
            $diff = $baru - $lama;
            $this->info("\nSelesai dalam " . number_format($diff, 0, ",", ".") . " detik");
            if (!count($error) < 1) {
                $name = "hukuman_log_" . date('Ymd_His') . ".txt";
                $error = implode("\n", $error);
                Storage::disk('local')->put($name, $error);
            }
        } else {
            $this->info("=== DATA HUKUMAN TERUPDATE ===");
        }
    }
}
