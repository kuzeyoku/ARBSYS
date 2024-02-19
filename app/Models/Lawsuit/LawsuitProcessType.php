<?php

namespace App\Models\Lawsuit;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class LawsuitProcessType extends Model
{
    public static function selectToArray()
    {
        return Cache::remember('lawsuit_process_types', 3600, function () {
            return self::pluck("name", "id");
        });
    }
}
