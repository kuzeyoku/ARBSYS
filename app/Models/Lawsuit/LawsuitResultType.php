<?php

namespace App\Models\Lawsuit;

use App\Models\Document\DocumentType;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

class LawsuitResultType extends Model
{
    public static function selectToArray()
    {
        return Cache::remember('lawsuit_result_types', 3600, function () {
            return self::pluck("name", "id");
        });
    }
}
