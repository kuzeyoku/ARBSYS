<?php

namespace App\Models\Document;

use App\Models\Lawsuit\LawsuitSubject;
use Illuminate\Database\Eloquent\Model;
use App\Models\Lawsuit\LawsuitSubjectType;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DocumentTypeTemplate extends Model
{
    protected $fillable = [
        "title", 'document_type_id', 'lawsuit_subject_type_id', "lawsuit_subject_id", 'html'
    ];

    public $timestamps = false;

    public function documentType(): BelongsTo
    {
        return $this->belongsTo(DocumentType::class);
    }

    public function lawsuitSubjectType(): BelongsTo
    {
        return $this->belongsTo(LawsuitSubjectType::class);
    }

    public function lawsuitSubject(): BelongsTo
    {
        return $this->belongsTo(LawsuitSubject::class);
    }
}
