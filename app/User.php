<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

use Carbon\Carbon;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'dpid', 'role', 'phone','storage'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function marchant(){
        return $this->hasOne('App\Merchant');
    }
    public function customer(){
        return $this->hasOne('App\Customer');
    }
    public function storages(){
        return $this->hasOne('App\Storage');
    }
    public function message(){
        return $this->hasOne('App\Merchant');
    }
    public function getCreatedAtAttribute($value){
        return Carbon::parse($value)->diffForHumans();
    }
}
