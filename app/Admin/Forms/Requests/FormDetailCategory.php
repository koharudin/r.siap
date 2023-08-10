<?php

namespace App\Admin\Forms\Requests;

use App\Models\KategoriLayanan;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Form;
use Encore\Admin\Widgets\StepForm;
use Illuminate\Http\Request;

class FormDetailCategory extends StepForm
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = 'Detail Kategori Layanan';

    /**
     * Handle the form request.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request)
    {
        $all = $this->all();
        $data = @$all['choose_kategori'];
        $kategori_layanan_id = @$data['kategori_layanan_id'];
        $url = route('admin.usulan.ajukan_baru.kategori',["id"=>$kategori_layanan_id]);
        return redirect($url);
    }
   
    /**
     * Build a form here.
     */
    public function buildForm()
    {
        $this->display('name','Nama Kategori');
        $this->display('deskripsi','Deskripsi');
    }

    /**
     * The data of the form.
     *
     * @return array $data
     */
    public function data()
    {
        $all = $this->all();
        $data = @$all['choose_kategori'];
        if($data){
            $kategori_layanan_id = @$data['kategori_layanan_id'];
            $kategori = KategoriLayanan::findOrFail($kategori_layanan_id);
            return [
                'name'       => $kategori->name,
            ];
        }
    }
}