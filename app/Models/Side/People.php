<?php

namespace App\Models\Side;

use App\Models\PersonType;
use App\Models\User\User;

use App\Services\HelperService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'person_type_id',
        "kep_address",
    ];

    protected $appends = ['display_name'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getDisplayNameAttribute(): string
    {
        return $this->identification . " - " . $this->name;
    }

    public function personType(): BelongsTo
    {
        return $this->belongsTo(PersonType::class);
    }

    public static function selectToArray(): array
    {
        $peoples = People::whereUserId(auth()->id())->get();

        foreach ($peoples as $people) {
            $data[$people->id] = $people->name . " - (" . $people->identification . ")";
        }
        return $data ?? [];
    }
}
