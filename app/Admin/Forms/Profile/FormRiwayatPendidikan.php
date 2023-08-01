<?php

namespace App\Admin\Forms\Profile;

use App\Http\Traits\FormRiwayatPendidikanTrait;
use App\Models\Pendidikan;
use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;

class FormRiwayatPendidikan extends Form
{
    use FormRiwayatPendidikanTrait;
    /**
     * The form title.
     *
     * @var string
     */
    public $title = '';

    /**
     * Handle the form request.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request)
    {
        //dump($request->all());

        admin_success('Processed successfully.');

        return back();
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $this->buildForm($this);
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
