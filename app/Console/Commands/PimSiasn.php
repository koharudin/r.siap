<?php

namespace App\Console\Commands;

use App\Helpers\AppHelper;
use Illuminate\Console\Command;
use App\Models\Employee;
use App\Admin\Controllers\SiasnController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use DateTime;

class PimSiasn extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string 
     */
    protected $signature = 'integrasi:pimsiasn';

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
        $employee = Employee::whereIn('status_pegawai_id', [2])->get();
        $total = count($employee);
        $this->info("Total Pegawai ".$total."\n");
        if(!$total < 1) {
            $token_api = SiasnController::token_api();
            $token_login = SiasnController::token_login();
            foreach($employee as $data) {
                $total--;
                $nip = $data->nip_baru;
                $this->info("Sekarang NIP ".$nip." dan Total Pegawai ".$total."\n");
                $id_pim = SiasnController::data_pim($nip, $token_login, $token_api);
                while($id_pim['code'] == 401) {
                    $token_api = SiasnController::token_api();
                    $token_login = SiasnController::token_login();
                    $id_pim = SiasnController::data_pim($nip, $token_login, $token_api);
                }
                $response = $id_pim['response'];
                if(isset($response->code) and $response->code == 1) {
                    $listPim = $response->data;
                    if(!empty($listPim)) {
                        foreach($listPim as $data2) {
                            $employee_id = $data->id;
                            $latihanStrukturalId = $data2->latihanStrukturalId;
                            $latihanStrukturalNama = $data2->latihanStrukturalNama;
                            $tahun = $data2->tahun;
                            
                            DB::table('pim_siasn')->insert([
                                'employee_id' => $employee_id,
                                'latihanStrukturalId' => $latihanStrukturalId,
                                'latihanStrukturalNama' => $latihanStrukturalNama,
                                'tahun' => $tahun,
                            ]);
                        }
                    }
                }
            }
        }
        $this->info("Selesai");
    }
}
