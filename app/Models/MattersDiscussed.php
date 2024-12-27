<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class MattersDiscussed extends Model
{
    protected $fillable = [
        "title",
        "lawsuit_subject_type_id",
        "lawsuit_subject_id"
    ];

    public $timestamps = false;

    public function toArray(): array
    {
        return Cache::remember('matters_discussed', 60, function () {
            return self::pluck("title", "id")->toArray();
        });
    }

}
