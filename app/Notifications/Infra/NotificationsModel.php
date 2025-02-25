<?php

namespace App\Notifications\Infra;

use Illuminate\Database\Eloquent\Model;
use App\Attendee\Infra\AttendeeModel;

class NotificationsModel extends Model
{
    protected $table = 'notifications';

    /**
     * @var array Rules
     */
    protected $rules = [
        'attendee_id' => 'required',
        'message' => 'required|string|max:255',
        'status' => 'required|string|in:sended,not_sended',
    ];
    
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