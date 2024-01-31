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
            // Aturan yang nilai di unit yang berbeda
            $unitRules = [
                41 => 350, // Sekretariat Utama
                38 => 'Lembaga', // Arsip Nasional Republik Indonesia
                39 => 350, // Deputi Bidang Konservasi Arsip
                9 => 350, // Direktorat Akuisisi
                10 => 350, // Direktorat Pengolahan
                47 => 350, // Direktorat Preservasi
                49 => 350, // Direktorat Layanan dan Pemanfaatan
                118 => 350, // Balai Arsip Tsunami Aceh
                15 => 200, // Pusat Pendidikan dan Pelatihan Kearsipan
                22 => 0, // Tidak Ada
                null => 'Unit Tidak Diketahui',
            ];

            $data = [];

            foreach (UnitKerja::whereIn('id', Employee::whereIn('status_pegawai_id', [2, 23])->pluck('unit_id')->toArray())->get() as $unit) {
                $unitValue = $unitRules[$unit->id] ?? 300;

                $data[] = [
                    'unit_kerja' => $unit->name,
                    'induk_unit_kerja' => $unit->parent ? $unit->parent->name : '',
                    'nilai_pegawai' => $unitValue,
                ];
            }
            $html = '
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Nilai Pegawai di Unit Kerja</h4>
                            <p>Perhitungan Nilai Unit Kerja Tunjangan Arsip Statis Merujuk Peraturan Kepala Arsip Nasional Republik Indonesia No 2 Tahun 2005</p>
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
                                                            <th>Induk Unit Kerja</th>
                                                            <th>Nilai Pegawai</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>';

            foreach ($data as $row) {
                $html .= "
                    <tr>
                        <td>{$row['unit_kerja']}</td>
                        <td>{$row['induk_unit_kerja']}</td>
                        <td>{$row['nilai_pegawai']}</td>
                    </tr>";
            }

            $html .= '
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
            return $html;
        });

        $grid->column('first_name', __('Nama Pegawai'))->display(function ($o) {
            $statusLabel = ($this->status_pegawai_id == 2) ? 'PNS' : (($this->status_pegawai_id == 23) ? 'PPPK' : '');

            return $this->first_name . " <br> " . $this->nip_baru . "<br> ASN: " . $statusLabel;
        })->sortable();

        $grid->column('latest_unit_info', __('Latest Unit Info'))->display(function () {
            $unitId = $this->unit_id;
            $unit = UnitKerja::find($unitId);
            $unitName = $unit->name;
            $parentName = optional($unit->parent)->name;
            $eselonId = $this->eselon_id;
            $parentId = $this->parent_id;

            if ($eselonId == 31 || $eselonId == 41) {
                $parentUnit = UnitKerja::where('id', $parentId)->whereIn('eselon_id', [21, 11])->first();

                if ($parentUnit) {
                    $unitValue = $parentUnit->id;
                }
            }

            return $unitId . ' - ' . $unitName . ' - ' . $parentName;
        });

        $grid->column('nilai_unit_kerja', __('Nilai Pegawai di Unit Kerja'))->display(function () {
            $unitId = $this->unit_id;
            // Aturan yang nilai di unit yang berbeda
            $unitRules = [
                41 => 350, // Sekretariat Utama
                38 => 0, // Arsip Nasional Republik Indonesia
                39 => 350, // Deputi Bidang Konservasi Arsip
                9 => 350, // Direktorat Akuisisi
                10 => 350, // Direktorat Pengolahan
                47 => 350, // Direktorat Preservasi
                49 => 350, // Direktorat Layanan dan Pemanfaatan
                118 => 350, // Balai Arsip Tsunami Aceh
                15 => 200, // Pusat Pendidikan dan Pelatihan Kearsipan
                22 => 0, // Tidak Ada
                null => 'Unit Tidak Diketahui',
                // ... Tambahkan aturan lainnya
            ];

            // Check if the unit has a specific rule, otherwise default to 300
            $unitValue = $unitRules[$unitId] ?? 300;

            // Cek Hirarki Eselon
            $eselonId = $this->eselon_id;
            $parentId = $this->parent_id;

            if ($eselonId == 11) { // Eselon 1
                // Value already set based on unit
            } elseif ($eselonId == 21) { // Eselon 2
                // Value already set based on unit
            } elseif ($eselonId == 31) { // Eselon 3
                // Find parent with eselon_id 21 or 11
                $parentUnit = UnitKerja::where('id', $parentId)->whereIn('eselon_id', [21, 11])->first();
                if ($parentUnit) {
                    // Use the parent unit's value
                    $unitValue = $unitRules[$parentUnit->id] ?? 300;
                }
            } elseif ($eselonId == 41) { // Eselon 4
                // Find parent with eselon_id 21 or 11
                $parentUnit = UnitKerja::where('id', $parentId)->whereIn('eselon_id', [21, 11])->first();
                if ($parentUnit) {
                    // Use the parent unit's value
                    $unitValue = $unitRules[$parentUnit->id] ?? 300;
                }
            }

            return $unitValue;
        });

        $grid->disableActions();
        $grid->disableCreateButton();
        return $grid;
    }
}