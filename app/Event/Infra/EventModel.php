<?php

namespace App\Event\Infra;

use App\Organizer\Infra\OrganizerModel;
use App\Schedule\Infra\ScheduleModel;
use App\Ticket\Infra\TicketModel;
use Illuminate\Database\Eloquent\Model;

class EventModel extends Model
{
    protected $table = 'event';
    
    /**
     * @var array Rules
     */
    public static $rules = [
        'name' => 'required|max:50',
        'organizer_id' => 'required',
        'description' => 'required|string|max:255',
        'location' => 'required',
        'address' => 'required'
    ];

    /**
     * @var array Fillable
     */
    protected $fillable = [
        'organizer_id',
        'name',
        'description',
        'location',
        'address'
    ];

    /**
     * @var array Casts
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function Organizer()
    {
        return $this->hasOne(OrganizerModel::class, 'organizer_id', 'id');
    }

    public function Schedule()
    {
        return $this->hasOne(ScheduleModel::class, 'event_id', 'id');
    }

    public function Ticket()
    {
        return $this->hasMany(TicketModel::class, 'event_id', 'id');
    }
}