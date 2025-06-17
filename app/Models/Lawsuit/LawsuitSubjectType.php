<?php

namespace App\Models\Lawsuit;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use App\Models\Document\DocumentTypeTemplate;

class LawsuitSubjectType extends Model
{

    public $fillable = ["name","lawsuit_type_id"];

    public $with = ["lawsuitSubjects", "documentTypeTemplate"];

    public static function selectToArray()
    {
        return Cache::rememberForever("lawsuit_subject_types", function () {
            return LawsuitSubjectType::pluck("name", "id")->toArray();
        });
    }

    public function documentType(int $id)
    {
        return $this->documentTypeTemplate->where("document_type_id", $id)->first();
    }

    public function documentTypeTemplate(): HasMany
    {
        return $this->hasMany(DocumentTypeTemplate::class);
    }

    public function lawsuitSubjects(): HasMany
    {
        return $this->hasMany(LawsuitSubject::class);
    }

}
