<?php

use App\Admin\Forms\Profile\FormRiwayatPendidikan;
use App\Admin\Forms\Requests\FormRiwayatPendidikan as RequestsFormRiwayatPendidikan;
use App\Models\Administrator;
use App\Models\Employee;
use App\Models\RiwayatAnak;
use App\Models\RiwayatNikah;
use App\Models\RiwayatOrangTua;
use App\Models\RiwayatUsulan;
use Encore\Admin\Facades\Admin;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('bkn-data-utama-training', function () {
    $this->info('integrasi siasn');
    $this->username = '199803262020121005';
    $this->password = 'False1';
    $this->sandbox_consumer_key = '2n1qXZdD6c3ROAeLSiEuQdXJS3Ma';
    $this->sandbox_consumer_secret = 'pvteqPbGSRTfrzzTryjvhv7Fxaca';
    $this->application_name = 'siap-siasn';

    $client = new GuzzleHttp\Client(['defaults' => [
        'verify' => false
    ]]);
    $response = $client->request('GET', 'https://training-apimws.bkn.go.id:8243/api/1.0/pns/data-utama/199803262020121005', [
        'headers' => [
            'Authorization' => "Bearer ". env('BKN_TRAINING_ACCESS_TOKEN')
        ],
    ]);
    $this->info($response->getBody());
});
Artisan::command('bkn-token2-training', function () {
    $this->info('integrasi siasn');
    $this->username = '199803262020121005';
    $this->password = 'False1';
    $this->sandbox_consumer_key = '2n1qXZdD6c3ROAeLSiEuQdXJS3Ma';
    $this->sandbox_consumer_secret = 'pvteqPbGSRTfrzzTryjvhv7Fxaca';
    $this->application_name = 'siap-siasn';

    $client = new GuzzleHttp\Client(['defaults' => [
        'verify' => false
    ]]);
    $response = $client->request('POST', 'https://training-apimws.bkn.go.id/oauth2/token', [
        'headers' => [
            'Authorization' => "Basic ".base64_encode($this->sandbox_consumer_key.":".$this->sandbox_consumer_secret)
        ],
        'form_params' => [
            'grant_type' => 'password',
            'username'=>$this->username,
            'password'=>$this->password
        ]
    ]);
    $this->info($response->getBody());
});

Artisan::command('bkn-token-training', function () {
    $this->info('integrasi siasn');
    $this->username = '199803262020121005';
    $this->password = 'False1';
    $this->sandbox_consumer_key = '2n1qXZdD6c3ROAeLSiEuQdXJS3Ma';
    $this->sandbox_consumer_secret = 'pvteqPbGSRTfrzzTryjvhv7Fxaca';
    $this->application_name = 'siap-siasn';

    $client = new GuzzleHttp\Client(['defaults' => [
        'verify' => false
    ]]);
    $response = $client->request('POST', 'https://training-apimws.bkn.go.id/oauth2/token', [
        'headers' => [
            'Authorization' => "Basic ".base64_encode($this->sandbox_consumer_key.":".$this->sandbox_consumer_secret)
        ],
        'form_params' => [
            'grant_type' => 'client_credentials',
        ]
    ]);
    $this->info($response->getBody());
});

