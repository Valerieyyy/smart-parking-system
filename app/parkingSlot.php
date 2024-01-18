<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class parkingSlot extends Model
{
    protected $table = 'parking';
    protected $fillable = [
        'user_id',
        'slot',
        'active',
        'availability'
    ];
}
