<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParkingReserve extends Model
{
    protected $table = 'parking_reserve';
    protected $fillable = [
        'user_id',
        'parking_id',
    ];
}
