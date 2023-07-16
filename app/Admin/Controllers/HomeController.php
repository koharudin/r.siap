<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('Dashboard')
            ->description('Description...')
            ->row(Dashboard::title())
            ->row(function (Row $row) {

                $row->column(4, function (Column $column) {
                    $column->append(self::user_profile()); 
                });
            });
    }
    protected static function user_profile()
    {
        $user = Auth::user();
        $roles = $user->roles->pluck('name');
        $roles = implode(',',$roles->toArray());
        $envs = [
            ['name' => 'Username',       'value' => $user->username],
            ['name' => 'Nama',       'value' => $user->name],
            ['name' => 'Roles',       'value' => $roles],
        ];

        return view('admin::dashboard.environment', compact('envs'));
    }
}
