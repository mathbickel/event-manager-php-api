<?php

namespace App\Schedule\Infra;

use App\Event\Infra\EventModel;
use Illuminate\Database\Eloquent\Model;

class ScheduleModel extends Model
{
    protected $table = 'schedule';

    protected $filalable = [
        'event_id',
        'start_time',
        'end_time',
        'start_date',
        'end_date',
    ];

    public function Organizer()
    {
        return $this->belongsTo(EventModel::class, 'event_id', 'id');
    }
}