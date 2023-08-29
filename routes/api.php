<?php

use App\Models\Pangkat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/kedudukan_pernikahan',function (Request $request) {
    $ls = config('app.sistem.kedudukan_pernikahan');
    $l = [];
    foreach($ls  as $k=>$v){
        $l[] = [
            'id'=>$k,
            'text'=>$v
        ];
    }
    return ['data'=>$l];
});
Route::get('/list_pangkat',function (Request $request) {
    $ls = Pangkat::all();
    $l = [];
    foreach($ls  as $r){
        $l[] = [
            'id'=>$r->id,
            'text'=>$r->text
        ];
    }
    return ['data'=>$l];
});