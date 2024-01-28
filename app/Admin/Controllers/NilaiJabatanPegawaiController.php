<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Employee;

class NilaiJabatanPegawaiController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Nilai Jabatan Pegawai';
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {

        $grid = new Grid(new Employee());
        $grid->header(function ($query) {
            return '
            <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>Nilai Jabatan</h4>
                    <p>Perhitungan Nilai Jabatan Tunjangan Arsip Statis Merujuk Peraturan Kepala Arsip Nasional Republik Indonesia No 2 Tahun 2005</p>
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
                                                    <th>Unit Kerja</th>
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
        $grid->model()->where(function ($query) {
            $query->whereIn('status_pegawai_id', [2, 23]);
        })->with(['obj_riwayat_jabatan', 'obj_riwayat_skcpns']);
        $grid->filter(function ($filter) {

            $filter->disableIdFilter();
            $filter->equal('status_pegawai_id', 'Status Pegawai')->select([2 => 'PNS', 23 => 'PPPK']);
            $filter->ilike('first_name', 'Nama Pegawai');
        });

        $grid->model()->with(['obj_riwayat_jabatan', 'obj_riwayat_skcpns']);
        $grid->column('first_name', __('Nama Pegawai'))->sortable();
        $grid->column('latest_skcpns', __('Awal Masuk ANRI'))->display(function () {
            $latestSKCPNS = $this->obj_riwayat_skcpns->sortByDesc('tgl_sk')->first();

            // Menggunakan optional() untuk memastikan $latestSKCPNS or $latestSKCPNS->tgl_sk = null
            return optional($latestSKCPNS)->tgl_sk ? $latestSKCPNS->tgl_sk->format('Y-m-d') : '-';
        });
        $grid->column('status_pegawai_id', __('Status Pegawai'))->display(function () {

            if ($this->status_pegawai_id == 2) {
                return 'PNS';
            } elseif ($this->status_pegawai_id == 23) {
                return 'PPPK';
            }
        })->sortable();
        $grid->column('lama_kerja', __('Lama Bekerja'))->display(function () {
            $latestSKCPNS = $this->obj_riwayat_skcpns->sortByDesc('tgl_sk')->first();
            if ($latestSKCPNS) {
                $cpnsDate = $latestSKCPNS->tgl_sk;
                $now = now();

                $lengthOfService = $cpnsDate->diff($now);

                return $lengthOfService->format('%y tahun, %m bulan, %d hari');
            }
            return '-';
        });
        $grid->column('nilai_masa_kerja', __('Nilai Masa Kerja'))->display(function () {
            $latestSKCPNS = $this->obj_riwayat_skcpns->sortByDesc('tgl_sk')->first();
            if ($latestSKCPNS) {
                $cpnsDate = $latestSKCPNS->tgl_sk;
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