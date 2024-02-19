<?php

namespace App\Models\User;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $with = ["mediator"];

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

    public function mediator()
    {
        return $this->hasOne(Mediator::class);
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
