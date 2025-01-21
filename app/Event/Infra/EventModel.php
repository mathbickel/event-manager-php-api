<?php

namespace App\Event\Infra;

use App\Event\Domain\Event;
use Illuminate\Database\Eloquent\Model;

class EventModel extends Model
{
    protected $table = 'event';
    
    protected $fillable = [
        'id',
        'name',
        'description',
        'date',
        'organizer_id',
        'created_at',
        'updated_at',
    ];
}