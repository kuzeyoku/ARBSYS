<?php

namespace App\Models\Lawsuit;

use Illuminate\Database\Eloquent\Model;
use App\Models\Document\DocumentTypeTemplate;

class LawsuitSubject extends Model
{

    public $fillable = ["lawsuit_subject_type_id", "name"];

    public function DocumentTypeTemplates()
    {
        return $this->hasMany(DocumentTypeTemplate::class);
    }

    public static function getMattersDiscussed(Lawsuit $lawsuit)
    {
        $matters_discussed = [];
        if ($lawsuit->lawsuit_subject_id) {
            $lawsuit_subject = LawsuitSubject::find($lawsuit->lawsuit_subject_id);
            if ($lawsuit_subject->matters_discussed) {
                $matters_discussed = json_decode($lawsuit_subject->matters_discussed, true);
            }
        }
        return $matters_discussed;
    }
}
