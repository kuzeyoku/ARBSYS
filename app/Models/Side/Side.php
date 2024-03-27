<?php

namespace App\Models\Side;

use App\Models\Lawsuit\Lawsuit;
use Illuminate\Database\Eloquent\Model;

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

    public function main_side()
    {
        return $this->hasOne(Side::class, 'id', 'parent_id');
    }

    public function sub_sides()
    {
        return $this->hasMany(Side::class, 'parent_id', 'id')->whereNotIn('side_applicant_type_id', [\ApplicantTypeOptions::WORKER]);
    }

    public function getClaimantsAttribute()
    {
        return Side::where('lawsuit_id', $this->lawsuit_id)->where('side_type_id', \SideTypeOptions::CLAIMANT)->whereIn('side_applicant_type_id', [\ApplicantTypeOptions::INDIVIDUAL, \ApplicantTypeOptions::COMPANY])->get();
    }

    public function getClaimantAttribute()
    {
        return Side::where('lawsuit_id', $this->lawsuit_id)->where('side_type_id', \SideTypeOptions::CLAIMANT)->whereIn('side_applicant_type_id', [\ApplicantTypeOptions::INDIVIDUAL, \ApplicantTypeOptions::COMPANY])->first();
    }

    public function getClaimantLawyerAttribute()
    {
        return Side::where('lawsuit_id', $this->lawsuit_id)->where('side_type_id', \SideTypeOptions::CLAIMANT)->whereIn('side_applicant_type_id', [\ApplicantTypeOptions::LAWYER])->first();
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

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function person()
    {
        return $this->belongsTo(People::class);
    }

    public function lawyer()
    {
        return $this->belongsTo(Lawyer::class);
    }

    public function lawsuit()
    {
        return $this->belongsTo(Lawsuit::class);
    }
}
