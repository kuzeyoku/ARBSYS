<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MinisteriesOpinion extends Model
{
    protected $fillable = [
        "title",
        "file",
        "status",
        "order",
    ];

    public $timestamps = false;

    public function getFileUrl()
    {
        return asset("uploads/ministeries_opinions/" . $this->file);
    }
}
