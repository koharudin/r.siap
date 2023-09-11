<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatUjiKompetensi extends Model
{
    public $table  = 'riwayat_uji_kompetensi';
    

    public function getTTahunAttribute(){
        return $this->tanggal->format('Y');
    }
    public $dates = ['tanggal'];
}
