<?php

namespace App\Ateendee\Infra;

use App\Attendee\Domain\Attendee;
use App\Attendee\Domain\AttendeeRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class AttendeeRepositoryModel extends Model
{
    protected $table = 'attendee';

    protected $fillable = [
        'event_id',
        'user_id',
        'ticket_id',
    ];
}   