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
        $ext = ".txt";
        $randomFileName = md5(uniqid()).$ext;
        $disk_layanan = Storage::disk("minio_layanan");
        $file = request()->file("cek");
        $disk_layanan->putFileAs("/",$file,"axx.jpg");
        $disk_layanan->put($randomFileName,"andin anak solehah");
        return response()->json(request());
    }
}
