<?php

namespace App\Ticket\PurchasedTicket\Infra;

use App\Ticket\Infra\TicketModel;
use Illuminate\Database\Eloquent\Model;

class PurchasedTicketModel extends Model
{
    protected $table = 'purchased_tickets';

    /**
     *  @var array Rules
     */
    public static $rules = [
        'ticket_id' => 'required',
        'status' => 'required|string|in:available,unavailable',
    ];

    /**
     * @var array Fillable
     */
    protected $fillable = [
        'id',
        'ticket_id',
        'status'
    ];

    /**
     * @var array Cast
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function ticket()
    {
        return $this->belongsTo(TicketModel::class, 'ticket_id');
    }
}