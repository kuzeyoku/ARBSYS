<?php

namespace App\Models\Lawsuit;

use Illuminate\Database\Eloquent\Model;
use App\Models\Document\DocumentTypeTemplate;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property mixed $matters_discussed
 */
class LawsuitSubject extends Model
{

    public $fillable = ["lawsuit_subject_type_id", "name"];

    public function getMattersDiscussedToArrayAttribute()
    {
        return json_decode($this->matters_discussed, true);
    }
}
