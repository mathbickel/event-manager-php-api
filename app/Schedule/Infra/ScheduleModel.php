<?php

namespace App\Schedule\Infra;

use Illuminate\Database\Eloquent\Model;

class ScheduleModel extends Model
{
    protected $table = 'schedule';

    protected $filalable = [
        'start_time',
        'end_time',
        'start_date',
        'end_date',
    ];
}