<?php

namespace App\Models\Side;

use App\Models\User\User;
use App\Models\PersonType;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

    protected $fillable = [
        'name',
        'tax_number',
        'mersis_number',
        'detsis_number',
        'address',
        'phone',
        'fixed_phone',
        "tax_office_id",
        "trade_registry_id",
        "trade_registry_number",
        "kep_address",
        'email',
        'check',
        'user_id',
        "type_id"
    ];

    protected $appends = ['display_name', 'phone'];

    public $with = ["type"];

    public function getDisplayNameAttribute()
    {
        return $this->tax_number . " - " . $this->name;
    }

    public static function selectToArray()
    {
        return self::pluck("name", "id");
    }

    public function type()
    {
        return $this->belongsTo(PersonType::class, "type_id", "id");
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function side()
    {
        return $this->belongsTo(Side::class, "id", "company_id");
    }

    public function getPhoneAttribute()
    {
        return $this->fixed_phone;
    }
}
