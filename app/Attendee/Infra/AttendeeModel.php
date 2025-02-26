<?php

namespace App\Attendee\Infra;

use Illuminate\Database\Eloquent\Model;
use App\Ticket\Infra\TicketModel;
use App\Notifications\Infra\NotificationsModel;
class AttendeeModel extends Model
{
    protected $table = 'attendee';

    /**
     * @var array Rules
     */
    public static $rules = [
        'ticket_id' => 'required',
        'name' => 'required|max:50',
        'email' => 'required',
        'phone_number' => 'required|string|min:10|max:13',
    ];

    /**
     * @var array Fillable
     */
    protected $fillable = [
        'ticket_id',
        'name',
        'email',
        'phone_number',
    ];

    /**
     * @var array Casts
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function ticket()
    {
        return $this->hasOne(TicketModel::class, 'ticket_id');
    }

    public function notifications()
    {
        return $this->hasMany(NotificationsModel::class, 'attendee_id', 'id');
    }

}   