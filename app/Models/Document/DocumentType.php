<?php

namespace App\Models\Document;

use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    public function getKeywords()
    {
        if (is_null($this->keywords)) {
            return [];
        }
        return explode(",", $this->keywords);
    }

    public function template()
    {
        return $this->hasOne(DocumentTypeTemplate::class);
    }
}
