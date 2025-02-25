<?php

namespace App\Organizer\Infra;

use Illuminate\Database\Eloquent\Model;

class OrganizerModel extends Model
{
    protected $table = 'organizer';

    /**
     * @var array Rules
     */
    protected $rules = [
        'name' => 'required|max:50',
        'email' => 'required',
        'phone_number' => 'required|string|min:10|max:13',
        'address' => 'required'
    ];

    /**
     * @var array Fillable
     */
    protected $fillable = [
        'name', 
        'email', 
        'phone_number', 
        'address'
    ];

    /**
     * @var array Casts
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}