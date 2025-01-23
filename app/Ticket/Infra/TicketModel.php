<?php

namespace App\Ticket\Infra;

use Illuminate\Database\Eloquent\Model;
class TicketModel extends Model
{
    protected $table = 'ticket';

    protected $fillable = [
        'id',
        'event_id',
        'type',
        'price',
        'status'
    ];
}