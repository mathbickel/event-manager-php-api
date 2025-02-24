<?php

namespace App\Event\Infra;

use App\Organizer\Infra\OrganizerModel;
use App\Schedule\Infra\ScheduleModel;
use Illuminate\Database\Eloquent\Model;

class EventModel extends Model
{
    protected $table = 'event';
    
    protected $fillable = [
        'organizer_id',
        'name',
        'description',
        'location',
        'address'
    ];

    public function Organizer()
    {
        return $this->belongsTo(OrganizerModel::class, 'organizer_id', 'id');
    }

    public function Schedule()
    {
        return $this->hasOne(ScheduleModel::class, 'event_id', 'id');
    }
}