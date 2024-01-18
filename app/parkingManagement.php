<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class parkingManagement extends Model
{
    protected $table = 'parking_management';
    protected $fillable = [
        'user_id',
        'parking_code',
        'time_in',
        'time_out',
        'vehicle_cat_id',
        'rate_id',
        'slot_id',
        'total_time',
        'total_amount',
        'paid_status',
        
    ];
}
