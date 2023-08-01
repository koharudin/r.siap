<?php

namespace App\Admin\Forms\Requests;

use App\Models\KategoriLayanan;
use Encore\Admin\Widgets\StepForm;
use Illuminate\Http\Request;

class FormChooseCategory extends StepForm
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = 'Kategori Layanan';

    /**
     * Handle the form request.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request)
    {
        admin_success('Berhasil memilih kategori.');

        return $this->next($request->all());
    }
    
    /**
     * Build a form here.
     */
    public function form()
    {
        $this->select('kategori_layanan_id','Kategori Layanan')->options(KategoriLayanan::orderBy('order','asc')->get()->pluck('name','id'));
    }

    /**
     * The data of the form.
     *
     * @return array $data
     */
    public function data()
    {
        return [
            'name'       => 'John Doe',
            'email'      => 'John.Doe@gmail.com',
            'created_at' => now(),
        ];
    }
   
}
