<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Attendance extends Model
{
    protected $table = 'attendance';
    protected $fillable = [
        'user_id',
        'time_in',
        'time_out',
        'slot_id',
        'vehicle_id'
    ];
}
