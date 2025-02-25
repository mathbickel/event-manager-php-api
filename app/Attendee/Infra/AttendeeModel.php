<?php

namespace App\Attendee\Infra;

use Illuminate\Database\Eloquent\Model;
use App\Ticket\Infra\TicketModel;
use App\Notifications\Infra\NotificationsModel;
class AttendeeModel extends Model
{
    protected $table = 'attendee';

    protected $fillable = [
        'ticket_id',
        'name',
        'email',
        'phone_number',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function ticket()
    {
        return $this->belongsTo(TicketModel::class, 'ticket_id', 'id');
    }

    public function notifications()
    {
        return $this->hasMany(NotificationsModel::class, 'attendee_id', 'id');
    }

}   