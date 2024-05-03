<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Grid;
use Encore\Admin\Widgets\Box;
use App\Models\Employee;
use App\Models\RiwayatJabatan;
use App\Models\UnitKerja;

class NilaiJabatanPegawaiController extends AdminController
{
    protected $title = 'Nilai Jabatan Pegawai';

    protected function grid()
    {
        $grid = new Grid(new Employee());
        $grid->model()
            ->whereIn('status_pegawai_id', [2, 23])
            ->with(['obj_riwayat_jabatan']);

        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->equal('unit_id', 'Unit Kerja')->select(function () {
                $unitIds = Employee::whereIn('status_pegawai_id', [2, 23])->pluck('unit_id');
                $unitInfo = UnitKerja::whereIn('id', $unitIds)->get()->mapWithKeys(function ($unit) {
                    $unitName = $unit->name;
                    $parentName = optional($unit->parent)->name;
                    return [$unit->id => $unit->id . ' - ' . $unitName . ' - ' . $parentName];
                })->toArray();
                return $unitInfo;
            });
            $filter->equal('status_pegawai_id', 'Status Pegawai')->select([2 => 'PNS', 23 => 'PPPK']);
            $filter->ilike('first_name', 'Nama Pegawai');
        });

        $grid->header(function ($query) {

            return '<div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Nilai Jabatan</h4>
                                <p>Perhitungan Nilai Jabatan Tunjangan Arsip Statis Merujuk Peraturan Kepala Arsip Nasional Republik Indonesia No 2 Tahun 2005</p>
                                <div class="alert alert-danger" role="alert">
                                    <strong>Info:</strong> Penentuan Nilai Jabatan berdasarkan Jabatan Struktural, Arsiparis, Non-Arsiparis berdasarkan $nama_jabatan atau $jabatan_id di <a href="https://kepegawaian.anri.go.id/siap/admin/daftar_pegawai" target="_blank">Daftar bagian Riwayat Jabatan Pegawai</a>, serta Unit Kerja merujuk di <a href="https://kepegawaian.anri.go.id/siap/admin/daftar_pegawai" target="_blank">Daftar bagian Profile Unit Kerja Pegawai.</a>
                                </div>
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
                                                                <th>Struktural/ Arsiparis/ Non Arsiparis</th>
                                                                <th>Jabatan</th>
                                                                <th>Tanggung Jawab</th>
                                                                <th>Nilai</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Kepala ANRI</td>
                                                                <td>Struktural</td>
                                                                <td>Eselon I</td>
                                                                <td>Pengawas</td>
                                                                <td>150</td>
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
                    <br/>';
        });

        $grid->model()->with(['obj_riwayat_jabatan']);
        $grid->column('first_name', __('Nama Pegawai'))->display(function ($o) {
            $statusLabel = ($this->status_pegawai_id == 2) ? 'PNS' : (($this->status_pegawai_id == 23) ? 'PPPK' : '');
            return $this->first_name . " <br> " . $this->nip_baru . "<br> ASN: " . $statusLabel;
        })->sortable();

        $grid->column('latest_unit_info', __('Unit Kerja saat ini'))->display(function () {
            $unitId = $this->unit_id;
            $unit = UnitKerja::find($unitId);
            $unitName = $unit ? $unit->name : 'Unit Tidak Diketahui';
            $parentName = $unit && $unit->parent ? $unit->parent->name : '';
            $eselonId = $this->eselon_id;
            $parentId = $this->parent_id;

            if ($eselonId == 31 || $eselonId == 41) {
                $parentUnit = UnitKerja::where('id', $parentId)->whereIn('eselon_id', [21, 11])->first();
                if ($parentUnit) {
                    $unitName = $parentUnit->id;
                }
            }

            return $unitId . ' - ' . $unitName . ' - ' . $parentName;
        });

        $grid->column('latest_jabatan', __('Jabatan Saat Ini'))->display(function () {
            $latestJabatan = $this->obj_riwayat_jabatan->sortByDesc('tmt_jabatan')->first();
            return optional($latestJabatan)->nama_jabatan ? $latestJabatan->nama_jabatan : '-';
        });

        $grid->column('tipe_jabatan', __('Tipe Jabatan'))->display(function () {
            $employeeId = $this->id;
            $riwayatJabatan = RiwayatJabatan::where('employee_id', $employeeId)
                ->orderByDesc('tmt_jabatan')
                ->first();

            $tipeJabatanId = $riwayatJabatan ? $riwayatJabatan->tipe_jabatan_id : null;

            switch ($tipeJabatanId) {
                case 1:
                    return 'Struktural (Pejabat Pimpinan Tinggi)';
                case 2:
                    return 'Fungsional Umum';
                case 3:
                    return 'Fungsional Tertentu';
                case 4:
                    return 'Fungsional Tertentu (Madya)';
                case 5:
                    return 'Fungsional Tertentu (Utama)';
                case 6:
                    return 'Struktural (Pejabat Administrasi)';
                default:
                    return '-Tipe Jabatan Belum didefinisikan-';
            }
        });

        $grid->column('nilai_jabatan_kerja', __('Nilai Pegawai di Unit Kerja'))->display(function () {
            $latestJabatan = $this->obj_riwayat_jabatan->sortByDesc('tmt_jabatan')->first();
            $unitId = $this->unit_id;
            $defaultUnitValue = 0;

            $nilaiJabatanKerja = 0;

            if ($latestJabatan) {
                $namaJabatan = $latestJabatan->nama_jabatan;

                if (
                    strpos(strtolower($namaJabatan), 'arsiparis') !== false
                    || strpos(strtolower($namaJabatan), 'kepala') !== false
                    || strpos(strtolower($namaJabatan), 'deputi') !== false
                    || $unitId == 118
                ) {
                    $nilaiJabatanKerja = 150;
                } else {
                    $nilaiJabatanKerja = 100;
                }
            }

            $additionalUnitIds = [39, 9, 10, 47, 49, 118];
            $totalNilai = in_array($unitId, $additionalUnitIds) ? $defaultUnitValue + $nilaiJabatanKerja + 50 : $defaultUnitValue + $nilaiJabatanKerja;

            return number_format($totalNilai);
        });

        $grid->disableActions();
        $grid->disableCreateButton();

        return $grid;
    }
}