<?php

namespace App\Organizer\Infra;

use Illuminate\Database\Eloquent\Model;
use App\Event\Infra\EventModel;

class OrganizerModel extends Model
{
    protected $table = 'organizer';

    protected $fillable = [
        'name', 
        'email', 
        'phone_number', 
        'address'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function event()
    {
        return  $this->hasMany(EventModel::class, 'organizer_id', 'id')->orderBy('date', 'desc');
    }
}