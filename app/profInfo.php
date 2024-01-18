<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class profInfo extends Model
{
    protected $table = 'prof_info';
    protected $fillable = [
        'user_id',
        'contact_num',
        'address',
        'birthday',
        'sex',
        'prof_pic',
    ];
}
