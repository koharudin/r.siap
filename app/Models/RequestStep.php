<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class RequestStep extends Model
{
    use HasFactory;
    public $table  = 'request_step';
    private $cacheKeyPrefix = "request_step_id_";
    //1=DRAFT, 2=SUBMIT/Inbox Verifikator, 3=Proses Verifikasi, 4=Revisi,5=Terima, 6=Tolak
    public static  $DRAFT = 1;
    public static  $SUBMIT = 2;
    public static  $INVERIFIKASI = 3;
    public static  $REVISI = 4;
    public static  $TERIMA = 5;
    public static  $TOLAK = 6;

    protected static function booted(): void
    {
        self::creating(function (RequestCategory $record) {
            $record->uuid = Str::uuid()->toString();
        });

        self::created(function ($model) {
            Cache::remember($model->cacheKeyPrefix . $model->id, 60 * 60 * 24, function () use ($model) {
                return $model;
            });
        });
        self::updated(function ($model) {
            Cache::remember($model->cacheKeyPrefix . $model->id, 60 * 60 * 24, function () use ($model) {
                return $model;
            });
        });
        self::deleted(function ($model) {
            Cache::forget($model->cacheKeyPrefix . $model->id);
        });
    }
}
