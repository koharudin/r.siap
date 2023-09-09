<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use Illuminate\Support\Facades\Storage;

class SiasnController extends Controller
{
    public function token_api()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://apimws.bkn.go.id/oauth2/token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'grant_type=client_credentials',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded',
                'Authorization: Basic ZmpjWktiUHE1WmpYUEhlbzNxSXZmQVJ1UU9JYTppWTJvUTV2NE1HcHJjR0lndlNCUXdUSHlWcEVh',
                'Cookie: pdns=1091068938.58148.0000'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($response);
        return $result->access_token;
    }

    public function token_login()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://sso-siasn.bkn.go.id/auth/realms/public-siasn/protocol/openid-connect/token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'client_id=anriclient&grant_type=password&username=199803262020121005&password=False1',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded',
                'Cookie: SERVERID=keycloak-02|ZO//Y|ZO/8o'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($response);
        return $result->access_token;
    }

    public function data_pns($nip, $token_login, $token_api)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://apimws.bkn.go.id:8243/apisiasn/1.0/pns/data-utama/'.$nip,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'accept: application/json',
                'Auth: bearer '.$token_login,
                'Authorization: Bearer '.$token_api,
                'Cookie: ff8d625df24f2272ecde05bd53b814bc=7c6816a8a1345ca8e9de6abab7a03a27; pdns=1091068938.13088.0000'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($response);
        return $result;
    }

    public function save_diklat($id, $instansiId, $institusiPenyelenggara, $jenisDiklatId, $jumlahJam, $namaKursus, $nomorSertipikat,
        $pnsOrangId, $tahunKursus, $tanggalKursus, $tanggalSelesaiKursus, $token_login, $token_api)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://apimws.bkn.go.id:8243/apisiasn/1.0/kursus/save',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode([
                "id" => $id,
                "instansiId" => $instansiId,
                "institusiPenyelenggara" => $institusiPenyelenggara,
                "jenisDiklatId" => $jenisDiklatId,
                "jumlahJam" => $jumlahJam,
                "namaKursus" => $namaKursus,
                "nomorSertipikat" => $nomorSertipikat,
                "pnsOrangId" => $pnsOrangId,
                "tahunKursus" => $tahunKursus,
                "tanggalKursus" => $tanggalKursus,
                "tanggalSelesaiKursus" => $tanggalSelesaiKursus
            ]),
            CURLOPT_HTTPHEADER => array(
                'accept: application/json',
                'Auth: bearer '.$token_login,
                'Content-Type: application/json',
                'Authorization: Bearer '.$token_api,
                'Cookie: ff8d625df24f2272ecde05bd53b814bc=6f8f0bbd43d57a472988156061717ab2; pdns=1091068938.13088.0000'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($response);
        return $result;
    }

    public function upload_dok_rw($file, $id_ref_dokumen, $id_riwayat, $token_login, $token_api) {
        $disk = Storage::disk('minio_dokumen')->get($file);
        $tempFilePath = tempnam(sys_get_temp_dir(), 'temp-file-');
        $tempName = substr($tempFilePath, strrpos($tempFilePath, "/") + 1);
        file_put_contents($tempFilePath, $disk);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://apimws.bkn.go.id:8243/apisiasn/1.0/upload-dok-rw',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => array(
                'id_riwayat' => $id_riwayat,
                'id_ref_dokumen' => $id_ref_dokumen,
                'file' => new \CURLFile($tempFilePath, 'application/pdf', $tempName.'.pdf')
            ),
            CURLOPT_HTTPHEADER => array(
                'accept: application/json',
                'Auth: bearer '.$token_login,
                'Content-Type: multipart/form-data',
                'Authorization: Bearer '.$token_api,
                'Cookie: ff8d625df24f2272ecde05bd53b814bc=eeb0fca813502b0c7e460bd92e553764; pdns=1091068938.13088.0000'
            ),
        ));
        $response = curl_exec($curl);
        unlink($tempFilePath);
        curl_close($curl);
        $result = json_decode($response);
        return $result;
    }
}
