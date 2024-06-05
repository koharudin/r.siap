<?php

namespace App\Admin\Controllers;

use App\Models\RiwayatPangkat;
use App\Helpers\AppHelper;
use Illuminate\Support\Facades\Storage;

class SiasnController
{
    public function token_sso($refresh_token)
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
            CURLOPT_POSTFIELDS => 'client_id=anriclient&grant_type=refresh_token&refresh_token='.$refresh_token,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($response)->access_token;
        if(isset($result) && !empty($result)) {
            return true;
        } else {
            return false;
        }
    }

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

    public function get_rw_pangkat($nip, $token_login, $token_api) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://apimws.bkn.go.id:8243/apisiasn/1.0/pns/rw-golongan/'.$nip,
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
                'Cookie: ff8d625df24f2272ecde05bd53b814bc=8821d34c0d1927d954417f8d3dbccab0; pdns=1091068938.13088.0000'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($response);
        return $result;
    }

    public function get_nip_pangkat($id) {
        $id_pangkat = RiwayatPangkat::where('id', $id)->first();
        $token = new self();
        $token_api = $token->token_api();
        $token_login = $token->token_login();
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://apimws.bkn.go.id:8243/apisiasn/1.0/pns/rw-golongan/'.$id_pangkat->obj_pegawai->nip_baru,
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
                'Cookie: ff8d625df24f2272ecde05bd53b814bc=8821d34c0d1927d954417f8d3dbccab0; pdns=1091068938.13088.0000'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($response);
        if($result->code == 1) {
            foreach($result->data as $data) {
                if($data->id == $id_pangkat->id_siasn) {
                    $result = array(
                        "golongan" => $data->golongan,
                        "skNomor" => $data->skNomor,
                        "skTanggal" => $data->skTanggal,
                        "tmtGolongan" => date("d-m-Y", strtotime($data->tmtGolongan)),
                        "noPertekBkn" => $data->noPertekBkn,
                        "tglPertekBkn" => $data->tglPertekBkn,
                        "jumlahKreditUtama" => $data->jumlahKreditUtama,
                        "jumlahKreditTambahan" => $data->jumlahKreditTambahan,
                        "jenisKPNama" => $data->jenisKPNama,
                        "masaKerjaGolonganTahun" => $data->masaKerjaGolonganTahun,
                        "masaKerjaGolonganBulan" => $data->masaKerjaGolonganBulan,
                        "dok_uri" => (!empty($data->path)) ? reset($data->path)->dok_uri : ''
                    );
                    break;
                }
            }
        }
        return $result;
    }

    public function download_dok($id, $klasifikasi_id) {
        $api = new self();
        $id = base64_decode($id);
        $klasifikasi_id = base64_decode($klasifikasi_id);
        switch($klasifikasi_id) {
            case '5':
                $path = $api->get_nip_pangkat($id);
                $dok_uri = (!empty($path['dok_uri'])) ? $path['dok_uri'] : '';
                break;
            default:
                $dok_uri = '';
                break;
        }
        // print_r($dok_uri);
        // die();

        $token_api = $api->token_api();
        $token_login = $api->token_login();
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://apimws.bkn.go.id:8243/apisiasn/1.0/download-dok?filePath='.$dok_uri,
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
                'Cookie: ff8d625df24f2272ecde05bd53b814bc=c94513f399ed33bb608b90b1189b3cb9; pdns=1091068938.13088.0000'
            ),
        ));
        
        $response = curl_exec($curl);
        curl_close($curl);
        if(strpos($response, '%PDF') === 0) {
            header('Content-Type: application/pdf');
            echo $response;
        } else {
            // admin_error('Error', 'File tidak ada!');
            admin_toastr('File tidak ada!', 'error', ['timeOut' => 10000]);
            return redirect()->back();
        }
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

    public function download_data($id, $klasifikasi_id) {
        // $api = new self();
        // $token_api = $api->token_api();
        // $token_login = $api->token_login();
        // $id_siasn = base64_decode($id_siasn);
        // $klasifikasi_id = base64_decode($klasifikasi_id);
        // $nip = base64_decode($nip);
        switch($klasifikasi_id) {
            case '5':
                $id_data = RiwayatPangkat::where('id', $id)->first();
                break;
        }
        var_dump($id_data);
        die();

        // $curl = curl_init();
        // curl_setopt_array($curl, array(
        //     CURLOPT_URL => 'https://apimws.bkn.go.id:8243/apisiasn/1.0/download-dok?filePath='.$dok_uri,
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => '',
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 0,
        //     CURLOPT_FOLLOWLOCATION => true,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => 'GET',
        //     CURLOPT_HTTPHEADER => array(
        //         'accept: application/json',
        //         'Auth: bearer '.$token_login,
        //         'Authorization: Bearer '.$token_api,
        //         'Cookie: ff8d625df24f2272ecde05bd53b814bc=c94513f399ed33bb608b90b1189b3cb9; pdns=1091068938.13088.0000'
        //     ),
        // ));
        
        // $response = curl_exec($curl);
        // curl_close($curl);
        // header('Content-Type: application/pdf');
        // header('Content-Disposition: inline; filename="download.pdf"');
        // echo $response;
    }

    public function save_hukuman($id, $akhirHukumanTanggal, $alasanHukumanDisiplinId, $golonganId, $hukumanTanggal, $jenisHukumanId, $jenisTingkatHukumanId,
        $kedudukanHukumId, $masaBulan, $masaTahun, $nomorPp, $pnsOrangId, $skNomor, $skTanggal, $token_login, $token_api)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://apimws.bkn.go.id:8243/apisiasn/1.0/hukdis/save',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode([
                "id" => $id,
                "akhirHukumanTanggal" => $akhirHukumanTanggal,
                "alasanHukumanDisiplinId" => $alasanHukumanDisiplinId,
                "golonganId" => $golonganId,
                "hukumanTanggal" => $hukumanTanggal,
                "jenisHukumanId" => $jenisHukumanId,
                "jenisTingkatHukumanId" => $jenisTingkatHukumanId,
                "kedudukanHukumId" => $kedudukanHukumId,
                "masaBulan" => $masaBulan,
                "masaTahun" => $masaTahun,
                "nomorPp" => $nomorPp,
                "pnsOrangId" => $pnsOrangId,
                "skNomor" => $skNomor,
                "skTanggal" => $skTanggal,
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
}
