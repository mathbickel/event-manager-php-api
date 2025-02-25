<?php

namespace App\Attendee\Infra;

use Illuminate\Database\Eloquent\Model;
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
}   