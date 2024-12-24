<?php

namespace App\Models\Side;

use App\Models\Lawsuit\Lawsuit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        "user_id"
    ];

    public function detail()
    {
        if (!is_null($this->person_id))
            return $this->belongsTo(People::class, 'person_id');
        elseif (!is_null($this->company_id))
            return $this->belongsTo(Company::class, 'company_id');
        elseif (!is_null($this->lawyer_id))
            return $this->belongsTo(Lawyer::class, 'lawyer_id');
    }

    public function main_side(): HasOne
    {
        return $this->hasOne(Side::class, 'id', 'parent_id');
    }

    public function sub_sides(): HasMany
    {
        return $this->hasMany(Side::class, 'parent_id');
    }

    public function getLawyerAttribute()
    {
        return Side::where("lawsuit_id", $this->lawsuit_id)->where("parent_id", $this->id)->first();
    }

    public function getDefendantsAttribute()
    {
        return Side::where('lawsuit_id', $this->lawsuit_id)->where('side_type_id', \SideTypeOptions::DEFENDANT)->whereIn('side_applicant_type_id', [1, 2])->get();
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

    public function side_type()
    {
        return $this->belongsTo(SideType::class);
    }

    public function side_applicant_type()
    {
        return $this->belongsTo(SideApplicantType::class);
    }

    public function company(): HasMany
    {
        return $this->hasMany(Company::class);
    }

    public function person(): HasMany
    {
        return $this->hasMany(People::class);
    }

    public function lawyer(): HasMany
    {
        return $this->hasMany(Lawyer::class);
    }

    public function lawsuit(): HasMany
    {
        return $this->hasMany(Lawsuit::class);
    }
}
