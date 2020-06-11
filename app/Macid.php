<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Macid extends Model
{
    protected $fillable = [
        'merchant_id', 'dlpid', 'user_id', 'macid',
    ];
}