Artisan::command('bkn-data-utama-production', function () {
    $this->info('integrasi siasn');
    $this->username = '
    ';
    $this->password = 'False1';
    $this->sandbox_consumer_key = 'iqHiRpzAfo2_bbumAppsvNqJkIka';
    $this->sandbox_consumer_secret = 'MjQH3Ybe8wbCzjqgPkKemPsVE1Ya';
    $this->application_name = 'siap-siasn';

    $client = new GuzzleHttp\Client(['defaults' => [
        'verify' => false
    ]]);
    $response = $client->request('GET', 'https://apimws.bkn.go.id/api/1.0/pns/data-utama/199803262020121005', [
        'headers' => [
            'Authorization' => "Bearer "."eyJ4NXQiOiJNell4TW1Ga09HWXdNV0kwWldObU5EY3hOR1l3WW1NNFpUQTNNV0kyTkRBelpHUXpOR00wWkdSbE5qSmtPREZrWkRSaU9URmtNV0ZoTXpVMlpHVmxOZyIsImtpZCI6Ik16WXhNbUZrT0dZd01XSTBaV05tTkRjeE5HWXdZbU00WlRBM01XSTJOREF6WkdRek5HTTBaR1JsTmpKa09ERmtaRFJpT1RGa01XRmhNelUyWkdWbE5nX1JTMjU2IiwiYWxnIjoiUlMyNTYifQ.eyJzdWIiOiIxOTk4MDMyNjIwMjAxMjEwMDUiLCJhdXQiOiJBUFBMSUNBVElPTiIsImF1ZCI6ImlxSGlScHpBZm8yX2JidW1BcHBzdk5xSmtJa2EiLCJuYmYiOjE2OTE5MDQyMzIsImF6cCI6ImlxSGlScHpBZm8yX2JidW1BcHBzdk5xSmtJa2EiLCJzY29wZSI6ImRlZmF1bHQiLCJpc3MiOiJodHRwczpcL1wvbG9jYWxob3N0Ojk0NDNcL29hdXRoMlwvdG9rZW4iLCJleHAiOjE2OTE5MDc4MzIsImlhdCI6MTY5MTkwNDIzMiwianRpIjoiZDNmYzU3NTYtMWNlZi00OWE4LWEwMmMtMTE5NWUyYzllYzgxIn0.Vj64CXfFLVc3dqbXenv1RLdmpp1Fqx4d-C1w-VhYxzx_wR8KqU_pvnLvY2dT1O6u6-2AOWZ7LCRqJ9Bv-ZRhn1MoygZ1OESQlmHg_Qhq2Q9CZbsUgDGNs4e5mQTKvPQEr5nGlqq1V2zvX_uWvXS_o2mCJ8HAhumgm_dRkFgdzJRxgia3ZRPAj-66ph9kNab3dPQ2LVuXielVio0XCpZgWp7dZv3zwCcNMLZTXZ17WSzAFtvt_qCW6nLpJQGcgXMvrQF0ghMz5xP7eKeK7jYPNL3zg7h_8iW51Y2Jl6gfphSbK2Y5U94rLL7Y0jSEKWGrO8aU12k83qhLaDnv5JdVzw"
        ],
    ]);
    $this->info($response->getBody());
});

Artisan::command('bkn-token-production', function () {
    $this->info('integrasi siasn');
    $this->username = '199803262020121005';
    $this->password = 'False1';
    $this->sandbox_consumer_key = 'iqHiRpzAfo2_bbumAppsvNqJkIka';
    $this->sandbox_consumer_secret = 'MjQH3Ybe8wbCzjqgPkKemPsVE1Ya';
    $this->application_name = 'siap-siasn';

    $client = new GuzzleHttp\Client(['defaults' => [
        'verify' => false
    ]]);
    $response = $client->request('POST', 'https://apimws.bkn.go.id/oauth2/token', [
        'headers' => [
            'Authorization' => "Basic ".base64_encode($this->sandbox_consumer_key.":".$this->sandbox_consumer_secret)
        ],
        'form_params' => [
            'grant_type' => 'client_credentials',
        ]
    ]);
    $this->info($response->getBody());
});

Artisan::command('demo', function () {
    $this->info("Random");
    $faker = Faker\Factory::create();
    $ls = Employee::all();
    $user = Administrator::find(1);
    $user->password_x = md5("demo");
    $user->save();
    foreach($ls as $e){
        $e->first_name = $faker->name;
        $e->email_kantor = $faker->email;
        $e->email = $faker->email;
        $e->birth_date = $faker->date;
        $e->karpeg = $faker->numberBetween(4500,4900);
        $e->nik = $faker->numberBetween(2000000000,21000000000);
        $e->no_hp = "0821-1292-".$faker->numberBetween(1000,4444);
        $e->alamat = $faker->paragraph(1);
        $e->save();
    }
    $ls = RiwayatAnak::all();
    foreach($ls as $e){
        $e->name = $faker->name;
        $e->save();
    }

    $ls = RiwayatOrangTua::all();
    foreach($ls as $e){
        $e->name = $faker->name;
        $e->birth_date = $faker->date;
        $e->save();
    }
    $ls = RiwayatNikah::all();
    foreach($ls as $e){
        $e->name = $faker->name;
        $e->birth_date = $faker->date;
        $e->buku_nikah = "NKH/".$faker->numberBetween(2000,3000);
        $e->save();
    }
});
Artisan::command('cek', function () {
    $credentials['username'] = 'muhammad.zahrudin@anri.go.id';
    $user = config('admin.database.users_model')::whereHas('obj_employee',function($q)use($credentials){
        $q->where('email_kantor',$credentials['username']);
    })->get()->first();
    dd($user);
})->purpose('Display an inspiring quote');
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
Artisan::command('bup', function () {
    $ls = Employee::with(['obj_riwayat_jabatan','obj_riwayat_jabatan.obj_tipe_jabatan','obj_riwayat_jabatan.obj_jabatan_fungsional','obj_riwayat_jabatan.obj_jabatan_struktural'])->get()->all();
    foreach($ls as $e){
        $this->info("Pegawai ID : ".$e->id);
        $this->info("NIP : ".$e->nip_baru);
        $this->info("Pegawai > ".$e->first_name);
        //$bup = $e->getBup();
        //$this->info($bup);
        $this->info($e->setTanggalPensiun());
    }
})->purpose('Display an inspiring quote');