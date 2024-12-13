<?php

namespace App\Models;
use \Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PengembanganKompetensiPlan extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'rencana_pengembangan_kompetensi';
    public $primaryKey = 'id';

    public $casts = ['kebutuhan_manso' => 'array','kebutuhan_komtek' => 'array','kebutuhan_pengembangan' => 'array'];
}