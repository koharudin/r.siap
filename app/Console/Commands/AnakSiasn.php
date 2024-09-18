<?php

namespace App\Console\Commands;

use App\Helpers\AppHelper;
use Illuminate\Console\Command;
use App\Models\Employee;
use App\Admin\Controllers\SiasnController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use DateTime;

class AnakSiasn extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string 
     */
    protected $signature = 'integrasi:anaksiasn';

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
        $employee = Employee::whereIn('status_pegawai_id', [1,2,23])->get();
        $total = count($employee);
        $this->info("Total Pegawai ".$total."\n");
        if(!$total < 1) {
            $token_api = SiasnController::token_api();
            $token_login = SiasnController::token_login();
            foreach($employee as $data) {
                $total--;
                $nip = $data->nip_baru;
                $this->info("Sekarang NIP ".$nip." dan Total Pegawai ".$total."\n");
                $id_anak = SiasnController::data_anak($nip, $token_login, $token_api);
                while($id_anak['code'] == 401) {
                    $token_api = SiasnController::token_api();
                    $token_login = SiasnController::token_login();
                    $id_anak = SiasnController::get_anak($nip, $token_login, $token_api);
                }
                $response = $id_anak['response'];
                if(isset($response->code) and $response->code == 1) {
                    $listAnak = $response->data->listAnak;
                    if(!empty($listAnak)) {
                        foreach($listAnak as $data2) {
                            $employee_id = $data->id;
                            $nama_anak = $data2->nama;
                            $tempatlahir_anak = $data2->tempatLahir;
                            $tgllahir_anak = (new DateTime($data2->tglLahir))->format('Y-m-d');
                            $jeniskelamin_anak = $data2->jenisKelamin;
                            $jenisanak_anak = $data2->jenisAnak;
                            $ayahid_anak = $data2->ayahId;
                            $ibuid_anak = $data2->ibuId;
                            $kabupatenid_anak = $data2->kabupatenId;
                            $id_anak = $data2->id;
                            
                            DB::table('anak_siasn')->insert([
                                'employee_id' => $employee_id,
                                'nama_anak' => $nama_anak,
                                'tempatlahir_anak' => $tempatlahir_anak,
                                'tgllahir_anak' => $tgllahir_anak,
                                'jeniskelamin_anak' => $jeniskelamin_anak,
                                'jenisanak_anak' => $jenisanak_anak,
                                'ayahid_anak' => $ayahid_anak,
                                'ibuid_anak' => $ibuid_anak,
                                'kabupatenid_anak' => $kabupatenid_anak,
                                'id_anak' => $id_anak,
                            ]);
                        }
                    }
                }
            }
        }
        $this->info("Selesai");
    }
}
