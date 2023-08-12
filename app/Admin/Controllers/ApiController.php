<?php

namespace App\Admin\Controllers;

use App\Models\Diklat;
use App\Models\Employee;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Http\Request;

class ApiController extends AdminController
{
    public function list_employees(Request $request)
    {
        $q = $request->get('q');
        $d = Employee::where('first_name', 'ilike', "%$q%")->paginate(null);
        $lis = [];
        $d = $d->toArray();
        foreach($d['data'] as $k=>$item){
            $lis [] = [
                'id'=>$item['id'],
                'text'=>$item['first_name']." - <b>{$item['nip_baru']}</b>"
            ];
        }
        $d['data'] = $lis;
        return $d;
    }
}
