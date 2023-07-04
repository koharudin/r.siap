<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Admin\Controllers\DaftarPegawaiController;
use App\Models\Agama;
use Doctrine\DBAL\Schema\Index;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Router;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/test', function () {
    $minio = Storage::disk('minio');
    //$contents = $minio->imagePreviewUrl('images/upin-ipin.jpg');
    
    $url = $minio->temporaryUrl(
        'images/upin-ipin.jpg', now()->addMinutes(5)
    );

    return $url;
});

Route::group([
   // 'middleware'    => config('admin.route.middleware')
], function (Router $router) {
   
});