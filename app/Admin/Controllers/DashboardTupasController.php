<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;
use App\Models\Employee;


class DashboardTupasController extends AdminController
{
    public function index(Content $content)
    {
        return $content
            ->header('Dashboard TUPAS ANRI')
            ->description('Perhitungan Tunjangan Arsip Statis ANRI')
            ->breadcrumb(['text' => 'Dashboard TUPAS'])
            ->body('Jumlah Nominal Tunjangan yang harus dibayarkan')
            ->row(function (Row $row) {
                $row->column(6, 'Statistik Nilai Masa Kerja');
                $row->column(6, 'Statistik Nilai Unit Kerja');
            });
    }
}