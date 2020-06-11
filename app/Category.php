<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    public function father()
    {
        return $this->belongsTo(Category::class, 'parent');
    }
    public function child()
    {
        return $this->hasMany(Category::class, 'parent');
    }

    public function products()
    {
        return $this->hasMany('App\Product');
    }
}
