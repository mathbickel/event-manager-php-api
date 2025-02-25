<?php

namespace App\Ticket\Infra;

use App\Event\Infra\EventModel;
use Illuminate\Database\Eloquent\Model;
class TicketModel extends Model
{
    protected $table = 'ticket';

    protected $fillable = [
        'event_id',
        'name',
        'type',
        'price',
        'status'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function event()
    {
        return  $this->hasMany(EventModel::class, 'ticket_id', 'id')->orderBy('id', 'desc');
    }
}