<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'name', 'local_id'
    ];

    public function local()
    {
        return $this->belongsTo(Local::class);
    }
}
