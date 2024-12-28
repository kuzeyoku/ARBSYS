<?php

namespace App\Models\Lawsuit;

use App\Models\Document\Document;
use App\Models\Log;
use App\Models\MediationOffice;
use App\Models\Side\Side;
use App\Models\User\User;
use App\Services\Document\InvitationLetterService;
use Carbon\Carbon;
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

    protected $with = [
        "lawsuit_process_type",
        "lawsuit_result_type",
        "lawsuit_subject_type",
        "lawsuit_subject",
        "lawsuit_type",
        "notes",
        "sides",
        "documents",
        "logs",
        "user",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
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
        return json_decode($this->matters_discussed, true) ?? [];
    }

    public function getMattersDiscussedToStringAttribute(): ?string
    {
        if (count($this->matters_discussed_to_array) == 0) return null;
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
        return $this->hasMany(Side::class)->whereNull("parent_id");
    }

    public function claimants()
    {
        return $this->sides->where('side_type_id', SideTypeOptions::CLAIMANT);
    }

    public function defendants()
    {
        return $this->sides->where('side_type_id', SideTypeOptions::DEFENDANT);
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
        if (is_array($document_type_id)) {
            return $this->documents->where('document_type_id', $document_type_id)->isNotEmpty();
        }
        return $this->documents->where('document_type_id', $document_type_id)->isNotEmpty();
    }

    public function getDisagreementTemplateAttribute(): string
    {
        return InvitationLetterService::getDisagreement($this);
    }

    public function meeting(): HasOne
    {
        return $this->hasOne(Meeting::class);
    }


    function getClaimantNameAttribute(): ?string
    {
        $claimants = $this->sides->where('side_type_id', SideTypeOptions::CLAIMANT);
        $names = "";
        if ($claimants->isNotEmpty()) {
            if ($claimants->count() > 1) {
                foreach ($claimants as $index => $side) {
                    $names .= (isset($side->detail) ? $side->detail->name : "") . ($index != $claimants->count() ? ", " : "");
                }
            } else {
                $names = $claimants[0]->detail->name ?? null;
            }
        }
        return $names;
    }

    public function getDefendantNameAttribute(): string
    {
        $defendants = $this->sides->where('side_type_id', SideTypeOptions::DEFENDANT);
        $names = "";
        if ($defendants->isNotEmpty()) {
            foreach ($defendants as $index => $side) {
                $names .= isset($side->detail) ? Str::limit($side->detail->name, 20) : "";
                $names .= $index < $defendants->count() - 1 ? ", " : "";
            }
        }
        return $names;
    }

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

        return '<div class="d-flex flex-column"><strong class="pb-2">' . $statuses[$type]["title"] . '</strong><div class="progress">
                <div class="progress-bar progress-bar-striped" role="progressbar" style="width: ' . $statuses[$type]["progress"] . ' % " aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
              </div></div>';
    }

    public function getProcessStartDateAttribute()
    {
        if ($this->mediation_office)
            return $this->application_date;
        return $this->process_start_date;
    }
}
