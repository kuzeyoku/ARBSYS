<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediationOffice extends Model
{
    protected $fillable = ['name'];
    public $timestamps = false;

    public static function selectToArray()
    {
        return self::pluck('name', 'id')->toArray();
    }
}
