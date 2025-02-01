<?php

namespace App\Event\Infra;

use App\Organizer\Infra\OrganizerModel;
use Illuminate\Database\Eloquent\Model;

class EventModel extends Model
{
    protected $table = 'event';
    
    protected $fillable = [
        'id',
        'name',
        'description',
        'date',
        'organizer_id'
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function Organizer()
    {
        return $this->hasOne(OrganizerModel::class, 'id', 'organizer_id');
    }
}