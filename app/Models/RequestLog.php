<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class RequestLog extends Model
{
    use HasFactory;
    public $table  = 'request_log';
    private $cacheKeyPrefix = "request_log_id_";

    public static function  addLog(Request $request, $keterangan)
    {
        $log = new RequestLog();
        $log->request_id = $request->id;
        $log->user_id = Auth::user()->id;
        $log->values = [
            'status_id' => $request->status_id,
            'keterangan' => $keterangan,
            'obj_request' => $request,
        ];
        $log->save();
    }
    protected static function booted(): void
    {

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

    public $casts = ['values' => 'json'];
}
