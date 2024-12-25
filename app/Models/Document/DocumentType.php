<?php

namespace App\Models\Document;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DocumentType extends Model
{

    protected $with = ["documentTypeTemplate"];

    public function getKeywords()
    {
        if (is_null($this->keywords)) {
            return [];
        }
        return explode(",", $this->keywords);
    }

    public function documentTypeTemplate(): HasMany
    {
        return $this->hasMany(DocumentTypeTemplate::class);
    }
}
