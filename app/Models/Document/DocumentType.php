<?php

namespace App\Models\Document;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DocumentType extends Model
{

    public function getKeywords()
    {
        if (is_null($this->keywords)) {
            return [];
        }
        return explode(",", $this->keywords);
    }
}
