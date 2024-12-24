<?php

namespace App\Models\Side;

use App\Models\User\User;
use App\Models\PersonType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        "person_type_id"
    ];

    protected $appends = ['display_name', 'phone'];

    public function getDisplayNameAttribute(): string
    {
        return $this->tax_number . " - " . $this->name;
    }

    public static function selectToArray()
    {
        return self::pluck("name", "id");
    }

    public function personType(): BelongsTo
    {
        return $this->belongsTo(PersonType::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function side(): BelongsTo
    {
        return $this->belongsTo(Side::class, "id", "company_id");
    }

    public function getPhoneAttribute()
    {
        return $this->fixed_phone;
    }
}
