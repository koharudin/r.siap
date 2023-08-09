<?php

namespace App\Admin\Forms\Requests;


use App\Models\Employee;
use App\Models\RiwayatUsulan;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Form\Builder;
use Encore\Admin\Form\Field;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FormBuilder extends Builder {
    public function getForm(){
        return $this->form;
    }
}