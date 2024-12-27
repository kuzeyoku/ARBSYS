<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

class TradeRegistry extends Model
{
    public static function selectToArray()
    {
        return Cache::rememberForever('trade_registries', function () {
            return TradeRegistry::pluck('name', 'id')->toArray();
        });
    }
}
