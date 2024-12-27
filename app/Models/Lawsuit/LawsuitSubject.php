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

    protected $with = ["documentTypeTemplate"];

    public function getMattersDiscussedToArrayAttribute()
    {
        return json_decode($this->matters_discussed, true);
    }
    public function documentTypeTemplate(): HasMany
    {
        return $this->hasMany(DocumentTypeTemplate::class);
    }

}
