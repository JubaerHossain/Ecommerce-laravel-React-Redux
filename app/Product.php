<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;

class Product extends Model
{
	protected $table = 'products';
    protected $fillable = ['thumbnail','name','merchant_id','slug','stock','brand','price','s_price','details','status','adstatus','category_id', 'string', 'images'
];

    public function merchant(){
        return $this->belongsTo('App\Merchant');
    }
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function variations()
    {
        return $this->hasMany('App\Variation');
    }
    public function colors()
    {
        return $this->hasMany('App\Color');
    }
    public function messages(){
        return $this->hasMany('App\Message');
    }
    public function properties()
    {
        return $this->hasOne('App\Property');
    }
    public function discount()
    {
        return $this->hasOne('App\Discount');
    }
    public function reviews()
    {
        return $this->hasMany('App\Review');
    }
    public function categories()
    {
        return Category::select('name')->whereIn('id', explode(',', $this->string))->get();
    }
    
}
