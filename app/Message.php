<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function users()
    {
        return User::select('name')->whereIn('id', $this->sender)->get();
    }
}
