<?php

namespace App\Checkout\Infra;

use Illuminate\Database\Eloquent\Model;
use App\Ticket\Infra\TicketModel;
use App\Attendee\Infra\AttendeeModel;

class CheckoutModel extends Model
{
    protected $table = 'checkouts';

    protected $fillable = [
        'ticket_id', 
        'attendee_id', 
        'quantity',
        'attendee_name',
        'attendee_phone_number', 
        'attendee_email',
        'total_price', 
        'status'
    ];

    public function ticket()
    {
        return $this->belongsTo(TicketModel::class, 'ticket_id');
    }

    public function attendee()
    {
        return $this->belongsTo(AttendeeModel::class, 'attendee_id');
    }
}