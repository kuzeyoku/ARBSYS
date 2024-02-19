<?php

namespace App\Models\Lawsuit;

use Illuminate\Database\Eloquent\Model;

class LawsuitNotes extends Model
{
    public $fillable = [
        'lawsuit_id',
        "user_id",
        "note"
    ];
}
