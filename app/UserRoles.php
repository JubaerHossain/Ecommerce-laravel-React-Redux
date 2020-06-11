<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRoles extends Model
{
    protected $table = 'user_roles';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id', 'user_id'
    ];
}
