<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class MediationOffice extends Model
{
    protected $fillable = ['name'];
    public $timestamps = false;

    public static function selectToArray()
    {
        return Cache::rememberForever('mediation_offices', function () {
            return self::all()->pluck('name', 'id')->toArray();
        });
    }
}
