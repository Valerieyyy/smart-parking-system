<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userInfo extends Model
{
    protected $table = 'user_info_driver';
    protected $fillable = [
        'user_id',
        'rfid',
        'plate_number',
        'vehicle',
    ];
}
