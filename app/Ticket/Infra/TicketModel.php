<?php

namespace App\Ticket\Infra;

use App\Event\Infra\EventModel;
use Illuminate\Database\Eloquent\Model;
class TicketModel extends Model
{
    protected $table = 'ticket';

    /**
     *  @var array Rules
     */
    protected $rules = [
        'event_id' => 'required',
        'name' => 'required|unique:name|max:50',
        'type' => 'required',
        'price' => 'required|decimal',
        'status' => 'required|string|in:available,unavailable',
    ];

    /**
     * @var array Fillable
     */
    protected $fillable = [
        'event_id',
        'name',
        'type',
        'price',
        'status'
    ];

    /**
     * @var array Cast
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function event()
    {
        return  $this->belongsTo(EventModel::class, 'ticket_id');
    }
}