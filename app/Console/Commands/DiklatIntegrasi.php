<?php

namespace App\Console\Commands;

use App\Helpers\AppHelper;
use Illuminate\Console\Command;
use App\Models\RiwayatDiklatTeknis;
use App\Models\RiwayatDiklatFungsional;
use App\Models\RiwayatKursus;
use App\Models\RiwayatSeminar;
use App\Models\DokumenPegawai;
use App\Models\Employee;
use App\Http\Controllers\SiasnController;
use Illuminate\Support\Facades\Storage;

class DiklatIntegrasi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string 
     */
    protected $signature = 'integrasi:diklat';

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
        $diklat = RiwayatDiklatTeknis::selectRaw('14 as klasifikasi, *')->where('jenis_diklat', 1)->where('flag_integrasi', 1)->get();
        $kursus = RiwayatKursus::selectRaw('15 as klasifikasi, *')->where('flag_integrasi', 1)->get();
        $seminar = RiwayatSeminar::selectRaw('16 as klasifikasi, *')->where('flag_integrasi', 1)->get();
        $fungsional = RiwayatDiklatFungsional::selectRaw('13 as klasifikasi, *')->where('jenis_diklat', 2)->where('flag_integrasi', 1)->get();
        $merged = $diklat->merge($kursus)->merge($seminar)->merge($fungsional);
        if(!count($merged) < 1) {
            $token_api = SiasnController::token_api();
            $token_login = SiasnController::token_login();
            $instansiId = "A5EB03E240FEF6A0E040640A040252AD";
            $total = count($merged);
            $no = 0;
            $this->info("Jumlah Data : ".$total."\n");
            foreach($merged as $data) {
                $no++;
                $total--;
                $id = $data->id_diklat_siasn;
                $institusiPenyelenggara = $data->penyelenggara;
                $jenisDiklatId = (string)$data->jenis_diklat_siasn;
                $jumlahJam = (isset($data->jumlah_jam)) ? $data->jumlah_jam : $data->lama_jam;
                $namaKursus = (isset($data->nama_diklat)) ? $data->nama_diklat : $data->nama;
                $nomorSertipikat = (isset($data->no_sttpp)) ? $data->no_sttpp : $data->no_piagam;
                $pnsOrangId = $data->obj_id->id_pns_bkn;
                $tahunKursus = $data->tahun;
                $tanggalKursus = date('d-m-Y', strtotime($data->tgl_mulai));
                $tanggalSelesaiKursus = date('d-m-Y', strtotime($data->tgl_selesai));
                $id_diklat = SiasnController::save_diklat($id, $instansiId, $institusiPenyelenggara, $jenisDiklatId, $jumlahJam, $namaKursus, $nomorSertipikat,
                    $pnsOrangId, $tahunKursus, $tanggalKursus, $tanggalSelesaiKursus, $token_login, $token_api);
                $this->info($no.". ".$data->klasifikasi." | ".$data->id." ==> ".$id_diklat->message." | Data Kurang : ".$total);
                while($id_diklat->message == 'invalid or expired jwt' or $id_diklat->message == 'Invalid Credentials') {
                    $token_api = SiasnController::token_api();
                    $token_login = SiasnController::token_login();
                    $id_diklat = SiasnController::save_diklat($id, $instansiId, $institusiPenyelenggara, $jenisDiklatId, $jumlahJam, $namaKursus, $nomorSertipikat,
                        $pnsOrangId, $tahunKursus, $tanggalKursus, $tanggalSelesaiKursus, $token_login, $token_api);
                    $this->info($no.". ".$data->klasifikasi." | ".$data->id." ==> ".$id_diklat->message." | Data Kurang : ".$total);
                }
                if($id_diklat->message == 'success') {
                    $dokumen = DokumenPegawai::select('file')->where('ref_id', $data->id)->where('klasifikasi_id', $data->klasifikasi)->first();
                    $file = $dokumen['file'];
                    $id_ref_dokumen = '881';
                    $id_riwayat = $id_diklat->mapData->rwKursusId;
                    if(!empty($file)) {
                        $path = SiasnController::upload_dok_rw($file, $id_ref_dokumen, $id_riwayat, $token_login, $token_api);
                        $this->info($no.". ".$data->klasifikasi." | ".$data->id." ==> ".$path->message." | Dokumen Kurang : ".$total);
                        while($path->message == 'invalid or expired jwt' or $path->message == 'Invalid Credentials') {
                            $token_api = SiasnController::token_api();
                            $token_login = SiasnController::token_login();
                            $path = SiasnController::upload_dok_rw($file, $id_ref_dokumen, $id_riwayat, $token_login, $token_api);
                            $this->info($no.". ".$data->klasifikasi." | ".$data->id." ==> ".$path->message." | Dokumen Kurang : ".$total);
                        }
                        if($path->message == 'File berhasil di upload') {
                            $data->flag_integrasi = 2;
                            $data->id_diklat_siasn = $id_riwayat;
                            $data->save();
                        } else {
                            array_push($error, $data->klasifikasi." | ".$data->id." ==> ".$path->message);
                        }
                    } else {
                        $this->info($no.". ".$data->klasifikasi." | ".$data->id." ==> Dokumen Kosong | Dokumen Kurang : ".$total);
                        $data->id_diklat_siasn = $id_riwayat;
                        $data->save();
                    }
                } else {
                    array_push($error, $data->klasifikasi." | ".$data->id." ==> ".$id_diklat->message);
                }
            }
            $end = date('Y-m-d H:i:s');
            $lama = strtotime($now);
            $baru = strtotime($end);
            $diff = $baru - $lama;
            $this->info("\nSelesai dalam ".number_format($diff, 0, ",", ".")." detik");
            if(!count($error) < 1) {
                $name = "log_".date('Ymd_His').".txt";
                $error = implode("\n", $error);
                Storage::disk('local')->put($name, $error);
            }
        } else {
            $this->info("== DATA DIKLAT TERUPDATE ==");
        }
    }
}
