<?php

namespace App\Models;

use App\Models\Lawsuit\LawsuitSubject;
use Illuminate\Database\Eloquent\Model;
use App\Models\Lawsuit\LawsuitSubjectType;

class MattersDiscussed extends Model
{
    protected $fillable = [
        "title",
        "lawsuit_subject_type_id",
        "lawsuit_subject_id"
    ];

    public $timestamps = false;

    // protected $with = ["lawsuitSubjectType","lawsuitSubject"];

    public function toArray()
    {
        return self::pluck("title", "id")->all();
    }

    public function lawsuit_subject_type()
    {
        return $this->belongsTo(LawsuitSubjectType::class);
    }

    public function lawsuit_subject()
    {
        return  $this->belongsTo(LawsuitSubject::class);
    }
}
