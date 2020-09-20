<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    protected $fillable = [
        'name'
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
