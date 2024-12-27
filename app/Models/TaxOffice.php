<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

class TaxOffice extends Model
{
    protected $table = "taxoffices";

    protected $fillable = [
        'province',
        'district',
        'informantCode',
        'name'
    ];

    public static function selectToArray()
    {
        return Cache::rememberForever('tax_offices', function () {
            return TaxOffice::orderBy("name", "ASC")->pluck('name', 'id')->toArray();
        });
    }
}
