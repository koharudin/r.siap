<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Employee;


class NilaiMasaKerjaPegawaiController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Nilai Masa Kerja Pegawai';
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {

        $grid = new Grid(new Employee());
        $grid->model()->where(function ($query) {
            $query->whereIn('status_pegawai_id', [2, 23]);
        })->with(['obj_riwayat_skcpns']);
        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->equal('status_pegawai_id', 'Status Pegawai')->select([2 => 'PNS', 23 => 'PPPK']);
            $filter->ilike('first_name', 'Nama Pegawai');
        });

        $grid->model()->with(['obj_riwayat_skcpns']);
        $grid->header(function ($query) {
            return view('admin.grid.nilai_masa_kerja_header');
        });

        $grid->column('first_name', __('Nama Pegawai'))->display(function ($o) {
            $statusLabel = ($this->status_pegawai_id == 2) ? 'PNS' : (($this->status_pegawai_id == 23) ? 'PPPK' : '');

            return $this->first_name . " <br> " . $this->nip_baru . "<br> ASN: " . $statusLabel;
        })->sortable();
        $grid->column('latest_skcpns', __('Awal Masuk ANRI'))->display(function () {
            $latestSKCPNS = $this->obj_riwayat_skcpns->sortByDesc('tmt_cpns')->first();

            // Menggunakan optional() untuk memastikan $latestSKCPNS or $latestSKCPNS->tmt_cpns tidak null, jika null, akan mengembalikan '-' karena $latestSKCPNS->tmt_cpns tidak ada
            return optional($latestSKCPNS)->tmt_cpns ? $latestSKCPNS->tmt_cpns->format('Y-m-d') : 'tmt_cpns/pppk kosong';
        });
        $grid->column('lama_kerja', __('Lama Bekerja'))->display(function () {
            $latestSKCPNS = $this->obj_riwayat_skcpns->sortByDesc('tmt_cpns')->first();
            if ($latestSKCPNS) {
                $cpnsDate = $latestSKCPNS->tmt_cpns;
                $now = now();

                $lengthOfService = $cpnsDate->diff($now);

                return $lengthOfService->format('%y tahun, %m bulan, %d hari');
            }
            return 0;
        });
        $grid->column('nilai_masa_kerja', __('Nilai Masa Kerja'))->display(function () {
            $latestSKCPNS = $this->obj_riwayat_skcpns->sortByDesc('tmt_cpns')->first();
            if ($latestSKCPNS) {
                $cpnsDate = $latestSKCPNS->tmt_cpns;
                $now = now();
                $lengthOfService = $cpnsDate->diff($now);
                $totalMonths = ($lengthOfService->y);

                $ranges = [
                    ['min' => 0, 'max' => 4, 'value' => 40],
                    ['min' => 4, 'max' => 8, 'value' => 140],
                    ['min' => 8, 'max' => 12, 'value' => 225],
                    ['min' => 12, 'max' => 16, 'value' => 295],
                    ['min' => 16, 'max' => 20, 'value' => 355],
                    ['min' => 20, 'max' => 28, 'value' => 400],
                    ['min' => 28, 'max' => 32, 'value' => 430],
                    ['min' => 32, 'max' => null, 'value' => 450],
                ];

                foreach ($ranges as $range) {
                    if (
                        ($range['max'] === null && $totalMonths >= $range['min']) ||
                        ($range['max'] !== null && $totalMonths >= $range['min'] && $totalMonths < $range['max'])
                    ) {
                        return $range['value'];
                    }
                }
            }

            return 0;
        });
        $grid->disableActions();
        $grid->disableCreateButton();
        return $grid;
    }
}