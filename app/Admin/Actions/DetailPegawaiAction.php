<?php

namespace App\Admin\Actions;

use Encore\Admin\Actions\RowAction;
use Illuminate\Support\Facades\URL;

class DetailPegawaiAction extends RowAction
{
    public $name = 'Profile Pegawai';

    /**
     * @return  string
     */
    public function href()
    {
        return URL::to(config('admin.route.prefix')."/profile/". $this->getKey()."/data_personal");
    }
}