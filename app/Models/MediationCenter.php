<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediationCenter extends Model
{
    protected $fillable = [
        "title",
        "address"
    ];

    public $timestamps = false;

    public static function selectToArray()
    {
        return MediationCenter::pluck('title', 'id')->toArray();
    }
}
