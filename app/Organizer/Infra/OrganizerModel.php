<?php

namespace App\Organizer\Infra;

use Illuminate\Database\Eloquent\Model;

class OrganizerModel extends Model
{
    protected $table = 'organizer';

    protected $fillable = [
        'name', 'email', 'phone_number', 'address'
    ];
}