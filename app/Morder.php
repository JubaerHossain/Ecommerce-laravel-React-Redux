<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Morder extends Model
{
    public function product(){
        return $this->belongsTo('App\Product');
    }
}
