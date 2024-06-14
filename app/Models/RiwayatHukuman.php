<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatHukuman extends Model
{
    public $table = 'riwayat_hukuman';

    public function obj_employee() {
        return $this->hasOne(Employee::class, 'id', 'employee_id');
    }
    public function obj_hukuman() {
        return $this->hasOne(Hukuman::class, 'simpeg_id', 'hukuman_id');
    }
    public function obj_alasan() {
        return $this->hasOne(AlasanHukuman::class, 'id_hukuman', 'alasan_hukuman');
    }
    public function getTTMTSKAttribute() {
        return $this->tmt_sk->format('d-m-Y');
    }

    public $dates = ['tgl_sk','tmt_sk','tmt_akhir','tgl_sk_akhir'];
    protected $casts = [
        'tgl_sk' => 'datetime:Y-m-d','tmt_sk' => 'datetime:Y-m-d','tmt_akhir' => 'datetime:Y-m-d','tgl_sk_akhir' => 'datetime:Y-m-d'
    ];
}
