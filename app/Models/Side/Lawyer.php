<?php

namespace App\Models\Side;

use App\Models\Baro;
use App\Models\User\User;

use App\Models\PersonType;
use Illuminate\Database\Eloquent\Model;

class Lawyer extends Model
{
    protected $fillable = [
        'name',
        'identification',
        'address',
        'phone',
        'fixed_phone',
        'email',
        'user_id',
        'check',
        'type_id',
        'baro_id',
        'registration_no',
        "type_id",
    ];

    protected $appends = ['display_name', 'baro_name'];

    public $with = ["type"];

    public function getDisplayNameAttribute()
    {
        return $this->identification . " - " . $this->name;
    }

    public function type()
    {
        return $this->belongsTo(PersonType::class, "type_id", "id");
    }

    public function getNameAttribute()
    {
        $name = $this->getAttributes()['name'];
        if (strtolower(mb_substr($name, 0, 2, "UTF-8")) == "av")
            return "Av." . mb_substr($name, 3, strlen($name), "UTF-8");
        return "Av. " . $name;
    }

    public function getBaroNameAttribute()
    {
        return $this->baro->name ?? "";
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function baro()
    {
        return $this->belongsTo(Baro::class);
    }

    public function side()
    {
        return $this->belongsTo(Side::class, "id", "lawyer_id");
    }
}
