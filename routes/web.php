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

use App\Models\Administrator;
use App\Models\Agama;
use App\Models\DokumenPegawai;
use Carbon\Carbon;
use Doctrine\DBAL\Schema\Index;
use Encore\Admin\Facades\Admin;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use MBence\OpenTBSBundle\Services\OpenTBS;
use App\Mnvx\Unoconv\Converter;
use App\Mnvx\Unoconv\UnoconvParameters;
use App\Mnvx\Unoconv\Format;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;
use Dompdf\Dompdf;

use NcJoes\OfficeConverter\OfficeConverter;
use Symfony\Component\Process\Process;

Route::get('/', function () {
    return redirect('/admin');
});
Route::get('/test-dom1', function () {
    $file = base_path() . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'drh_singkat.docx';
    $phpWord = IOFactory::load($file);

    //$pdf = PDF::loadView('view', compact('phpWord'))->save('path/to/file.pdf');
    $domPdfPath = base_path('vendor/dompdf/dompdf');
    Settings::setPdfRendererPath($domPdfPath);
    Settings::setPdfRendererName('DomPDF');
    $PDFWriter = IOFactory::createWriter($phpWord, 'PDF');
    $PDFWriter->save(public_path('new-result.pdf'));
});
Route::get('/test-dom2', function () {
    $file = base_path() . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'drh_singkat.docx';
    $phpWord = IOFactory::load($file);
    $domPdfPath = base_path('vendor/dompdf/dompdf');
    Settings::setPdfRendererPath($domPdfPath);
    Settings::setPdfRendererName('DomPDF');
    $phpWord->save('cek.pdf', 'PDF');
});
Route::get('/test-unoconv2', function () {
    $file = base_path() . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'drh_singkat.docx';
    $command = 'unoconv -o d:\test123.pdf -f pdf ' . $file;
    exec($command, $output);
    dd(123);
});
Route::get('/test-unoconv3', function () {
    $file = base_path() . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'drh_singkat.docx';
    $process = Process::fromShellCommandline('unoconv', null,[
        'APP_ENV' => false,
    'SYMFONY_DOTENV_VARS' => false,
        'ENV_VAR_NAME' => 'value']);
        $process = new Process(['ls', '-lsa']);
    $process->run(function ($type, $buffer): void {
        if (Process::ERR === $type) {
            echo 'ERR > ' . $buffer;
        } else {
            echo 'OUT > ' . $buffer;
        }
    });
});
Route::get('/test-unoconv', function () {

    // Create converter
    $converter = new Converter();
    $file = base_path() . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'drh_singkat.docx';
    // Describe parameters for converter
    $parameters = (new UnoconvParameters())
        // HTML document as string on input
        //->setInputStream('<!DOCTYPE html><html>Example of HTML document</html>')
        // Result file name
        ->setInputFile($file)
        ->setOutputFile('path-to-result-docx.pdf')
        // Format of result document is docx
        ->setOutputFormat(Format::FORMAT_TEXT_PDF);

    // Run converter
    $converter->convert($parameters);
});
Route::get('/test-conv1', function () {

    $file = base_path() . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'drh_singkat.docx';
    $converter = new OfficeConverter($file);
    $converter->convertTo('output-file.pdf'); //generates pdf file in same directory as test-file.docx
});
Route::get('/test-opentbs', function () {
    $TBS = new OpenTBS();
    \Carbon\Carbon::setLocale('id');
    // load your template
    $file = base_path() . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'drh_singkat.docx';
    $TBS->LoadTemplate($file);
    $TBS->MergeField('e', array('nip' => 'Test'));
    $today = Carbon::now()->isoFormat('dddd, D MMMM Y');
    $TBS->MergeField('o', array('date' => $today));
    // send the file
    $TBS->Show(OPENTBS_FILE, 'drh2.docx');
});
Route::get('/d', function () {
    $doc = DokumenPegawai::where('id', request('id'))->get()->first();
    return Storage::disk('minio_dokumen')->response($doc->file);
});
Route::get('/test', function () {
    $minio = Storage::disk('minio');
    //$contents = $minio->imagePreviewUrl('images/upin-ipin.jpg');

    $url = $minio->temporaryUrl(
        'images/upin-ipin.jpg',
        now()->addMinutes(5)
    );

    return $url;
});

function getUserId()
{
    $o_token = json_decode(session('sso_token'), true);
    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $o_token['access_token']
    ])->get(env('SSO_USER_URL'), []);
    if ($response->ok()) {
        return $response->json('user_id');
    }
}
Route::middleware(['web'])->get('/test-login2', function () {
    $user = Administrator::where('id', 1)->get()->first();
    //Auth::login($user);
    //Auth::guard('admin')->login($user);
    dd(session()->all());
});
Route::group([
    'middleware'    => []
], function (Router $router) {
    $router->get('/admin/test-login', function (Request $request) {
        $user = Administrator::where('id', 2)->get()->first();
        auth()->guard('admin')->login($user, true);
        // dd(auth()->guard('admin'));
        //Auth::guard('admin')->login($user);
        //Auth::guard('admin')->login($user);
        //Auth::guard('admin')->setUser($user);
        // dd(Auth::user());
        //dd($request->session());
        //dd(session()->all());
    });
    $router->get('/test-token', function () {
        $user = Administrator::where('id', getUserId())->get()->first();
        Auth::login($user);
        return redirect(route('admin.home'));
    });
    $router->get('/auth-mediakolaborasi-sso', function () {
        $code = request('code');
        if ($code) {
            $response = Http::withHeaders([])->post(env('SSO_TOKEN_URL'), [
                'grant_type' => 'authorization_code',
                'client_id' => env('SSO_CLIENT_ID'),
                'client_secret' => env('SSO_CLIENT_SECRET'),
                'code' => $code
            ]);
            if ($response->ok()) {
                $access_token = $response->json('access_token');
                request()->session()->put('sso_token', $response->body());
                session(['sso_token' => $response->body()]);
                $user = Administrator::where('id', getUserId())->get()->first();
                auth()->guard('admin')->login($user, true);
                return redirect(route('admin.home'));
            }
        }
        $params = [];
        $params['client_id'] = env('SSO_CLIENT_ID');
        $params['response_type'] = 'code';
        $params['state'] = md5(uniqid('sso_state'));

        return redirect(env('SSO_AUTHORIZE_URL') . "?" . http_build_query($params));
    })->name('auth.sso');
});
