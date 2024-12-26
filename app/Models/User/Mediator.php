<?php

namespace App\Models\User;

use App\Models\Side\Lawyer;
use App\Models\Side\People;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mediator extends Model
{

    protected $fillable = [
        "user_id",
        "registration_no",
        "iban",
        "meeting_address",
    ];

    protected $appends = [
        'logo'
    ];

    public function people(): HasMany
    {
        return $this->hasMany(People::class);
    }

    public function lawyers(): HasMany
    {
        return $this->hasMany(Lawyer::class);
    }

    public function companies(): HasMany
    {
        return $this->hasMany(Company::class);
    }

    public function getPathAttribute()
    {
        $path = public_path('files/mediators/');

        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        $path = public_path('/files/mediators/' . $this->id);

        if (!is_dir($path)) {
            mkdir($path, 0777);
        }

        return $path . "/";
    }

    public function getDefaultMediationCenterAttribute()
    {
        return $this->meeting_address_proposal ? $this->mediation_center_id : null;
    }

    public function getPathLogoAttribute()
    {
        return $this->path . $this->letter_logo;
    }


    public function getLogoAttribute()
    {
        return !is_null($this->letter_logo) ? asset('/files/mediators/' . $this->id . '/' . $this->letter_logo) : "";
    }
}
