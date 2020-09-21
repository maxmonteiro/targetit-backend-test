<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scheduling extends Model
{
    protected $fillable = [
        'date_scheduling',
        'time_start',
        'time_end',
        'user_id',
        'room_id'
    ];
}
