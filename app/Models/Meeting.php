<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $fillable = [
        "user_id",
        "lawsuit_id",
        "document_id",
        "date",
        "start_hour",
    ];

    public $timestamps = false;
}
