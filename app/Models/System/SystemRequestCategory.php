<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;

class SystemRequestCategory extends Model
{
    protected $fillable = [
        'name',
    ];

    public static function getSelectArray()
    {
        return SystemRequestCategory::pluck('name', 'id')->toArray();
    }

    public $timestamps = false;
}
