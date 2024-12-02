<?php

namespace App\Models\Lawsuit;

use App\Models\Document\Document;
use App\Models\Document\DocumentType;
use App\Models\Document\DocumentTypeTemplate;
use App\Models\Log;
use App\Models\MediationOffice;
use App\Models\Side\Side;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\MediationCenter;
use App\Models\Meeting;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lawsuit extends Model
{

    public $fillable = [
        "delivery_by",
        "lawsuit_type_id",
        "lawsuit_subject_type_id",
        "lawsuit_subject_id",
        "mediation_office_id",
        "application_document_no",
        "mediation_document_no",
        "mediation_center_id",
        "process_start_date",
        "application_date",
        "matters_discussed",
        "job_date",
        "lawsuit_process_type_id",
        "lawsuit_result_type_id",
        "result_date",
        "user_id",
    ];

    public function getDocumentTemplate(DocumentType $documentType)
    {
        $singleTemplates = [1, 2, 3, 6, 7, 8, 9, 10];
        return DocumentTypeTemplate::where('document_type_id', $documentType->id)
            ->where('lawsuit_subject_type_id', $this->lawsuit_subject_type_id)
            ->when(!in_array($documentType->id, $singleTemplates), function ($query) {
                return $query->where('lawsuit_subject_id', $this->lawsuit_subject_id);
            })
            ->first();
    }

    public function mediation_center()
    {
        return $this->belongsTo(MediationCenter::class);
    }

    public function mediation_office()
    {
        return $this->belongsTo(MediationOffice::class);
    }

    public function lawsuit_process_type()
    {
        return $this->belongsTo(LawsuitProcessType::class);
    }

    public function lawsuit_result_type()
    {
        return $this->belongsTo(LawsuitResultType::class);
    }

    public function lawsuit_subject()
    {
        return $this->belongsTo(LawsuitSubject::class);
    }

    public function lawsuit_subject_type()
    {
        return $this->belongsTo(LawsuitSubjectType::class);
    }

    public function lawsuit_type()
    {
        return $this->belongsTo(LawsuitType::class);
    }

    public function notes()
    {
        return $this->hasOne(LawsuitNotes::class);
    }

    public function sides()
    {
        return $this->hasMany(Side::class)->where("parent_id", null);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function logs()
    {
        return $this->hasMany(Log::class)->orderBy('created_at', 'desc');
    }

    public function getHasMeetingProtocolAttribute()
    {
        return $this->documents()->where('document_type_id', 5)->exists();
    }

    public function getHasFinalProtocolAttribute()
    {
        return $this->documents()->where('document_type_id', 7)->exists();
    }

    public function getClaimants()
    {
        return $this->sides()->where('side_type_id', \SideTypeOptions::CLAIMANT)->get();
    }

    public function getDefendants()
    {
        return $this->sides()->where('side_type_id', \SideTypeOptions::DEFENDANT)->get();
    }

    public function getSubjectTypeAttribute()
    {
        return $this->lawsuit_subject_type->name ?? "";
    }

    public function getSubjectAttribute()
    {
        return $this->lawsuit_subject->name ?? "";
    }

    public function getClaimantTypeAttribute()
    {
        $side = Side::where('lawsuit_id', $this->id)->where('side_type_id', \SideTypeOptions::CLAIMANT)->whereIn('side_applicant_type_id', [\ApplicantTypeOptions::INDIVIDUAL, \ApplicantTypeOptions::COMPANY])->first();

        return !is_null($side) ? $side->side_applicant_type_id : null;
    }

    public function getClaimantAttribute()
    {
        return $this->sides()->where('side_type_id', \SideTypeOptions::CLAIMANT)->whereIn('side_applicant_type_id', [\ApplicantTypeOptions::INDIVIDUAL, \ApplicantTypeOptions::COMPANY])->first();
    }

    public function getDefendantAttribute()
    {
        return $this->sides()->where('side_type_id', \SideTypeOptions::DEFENDANT)->whereIn('side_applicant_type_id', [\ApplicantTypeOptions::INDIVIDUAL, \ApplicantTypeOptions::COMPANY])->first();
    }

    public function getDisagreementTemplateAttribute()
    {
        return \App\Services\Document\InvitationLetterService::getDisagreement($this);
    }

    public function meeting()
    {
        return $this->hasOne(Meeting::class);
    }

    public function getMeetingDateAttribute()
    {
        return $this->meeting->date ?? null;
    }

    public function getMeetingStartHourAttribute()
    {
        return $this->meeting->start_hour ?? null;
    }



    function getClaimantNameAttribute()
    {
        $sides = Side::where('lawsuit_id', $this->id)->where('side_type_id', \SideTypeOptions::CLAIMANT)->whereIn('side_applicant_type_id', [\ApplicantTypeOptions::INDIVIDUAL, \ApplicantTypeOptions::COMPANY])->get();
        $names = "";
        if (!is_null($sides)) {
            if ($sides->count() > 1) {
                foreach ($sides as $index => $side) {
                    $names .= (isset($side->detail) ? $side->detail->name : "") . ($index != $sides->count() ? ", " : "");
                }
            } else {
                return $names = isset($sides[0]->detail) ? $sides[0]->detail->name : "";
            }
        }
        return $names;
    }

    public function getDefendantNameAttribute()
    {
        $sides = Side::where('lawsuit_id', $this->id)->where('side_type_id', \SideTypeOptions::DEFENDANT)->whereIn('side_applicant_type_id', [\ApplicantTypeOptions::INDIVIDUAL, \ApplicantTypeOptions::COMPANY])->get();
        $names = "";
        if (!is_null($sides)) {
            if ($sides->count() > 1) {
                foreach ($sides as $index => $side) {
                    $names .= (isset($side->detail) ? $side->detail->name : "") . ($index != $sides->count() ? ", " : "");
                }
            } else {
                return $names = isset($sides[0]->detail) ? $sides[0]->detail->name : "";
            }
        }
        return $names;
    }

    // public function getSubjectAttribute()
    // {
    //     return (($this->lawsuit_subject_type->name ?? "") . " (" . ($this->lawsuit_subject->name ?? "") . ")") ?? ($this->udf_subject ?? "");
    // }

    public function getMeetingCountAttribute()
    {
        return $this->documents->where('document_type_id', 5)->count();
    }

    protected static function booted()
    {
        static::addGlobalScope('user_id', function (Builder $builder) {
            $builder->where('user_id', auth()->id());
        });
    }

    public function getMediationDocumentNumberAttribute()
    {
        $data = explode('/', $this->mediation_document_no);

        return $data[1] ?? $this->mediation_document_no;
    }

    public function getFirmDocumentNumberAttribute()
    {
        $data = explode('/', $this->firm_document_no);

        return $data[1] ?? $this->firm_document_no;
    }

    // public function getMeetingTemplateAttribute()
    // {
    //     return LawsuitService::getTemplate($this, 5, 'meeting');
    // }

    public function getLastTimeAttribute()
    {
        $addDay = null;
        $now = Carbon::today();
        $type_ids = [1, 3, 4, 5]; //Dava Şartı Kapsamında
        if (in_array($this->lawsuit_type_id, $type_ids)) {
            $accept_date = Carbon::parse($this->job_date);
            if ($this->lawsuit_subject_type_id == 1) {
                $addDay = $accept_date->addDay(28);
            } elseif ($this->lawsuit_subject_type_id == 2) {
                $addDay = $accept_date->addDay(56);
            } elseif ($this->lawsuit_subject_type_id == 3) {
                $addDay = $accept_date->addDay(28);
            }
        }
        if (!is_null($addDay)) {
            $result = "<span class='text-success'>" . $addDay->format('d.m.Y') . "</span>";
            if ($now->gte($addDay)) {
                $result = "<span class='text-danger'>" . $addDay->format('d.m.Y') . "</span>";
            }
            return $result;
        }
        return "-";
    }


    public function getProcessStatus()
    {
        $statuses = [
            1 => ['title' => 'Açık', 'progress' => 25],
            2 => ['title' => 'Toplantı günü verildi', 'progress' => 50],
            3 => ['title' => 'Görüşmeler başladı / sürüyor', 'progress' => 75],
            4 => ['title' => 'Süreç sona erdi', 'progress' => 100],
            5 => ['title' => 'Dosya sistemden kapatıldı', 'progress' => 100],
        ];

        $type = $this->lawsuit_process_type_id;

        return '<div class="d-flex flex-column"><strong class="pb-2">' . $statuses[$type]["title"] . '</strong><div class="progress">
                <div class="progress-bar progress-bar-striped" role="progressbar" style="width: ' . $statuses[$type]["progress"] . '%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
              </div></div>';
    }

    public function getProcessStartDateAttribute()
    {
        if ($this->mediation_office)
            return $this->application_date;
        return $this->process_start_date;
    }
}
