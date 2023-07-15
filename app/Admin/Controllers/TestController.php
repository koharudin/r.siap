<?php

namespace App\Admin\Controllers;

use App\Admin\Forms\FormRiwayatJabatan;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Layout\Content;

class TestController extends AdminController
{
    public function index(Content $content)
    {

    }
    public function form(){
        $form = new FormRiwayatJabatan();

        
        return $form;
    }
}
