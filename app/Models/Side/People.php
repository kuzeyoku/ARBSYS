<?php

namespace App\Models\Side;

use App\Models\PersonType;
use App\Models\User\User;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{

    protected $fillable = [
        'name',
        'identification',
        'address',
        'phone',
        'fixed_phone',
        "tax_office_id",
        'email',
        'user_id',
        'check',
        'type_id',
        "kep_address",
    ];

    protected $appends = ['display_name'];

    public $with = ["type"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getDisplayNameAttribute()
    {
        return $this->identification . " - " . $this->name;
    }

    public function type()
    {
        return $this->belongsTo(PersonType::class, "type_id", "id");
    }

    public function side()
    {
        return $this->belongsTo(Side::class, "id", "person_id");
    }

    public static function selectToArray()
    {
        $peoples = People::whereUserId(auth()->id())->get();

        foreach ($peoples as $people) {
            $data[$people->id] = $people->name . " - (" . $people->identification . ")";
        }
        return $data ?? [];
    }
}
