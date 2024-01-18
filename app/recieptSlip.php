<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class recieptSlip extends Model
{
    protected $table = 'receipt';
    protected $fillable = [
        'user_id',
        'company_name',
        'address',
        'message',
        'currency',
    ];
}
