<?php

namespace App\Models\Document;

use App\Models\Lawsuit\LawsuitSubject;
use Illuminate\Database\Eloquent\Model;
use App\Models\Lawsuit\LawsuitSubjectType;

class DocumentTypeTemplate extends Model
{
    protected $fillable = [
        "title", 'document_type_id', 'lawsuit_subject_type_id', "lawsuit_subject_id", 'html'
    ];

    public $timestamps = false;

    public function documentType()
    {
        return $this->belongsTo(DocumentType::class);
    }

    public function lawsuitSubjectType()
    {
        return $this->belongsTo(LawsuitSubjectType::class);
    }

    public function lawsuitSubject()
    {
        return $this->belongsTo(LawsuitSubject::class);
    }
}
