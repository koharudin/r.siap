<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\DetailPegawaiAction;
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

class StatistikController extends Controller
{
    public $title  = 'Data Statistika';
    public function index(Content $content)
    {
        $box = new Box(""," ");
        return $content
            ->title($this->title)
            ->body($box);
    }
}