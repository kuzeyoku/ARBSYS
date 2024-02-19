<?php

namespace App\Models\Lawsuit;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use App\Models\Document\DocumentTypeTemplate;

class LawsuitSubjectType extends Model
{

    public $fillable = ["name"];

    public $with = ["lawsuitSubjects"];

    public static function selectToArray()
    {
        return Cache::remember("lawsuit_subject_types", 3600, function () {
            return LawsuitSubjectType::pluck("name", "id")->toArray();
        });
    }

    public function lawsuitSubjects()
    {
        return $this->hasMany(LawsuitSubject::class);
    }

    public function templates()
    {
        return $this->hasMany(DocumentTypeTemplate::class)->where("lawsuit_subject_id", null);
    }
}
