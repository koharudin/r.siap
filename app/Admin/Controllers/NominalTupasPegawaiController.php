<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Grid;
use App\Models\Employee;
use App\Models\RiwayatJabatan;
use App\Models\UnitKerja;
use App\Models\TupasKeuangan;

class NominalTupasPegawaiController extends AdminController
{
    protected $title = 'Nilai Jabatan Pegawai';

    protected function grid()
    {
        $grid = new Grid(new Employee());
        $grid->model()
            ->whereIn('status_pegawai_id', [2, 23])
            ->with(['obj_riwayat_jabatan', 'obj_riwayat_skcpns']);

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
        $grid->model()->with(['obj_riwayat_jabatan']);

        $grid->column('nip_baru', __('NIP'))->display(function ($o) {
            return "'".$o;
        })->sortable();

        $grid->column('first_name', __('Nama Pegawai'))->sortable();

        $grid->column('status_pegawai_id', __('Status'))->display(function ($o) {
            $statusLabel = ($o == 2) ? 'PNS' : (($this->status_pegawai_id == 23) ? 'PPPK' : '');
            return $statusLabel;
        })->sortable();

        $grid->column('latest_skcpns', __('Awal Masuk ANRI'))->display(function () {
            $latestSKCPNS = $this->obj_riwayat_skcpns->sortByDesc('tmt_cpns')->first();
            // Menggunakan optional() untuk memastikan $latestSKCPNS or $latestSKCPNS->tmt_cpns tidak null, jika null, akan mengembalikan '-' karena $latestSKCPNS->tmt_cpns tidak ada
            return optional($latestSKCPNS)->tmt_cpns ? $latestSKCPNS->tmt_cpns->format('Y-m-d') : '-';
        });

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

        $grid->column('unit_id', __('Unit Kerja Saat Ini'))->display(function () {
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
        })->sortable();

        $grid->column('latest_jabatan', __('Jabatan Saat Ini'))->display(function () {
            $latestJabatan = $this->obj_riwayat_jabatan->where('status_riwayat', 1)->sortByDesc('tmt_jabatan')->first();
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
                    return 'Tipe Jabatan Belum Didefinisikan';
            }
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
                    ['min' => 20, 'max' => 24, 'value' => 400],
                    ['min' => 24, 'max' => 28, 'value' => 430],
                    ['min' => 28, 'max' => null, 'value' => 450],
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

        $grid->column('nilai_unit_kerja', __('Nilai Unit Kerja'))->display(function () {
            $unitId = $this->unit_id;
            // Aturan yang nilai di unit yang berbeda
            $unitRules = [
                41 => 300, // Sekretariat Utama
                38 => 350, // Arsip Nasional Republik Indonesia
                39 => 350, // Deputi Bidang Konservasi Arsip
                9 => 350, // Direktorat Akuisisi
                10 => 350, // Direktorat Pengolahan
                47 => 350, // Direktorat Preservasi
                49 => 350, // Direktorat Layanan dan Pemanfaatan
                118 => 350, // Balai Arsip Statis dan Tsunami
                15 => 200, // Pusat Pendidikan dan Pelatihan Kearsipan
                22 => 0, // Tidak ada
                161 => 200, // PPSDM
                null => 'Unit Tidak Diketahui',
                152 => 350, // 152 - Deputi Bidang Penyelamatan, Pelestarian, dan Pelindungan Arsip
                153 => 350, // 153 - Direktorat Penyelamatan Arsip
                154 => 350, // 154 - Direktorat Pengolahan Arsip
                155 => 350, // 155 - Direktorat Pelestarian dan Pelindungan Arsip
                156 => 350, // 156 - Direktorat Layanan dan Pemanfaatan Arsip
                169 => 350, // 169 - Balai Arsip Statis dan Tsunami
                135 => 350, // 135 - Pusat Studi Arsip Statis Kepresidenan
            ];
            $unitValue = $unitRules[$unitId] ?? 300;

            // Cek Hierarki Eselon
            $eselonId = $this->obj_satker ? $this->obj_satker->eselon_id : $this->eselon_id;
            $parentId = $this->obj_satker ? $this->obj_satker->parent_id : $this->parent_id;

            if ($eselonId == 11) { // Eselon 1
                // Otamatis sesuai UnitRules
            } elseif ($eselonId == 21) { // Eselon 2
                // Otamatis sesuai UnitRules
            } elseif ($eselonId == 31) { // Eselon 3
                // Cari Parent dengan eselon_id 21 atau 11
                $parentUnit = UnitKerja::where('id', $parentId)->whereIn('eselon_id', [21, 11])->first();
                if ($parentUnit) {
                    $unitValue = $unitRules[$parentUnit->id] ?? 300;
                }
            } elseif ($eselonId == 41) { // Eselon 4
                // Cari Parent dengan eselon_id 21 atau 11 atau 31
                $parentUnit = UnitKerja::where('id', $parentId)->whereIn('eselon_id', [21, 11, 31])->first();
                if ($parentUnit) {
                    $unitValue = $unitRules[$parentUnit->id] ?? 300;
                }
            }

            return $unitValue;
        });

        $grid->column('nilai_jabatan_kerja', __('Nilai Jabatan'))->display(function () {
            $latestJabatan = $this->obj_riwayat_jabatan->where('status_riwayat', 1)->sortByDesc('tmt_jabatan')->first();
            $unitId = $this->unit_id;
            $employeeId = $this->id;
            $defaultUnitValue = 0;

            $nilaiJabatanKerja = 0;
            if ($latestJabatan) {
                $namaJabatan = $latestJabatan->nama_jabatan;
                if (
                    strpos(strtolower($namaJabatan), 'arsiparis') !== false
                    || strpos(strtolower($namaJabatan), 'kepala') !== false
                    || strpos(strtolower($namaJabatan), 'deputi') !== false
                    || strpos(strtolower($namaJabatan), 'sekretaris') !== false
                    || strpos(strtolower($namaJabatan), 'direktur') !== false
                    || strpos(strtolower($namaJabatan), 'inspektur') !== false
                    || $unitId == 118 || $unitId == 169 || $unitId == 170 // BAST
                    || $unitId == 39 || $unitId == 152 // Dekon
                    || $unitId == 9 || $unitId == 153 // Akuisisi
                    || $unitId == 10 || $unitId == 154 // Pengolahan
                    || $unitId == 47 || $unitId == 155 // Preservasi
                    || $unitId == 49 || $unitId == 156 // LP
                    || $unitId == 135 || $unitId == 118 || $unitId == 136 // PSASK
                ) {
                    $nilaiJabatanKerja = 150;
                } else {
                    $nilaiJabatanKerja = 100;
                }

                if (
                    $latestJabatan->tipe_jabatan_id == 1
                    && ($unitId == 39 || $unitId == 152 // Dekon
                        || $unitId == 9 || $unitId == 153 // Akuisisi
                        || $unitId == 10 || $unitId == 154 // Pengolahan
                        || $unitId == 47 || $unitId == 155 // Preservasi
                        || $unitId == 49 || $unitId == 156 // LP
                        || $unitId == 135 || $unitId == 136 // PSASK
                        || $unitId == 118 || $unitId == 169 || $unitId == 170 // BAST
                    )
                ) {
                    $nilaiJabatanKerja = 100;
                }
            }

            $additionalUnitIds = [39, 152, 9, 153, 10, 154, 47, 155, 49, 156, 118, 169, 170, 135, 136];
            $totalNilai = in_array($unitId, $additionalUnitIds) ? $defaultUnitValue + $nilaiJabatanKerja + 50 : $defaultUnitValue + $nilaiJabatanKerja;

            $mantanStruktural = [267, 257, 272, 367, 355, 322, 397, 454, 255, 443, 751, 260, 249, 266, 265, 296, 287, 302, 258, 292, 283, 310, 337, 309, 362, 269, 434, 404, 432, 414, 427, 439, 289, 300, 437, 307,
                358, 254, 455, 256, 352, 752, 359, 263, 447, 585, 366, 321, 349, 578, 353, 299, 275];
            if(in_array($employeeId, $mantanStruktural)) {
                if($totalNilai < 150) {
                    $totalNilai = 150;
                }
            }

            return $totalNilai;
        });

        $grid->column('jumlah_nilai_tupas', __('Jumlah Nilai'))->display(function () {
            $nilaiMasaKerja = $this->calculateNilaiMasaKerja();

            $unitId = $this->unit_id;
            // Aturan yang nilai di unit yang berbeda
            $unitRules = [
                41 => 300, // Sekretariat Utama
                38 => 350, // Arsip Nasional Republik Indonesia
                39 => 350, // Deputi Bidang Konservasi Arsip
                9 => 350, // Direktorat Akuisisi
                10 => 350, // Direktorat Pengolahan
                47 => 350, // Direktorat Preservasi
                49 => 350, // Direktorat Layanan dan Pemanfaatan
                118 => 350, // Balai Arsip Statis dan Tsunami
                15 => 200, // Pusat Pendidikan dan Pelatihan Kearsipan
                22 => 0, // Tidak ada
                161 => 200, // PPSDM
                null => 'Unit Tidak Diketahui',
                152 => 350, // 152 - Deputi Bidang Penyelamatan, Pelestarian, dan Pelindungan Arsip
                153 => 350, // 153 - Direktorat Penyelamatan Arsip
                154 => 350, // 154 - Direktorat Pengolahan Arsip
                155 => 350, // 155 - Direktorat Pelestarian dan Pelindungan Arsip
                156 => 350, // 156 - Direktorat Layanan dan Pemanfaatan Arsip
                169 => 350, // 169 - Balai Arsip Statis dan Tsunami
                135 => 350, // 135 - Pusat Studi Arsip Statis Kepresidenan
            ];
            $unitValue = $unitRules[$unitId] ?? 300;

            // Cek Hierarki Eselon
            $eselonId = $this->obj_satker ? $this->obj_satker->eselon_id : $this->eselon_id;
            $parentId = $this->obj_satker ? $this->obj_satker->parent_id : $this->parent_id;

            if ($eselonId == 11) { // Eselon 1
                // Otamatis sesuai UnitRules
            } elseif ($eselonId == 21) { // Eselon 2
                // Otamatis sesuai UnitRules
            } elseif ($eselonId == 31) { // Eselon 3
                // Cari Parent dengan eselon_id 21 atau 11
                $parentUnit = UnitKerja::where('id', $parentId)->whereIn('eselon_id', [21, 11])->first();
                if ($parentUnit) {
                    $unitValue = $unitRules[$parentUnit->id] ?? 300;
                }
            } elseif ($eselonId == 41) { // Eselon 4
                // Cari Parent dengan eselon_id 21 atau 11 atau 31
                $parentUnit = UnitKerja::where('id', $parentId)->whereIn('eselon_id', [21, 11, 31])->first();
                if ($parentUnit) {
                    $unitValue = $unitRules[$parentUnit->id] ?? 300;
                }
            }

            $latestJabatan = $this->obj_riwayat_jabatan->where('status_riwayat', 1)->sortByDesc('tmt_jabatan')->first();
            $unitId = $this->unit_id;
            $employeeId = $this->id;
            $defaultUnitValue = 0;

            $nilaiJabatanKerja = 0;
            if ($latestJabatan) {
                $namaJabatan = $latestJabatan->nama_jabatan;
                if (
                    strpos(strtolower($namaJabatan), 'arsiparis') !== false
                    || strpos(strtolower($namaJabatan), 'kepala') !== false
                    || strpos(strtolower($namaJabatan), 'deputi') !== false
                    || strpos(strtolower($namaJabatan), 'sekretaris') !== false
                    || strpos(strtolower($namaJabatan), 'direktur') !== false
                    || strpos(strtolower($namaJabatan), 'inspektur') !== false
                    || $unitId == 118 || $unitId == 169 || $unitId == 170 // BAST
                    || $unitId == 39 || $unitId == 152 // Dekon
                    || $unitId == 9 || $unitId == 153 // Akuisisi
                    || $unitId == 10 || $unitId == 154 // Pengolahan
                    || $unitId == 47 || $unitId == 155 // Preservasi
                    || $unitId == 49 || $unitId == 156 // LP
                    || $unitId == 135 || $unitId == 118 || $unitId == 136 // PSASK
                ) {
                    $nilaiJabatanKerja = 150;
                } else {
                    $nilaiJabatanKerja = 100;
                }

                if (
                    $latestJabatan->tipe_jabatan_id == 1
                    && ($unitId == 39 || $unitId == 152 // Dekon
                        || $unitId == 9 || $unitId == 153 // Akuisisi
                        || $unitId == 10 || $unitId == 154 // Pengolahan
                        || $unitId == 47 || $unitId == 155 // Preservasi
                        || $unitId == 49 || $unitId == 156 // LP
                        || $unitId == 135 || $unitId == 136 // PSASK
                        || $unitId == 118 || $unitId == 169 || $unitId == 170 // BAST
                    )
                ) {
                    $nilaiJabatanKerja = 100;
                }
            }

            $additionalUnitIds = [39, 152, 9, 153, 10, 154, 47, 155, 49, 156, 118, 169, 170, 135, 136];
            $totalNilai = in_array($unitId, $additionalUnitIds) ? $defaultUnitValue + $nilaiJabatanKerja + 50 : $defaultUnitValue + $nilaiJabatanKerja;

            $mantanStruktural = [267, 257, 272, 367, 355, 322, 397, 454, 255, 443, 751, 260, 249, 266, 265, 296, 287, 302, 258, 292, 283, 310, 337, 309, 362, 269, 434, 404, 432, 414, 427, 439, 289, 300, 437, 307,
                358, 254, 455, 256, 352, 752, 359, 263, 447, 585, 366, 321, 349, 578, 353, 299, 275];
            if(in_array($employeeId, $mantanStruktural)) {
                if($totalNilai < 150) {
                    $totalNilai = 150;
                }
            }
            $totalNilai = is_numeric($totalNilai) ? $totalNilai : 0;

            if (is_numeric($unitValue) && is_numeric($totalNilai) && is_numeric($nilaiMasaKerja)) {
                $totalNilaiTupas = 0;
                $totalNilaiTupas = is_numeric($unitValue + $totalNilai + $nilaiMasaKerja) ? $unitValue + $totalNilai + $nilaiMasaKerja : 0;
                if ($totalNilaiTupas >= 184 && $totalNilaiTupas <= 344) {
                    $result = 100000;
                } elseif ($totalNilaiTupas >= 345 && $totalNilaiTupas <= 454) {
                    $result = 200000;
                } elseif ($totalNilaiTupas >= 455 && $totalNilaiTupas <= 565) {
                    $result = 300000;
                } elseif ($totalNilaiTupas >= 566 && $totalNilaiTupas <= 676) {
                    $result = 400000;
                } elseif ($totalNilaiTupas >= 677 && $totalNilaiTupas <= 787) {
                    $result = 500000;
                } elseif ($totalNilaiTupas >= 788 && $totalNilaiTupas <= 898) {
                    $result = 600000;
                } elseif ($totalNilaiTupas >= 899 && $totalNilaiTupas <= 1000) {
                    $result = 700000;
                } else {
                    $result = 0;
                }
            }
            $totalNilaiTupas = $totalNilaiTupas ?? 0;
            $result = $result ?? 0;
            $this->nominal_result = $result;
            return $totalNilaiTupas;
        });

        $grid->column('nominal_nilai_tupas', __('Nominal Tunjangan'))->display(function () {
            $result = $this->nominal_result;
            return 'Rp. '.number_format($result);
        });

        $grid->column('tupas_keuangan', __('Dibayarkan Keuangan'))->display(function() {
            $employee_id = $this->id;
            $nominal_result = $this->nominal_result;
            $tupasKeuangan = TupasKeuangan::where('employee_id', $employee_id)->first();
            $nominal = $tupasKeuangan->nominal_tunjangan ?? 0;
            $this->nominal_selisih = $nominal_result - $nominal;
            return 'Rp. '.number_format($nominal);
        });

        $grid->column('selisih', __('Selisih Tupas'))->display(function() {
            $nominal_selisih = $this->nominal_selisih;
            return 'Rp. '.number_format($nominal_selisih);
        });

        $grid->disableActions();
        $grid->disableCreateButton();

        return $grid;
    }
}
