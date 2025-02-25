<?php

namespace App\Notifications\Infra;

use Illuminate\Database\Eloquent\Model;
use App\Attendee\Infra\AttendeeModel;

class NotificationsModel extends Model
{
    protected $table = 'notifications';

    protected $fillable = [
        'id',
        'attendee_id',
        'message',
        'status'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function attendee()
    {
        return $this->belongsTo(AttendeeModel::class, 'attendee_id', 'id');
    }
}