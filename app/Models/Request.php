<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class Request extends Model
{
    use HasFactory;
    public $table  = 'requests';
    private $cacheKeyPrefix = "request_id_";

    protected static function booted(): void
    {
        self::creating(function (Request $record) {
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
    // other methods goes here
    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function scopeInboxVerifikator($query)
    {
        $query->whereIn('status_id', [RequestStep::$REVISI, RequestStep::$TOLAK, RequestStep::$SUBMIT, RequestStep::$INVERIFIKASI, RequestStep::$TERIMA]);
    }
    public function scopeMyInboxVerifikator($query, $verifikator_id)
    {
        $query->where("verifikator_id", $verifikator_id);
        $query->whereIn('status_id', [RequestStep::$REVISI, RequestStep::$TOLAK,  RequestStep::$INVERIFIKASI, RequestStep::$TERIMA]);
    }

    public $date = ['date_created'];
    public $casts = ['old_data' => 'json', 'request_data' => 'json'];
}
