<?php

namespace App\Notifications\Infra;

use Illuminate\Database\Eloquent\Model;

class NotificationsModel extends Model
{
    protected $table = 'notifications';

    protected $fillable = [
        'id',
        'title',
        'description',
        'event_id',
        'user_id',
    ];
}