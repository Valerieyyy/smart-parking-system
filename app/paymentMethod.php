<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class paymentMethod extends Model
{
    protected $table = 'payment';
    protected $fillable = [
        'user_id',
        'rate_name',
        'type',
        'rate',
        'category',
        'status'
    ];
}
