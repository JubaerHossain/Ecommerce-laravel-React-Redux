<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    protected $fillable = [
        'storage', 'user_id',
    ];
    public function marchant(){
        return $this->belongsTo('App\Merchant');
    }
}
