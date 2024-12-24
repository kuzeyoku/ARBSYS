<?php

namespace App\Models\Lawsuit;

use App\Models\Document\Document;
use App\Models\Document\DocumentType;
use App\Models\Document\DocumentTypeTemplate;
use App\Models\Log;
use App\Models\MediationOffice;
use App\Models\Side\Side;
use App\Services\Document\InvitationLetterService;
use ApplicantTypeOptions;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\MediationCenter;
use App\Models\Meeting;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;
use SideTypeOptions;

/**
 * @property false|mixed $is_archive
 * @property mixed $defendants
 * @method static whereIsArchive(int $int)
 */
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

    public function scopeArchive($query)
    {
        return $query->where('is_archive', 1);
    }

    public function scopeActive($query)
    {
        return $query->where('is_archive', 0);
    }

    public function mediation_center(): BelongsTo
    {
        return $this->belongsTo(MediationCenter::class);
    }

    public function mediation_office(): BelongsTo
    {
        return $this->belongsTo(MediationOffice::class);
    }

    public function lawsuit_process_type(): BelongsTo
    {
        return $this->belongsTo(LawsuitProcessType::class);
    }

    public function lawsuit_result_type(): BelongsTo
    {
        return $this->belongsTo(LawsuitResultType::class);
    }

    public function lawsuit_subject(): BelongsTo
    {
        return $this->belongsTo(LawsuitSubject::class);
    }

    public function getMattersDiscussedToArrayAttribute()
    {
        return json_decode($this->attributes['matters_discussed']);
    }

    public function getMattersDiscussedToStringAttribute()
    {
        $result = array_intersect_key($this->lawsuit_subject->matters_discussed_to_array, array_flip($this->matters_discussed_to_array));
        $implode = implode(", ", $result);
        return Str::lower($implode);
    }

    public function lawsuit_subject_type(): BelongsTo
    {
        return $this->belongsTo(LawsuitSubjectType::class);
    }

    public function lawsuit_type(): BelongsTo
    {
        return $this->belongsTo(LawsuitType::class);
    }

    public function notes(): HasOne
    {
        return $this->hasOne(LawsuitNotes::class);
    }

    public function sides(): HasMany
    {
        return $this->hasMany(Side::class)->where("parent_id", null);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }

    public function logs(): HasMany
    {
        return $this->hasMany(Log::class)->orderBy('created_at', 'desc');
    }

    public function hasDocument($document_type_id): bool
    {
        return $this->documents()->where("document_type_id", $document_type_id)->exists();
    }

    public function getHasMeetingProtocolAttribute(): bool
    {
        return $this->documents()->where('document_type_id', 5)->exists();
    }

    public function getHasFinalProtocolAttribute(): bool
    {
        return $this->documents()->where('document_type_id', 7)->exists();
    }

    public function getSubjectTypeAttribute()
    {
        return $this->lawsuit_subject_type->name ?? "";
    }

    public function getSubjectAttribute()
    {
        return $this->lawsuit_subject->name ?? "";
    }

    public function getClaimantsAttribute(): Collection
    {
        return $this->sides()->where('side_type_id', SideTypeOptions::CLAIMANT)->whereNull("parent_id")->get();
    }

    public function getDefendantsAttribute(): Collection
    {
        return $this->sides()->where('side_type_id', SideTypeOptions::DEFENDANT)->whereNull("parent_id")->get();
    }

    public function getDisagreementTemplateAttribute(): string
    {
        return InvitationLetterService::getDisagreement($this);
    }

    public function meeting(): HasOne
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
        $sides = Side::where('lawsuit_id', $this->id)->where('side_type_id', SideTypeOptions::CLAIMANT)->whereIn('side_applicant_type_id', [ApplicantTypeOptions::INDIVIDUAL, ApplicantTypeOptions::COMPANY])->get();
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

    public function getDefendantNameAttribute(): string
    {
        $names = "";
        if ($this->defendants->isNotEmpty())
            foreach ($this->defendants as $index => $side) {
                $names .= isset($side->detail) ? Str::limit($side->detail->name, 20) : "";
                $names .= $index < $this->defendants->count() - 1 ? ", " : "";
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
            $builder->where('user_id', auth()->user()->id);
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

    public function getLastTimeAttribute(): string
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
            $result = " <span class='text-success' > " . $addDay->format('d.m.Y') . "</span > ";
            if ($now->gte($addDay)) {
                $result = "<span class='text-danger' > " . $addDay->format('d.m.Y') . "</span > ";
            }
            return $result;
        }
        return " - ";
    }


    public function getProcessStatus(): string
    {
        $statuses = [
            1 => ['title' => 'Açık', 'progress' => 25],
            2 => ['title' => 'Toplantı günü verildi', 'progress' => 50],
            3 => ['title' => 'Görüşmeler başladı / sürüyor', 'progress' => 75],
            4 => ['title' => 'Süreç sona erdi', 'progress' => 100],
            5 => ['title' => 'Dosya sistemden kapatıldı', 'progress' => 100],
        ];

        $type = $this->lawsuit_process_type_id;

        return '<div class="d - flex flex - column"><strong class="pb - 2">' . $statuses[$type]["title"] . '</strong><div class="progress">
                <div class="progress - bar progress - bar - striped" role="progressbar" style="width: ' . $statuses[$type]["progress"] . ' % " aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
              </div></div>';
    }

    public function getProcessStartDateAttribute()
    {
        if ($this->mediation_office)
            return $this->application_date;
        return $this->process_start_date;
    }
}
