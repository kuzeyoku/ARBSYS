<?php

namespace App\Models\Side;

use App\Models\Lawsuit\Lawsuit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use SideTypeOptions;

/**
 * @property mixed $person_id
 * @property mixed $company_id
 * @property mixed $lawyer_id
 */
class Side extends Model
{
    public $fillable = [
        "person_id",
        "side_applicant_type_id",
        "company_id",
        "lawsuit_id",
        "lawyer_id",
        "side_type_id",
        "parent_id",
        "user_id",
        "detail"
    ];

    public function detail(): ?BelongsTo
    {
        if ($this->person_id) {
            return $this->person();
        } else if ($this->company_id) {
            return $this->company();
        } else if ($this->lawyer_id) {
            return $this->lawyer();
        }
        return null;
    }

    public function sub_sides(): HasMany
    {
        return $this->hasMany(Side::class, 'parent_id');
    }

    public function person(): BelongsTo
    {
        return $this->belongsTo(People::class, 'person_id');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function lawyer(): BelongsTo
    {
        return $this->belongsTo(Lawyer::class, 'lawyer_id');
    }

    public function scopeClaimant($query)
    {
        return $query->where('side_type_id', SideTypeOptions::CLAIMANT);
    }

    public function scopeDefendant($query)
    {
        return $query->where('side_type_id', SideTypeOptions::DEFENDANT);
    }

    public function side_type(): BelongsTo
    {
        return $this->belongsTo(SideType::class);
    }

    public function side_applicant_type(): BelongsTo
    {
        return $this->belongsTo(SideApplicantType::class);
    }

    public function lawsuit(): BelongsTo
    {
        return $this->belongsTo(Lawsuit::class);
    }

    public function getApplicantTitleAttribute()
    {
        if ($this->side_applicant_type_id == 3) {
            return "Vekili";
        } else if ($this->side_applicant_type_id == 4) {
            return "Yetkilisi";
        } else if ($this->side_applicant_type_id == 5) {
            return "Çalışan";
        } else if ($this->side_applicant_type_id == 6) {
            return "Kanuni Temsilci";
        } else if ($this->side_applicant_type_id == 7) {
            return "Uzman Kişi";
        }
    }

    public function getApplicantTitleCaseAttribute()
    {
        return $this->applicant_title;
    }

    public function getTitleAttribute()
    {
        if ($this->side_applicant_type_id == 1) {
            return "Şahıs";
        } else if ($this->side_applicant_type_id == 2) {
            return "Şirket";
        } else if ($this->side_applicant_type_id == 3) {
            return "Avukat";
        } else if ($this->side_applicant_type_id == 4) {
            return "Yetkili";
        } else if ($this->side_applicant_type_id == 5) {
            return "Çalışan";
        } else if ($this->side_applicant_type_id == 6) {
            return "Kanuni Temsilci";
        } else if ($this->side_applicant_type_id == 7) {
            return "Uzman Kişi";
        } else {
            return "-";
        }
    }


}
