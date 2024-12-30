<?php

namespace App\Models\User;

use App\Models\Notification\Notification;
use App\Models\Side\Company;
use App\Models\Side\Lawyer;
use App\Models\Side\People;
use App\Models\System\SystemRequest;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $with = ["mediator", "notifications", "requests"];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "name",
        "gender",
        "email",
        "borndate",
        "phone",
        "password",
        "address",
        "change_request",
        "role_id",
        "end",
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function parent()
    {
        return $this->belongsTo(User::class, "parent_id");
    }

    public function mediator(): HasOne
    {
        return $this->hasOne(Mediator::class, "user_id");
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }

    public function requests(): HasMany
    {
        return $this->hasMany(SystemRequest::class);
    }

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

    public function getRemainingDayAttribute()
    {
        $now = strtotime(\Carbon\Carbon::now());
        $end = strtotime($this->end);
        $diff = ($end - $now) / 86400;
        return intval($diff);
    }

    public function getChange()
    {
        return User::where("parent_id", $this->id)->where("change_request", TRUE)->first();
    }

}
