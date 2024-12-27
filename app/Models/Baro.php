<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

class Baro extends Model
{
    protected $table = "barolar";
    public $timestamps = false;

    public static function selectToArray(): array
    {
        return Cache::rememberForever('bare_select', function () {
            return Baro::pluck('name', 'id')->toArray();
        });
    }
}
