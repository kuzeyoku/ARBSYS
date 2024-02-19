<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;

class SystemRequest extends Model
{
    protected $fillable = [
        'user_id',
        'system_request_category_id',
        'title',
        'description',
    ];

    public function system_request_category()
    {
        return $this->belongsTo(SystemRequestCategory::class);
    }
}
