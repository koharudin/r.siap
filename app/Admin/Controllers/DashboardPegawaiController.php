<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\DetailPegawaiAction;
use App\Admin\Controllers\ProfilePegawai\DataPersonalController;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DashboardPegawaiController extends Controller
{
    public $title  = 'Dashboard Pegawai';
    public function index(Content $content)
    {
        $dp = new DataPersonalController();
        return $dp->index($content);
    }
}