<?php

namespace App\Schedule\Infra;

use App\Event\Infra\EventModel;
use Illuminate\Database\Eloquent\Model;

class ScheduleModel extends Model
{
    protected $table = 'schedule';

    /**
     * @var array Rules
     */
    public static $rules = [
        'event_id' => 'required',
        'start_time' => 'required|date_format:H:i',
        'end_time' => 'required|date_format:H:i',
        'start_date' => 'required|date|date_format:Y-m-d',
        'end_date' => 'required|date|date_format:Y-m-d',
    ];

    /**
     * @var array Fillable
     */
    protected $fillable = [
        'event_id',
        'start_time',
        'end_time',
        'start_date',
        'end_date',
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
        return $this->belongsTo(EventModel::class, 'event_id', 'id');
    }
}