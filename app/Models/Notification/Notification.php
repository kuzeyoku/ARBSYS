<?php

namespace App\Models\Notification;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        "notification_category_id",
        'text',
        'user_id',
        'is_read',
    ];
}
