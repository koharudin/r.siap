<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Presensi\JenisCuti as PresensiJenisCuti;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('Dashboard')
            ->row(Dashboard::title())
            ->row(function (Row $row) {

                $row->column(4, function (Column $column) {
                    $column->append(self::user_profile()); 
                });
            })
	    ->row(function (Row $row) {

                $row->column(12, function (Column $column) {
                    $column->append(self::statistik_chart()); 
                });
            });
    }
    protected static function user_profile()
    {
        $user = Auth::user();
        $roles = $user->roles->pluck('name');
        $roles = implode(',',$roles->toArray());
        $envs = [
            ['name' => 'Username',       'value' => $user->username],
            ['name' => 'Nama',       'value' => $user->name],
            ['name' => 'Roles',       'value' => $roles],
        ];

        return view('admin::dashboard.environment', compact('envs'));
    }
    protected static function statistik_chart(){
        return view('admin::dashboard.statistik');
    }

    public function download_dokumen($f) {
        $file = base64_decode($f);
        $disk = Storage::disk("minio_dokumen");
        if($disk->exists($file)) {
           return $disk->response($file);
        }
        else abort(404);
    }
    public function download_foto($f){
        $file = base64_decode($f);
        $disk = Storage::disk("minio_foto");
        if($disk->exists($file)){
           return $disk->response($file);
        }
        else abort(404);
    }
    public function absensi(Content $content){
        return PresensiJenisCuti::all();
        //return $content->body('Ho');
    }
}
