<?php

namespace App\Models\Lawsuit;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

class LawsuitType extends Model
{

    public static function selectToArray()
    {
        return Cache::remember("lawsuit_types", 3600, function () {
            return self::pluck("name", "id");
        });
    }

    public function getDeliveryByAttribute()
    {
        if ($this->id == 2) {
            return "Tarafların Başvurusu";
        } else {
            return "Sistem Üzerinden";
        }
    }
}
