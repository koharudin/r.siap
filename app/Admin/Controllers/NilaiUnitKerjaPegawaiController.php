<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Employee;
use App\Models\UnitKerja;

class NilaiUnitKerjaPegawaiController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Nilai Pegawai di Unit Kerja';
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
        })->with(['obj_satker']);
        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->equal('unit_id', 'Unit Kerja Saat Ini')->select(UnitKerja::all()->pluck('name_with_parent', 'id'));
            $filter->equal('status_pegawai_id', 'Status Pegawai')->select([2 => 'PNS', 23 => 'PPPK']);
            $filter->ilike('first_name', 'Nama Pegawai');
        });
        $grid->model()->with(['obj_satker']);
        $grid->header(function ($query) {
            return '
            <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>Nilai Masa Kerja</h4>
                    <p>Perhitungan Nilai Masa Kerja Tunjangan Arsip Statis Merujuk Peraturan Kepala Arsip Nasional Republik Indonesia No 2 Tahun 2005</p>
                </div>
            </div>
        
            <div class="row">
                <div class="col-md-12">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                            <button class="btn" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                            Lihat Nilai
                            </button>
                                <div class="collapse" id="collapseExample">
                                    <div class="mt-3">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Masa Kerja</th>
                                                    <th>Range Masa Kerja</th>
                                                    <th>Nilai</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>>0 s.d 4 tahun</td>
                                                    <td>00 tahun 0 bulan 1 hari</td>
                                                    <td>40</td>
                                                </tr>
                                                <tr>
                                                    <td>>4 s.d 8 tahun</td>
                                                    <td>04 tahun 0 bulan 1 hari</td>
                                                    <td>140</td>
                                                </tr>
                                                <tr>
                                                    <td>>8 s.d 12 tahun</td>
                                                    <td>08 tahun 0 bulan 1 hari</td>
                                                    <td>225</td>
                                                </tr>
                                                <tr>
                                                    <td>>12 s.d 16 tahun</td>
                                                    <td>12 tahun 0 bulan 1 hari</td>
                                                    <td>295</td>
                                                </tr>
                                                <tr>
                                                    <td>>16 s.d 20 tahun</td>
                                                    <td>16 tahun 0 bulan 1 hari</td>
                                                    <td>355</td>
                                                </tr>
                                                <tr>
                                                    <td>>20 s.d 28 tahun</td>
                                                    <td>20 tahun 0 bulan 1 hari</td>
                                                    <td>400</td>
                                                </tr>
                                                <tr>
                                                    <td>>24 s.d 28 tahun</td>
                                                    <td>24 tahun 0 bulan 1 hari</td>
                                                    <td>430</td>
                                                </tr>
                                                <tr>
                                                    <td>>28 tahun</td>
                                                    <td>28 tahun 0 bulan 1 hari</td>
                                                    <td>450</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        ';
        });
        $grid->column('first_name', __('Nama Pegawai'))->display(function ($o) {
            return $this->first_name . " <br> " . $this->nip_baru;
        })->sortable();
        $grid->column('obj_satker', __('Unit Kerja'))->display(function () {
            $unitInfo = '';

            if ($this->obj_satker) {
                $unitInfo .= $this->obj_satker->id . " - " . $this->obj_satker->name;

                $parentUnit = $this->obj_satker->parent;

                if ($parentUnit) {
                    $parentUnitName = $parentUnit->name ?? '';
                    $unitInfo .= " <br/>- " . $parentUnitName;
                }
            }

            return $unitInfo ?: '-';
        })->label('Unit Info');

        $grid->column('status_pegawai_id', __('Status Pegawai'))->display(function () {

            if ($this->status_pegawai_id == 2) {
                return 'PNS';
            } elseif ($this->status_pegawai_id == 23) {
                return 'PPPK';
            }
        })->sortable();
        $grid->column('lama_kerja', __('Lama Bekerja'))->display(function () {
            $latestSKCPNS = $this->obj_riwayat_skcpns->sortByDesc('tmt_cpns')->first();
            if ($latestSKCPNS) {
                $cpnsDate = $latestSKCPNS->tmt_cpns;
                $now = now();

                $lengthOfService = $cpnsDate->diff($now);

                return $lengthOfService->format('%y tahun, %m bulan, %d hari');
            }
            return '-';
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

            return '-';
        });


        $grid->disableActions();
        $grid->disableCreateButton();
        return $grid;
    }
}