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
        'taxOfficeName'
    ];

    public static function selectToArray()
    {
        return Cache::remember('taxOfficeSelect', 3600, function () {
            return TaxOffice::orderBy("taxOfficeName", "ASC")->pluck('taxOfficeName', 'id')->toArray();
        });
    }
}
