<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class MediationCenter extends Model
{
    protected $fillable = [
        "title",
        "address"
    ];

    public $timestamps = false;

    public static function selectToArray(): array
    {
        return Cache::rememberForever('mediation_centers', function () {
            return MediationCenter::pluck('title', 'id')->toArray();
        });
    }
}
