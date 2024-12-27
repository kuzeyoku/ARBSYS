<?php

namespace App\Models\Document;

use App\Models\Lawsuit\LawsuitSubject;
use Illuminate\Database\Eloquent\Model;
use App\Models\Lawsuit\LawsuitSubjectType;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DocumentTypeTemplate extends Model
{
    protected $fillable = [
        "title", 'document_type_id', 'lawsuit_subject_type_id', "lawsuit_subject_id", 'html'
    ];

    public $timestamps = false;
    protected $with = ['documentType'];

    public function documentType(): HasOne
    {
        return $this->hasOne(DocumentType::class, 'id', 'document_type_id');
    }

    public function lawsuitSubjectType(): HasOne
    {
        return $this->hasOne(LawsuitSubjectType::class, 'id', 'lawsuit_subject_type_id');
    }

    public function lawsuitSubject(): HasOne
    {
        return $this->hasOne(LawsuitSubject::class, 'lawsuit_subject_id', 'id');
    }
}
