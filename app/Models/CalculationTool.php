<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalculationTool extends Model
{
    protected $fillable = [
        "name",
        "description",
        "status",
        "url",
    ];

    public $timestamps = false;
}
