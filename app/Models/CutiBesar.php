<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;

class CutiBesar extends Model
{
    protected $connection = 'presensi_2020';
    public $table = 'tbl_cuti';
    public $primaryKey = 'id_cuti';

    public $dates = ['tgl_mulai', 'tgl_selesai'];
}
