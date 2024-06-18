<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller
{
    //
    public function index(){
        echo 123;
    }

    public function testUpload(){
       
        $disk_layanan = Storage::disk("minio_layanan");
        $files = request()->file("files");
        foreach($files as $file){
            $ext = ".".$file->getClientOriginalExtension();
            $randomFileName = md5(uniqid()).$ext;
            $disk_layanan->putFileAs("/",$file,$randomFileName);
        }
        
       // $disk_layanan->put($randomFileName,"andin anak solehah");
        return response()->json("jumlah file " .(sizeof($files)));
    }
}
