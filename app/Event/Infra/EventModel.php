<?php

namespace App\Event\Infra;

use App\Organizer\Infra\OrganizerModel;
use Illuminate\Database\Eloquent\Model;

class EventModel extends Model
{
    protected $table = 'event';
    
    protected $fillable = [
        'organizer_id',
        'name',
        'description',
        'location',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function Organizer()
    {
        return $this->belongsTo(OrganizerModel::class, 'organizer_id', 'id');
    }
}